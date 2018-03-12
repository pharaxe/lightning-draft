import { AfterViewChecked, ElementRef, ViewChild, Component, OnInit } from '@angular/core';
import { EventEmitter } from '@angular/core';
import {Router, ActivatedRoute } from '@angular/router';
import { Observable } from "rxjs/Observable";

import {ArenaService} from '../arena.service';
import {Draft} from '../draft';
import {Color} from '../color';
import { Location, LocationStrategy, PathLocationStrategy } from '@angular/common';

@Component({
   selector: 'app-arena-grid',
   templateUrl: './arena-grid.component.html',
   styleUrls: ['./arena-grid.component.css'],
   providers: [Location, {provide: LocationStrategy, useClass: PathLocationStrategy}]
})
export class ArenaGridComponent implements OnInit {
   @ViewChild('scrollMe') private myScroll: ElementRef;
   private draftid: number;
   private status: string; // setup, running, completed

   constructor(
      private route: ActivatedRoute,
      private router: Router,
      private location: Location,
      private ArenaService: ArenaService
   ) { 
   }


   ngOnInit() {
     this.ArenaService.getDraft().subscribe(draft => {

        this.draftid = draft.draftid;
        this.location.replaceState('draft/' + draft.draftid);

        // determine state of draft.
        this.status = draft.status;
     });

     let id = this.route.snapshot.paramMap.get('id');
     if (id) {
        this.ArenaService.fetchDraft(+id);
     } else {
        this.ArenaService.fetchGuildChoices();

        //this.ArenaService.newDraft();
     }
   }

   ngAfterViewChecked() {
      this.scrollToBottom();
   }

   scrollToBottom(): void {
      try {
         this.myScroll.nativeElement.scrollTop = this.myScroll.nativeElement.scrollHeight;
      } catch(err) {console.log(err) }
   }
}
