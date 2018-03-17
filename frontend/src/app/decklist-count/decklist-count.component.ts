import { Component, OnInit } from '@angular/core';
import {Card} from '../card';
import {ArenaService} from '../arena.service';

@Component({
   selector: 'app-decklist-count',
   templateUrl: './decklist-count.component.html',
   styleUrls: ['./decklist-count.component.css']
})
export class DecklistCountComponent implements OnInit {
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
