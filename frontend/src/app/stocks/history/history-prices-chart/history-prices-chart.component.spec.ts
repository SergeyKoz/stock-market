import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { HistoryPricesChartComponent } from './history-prices-chart.component';

describe('HistoryPricesChartComponent', () => {
  let component: HistoryPricesChartComponent;
  let fixture: ComponentFixture<HistoryPricesChartComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ HistoryPricesChartComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(HistoryPricesChartComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
