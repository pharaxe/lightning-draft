import { Observable } from "rxjs/Observable";
import { of } from 'rxjs/observable/of';
import { Type } from "@angular/core";
import { ActivatedRoute } from '@angular/router';

import { Card } from '../card';

export class MockCardService { 
   getCards(): Observable<Card[]> {
      return null;
   }

   getCard(id: number): Observable<Card> {
      return of(cards[id]);
   }
}

export const cards = {
   205223:   new Card({
      "name": "Fireball",
      "id": 61590,
      "multiverseid": 205223,
      "url": "http://bensweedler.com/art/205223.jpg",
       "cmc": 1,
      "mana_cost": "{X}{R}"
   }),
   83731: new Card({
      "id": 64723,
      "multiverseid": 83731,
      "name": "Watery Grave",
      "url": "http://bensweedler.com/art/83731.jpg",
      "cmc": 0,
   }),
   382374: new Card({
		"id": 65622,
		"multiverseid": 382374,
		"name": "Squirrel Nest",
		"url": "http://bensweedler.com/art/382374.jpg",
      "cmc": 3,
      "mana_cost": "{1}{G}{G}"
   }),
   1: new Card({
      "id": 1,
      "multiverseid": 89092,
      "name": "Szadek, Lord of Secrets",
      "url": "http://bensweedler.com/art/89092.jpg",
      "cmc": 7,
      "mana_cost": "{3}{U}{U}{B}{B}"
   }),
};

