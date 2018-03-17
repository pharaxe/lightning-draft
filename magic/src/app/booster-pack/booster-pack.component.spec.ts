import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BoosterPackComponent } from './booster-pack.component';

describe('BoosterPackComponent', () => {
  let component: BoosterPackComponent;
  let fixture: ComponentFixture<BoosterPackComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BoosterPackComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BoosterPackComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
