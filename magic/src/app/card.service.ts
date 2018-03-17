import { Injectable } from '@angular/core';

import { Observable } from 'rxjs/Observable';
import { of } from 'rxjs/observable/of';
import { catchError, map, tap } from 'rxjs/operators';

import {HttpClient, HttpHeaders} from '@angular/common/http';
import { Card } from './card';
import { CARDS } from './mock-cards';
import { MessageService } from './message.service';

@Injectable()
export class CardService {
   private url = 'http://localhost/draft/web/app_dev.php/api/cards';
   private myCards: Card[];
   private cardCache: { [id: number] : Card; };
   private searchResults: Card[];

   constructor(private http: HttpClient, private messageService: MessageService) { 

      this.myCards = CARDS;
      this.cardCache = { };
   }

   getCards(): Observable<Card[]> {
      this.messageService.add('CardService: fetched cards');
      this.http.get<Card[]>(this.url).subscribe(response => 
          this.myCards = response
      );
      return of(this.myCards);

   }

   getCard(id: number): Observable<Card> {
      this.messageService.add(`CardSerivce: fetched hero: id ${id}`);
      return of(this.myCards.find(card => card.id === id)); 
   }

   searchCards(term: string): Observable<Card[]> {
      if (!term.trim()) {
         return of([]); 
      }

      this.messageService.add(`CardSerivce: searching for ${term}`);

      return this.http
         .get<Card[]>(this.url + `?name=${term}`).pipe(
            tap(response => this.cacheCards(response)));
   }

   cacheCards(response) {
      console.log(response);
      this.searchResults = response;
      this.myCards = this.myCards.concat(response);
   }
}
