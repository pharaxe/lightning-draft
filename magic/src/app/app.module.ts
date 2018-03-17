import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { RouterModule, Routes, Router, ActivatedRoute } from '@angular/router';
import { NgModule } from '@angular/core';
import { ClipboardModule } from 'ngx-clipboard';
import { PersistenceModule } from 'angular-persistence';

import { AppComponent } from './app.component';
import { AppRoutes } from './app.routes';
import { MessagesComponent } from './messages/messages.component';
import { MessageService } from './message.service';

import { CardService } from './card.service';
import { ArenaService } from './arena.service';

import { CardDetailComponent } from './card-detail/card-detail.component';
import { BoosterPackComponent } from './booster-pack/booster-pack.component';
import { DraftableDirective } from './draftable.directive';
import { GuildChoiceDirective } from './guild-choice/guild-choice.directive';
import { DecklistItemComponent } from './decklist-item/decklist-item.component';
import { DecklistComponent } from './decklist/decklist.component';
import { SimpleArenaComponent } from './simple-arena/simple-arena.component';
import { ManaCostComponent } from './mana-cost/mana-cost.component';
import { ArenaGridComponent } from './arena-grid/arena-grid.component';
import { NavigationBarComponent } from './navigation-bar/navigation-bar.component';
import { GuildIconComponent } from './guild-icon/guild-icon.component';
import { GuildChoiceComponent } from './guild-choice/guild-choice.component';
import { DraftManagerComponent } from './draft-manager/draft-manager.component';
import { DecklistCountComponent } from './decklist-count/decklist-count.component';
import { CompletedScreenComponent } from './completed-screen/completed-screen.component';
import { DeckGridComponent } from './deck-grid/deck-grid.component';
import { GuildIconDescriptionComponent } from './guild-icon-description/guild-icon-description.component';
import { HintComponent } from './hint/hint.component';

@NgModule({
   declarations: [
      AppComponent,
      MessagesComponent,
      CardDetailComponent,
      BoosterPackComponent,
      DraftableDirective,
      GuildChoiceDirective,
      DecklistItemComponent,
      DecklistComponent,
      SimpleArenaComponent,
      ManaCostComponent,
      ArenaGridComponent,
      NavigationBarComponent,
      GuildIconComponent,
      GuildChoiceComponent,
      DraftManagerComponent,
      DecklistCountComponent,
      CompletedScreenComponent,
      DeckGridComponent,
      GuildIconDescriptionComponent,
      HintComponent
   ],
   entryComponents: [HintComponent],
   imports: [
      BrowserModule,
      BrowserAnimationsModule,
      HttpClientModule,
      FormsModule,
      RouterModule.forRoot(AppRoutes),
      ClipboardModule,
      PersistenceModule
   ],
   providers: [ArenaService, CardService, MessageService],
   bootstrap: [AppComponent]
})
export class AppModule { }
