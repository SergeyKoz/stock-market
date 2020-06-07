import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { HistoryRequestFormComponent } from './history-request-form.component';

describe('HistoryRequestFormComponent', () => {
  let component: HistoryRequestFormComponent;
  let fixture: ComponentFixture<HistoryRequestFormComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ HistoryRequestFormComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(HistoryRequestFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
