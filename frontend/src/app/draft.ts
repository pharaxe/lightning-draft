import {Color} from './color';

export class Draft {
   guildChoices: Color[][];
   guild: Color[];
   status: string;
   picks: number;
   draftid: number;
   playerid: number;

   constructor() {
      this.guildChoices = [];
   }
}
