import {sandboxOf} from 'angular-playground';
import {DecklistItemComponent} from './decklist-item.component';

import { Card }         from '../card';
import { CardService }  from '../card.service';

import { MockCardService } from '../card-detail/mock.card.service';

import {ManaCostComponent} from '../mana-cost/mana-cost.component';

const sandboxConfig = {
   imports: [],
   providers: [
   { provide: CardService, useClass: MockCardService },
   ],
   declarations: [
      ManaCostComponent,
   ],
   label: 'Decklist',
}; 


export default sandboxOf(DecklistItemComponent, sandboxConfig)
   .add('fireball', {
      template: `<div style="width: 250px"><app-decklist-item [id]="205223"></app-decklist-item></div>`
   });
