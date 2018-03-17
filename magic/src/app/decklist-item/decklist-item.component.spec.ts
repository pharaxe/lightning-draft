import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DecklistItemComponent } from './decklist-item.component';

describe('DecklistItemComponent', () => {
  let component: DecklistItemComponent;
  let fixture: ComponentFixture<DecklistItemComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DecklistItemComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DecklistItemComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
