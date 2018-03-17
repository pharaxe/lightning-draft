import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DecklistCountComponent } from './decklist-count.component';

describe('DecklistCountComponent', () => {
  let component: DecklistCountComponent;
  let fixture: ComponentFixture<DecklistCountComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DecklistCountComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DecklistCountComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
