import {sandboxOf} from 'angular-playground';
import {SimpleArenaComponent} from './simple-arena.component';

import { Card }         from '../card';
import { CardService }  from '../card.service';
import { ArenaService }  from '../arena.service';

import { MockSimpleArenaService } from './mock.simple-arena.service';
import { MockCardService } from '../card-detail/mock.card.service';
import {HttpClientModule} from '@angular/common/http';

import {BoosterPackComponent} from '../booster-pack/booster-pack.component';
import {CardDetailComponent} from '../card-detail/card-detail.component';
import {DecklistComponent} from '../decklist/decklist.component';
import {DecklistItemComponent} from '../decklist-item/decklist-item.component';
import {ManaCostComponent} from '../mana-cost/mana-cost.component';
import { DraftableDirective} from '../draftable.directive';

const sandboxConfig = {
   imports: [HttpClientModule],
   providers: [
   { provide: ArenaService, useClass: MockSimpleArenaService },
   { provide: CardService, useClass: MockCardService },
   ],
   declarations: [
      SimpleArenaComponent,
      BoosterPackComponent,
      DecklistComponent,
      CardDetailComponent,
      DecklistItemComponent,
      DraftableDirective,
      ManaCostComponent
   ],
   label: 'Arena'
}; 

export default sandboxOf(SimpleArenaComponent, sandboxConfig)
   .add('simple arena', {
      template: `<app-simple-arena></app-simple-arena>`
   });

