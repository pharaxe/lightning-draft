import { Component, OnInit } from '@angular/core';

import {Card} from '../card';
import {ArenaService} from '../arena.service';
import {DecklistItemComponent} from '../decklist-item/decklist-item.component';
import {ManaCostComponent} from '../mana-cost/mana-cost.component';

@Component({
  selector: 'app-decklist',
  templateUrl: './decklist.component.html',
  styleUrls: ['./decklist.component.css']
})
export class DecklistComponent implements OnInit {
   public deck: Card[];

   constructor(  
		private ArenaService: ArenaService,
   )
   {}

   ngOnInit() {
      this.ArenaService.getDeck().subscribe((deck) => {
         this.deck = deck;
      });
   }
}
