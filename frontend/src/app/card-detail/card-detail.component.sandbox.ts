import {sandboxOf} from 'angular-playground';
import {CardDetailComponent} from '../card-detail/card-detail.component';

import { Card }         from '../card';
import { CardService }  from '../card.service';

import { MockCardService } from './mock.card.service';
//import { MockActivatedRoute, getActivatedRouteWithParent } from './mock.card.service';

const sandboxConfig = {
   imports: [],
   providers: [
   { provide: CardService, useClass: MockCardService },
   ],
   label: 'Single Card Component',
}; 


export default sandboxOf(CardDetailComponent, sandboxConfig)
   .add('with fireball', {
      template: `<div style="width: 200px"><app-card-detail [id]="205223"></app-card-detail></div>`
   });
