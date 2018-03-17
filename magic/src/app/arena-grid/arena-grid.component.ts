import { AfterViewChecked, ElementRef, ViewChild, Component, OnInit } from '@angular/core';
import { EventEmitter } from '@angular/core';
import {Router, ActivatedRoute } from '@angular/router';
import { Observable } from "rxjs/Observable";
import { ISubscription, Subscription } from "rxjs/Subscription";

import {ViewContainerRef, ComponentRef,ComponentFactoryResolver} from  '@angular/core';
import {HintComponent} from '../hint/hint.component';

import {ArenaService} from '../arena.service';
import {Draft} from '../draft';
import {Color} from '../color';
import {Card} from '../card';
import { Location, LocationStrategy, PathLocationStrategy } from '@angular/common';

@Component({
   selector: 'app-arena-grid',
   templateUrl: './arena-grid.component.html',
   styleUrls: ['./arena-grid.component.css'],
   providers: [Location, {provide: LocationStrategy, useClass: PathLocationStrategy}]
})
export class ArenaGridComponent implements OnInit {
   @ViewChild('scrollMe') private myScroll: ElementRef;
   @ViewChild('guildHint', {read: ViewContainerRef} ) private guildHintContainer: ViewContainerRef;
   private draftid: number = 0;
   private playerid: number;
   private draft: Draft;
   public status: string = 'setup'; // setup, running, completed
   private locationSubscription: ISubscription;
   private paramSubscription: Subscription;
   public finalizeDecklist = false;
   private deck: Card[];
   private hintRef: ComponentRef<HintComponent>;

   constructor(
      private route: ActivatedRoute,
      private router: Router,
      private location: Location,
      private ArenaService: ArenaService,
      private componentFactoryResolver: ComponentFactoryResolver,
      private viewContainerRef: ViewContainerRef
   ) { 
   }

   ngOnInit() {
      this.ArenaService.getDraft().subscribe(draft => {
         if (this.status == "setup" && this.location.path() == "") {
            // starting out a draft.
            this.location.go('draft/' + draft.draftid);
         }

         this.draftid = draft.draftid;
         this.playerid = draft.playerid;
         this.status = draft.status;
         this.draft = draft;

         this.finalizeDecklist = (this.draft.status == "completed");
      });

      this.ArenaService.getDeck().subscribe((deck) => {
         this.deck = deck;
      });

      // TODO I have much to learn about location history in angular. this isn't working quite how intended but it's close enough. The main bug is caling fetchguildchoices twice sometimes. only if back and forward buttons are used to navigate.
      this.paramSubscription = this.route.params.subscribe( params => {
         let id = this.route.snapshot.paramMap.get('id');
         if (id) {
            this.ArenaService.fetchDraft(+id);
         } else {
            this.ArenaService.fetchGuildChoices();

         }
      });

      this.locationSubscription = this.location.subscribe( data => {
         let id = this.route.snapshot.paramMap.get('id');
         if (data.url == "") {
            this.draftid = 0;
            this.ArenaService.clearDraft();
            this.status = "setup";
            this.ArenaService.fetchGuildChoices();
         }
      });
   }

   ngAfterViewChecked() {
      this.scrollToBottom();

      /*
      if (!this.hintRef) {
         const factory = 
          this.componentFactoryResolver.resolveComponentFactory(HintComponent);
         this.hintRef = this.guildHintContainer.createComponent(factory);
         this.hintRef.instance.message = "here";
         this.hintRef.changeDetectorRef.detectChanges();
      }
      */
   }

   ngOnDestroy() {
      this.paramSubscription.unsubscribe();
      this.locationSubscription.unsubscribe();
      //this.hintRef.destroy();
   }

   scrollToBottom(): void {
      try {
         this.myScroll.nativeElement.scrollTop = this.myScroll.nativeElement.scrollHeight;
      } catch(err) {console.log(err) }
   }
}
