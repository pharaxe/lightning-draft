import { Component, OnInit, Input  } from '@angular/core';
import { Observable } from "rxjs/Observable";
import { of }         from 'rxjs/observable/of';
import { Color }         from '../color';
import { Draft }  from '../draft';
import { Card }  from '../card';
import { ArenaService }  from '../arena.service';

import {GuildIconComponent} from '../guild-icon/guild-icon.component';

@Component({
  selector: 'app-guild-choice',
  templateUrl: './guild-choice.component.html',
  styleUrls: ['./guild-choice.component.css'],
})
export class GuildChoiceComponent implements OnInit {
   public choices: Color[][];

   constructor(
      private ArenaService: ArenaService,
   )
   { }

   ngOnInit() {
      this.ArenaService.getGuildChoices().subscribe(choices => this.choices = choices);
   }

   ngAfterViewInit() {
   }
}
