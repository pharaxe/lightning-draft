import { Input, Component, OnInit } from '@angular/core';

import {Card} from '../card';
import {CardService} from '../card.service';

@Component({
   selector: 'app-decklist-item',
   templateUrl: './decklist-item.component.html',
   styleUrls: [
      './decklist-item.component.css'
   ]
})
export class DecklistItemComponent implements OnInit {
   @Input() public card: Card;
   @Input() public id: number;

   constructor(  
		private CardService: CardService,
   )
   {}


   ngOnInit() {
		if (this.id) {
         this.CardService.getCard(this.id).subscribe(card => 
            this.card = card);
		}
   }

}
