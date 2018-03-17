import { Input, Component, OnInit } from '@angular/core';
import { Color } from '../color';
import { Observable } from "rxjs/Observable";
import { of } from 'rxjs/observable/of';
import { GuildChoiceDirective} from '../guild-choice/guild-choice.directive';

@Component({
  selector: 'app-guild-icon-description',
  templateUrl: './guild-icon-description.component.html',
  styleUrls: ['./guild-icon-description.component.css']
})
export class GuildIconDescriptionComponent implements OnInit {
  @Input() public colors: Color[];

  constructor() { }

  ngOnInit() {
  }

  getGuildName(): string {
     let colorString = this.colors[0].symbol + this.colors[1].symbol;
     switch(colorString) {
        case 'WU':
           return 'Azorious';
        case 'UB':
          return 'Dimir';
        case 'BR':
          return 'Rakdos';
        case 'RG':
          return 'Gruul';
        case 'WG':
          return 'Selesnya';
        case 'WB':
          return 'Orzhov';
        case 'UR':
          return 'Izzet';
        case 'BG':
          return 'Golgari';
        case 'WR':
          return 'Boros';
        case 'UG':
          return 'Simic';
     }
  }
}
