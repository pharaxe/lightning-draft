import {sandboxOf} from 'angular-playground';
import {ViewContainerRef} from '@angular/core'
import {BoosterPackComponent} from './booster-pack.component';

import { Card }         from '../card';
import {CardDetailComponent} from '../card-detail/card-detail.component';
import { CardService }  from '../card.service';
import { ArenaService }  from '../arena.service';
import { DraftableDirective} from '../draftable.directive';

import { MockBasicBoosterPackService } from './mock.basic-booster-pack.service';
import { MockRandomBoosterPackService } from './mock.random-booster-pack.service';
import { MockCardService } from '../card-detail/mock.card.service';
import {HttpClientModule} from '@angular/common/http';

const sandboxConfig = {
   imports: [HttpClientModule],
   providers: [
   { provide: ArenaService, useClass: MockBasicBoosterPackService },
   { provide: CardService, useClass: MockCardService },
   ],
   declarations: [
      CardDetailComponent,
      DraftableDirective,
   ],
   label: 'Booster Pack'
}; 

export default sandboxOf(BoosterPackComponent, sandboxConfig)
   .add('basic pack switching', {
      template: `<app-booster-pack></app-booster-pack>`
   })
   .add('random packs', {
      template: `<app-booster-pack></app-booster-pack>`,
      providers: [
         {provide: ArenaService, useClass: MockRandomBoosterPackService},
      ]
   });
