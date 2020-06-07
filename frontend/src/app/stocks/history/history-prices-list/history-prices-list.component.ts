import { Component, OnInit } from '@angular/core';
import {StockMarketService} from '../../../shared/stock-market.service';
import * as moment from 'moment';


@Component({
  selector: 'app-history-prices-list',
  templateUrl: './history-prices-list.component.html',
  styleUrls: []
})
export class HistoryPricesListComponent implements OnInit {
  moment: any = moment;

  constructor(public service: StockMarketService) { }

  ngOnInit(): void {
  }

}
