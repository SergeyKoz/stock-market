import { Component, OnInit } from '@angular/core';
import { StockMarketService } from '../../../shared/stock-market.service';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-history-request-form',
  templateUrl: './history-request-form.component.html',
  styleUrls: []
})
export class HistoryRequestFormComponent implements OnInit {

  constructor(public service: StockMarketService) { }

  ngOnInit(): void {
  }

  onSubmit(form: NgForm)
  {
    this.service.getHistoricalPricesList(form);
  }
}
