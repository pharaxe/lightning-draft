import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CompletedScreenComponent } from './completed-screen.component';

describe('CompletedScreenComponent', () => {
  let component: CompletedScreenComponent;
  let fixture: ComponentFixture<CompletedScreenComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CompletedScreenComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CompletedScreenComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
