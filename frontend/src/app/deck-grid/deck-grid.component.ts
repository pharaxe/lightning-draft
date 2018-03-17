import { Component, OnInit } from '@angular/core';

import {ArenaService } from '../arena.service';
import {Card} from '../card';

@Component({
   selector: 'app-deck-grid',
   templateUrl: './deck-grid.component.html',
   styleUrls: ['./deck-grid.component.css']
})
export class DeckGridComponent implements OnInit {
   private deck: Card[];

   constructor(
      private ArenaService: ArenaService,
   ) { }

   ngOnInit() {
      this.ArenaService.getDeck().subscribe((deck) => {
         this.deck = deck;
      });
   }

   public getDeck():Card[] {
      return this.deck.slice(2, this.deck.length);
   }
}
