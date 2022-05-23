<?php

namespace App\Http\Controllers;

use App\Models\TypeProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller{
    public function index(){
        $type_product = TypeProduct::get();
        $category = Category::get();

        return view('backend.category.index', compact('category', 'type_product'));
    }

    public function postAdd(Request $data){
        $category = new Category();
        
        $category->type_product_id = $data->type_product_id;
        $category->name = $data->name;
        $category->name_slug = Str::slug($data->name, '-');
        $category->save();

        RecordController::add('Thêm danh mục ['.$data->name.']', $data->ip());

        return redirect()->route('backend.category');
    }

    public function postEdit(Request $data){
        $category = Category::find($data->id);
        RecordController::add('Chỉnh sửa danh mục ['.$category->name.'] thành ['.$data->name.']', $data->ip());
        $category->type_product_id = $data->type_product_id;
        $category->name = $data->name;
        $category->name_slug = Str::slug($data->name, '-');
        $category->save();

        return redirect()->route('backend.category');
    }

    public function delete(Request $data){
        if(Product::where('category_id', $data->id)->count() > 0){
            return false;
        }
        else{
            $category = Category::find($data->id);
            RecordController::add('Xóa danh mục ['.$category->name.']', $data->ip());
            $category->delete();

            return true;
        }

    }

    public function check(Request $data){
        return Category::where('name', $data->name)->count();
    }

    public static function show(){
        return Category::get();
    }
}
