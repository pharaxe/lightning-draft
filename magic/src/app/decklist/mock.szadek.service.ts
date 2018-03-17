import { Observable } from "rxjs/Observable";
import { of } from 'rxjs/observable/of';
import { Type } from "@angular/core";

import { Card } from '../card';
import {Injectable} from '@angular/core'

@Injectable()
export class MockSzadekDeckService { 
   deck: Card[];

   getPack(): Observable<Card[]> {
      return null;
   }

   getDeck(): Observable<Card[]> {
      this.deck = deck1;

      return of(this.deck);
   }

   sendPick(card) { }
}

export const szadek = new Card({
   "id": 1,
   "multiverseid": 89092,
   "name": "Szadek, Lord of Secrets",
   "url": "http://bensweedler.com/art/89092.jpg",
   "cmc": 7,
   "mana_cost": "{3}{U}{U}{B}{B}"
});

export const deck1 = [szadek, szadek, szadek];
