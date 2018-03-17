import { Component, OnInit } from '@angular/core';

import {Card} from '../card';
import {CardService} from '../card.service';
import {ArenaService} from '../arena.service';

@Component({
  selector: 'app-simple-arena',
  templateUrl: './simple-arena.component.html',
  styleUrls: ['./simple-arena.component.css'],
})
export class SimpleArenaComponent implements OnInit {
  private pack: Card[];
  private deck: Card[];

   constructor(  
		private CardService: CardService,
		private ArenaService: ArenaService,
   )
   {}

  ngOnInit() {
     this.ArenaService.getPack().subscribe(pack => this.pack = pack);
     this.ArenaService.getDeck().subscribe(deck => this.deck = deck);
  }
}
