import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ArenaGridComponent } from './arena-grid.component';

describe('ArenaGridComponent', () => {
  let component: ArenaGridComponent;
  let fixture: ComponentFixture<ArenaGridComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ArenaGridComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ArenaGridComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
