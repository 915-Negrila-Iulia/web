import { Injectable } from '@angular/core';
import {HttpClient, HttpParams} from "@angular/common/http";

import { map } from 'rxjs/operators';
import { Recipe } from './recipe';

@Injectable({
  providedIn: 'root'
})
export class RecipeService {
  baseUrl = 'http://localhost/labWeb/lab7';
  constructor(private http: HttpClient) { }
  // getAll() - return list of recipes wrapped inside an Observable
  getAll(){
    // get() - fetch data from server side
    return this.http.get(`${this.baseUrl}/ang.php`).pipe(
      map((res: any) => {
        return res['data'];
      })
    )
  }

  store(recipe: Recipe){
    // post() - send data to the server side
    return this.http.post(`${this.baseUrl}/insertAng.php`,{ data: recipe }).pipe(
      map((res: any) => {
        return res['data'];
      })
    )
  }

  update(recipe: Recipe){
    return this.http.put(`${this.baseUrl}/updateAng.php`, { data: recipe });
  }

  delete(id: any){
    const params = new HttpParams().set('id',id.toString());
    return this.http.delete(`${this.baseUrl}/deleteAng.php`,{params: params});
  }

  getFiltered(filterText: any){
    return this.http.get(`${this.baseUrl}/ang.php`).pipe(
      map((res: any) => {
        return res['data'];
      })
    )
  }
}
