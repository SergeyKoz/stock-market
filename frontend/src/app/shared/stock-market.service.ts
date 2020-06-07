import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Price } from './price.model';
import { HistoryRequestForm } from './history-request-form.model';
import { ToastrService } from 'ngx-toastr';
import { NgForm } from '@angular/forms';
import * as moment from 'moment';
import { Observable , BehaviorSubject} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class StockMarketService {

  formData: HistoryRequestForm = new HistoryRequestForm();

  readonly apiUrl = 'http://127.0.0.1:80/api';

  historicalPricesList: Price[] = [];

  private collectionsSubject: BehaviorSubject<Price[]>;
  collections$: Observable<Price[]>;

  constructor(private http: HttpClient, private toastr: ToastrService)
  {
    this.collectionsSubject = new BehaviorSubject<Price[]>(this.historicalPricesList);
    this.collections$ = this.collectionsSubject.asObservable();
  }

  getHistoricalPricesList(formData: NgForm)
  {
    formData.value.from = moment(formData.value.from).format('YYYY-MM-DD');
    formData.value.to = moment(formData.value.to).format('YYYY-MM-DD');
    this.http.get(this.apiUrl + '/stocks/historical-data', {params: formData.value})
      .toPromise()
      .then(res => {
        // @ts-ignore
        this.historicalPricesList = res.prices as Price[];
        this.collectionsSubject.next([...this.historicalPricesList]);
      }).catch(error => {
        const apiError = error.error.error;
        this.toastr.error(apiError.message, 'Get history error');

        if (apiError.fields !== undefined) {
          apiError.fields.forEach((field) => {
            if (apiError.fields.includes(field)) {
              formData.controls[field].setErrors({incorrect: true});
            }
          });
        }
      });
  }
}
