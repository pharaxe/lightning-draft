import { ChangeDetectorRef, Component, AfterViewInit, OnInit, Input} from '@angular/core';
import {
   trigger,
   state,
   style,
   animate,
   transition
} from '@angular/animations';

@Component({
   selector: 'app-footer',
   templateUrl: './footer.component.html',
   styleUrls: ['./footer.component.css'],
   animations: [
      trigger('slideTrigger', [
         state('in', style({
            transform: 'translate3d(0,100%,0)',
         })),
         state('out', style({
            transform: 'translate3d(0,0,0)',
         })),
         transition('in <=> out', animate('500ms ease-in')),
      ]),
})
export class FooterComponent implements AfterViewInit {
   public slideState: string = 'in';

   constructor() { }

   ngAfterViewInit() {
      //this.slideState = 'in';
   }

   public openTab() {
      this.slideState = 'out';
   }

   public closeTab() {
      this.slideState = 'in';
   }
}
