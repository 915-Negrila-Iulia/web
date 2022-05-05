import { Component } from '@angular/core';
//imports
import { OnInit } from '@angular/core';
import { Recipe } from './recipe';
import { RecipeService } from "./recipe.service";
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit{
  recipes: Recipe[] = []; //variable 'recipes' stores array of Recipe elems retrieved from server
  recipe: Recipe = {recipeName:'', type:'', description:'', uid:-1}; //rid is optional ('?'); it is provided by the db

  filterText = '';
  prevFilter = ['noPrevFilter'];

  error = '';
  success = '';

  constructor(private recipeService: RecipeService) {
  }
  ngOnInit(){
    this.getRecipes();
  }

  getRecipes(): void{
    this.recipeService.getAll().subscribe(
      (data: Recipe[]) => { //first callback; handles successful retrieval
        this.recipes = data;
        this.success = 'successful retrieval of the list';
      },
      (err) => { // second callback; handles errors
        console.log(err);
        this.error = err;
      }
    );
  }

  addRecipe(f: NgForm): void{ //send values from the form to the store() method of service
    this.resetAlerts();
    this.recipeService.store(this.recipe).subscribe(
      (res: Recipe) => {
        //update list of recipes
        this.recipes.push(res);
        //inform the user
        this.success = 'Created and Added successfully';
        //reset the form
        f.reset();
      },
      (err) => (this.error = err.message)
    );
  }

  updateRecipe(rid: any, recipeName: any, type: any, description: any, uid: any): void{
    this.resetAlerts();
    this.recipeService
      .update({rid: rid, recipeName: recipeName.value, type: type.value, description: description.value, uid: uid})
      .subscribe(
        (res) => {
          this.success = 'Updated successfully';
        },
        (err)=>(this.error=err)
      );
  }

  deleteRecipe(id: number): void{
    this.resetAlerts();
    this.recipeService.delete(id).subscribe(
      (res) => {
        this.recipes = this.recipes.filter(function (item){
          return item['rid'] && item['rid'] !== id;
        })
        this.success = 'Deleted successfully';
      },
      (err)=>(this.error = err)
    )
  }

  filterRecipes(filterText: any): void{
    this.recipeService.getFiltered(filterText).subscribe(
      (data: Recipe[]) => { //first callback; handles successful retrieval
        this.recipes = data.filter(function (item){
          return item['rid'] && item['type'] == filterText;
        })
        this.success = 'Filtered successfully';
      },
      (err) => { // second callback; handles errors
        console.log(err);
        this.error = err;
      }
    );
  }

  changePrevFilter(): void{
    this.prevFilter.push(this.filterText);
  }

  resetAlerts(){
    this.error = '';
    this.success = '';
  }
  title = 'my-project';
}
