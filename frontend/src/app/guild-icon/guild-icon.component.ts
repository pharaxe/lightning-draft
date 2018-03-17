import { Input, Component, OnInit } from '@angular/core';
import { Color } from '../color';
import { Observable } from "rxjs/Observable";
import { of } from 'rxjs/observable/of';

@Component({
  selector: 'app-guild-icon',
  templateUrl: './guild-icon.component.html',
  styleUrls: ['./guild-icon.component.css']
})
export class GuildIconComponent implements OnInit {
  @Input() public colors: Color[];
  public colorCode: string;

  constructor() { }

  ngOnInit() {
     of(this.colors).subscribe(colors => this.updateColorCode(colors));
  }

  updateColorCode(colors: Color[]) {
     this.colorCode = "";
     colors.forEach(color => this.colorCode += color.symbol);
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
