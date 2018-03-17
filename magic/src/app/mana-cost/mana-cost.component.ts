import { Input, Component, OnInit } from '@angular/core';
import {Card} from '../card';

@Component({
   selector: 'app-mana-cost',
   templateUrl: './mana-cost.component.html',
   styleUrls: [
      './mana-cost.component.css'
   ]
})
export class ManaCostComponent implements OnInit {
   @Input() public card: Card;

   constructor() { }

   ngOnInit() {
   }
}
