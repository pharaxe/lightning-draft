import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GuildChoiceComponent } from './guild-choice.component';

describe('GuildChoiceComponent', () => {
  let component: GuildChoiceComponent;
  let fixture: ComponentFixture<GuildChoiceComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GuildChoiceComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GuildChoiceComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
