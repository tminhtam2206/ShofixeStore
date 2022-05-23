<?php

namespace App\Http\Controllers;

use App\Models\TypeProduct;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeProductController extends Controller{
    public function index(){
        $type_product = TypeProduct::get();

        return view('backend.type_product.index', compact('type_product'));
    }

    public function postAdd(Request $data){
        $type_product = new TypeProduct();
        $type_product->name = $data->name;
        $type_product->name_slug = Str::slug($data->name, '-');
        $type_product->save();

        RecordController::add('Thêm loại sản phẩm ['.$data->name.']', $data->ip());

        return redirect()->route('backend.type_product');
    }

    public function postEdit(Request $data){
        $type_product = TypeProduct::find($data->id);
        RecordController::add('Chỉnh sửa loại sản phẩm ['.$type_product->name.'] thành ['.$data->name.']', $data->ip());
        $type_product->name = $data->name;
        $type_product->name_slug = Str::slug($data->name, '-');
        $type_product->save();

        return redirect()->route('backend.type_product');
    }

    public function delete(Request $data){
        if(Category::where('type_product_id', $data->id)->count() > 0){
            return false;
        }
        else{
            $type_product = TypeProduct::find($data->id);
            RecordController::add('Xóa loại sản phẩm ['.$type_product->name.']', $data->ip());
            $type_product->delete();
            
            return true;
        }

    }

    public function check(Request $data){
        return TypeProduct::where('name', $data->name)->count();
    }

    public static function show($num){
        return TypeProduct::paginate($num);
    }
}
