import { Component, OnInit, Input, ViewChildren, ViewChild, QueryList } from '@angular/core';
import { Observable } from "rxjs/Observable";
import { of }         from 'rxjs/observable/of';
import { Card }         from '../card';
import { CardService }  from '../card.service';
import { ArenaService }  from '../arena.service';
import { DraftableDirective} from '../draftable.directive';

import {CardDetailComponent} from '../card-detail/card-detail.component';

@Component({
  selector: 'app-booster-pack',
  templateUrl: './booster-pack.component.html',
  styleUrls: ['./booster-pack.component.css'],
})
export class BoosterPackComponent implements OnInit {
   public pack: Card[];

   constructor(
      private CardService: CardService,
      private ArenaService: ArenaService,
   )
   { }

   ngOnInit() {
      this.ArenaService.getPack().subscribe(pack => {
         this.pack = pack
      });
   }

   ngAfterViewInit() {
   }
}
