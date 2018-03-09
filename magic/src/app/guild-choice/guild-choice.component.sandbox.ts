import {sandboxOf} from 'angular-playground';
import {GuildChoiceComponent} from './guild-choice.component';
import {GuildIconComponent} from '../guild-icon/guild-icon.component';

import { ArenaService }  from '../arena.service';
import { DraftableDirective} from '../draftable.directive';

import { MockGuildService } from './mock-guild-service';

const sandboxConfig = {
   providers: [
   { provide: ArenaService, useClass: MockGuildService},
   ],
   declarations: [
      GuildIconComponent,
      DraftableDirective,
   ],
   label: 'Choose a Guild'
}; 

export default sandboxOf(GuildChoiceComponent, sandboxConfig)
   .add('guilds', {
      template: `<app-guild-choice></app-guild-choice>`
   });
