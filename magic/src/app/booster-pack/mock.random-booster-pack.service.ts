import { Observable } from "rxjs/Observable";
import { of } from 'rxjs/observable/of';
import { catchError, map, tap } from 'rxjs/operators';
import { Type } from "@angular/core";
import { ActivatedRoute } from '@angular/router';

import { Card } from '../card';
import {HttpClientModule} from '@angular/common/http';
import {HttpClient, HttpHeaders} from '@angular/common/http';

import {Inject} from '@angular/core'
import {Injectable} from '@angular/core'

@Injectable()
export class MockRandomBoosterPackService { 
   pack: Card[];
   private url = 'http://localhost/draft/web/app_dev.php/api/cards/random';

   constructor(private http:HttpClient) { 
   }

   getPack(): Observable<Card[]> {
      this.pack = [];
      this.getRandomCards();
      return of(this.pack);
   }

   getRandomCards(): void {
      this.http
        .get<Card[]>(this.url).subscribe(response => this.copyCards(response));
   }

   copyCards(newCards: Card[]): void {
      console.log(newCards);
      Object.assign(this.pack, newCards);
      /*
      newCards.forEach(function(card, index) {
         this.pack[index] = card;
      }.bind(this));
       */
   }

   sendPick(card) {
      console.log(card.url);
      this.getRandomCards();
   }
}
