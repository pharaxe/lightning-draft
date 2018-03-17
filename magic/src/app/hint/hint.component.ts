import { ChangeDetectorRef, Input, Component, AfterViewInit } from '@angular/core';
import {
     trigger,
     state,
     style,
     animate,
     transition
} from '@angular/animations';

@Component({
   selector: 'app-hint',
   templateUrl: './hint.component.html',
   styleUrls: ['./hint.component.css'],
   animations: [
      trigger('fadeTrigger', [
         state('out', style({
            opacity: '0',
         })),
         state('in', style({
            opacity: '1',
         })),
         transition('out <=> in', animate('250ms ease-out')),
      ]),
   ]

})
export class HintComponent implements AfterViewInit {
   @Input() public options;
   @Input() public direction:string;
   @Input() public message: string;
   public fadeState: string = 'out';

   constructor(
      private cdRef:ChangeDetectorRef,
) { }

   ngAfterViewInit() {
      this.fadeState = 'in';
      this.cdRef.detectChanges();
   }
}
