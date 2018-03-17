import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DraftManagerComponent } from './draft-manager.component';

describe('DraftManagerComponent', () => {
  let component: DraftManagerComponent;
  let fixture: ComponentFixture<DraftManagerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DraftManagerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DraftManagerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
