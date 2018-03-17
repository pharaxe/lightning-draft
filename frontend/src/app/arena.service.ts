import { Observable } from "rxjs/Observable";
import { of } from 'rxjs/observable/of';
import 'rxjs/add/operator/map';
import { Type } from "@angular/core";
import { Subject } from 'rxjs/Subject';

import { Card, basic_lands } from './card';
import { Draft } from './draft';
import { Color } from './color';

import {HttpClient, HttpHeaders} from '@angular/common/http';

import {Inject} from '@angular/core'
import {Injectable} from '@angular/core'
import { UUID } from 'angular2-uuid';
import {PersistenceService} from 'angular-persistence';
import {StorageType} from 'angular-persistence';

@Injectable()
export class ArenaService { 
   deck: Card[];
   pack: Card[];
   draft: Draft;
   private draftSubject:Subject<Draft> = new Subject<Draft>();
   private guildSubject:Subject<Color[][]> = new Subject<Color[][]>();
   public api_url = 'http://api.lightningdraft.online';
   public random_url = '/cards/random';
   public draft_url = '/drafts';
   public player_url = '/players';
   public picks_url = '/picks';
   public pack_url = '/pack';
   public guilds_url = '/guilds';
   public deck_url = '/deck';
   private uuid: string = "";
      
   constructor(
      private http:HttpClient,
      private persistenceService:PersistenceService
   ) { 
   
      this.draft = new Draft();
      this.deck = [];
      this.pack = [];

      this.uuid = this.persistenceService.get('lightning-draft-uuid', StorageType.LOCAL);
      if (this.uuid == undefined) {
         this.uuid = UUID.UUID(); 
         this.persistenceService.set('lightning-draft-uuid', this.uuid, {type: StorageType.LOCAL });
      }
   }

   getPack(): Observable<Card[]> {
      return of(this.pack);
   }

   getDeck(): Observable<Card[]> {
      return of(this.deck);
   }

   getDraft(): Observable<Draft> {
      return this.draftSubject.asObservable();
   }

   getGuildChoices(): Observable<Color[][]> {
      return this.guildSubject.asObservable();
   }

   getUUID():string {
      return this.uuid;
   }

   sendPick(card) { 
      this.http.put(
       this.api_url 
         + this.draft_url + '/' + this.draft.draftid 
         + this.player_url + '/' + this.draft.playerid 
         + this.picks_url + '/' +  card.id, null).subscribe(
        suc => {
           this.addPickToDecklist(card);

           //this.sortDeck();
           let json = JSON.parse(String(suc)); // TODO I'm parsing twice for each response.
           if (json.cards.length > 0) { // we got a pack back
              this.parseCards(suc);
           } else { // not getting a pack back means draft is done.
              this.draft.status = "completed";
              this.announceDraft();
           }
        },
        err => {
           // hack. make sure to update the cards on an error in case frontend and backend are out of sync.
           this.parseCards(err);
        }
      );
   }

   addPickToDecklist(card) {
      for (var i = this.deck.length - 1; i >= 0; i--) {
         let spot:Card = this.deck[i];

         if (card.getAdjustedCmc() >= spot.getAdjustedCmc()) {
            this.deck.splice(i + 1, 0, card);
            return;
         }
      }

      // no cards in decklist yet.
      this.deck.splice(0, 0, card);
   }

      /*
   sortDeck() {
      this.deck.sort((n1, n2) =>
         if (n1.cmc == n2.cmc) 
            return 0;

         return n1.cmc > n2.cmc ? +1 : -1;
      );
   }
       */

   sendGuild(colors) {
      this.http.post( this.api_url + this.draft_url, {"colors" : colors, "uuid": this.uuid}).subscribe(
        suc => {
           this.setupDraft(suc);
        },
        err => {
           console.log(err);
        }
      );
   }

   setupDraft(json: any) {
      // TODO there's gotta be a better way to copy the json data to an object.
      let draftData = JSON.parse(json);

      let newDraft = new Draft();
      newDraft.draftid = draftData.id;
      let player = draftData.players[0];
      newDraft.playerid = player.id;
      newDraft.status = draftData.status;

      let pack:Card[] = this.copyCards(player.pack.cards);

      for (var i = 0; i < pack.length; i++) {
         this.pack[i] = pack[i]; // somehow a hard copy is needed to not trash observers of this.pack
      }
      // I think it's because I'm using of() and subscribe improperly.

      let deck:Card[] = this.copyCards(player.deck);


      let colors = [];
      for (var x = 0; x < player.colors.length; x++) {
         let color = new Color(player.colors[x].name, player.colors[x].symbol);
         color.id = player.colors[x].id;
         colors[x] = color;
      }
      newDraft.guild = colors;

      // add basic lands to deck.
      console.log(basic_lands);
      for (var i = newDraft.guild.length - 1; i >= 0; i--) {
         deck.splice(0, 0, basic_lands[newDraft.guild[i].name]);
      }

      // copy deck over
      for (var i = 0; i < deck.length; i++) {
         this.deck[i] = deck[i];
      }

      this.draft = newDraft;
      this.announceDraft();
   }

   fetchPack(): void {
      this.http
      .get<Card[]>(
         this.api_url + 
         this.draft_url + '/' + this.draft.draftid + 
         this.player_url +'/' +  this.draft.playerid + 
         this.pack_url)
       .subscribe(response => this.parseCards(response));
   }

   fetchDraft(draftid: number): void {
      this.http
      .get( this.api_url + this.draft_url + '/' + draftid)
       .subscribe(response => this.setupDraft(response));
   }

   announceDraft() {
      this.draftSubject.next(this.draft);
   }

   announceGuilds() {
      this.guildSubject.next(this.draft.guildChoices);
   }

   newDraft(): void {
      this.http
       .post( this.api_url + this.draft_url, null)
       .subscribe(response => this.setupDraft(response));
   }

   clearDraft(): void {
      this.draft = new Draft();
      this.deck.length = 0;
      this.pack.length = 0;
   }

   // this function making assumption on the data layout symfony provides
   // also cardData should already be parsed from JSON
   // more like "formatCards" than "copyCards"
   copyCards(cardData: any[]): Card[] {
      let cards: Card[] = [];

      for (var i = 0; i < cardData.length; i++) {
         let card = new Card(cardData[i].art.card)
         card.multiverseid = cardData[i].multiverseid;
         card.rarity = cardData[i].multiverseid;

         cards[i] = card;
      }

      return cards;
   }

   parseCards(json: any): void {
      let cardData = JSON.parse(json).cards;
      let newCards = this.copyCards(cardData);

      for (var i = 0; i < newCards.length; i++) {
         this.pack[i] = newCards[i];
      }
   }

   fetchGuildChoices() {
      this.http.get( this.api_url + this.guilds_url)
       .subscribe(response => this.copyGuildChoices(response));
   }

   copyGuildChoices(response) {
      this.draft.guildChoices = [];
      let guildData = JSON.parse(response);

      // TODO there has GOT to be a better way of copying json to an array of objects...
      for (var y = 0; y < guildData.length; y++) {
         this.draft.guildChoices[y] = [];
         for (var x = 0; x < guildData[y].length; x++) {
            let color = new Color(guildData[y][x].name, guildData[y][x].symbol);
            color.id = guildData[y][x].id;
            this.draft.guildChoices[y][x] = color;
         }
      }

      this.announceGuilds();
   }
}

