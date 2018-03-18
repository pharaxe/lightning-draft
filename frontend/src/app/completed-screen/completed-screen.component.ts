import { ChangeDetectorRef, Component, AfterViewInit, OnInit, Input} from '@angular/core';
import { Draft }         from '../draft';
import { Card }         from '../card';
import { ArenaService }         from '../arena.service';
import {
     trigger,
     state,
     style,
     animate,
     transition
} from '@angular/animations';

@Component({
   selector: 'app-completed-screen',
   templateUrl: './completed-screen.component.html',
   styleUrls: ['./completed-screen.component.css'],
   animations: [
      trigger('fadeDeck', [
         state('inactive', style({
            opacity: '0',
         })),
         state('active', style({
            opacity: '1',
         })),
         transition('inactive => active', animate('500ms ease-in')),
      ]),
      trigger('slideIn', [
         state('in', style({
            transform: 'translate3d(0,-100%,0)',
         })),
         state('out', style({
            transform: 'translate3d(0, 0, 0)'
         })),
         transition('in => out', animate('400ms ease-in-out')),
      ])
   ]
})
export class CompletedScreenComponent implements OnInit, AfterViewInit {
   @Input() public draft: Draft;
   public fadeState = 'inactive';
   public slideState = 'in';
   private deck:Card[];
   public survey_url: string = 
      "https://docs.google.com/forms/d/e/1FAIpQLSdk6W1uVcsTf6YU5GsqArmuPJ9vFlGs1CD4na7t6a8cqO21RQ/viewform?entry.1858318558=";
   private print_url: string = "http://www.mtgpress.net/build?url=";


   constructor(
      private ArenaService: ArenaService,
      private cdRef:ChangeDetectorRef,
   ) { }

   toggleFade() {
      if (this.fadeState == "active") {
         this.fadeState = "inactive";
      } else {
         this.fadeState = "active";
      }
   }

   ngOnInit() {
      this.ArenaService.getDeck().subscribe((deck) => {
         this.deck = deck;
      });
   }

   ngAfterViewInit() {
      this.fadeState = 'active';
      this.slideState = 'out';
      this.cdRef.detectChanges();
      //this.toggleFade();
   }

   getPrintUrl() {

      return this.print_url + this.ArenaService.api_url +
         this.ArenaService.draft_url + "/" + this.draft.draftid +
         this.ArenaService.player_url + "/" + this.draft.playerid + 
         this.ArenaService.deck_url;
   }

   getDecklistText() {
      let txt = "";
      for (let i = 0; i < this.deck.length; i++) {
         txt += this.deck[i].name + "\n";
      }
      return txt;
   }

   copiedSuccessfully() {
   }
}
