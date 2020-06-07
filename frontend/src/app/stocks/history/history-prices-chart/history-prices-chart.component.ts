import { Component, OnInit, ViewChild } from '@angular/core';
import {StockMarketService} from '../../../shared/stock-market.service';
import {Price} from '../../../shared/price.model';

import {
  ChartComponent,
  ApexAxisChartSeries,
  ApexChart,
  ApexYAxis,
  ApexXAxis,
  ApexTitleSubtitle
} from 'ng-apexcharts';

export type ChartOptions = {
  series: ApexAxisChartSeries;
  chart: ApexChart;
  xaxis: ApexXAxis;
  yaxis: ApexYAxis;
  title: ApexTitleSubtitle;
};

@Component({
  selector: 'app-history-prices-chart',
  templateUrl: './history-prices-chart.component.html',
  styleUrls: []
})
export class HistoryPricesChartComponent implements OnInit {
  @ViewChild('chart') chart: ChartComponent;
  public chartOptions: Partial<ChartOptions>;

  constructor(public service: StockMarketService) {
    this.chartOptions = {
      series: [
        {
          name: 'candle',
          data: [],
        }
      ],
      chart: {
        type: 'candlestick',
        height: 350
      },
      title: {
        text: 'CandleStick Chart',
        align: 'left'
      },
      xaxis: {
        type: 'datetime'
      },
      yaxis: {
        tooltip: {
          enabled: true
        }
      }
    };

    this.service.collections$.subscribe((prices: Price[]) => {
      const data = [];
      prices.forEach((price) => {
        data.push({
          x: new Date(price.date * 1000),
          y: [
            price.open.toFixed(5),
            price.high.toFixed(5),
            price.low.toFixed(5),
            price.close.toFixed(5)
          ]
        });
      });
      // fix render problem
      // prices.forEach((price) => {
      //   data.push({
      //     x: new Date(price.date * 1000),
      //     y: [
      //       price.open.toFixed(5),
      //       price.high.toFixed(5),
      //       price.low.toFixed(5),
      //       price.close.toFixed(5)
      //     ]
      //   });
      // });

      this.chartOptions.series = [{
        name: 'candle',
        data
      }];
    });
  }

  ngOnInit(): void {
  }
}
