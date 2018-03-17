import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SimpleArenaComponent } from './simple-arena.component';

describe('SimpleArenaComponent', () => {
  let component: SimpleArenaComponent;
  let fixture: ComponentFixture<SimpleArenaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SimpleArenaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SimpleArenaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
