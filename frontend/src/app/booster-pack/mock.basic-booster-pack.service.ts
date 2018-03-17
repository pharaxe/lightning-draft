import { Observable } from "rxjs/Observable";
import { of } from 'rxjs/observable/of';
import { Type } from "@angular/core";
import { ActivatedRoute } from '@angular/router';

import { Card } from '../card';
import {Injectable} from '@angular/core'

@Injectable()
export class MockBasicBoosterPackService { 
   pack: Card[];
   onSecondPack: boolean = false;

   getPack(): Observable<Card[]> {
      this.pack = Object.assign([], pack1);
      return of(this.pack);
   }

   sendPick(card) {
      // simply flip between two predefined packs.
      if (this.onSecondPack) {
         Object.assign(this.pack, pack1);
      } else {
         Object.assign(this.pack, pack2);
      }

      this.onSecondPack = !this.onSecondPack;
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
