import {sandboxOf} from 'angular-playground';
import {GuildIconComponent} from './guild-icon.component';

import {white, blue, black, red, green, Color }         from '../color';

const sandboxConfig = {
   imports: [],
   providers: [],
   label: 'Guild Icons',
}; 


export default sandboxOf(GuildIconComponent, sandboxConfig)
   .add('white blue', {
      template: `<app-guild-icon [colors]="azor"> </app-guild-icon>`,
      context: {azor: [ white, blue] }
   })
   .add('all guilds', {
      template: `<div style="display:flex; justify-content: space-around; flex-wrap: wrap; height: 300px; width: 1000px;"><app-guild-icon *ngFor="let colors of guilds" [colors]="colors"></app-guild-icon></div>`,
      context: {
         guilds: [
            [white, blue],
            [white, red],
            [white, green],
            [white, black],
            [blue, black],
            [black, red],
            [black, green],
            [red, green],
            [blue, green],
            [blue, red]
         ]
      }
   });
