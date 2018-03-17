import { Component, OnInit, Input, Output, EventEmitter, HostListener } from '@angular/core';
//import { ActivatedRoute } from '@angular/router';
//import { Location } from '@angular/common';
import { Observable } from "rxjs/Observable";
import { of } from 'rxjs/observable/of';


import { Card }         from '../card';
import { CardService }  from '../card.service';

@Component({
	selector: 'app-card-detail',
	templateUrl: './card-detail.component.html',
	styleUrls: [ './card-detail.component.css' ]
})
export class CardDetailComponent implements OnInit {
	@Input() public card: Card;
	@Input() public id: number;

	constructor(
		//private route: ActivatedRoute,
		private CardService: CardService,
		//private location: Location
	) {}

	ngOnInit(): void {
		if (this.id) {
         this.CardService.getCard(this.id).subscribe(card => this.card = card);
		}
	}

	getCard(): void {
	}

	observe(card): void {
		of(card).subscribe(card => this.card = card);
	}

}
