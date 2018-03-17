import { Input, Output, HostListener, HostBinding, Directive, EventEmitter, ElementRef } from '@angular/core';

import {Card} from './card';

import {ArenaService} from './arena.service';

@Directive({
  selector: '[appDraftable]'
})
export class DraftableDirective {
   constructor(private arenaService:ArenaService) {
   }

   @Input() card: Card;

   @HostListener('click', ['$event'])
   clicked() {
      this.arenaService.sendPick(this.card);
   }
}
