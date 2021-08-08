<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\CategoryController;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function create(Request $request) {
        $array = ['error' => ''];

        $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'expiration_date' => 'required',
            'price' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        } 

        $category_id = $request->input('category_id');
        $name = $request->input('name');
        $description = $request->input('description');
        $expiration_date = $request->input('expiration_date');
        $price = $request->input('price');

        $newproduct = new Product();
        $newproduct->category_id = $category_id;
        $newproduct->name = $name;
        $newproduct->description = $description;
        $newproduct->expiration_date = $expiration_date;
        $newproduct->price = $price;
        $newproduct->save();

        return $array;
    }

    public function readAll() {
        $array = ['error' => ''];

        $products = Product::simplePaginate(10);

        $array['list'] = $products->items();

        return $array;
    }

    public function read($id) {
        $array = ['error' => ''];

        $products = Product::find($id);

        if($products) {
            $array['products'] = $products;
        } else {
            $array['error'] = 'O produto '.$id.' nao foi encontrado!';
        }

        return $array;
    }

    public function update(Request $request, $id) {
        $array = ['error' => ''];

        $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'expiration_date' => 'required',
            'price' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $category_id = $request->input('category_id');
        $name = $request->input('name');
        $description = $request->input('description');
        $expiration_date = $request->input('expiration_date');
        $price = $request->input('price');

        $products = Product::find($id);

        if($products) {
            if($category_id) {
                $products->category_id = $category_id;
            }
            if($name) {
                $products->name = $name;
            }
            if($description) {
                $products->description = $description;
            }
            if($expiration_date) {
                $products->expiration_date = $expiration_date;
            }
            if($price) {
                $products->price = $price;
            }
            $products->save();
        } else {
            $array['error'] = 'O produto '.$id.' nao foi encontrado!';
        }

        return $array;
    }

    public function delete($id) {
        $array = ['error' => ''];

        $products = Product::find($id);
        $products->delete();

        return $array;
    }
}
