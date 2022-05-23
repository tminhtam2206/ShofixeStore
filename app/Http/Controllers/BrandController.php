<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller{
    public function check(Request $data){
        return Brand::where('name', $data->name)->count();
    }

    public function index(){
        $brand = Brand::get();

        return view('backend.brand.index', compact('brand'));
    }

    public function postAdd(Request $data){
        $folder = "";

        if(($data->hasFile('logo'))){
            $folder = addBrandLogo($data);
        }

        $brand = new Brand();
        $brand->name = $data->name;
        $brand->name_slug = Str::slug($data->name, '-');
        if($data->hasFile('logo')) { $brand->logo = $folder; };
        $brand->save();

        RecordController::add('Thêm thương hiệu ['.$data->name.']', $data->ip());

        return redirect()->route('backend.brand');
    }

    public function postEdit(Request $data){
        $folder = "";

        if(($data->hasFile('logo'))){
            $folder = editBrandLogo($data);
        }

        $brand = Brand::find($data->id);
        RecordController::add('Chỉnh sửa thương hiệu ['.$brand->name.'] thành ['.$data->name.']', $data->ip());

        if($brand->name != $data->name){
            $brand->name = $data->name;
            $brand->name_slug = Str::slug($data->name, '-'); 
        }

        if($data->hasFile('logo')) { $brand->logo = $folder; };
        $brand->save();


        return redirect()->route('backend.brand');
    }

    public function delete(Request $data){
        if(Product::where('brand_id', $data->id)->count() > 0){
            return false;
        }
        else{
            $brand = Brand::find($data->id);
            RecordController::add('Xóa thương hiệu ['.$brand->name.']', $data->ip());
            $brand->delete();

            return true;
        }
    }

    public static function show(){
        return Brand::get();
    }
}
