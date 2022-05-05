import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
//communicate with the server through HttpClient module
import { HttpClientModule } from "@angular/common/http";
//to be able to work with forms
import { FormsModule } from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    //add it here too
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
