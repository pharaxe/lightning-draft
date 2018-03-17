import { Observable } from "rxjs/Observable";
import { of } from 'rxjs/observable/of';
import { Type } from "@angular/core";

import { Card } from '../card';
import {Injectable} from '@angular/core'

@Injectable()
export class MockDecklistService { 
   deck: Card[];

   getPack(): Observable<Card[]> {
      return null;
   }

   getDeck(): Observable<Card[]> {
      this.deck = [];
      Object.assign(this.deck, deck1);
      Object.assign(this.deck, deck2);

      return of(this.deck);
   }

   sendPick(card) { }
}

export const deck1 = [
   {
      "name": "Fireball",
      "id": 61590,
      "multiverseid": 205223,
      "url": "http://bensweedler.com/art/205223.jpg"
   },
   {
      "id": 64723,
      "multiverseid": 83731,
      "name": "Watery Grave",
      "url": "http://bensweedler.com/art/83731.jpg"
   },
   {
		"id": 65622,
		"multiverseid": 382374,
		"name": "Squirrel Nest",
		"url": "http://bensweedler.com/art/382374.jpg"
   }
]

export const deck2 = [
   new Card({
      "id": 63861,
      "multiverseid": 159230,
      "name": "Hallowed Ground",
      "url": "http://bensweedler.com/art/159230.jpg",
      "cmc": 0
   }),
   new Card({
      "id": 61623,
      "multiverseid": 191089,
      "name": "Lightning Bolt",
      "url": "http://bensweedler.com/art/191089.jpg",
      "mana_cost": "{R}",
      "cmc": 0
   }),
   new Card({
      "id": 67641,
      "multiverseid": 45483,
      "name": "Teferi's Puzzle Box",
      "url": "http://bensweedler.com/art/45483.jpg",
      "mana_cost": "{4}",
      "cmc": 4
   })
]
