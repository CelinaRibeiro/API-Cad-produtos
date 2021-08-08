<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;

class CategoryController extends Controller
{
    public function create(Request $request) {
        $array = ['error' => ''];

        $rules = [
            'name' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        } 

        $name = $request->input('name');

        $newCategory = new Category();
        $newCategory->name = $name;
        $newCategory->save();

        return $array;
    }

    public function readAll() {
        $array = ['error' => ''];

        $categories = Category::simplePaginate(5); //define qtd p paginação

        $array['list'] = $categories->items();

        return $array;
    }

    public function read($id) {
        $array = ['error' => ''];

        $categories = Category::find($id);

        if($categories) {
            $array['categories'] = $categories;
        } else {
            $array['error'] = 'A categoria '.$id.' nao foi encontrada!';
        }

        return $array;
    }

    public function update(Request $request, $id) {
        $array = ['error' => ''];

         //regras para validação
        $rules = [
            'name' => 'required|string'
        ];

        //passa o validador do validator
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        //pega os campos com request
        $name = $request->input('name');
        
        //Pesquisa o item para atualização
        //Faz a atualização do item 
        $categories = Category::find($id);
        
         if($categories) {
             if($name) {
                 $categories->name = $name;
             }

             $categories->save();
         } else {
             $array['error'] = 'A categoria '.$id.' nao foi encontrada!';
         }

        return $array;
    }

    public function delete($id) {
        $array = ['error' => ''];

        $categories = Category::find($id);
        $categories->delete();

        return $array;
    }
}
