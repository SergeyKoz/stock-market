import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { AppComponent } from './app.component';
import { StockMarketService } from './shared/stock-market.service';
import { StocksComponent } from './stocks/stocks.component';
import { HistoryRequestFormComponent } from './stocks/history/history-request-form/history-request-form.component';
import { HistoryPricesListComponent } from './stocks/history/history-prices-list/history-prices-list.component';
import { HistoryPricesChartComponent } from './stocks/history/history-prices-chart/history-prices-chart.component';
import { ToastrModule } from 'ngx-toastr';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { OwlDateTimeModule, OwlNativeDateTimeModule } from 'ng-pick-datetime';
import { NgApexchartsModule } from 'ng-apexcharts';

@NgModule({
  declarations: [
    AppComponent,
    StocksComponent,
    HistoryRequestFormComponent,
    HistoryPricesListComponent,
    HistoryPricesChartComponent,
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    BrowserAnimationsModule,
    ToastrModule.forRoot(),
    OwlDateTimeModule,
    OwlNativeDateTimeModule,
    NgApexchartsModule
  ],
  providers: [
    StockMarketService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
