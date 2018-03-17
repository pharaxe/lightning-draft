import {sandboxOf} from 'angular-playground';
import {DecklistComponent} from './decklist.component';
import {DecklistItemComponent} from '../decklist-item/decklist-item.component';
import {ManaCostComponent} from '../mana-cost/mana-cost.component';
import {CardDetailComponent} from '../card-detail/card-detail.component';

import { Card }         from '../card';
import { CardService }  from '../card.service';
import { ArenaService }  from '../arena.service';

import { MockDecklistService } from './mock.decklist.service';
import { MockSzadekDeckService } from './mock.szadek.service';
import { MockCardService } from '../card-detail/mock.card.service';

const sandboxConfig = {
   providers: [
   { provide: ArenaService, useClass: MockDecklistService },
   { provide: CardService, useClass: MockCardService },
   ],
   declarations: [
      DecklistItemComponent,
      ManaCostComponent,
      CardDetailComponent,
   ],
   label: 'Decklist'
}; 

export default sandboxOf(DecklistComponent, sandboxConfig)
   .add('a couple cards', {
      template: `<div style="width: 290px"><app-decklist></app-decklist></div>`
   })
   .add('Szadek, Lord of Secrets', {
      template:  `<div style="width: 200px"><app-card-detail [id]="1"></app-card-detail></div><div style="width: 290px"><app-decklist></app-decklist></div>`,
      providers: [
         {provide: ArenaService, useClass: MockSzadekDeckService},
      ],
   });
