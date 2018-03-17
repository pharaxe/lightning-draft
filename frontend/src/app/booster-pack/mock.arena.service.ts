import { Observable } from "rxjs/Observable";
import { of } from 'rxjs/observable/of';
import { Type } from "@angular/core";
import { ActivatedRoute } from '@angular/router';

import { Card } from '../card';

export class MockBasicBoosterPackService { 
   pack: Card[];
   onSecondPack: boolean = false;

   getPack(): Observable<Card[]> {
      this.pack = [];
      pack1.forEach(function(card, index) {
         this.pack[index] = card;
      }.bind(this));
      return of(this.pack);
   }

   getCard(id: number): Observable<Card> {
      return null;
   }

   sendPick(card) {
      this.pack.forEach(function(card, index) {
         if (this.onSecondPack) {
            this.pack[index] = pack1[index];
         } else {
            this.pack[index] = pack2[index];
         }
      }.bind(this));

      if (this.onSecondPack) {
         this.onSecondPack = false;
      } else {
         this.onSecondPack = true;
      }


   }
}

export const pack1 = [
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

export const pack2 = [
   {
      "id": 63861,
      "multiverseid": 159230,
      "name": "Hallowed Ground",
      "url": "http://bensweedler.com/art/159230.jpg"
   },
   {
      "id": 61623,
      "multiverseid": 191089,
      "name": "Lightning Bolt",
      "url": "http://bensweedler.com/art/191089.jpg"
   },
   {
      "id": 67641,
      "multiverseid": 45483,
      "name": "Teferi's Puzzle Box",
      "url": "http://bensweedler.com/art/45483.jpg"
   }
]
