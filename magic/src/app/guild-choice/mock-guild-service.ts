import { Observable } from "rxjs/Observable";
import { of } from 'rxjs/observable/of';
import { Type } from "@angular/core";

import { Card } from '../card';
import { Draft } from '../draft';
import { white, black, blue, red, green, Color } from '../color';

import {Inject} from '@angular/core'
import {Injectable} from '@angular/core'

@Injectable()
export class MockGuildService { 
   guilds: Color[][];

   constructor()  {
      this.guilds = [];
      this.guilds[0] = [black, green];
      this.guilds[1] = [blue, green];
      this.guilds[2] = [white, red];
   }

   getGuildChoices(): Observable<Color[][]> { 
      return of(this.guilds);
   }

   sendGuild(colors) {
      console.log(colors);
   }
}
