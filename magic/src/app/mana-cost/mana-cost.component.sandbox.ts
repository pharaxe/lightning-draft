import {sandboxOf} from 'angular-playground';
import {ManaCostComponent} from './mana-cost.component';

import {costs} from './mock-manacost-cards';

const sandboxConfig = {
   imports: [],
   providers: [],
   label: 'Mana Cost',
}; 


export default sandboxOf(ManaCostComponent, sandboxConfig)
   .add('all symbols', {
      template: `<app-mana-cost *ngFor="let card of costs" [card]="card"> </app-mana-cost>`,
      context: {costs: costs }
   });
