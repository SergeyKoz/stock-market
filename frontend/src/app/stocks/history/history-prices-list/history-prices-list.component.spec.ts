import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { HistoryPricesListComponent } from './history-prices-list.component';

describe('HistoryPricesListComponent', () => {
  let component: HistoryPricesListComponent;
  let fixture: ComponentFixture<HistoryPricesListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ HistoryPricesListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(HistoryPricesListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
