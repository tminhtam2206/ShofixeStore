<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\FrameColor;
use App\Models\FrameSize;
use App\Models\Brand;
use App\Models\TypeProduct;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductSizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller{

    public function all(){
        $product = Product::orderBy('created_at', 'desc')->get();

        return view('backend.product.index', compact('product'));
    }

    public function approval(){
        $product = Product::where('approval', 'YES')->orderBy('created_at', 'desc')->get();

        return view('backend.product.index', compact('product'));
    }

    public function pending(){
        $product = Product::where('approval', 'NO')->orderBy('created_at', 'desc')->get();

        return view('backend.product.index', compact('product'));
    }
    
    public function getAdd(){
        $type_product = TypeProduct::get();
        $color = FrameColor::get();
        $size = FrameSize::get();
        $brand = Brand::get();

        return view('backend.product.add', compact('type_product', 'color', 'size', 'brand'));
    }

    public function postAdd(Request $request){
        $folder_name = "";
        $thumb = "";

        if (($request->hasFile('image'))) {
            $folder_name = addProduct($request);
        }

        if (($request->hasFile('thumb'))) {
            $thumb = MakeThumbProduct($request);
        }

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->code = Str::upper($request->code);
        $product->name = $request->name;
        $product->name_slug = Str::slug($request->name, '-');
        $product->image = $folder_name;
        $product->thumb = $thumb;
        $product->unit_price = str_replace(',', '', $request->unit_price);
        $product->price = str_replace(',', '', $request->price);
        $product->import = $request->import;
        $product->exist = $request->import;
        $product->discount = $request->discount;
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->video = $request->video;
        $product->save();

        if($request->input('product_color') != null){
            foreach($request->input('product_color') as $value){
                ProductColorController::add($product->id, $value);
            }
        }

        if($request->input('product_size') != null){
            foreach($request->input('product_size') as $value){
                ProductSizeController::add($product->id, $value);
            }
        }

        RecordController::add('Thêm sản phẩm ['.$request->name.']', $request->ip());

        return redirect()->route('backend.product');
    }

    public function getEdit($id){
        $product = Product::find($id);
        $type_product = TypeProduct::get();
        $color = FrameColor::get();
        $size = FrameSize::get();
        $brand = Brand::get();
        $product_color = ProductColorController::show($id);
        $product_size = ProductSizeController::show($id);

        return view('backend.product.edit', compact('type_product', 'color', 'size', 'brand', 'product', 'product_color', 'product_size'));
    }

    public function postEdit(Request $request){
        $product = Product::find($request->id);
        $link_folder = '';
        $thumb = '';

        if(($request->has('image'))){
            deleteProductFolder($product->image);
            $link_folder = addProduct($request);
        }

        if(($request->has('thumb'))){
            deleteThumb($product->thumb);
            $thumb = MakeThumbProduct($request);
        }

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->code = Str::upper($request->code);
        $product->name = $request->name;
        $product->name_slug = Str::slug($request->name, '-');
        if($link_folder != ''){$product->image = $link_folder;}
        if($thumb != ''){$product->thumb = $thumb;}
        $product->unit_price = str_replace(',', '', $request->unit_price);
        $product->price = str_replace(',', '', $request->price);
        $product->import = $product->import + $request->import;
        $product->exist = $product->exist + $request->import;
        $product->discount = $request->discount;
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->video = $request->video;
        $product->save();

        ProductColorController::delete($product->id);
        ProductSizeController::delete($product->id);
        
        if($request->input('product_color') != null){
            foreach($request->input('product_color') as $value){
                ProductColorController::add($product->id, $value);
            }
        }

        if($request->input('product_size') != null){
            foreach($request->input('product_size') as $value){
                ProductSizeController::add($product->id, $value);
            }
        }

        RecordController::add('Sửa sản phẩm ['.$request->name.']', $request->ip());
        
        return redirect()->route('backend.product');
    }

    public function editStatus(Request $data){
        $product = Product::find($data->id);

        if($data->status == 'hide'){
            $product->status = 'show';
        }
        else{
            $product->status = 'hide';
        }

        RecordController::add('Đổi trạng thái sản phẩm ['.$product->name.']', $data->ip());

        $product->save();
    }

    public function editApproval(Request $data){
        $product = Product::find($data->id);

        if($data->approval == 'YES'){
            $product->approval = 'NO';
        }
        else{
            $product->approval = 'YES';
        }

        RecordController::add('Đổi trạng thái duyệt sản phẩm ['.$product->name.']', $data->ip());

        $product->save();
    }

    public function getCategory(Request $data){
        $category = Category::where('type_product_id', $data->id)->get();

        $data = '';

        foreach($category as $value){
            $data .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }

        $data_return = '<option value="">-- Chọn --</option>'.$data;
        return $data_return;
    }

    public function checkCode(Request $data){
        return Product::where('code', $data->code)->count();
    }

    public function delete(Request $data){
        $product = Product::find($data->id);

        if(OrderDetail::where('product_id', $data->id)->count() > 0){
            return false;
        }
        else{
            deleteProductFolder($product->image);
            deleteThumb($product->thumb);
            ProductColorController::delete($product->id);
            ProductSizeController::delete($product->id);
            RecordController::add('Xóa sản phẩm ['.$product->name.']', $data->ip());
            $product->delete();

            return true;
        }
    }


    /*
    |--------------------------------------------------------------------------
    |Product call by controller
    |--------------------------------------------------------------------------
    | sản phẩm mà trang home gọi tới
    |
    */

    public static function getNewProduct(){
        return Product::where('status', 'show')->where('approval', 'YES')->orderBy('created_at', 'desc')->paginate(16);
    }

    public static function getHotProduct(){
        return Product::where('status', 'show')->where('approval', 'YES')->where('discount', '>', 0)->orderBy('created_at', 'desc')->paginate(4);
    }

    //Sản phẩm bán chạy
    public static function getSelling(){
        
    }

    public static function getFeatured(){
        return Product::where('status', 'show')->where('approval', 'YES')->where('discount', '>', 0)->orderBy('marks', 'desc')->paginate(16);
    }

    public static function getProductDetail($id){
        return Product::find($id);
    }

    public static function getRelated($category_id){
        return Product::where('status', 'show')->where('approval', 'YES')->where('category_id', $category_id)->paginate(16);
    }

    public static function update_exist($product_id, $num){
        $product = Product::find($product_id);
        $product->exist = ($product->exist - $num);
        $product->save();
    }

    public static function updateRacting($id, $marks){
        $product = Product::find($id);
        $product->num_of_review = ($product->num_of_review +1);
        $product->marks = $marks;
        $product->save();
    }

    public static function count(){
        return Product::count();
    }

    public static function search_product($data){
        return Product::where('name', 'like', '%'.$data->key.'%')->get();
    }

    public static function search_product_ajax($data){
        return Product::where('name', 'like', '%'.$data->key.'%')->paginate(8);
    }
}
