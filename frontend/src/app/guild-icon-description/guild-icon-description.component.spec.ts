import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GuildIconDescriptionComponent } from './guild-icon-description.component';

describe('GuildIconDescriptionComponent', () => {
  let component: GuildIconDescriptionComponent;
  let fixture: ComponentFixture<GuildIconDescriptionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GuildIconDescriptionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GuildIconDescriptionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
