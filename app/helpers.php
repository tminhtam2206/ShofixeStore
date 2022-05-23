<?php 
    use Intervention\Image\Facades\Image;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Auth;

    function randomCode(){
        $len = 32;
        return substr(md5(rand()), 0, $len);
    }

    function removeImages($files, $folder){
        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $storeName = $fileName.'.'.$extension;
            $file->move($folder, $storeName);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Change Avatar
    |--------------------------------------------------------------------------
    |
    */

    function changeAvatar(){
        $link_remove = storage_path().'/app/public/avatar/';
        
        $data = $_POST["image"];

        $image_array_1 = explode(";", $data);
       
        $image_array_2 = explode(",", $image_array_1[1]);
       
        $data = base64_decode($image_array_2[1]);

        $name_file = Str::slug(Auth::user()->name, '-').'-'.Auth::id().'.png';

        file_put_contents($link_remove.$name_file, $data); 

        return $name_file;
    }
        

    /*
    |--------------------------------------------------------------------------
    | Brand
    |--------------------------------------------------------------------------
    | Các chức năng dành cho thương hiệu
    |
    */

    function addBrandLogo($data){
        $folder_name = Str::slug($data->name, '-').'-'.randomCode();
        Storage::makeDirectory('public/brand/'.$folder_name);
        $link_remove = storage_path().'/app/public/brand/'.$folder_name;

        $file = $data->file('logo');
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $storeName = $fileName.'.'.$extension;
        $file->move($link_remove, $storeName);

        return $folder_name;
    }

    function editBrandLogo($data){
        $path_delete = 'public/brand'.'/'.$data->logo;
        Storage::deleteDirectory($path_delete);

        $folder_name = Str::slug($data->name, '-').'-'.randomCode();
        Storage::makeDirectory('public/brand/'.$folder_name);
        $link_remove = storage_path().'/app/public/brand/'.$folder_name;

        $file = $data->file('logo');
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $storeName = $fileName.'.'.$extension;
        $file->move($link_remove, $storeName);

        return $folder_name;
    }

    function getLogoBrand($folder){
        $directory = storage_path('app/public/brand').'/'.$folder; 
        $files = scandir($directory); 
        return asset('storage/app/public/brand').'/'.$folder.'/'.$files[2]; 
    }

    function deleteFolderBrand($folder){
        $path_delete = 'public/brand'.'/'.$folder;
        Storage::deleteDirectory($path_delete);
    }

    /*
    |--------------------------------------------------------------------------
    | Product
    |--------------------------------------------------------------------------
    | Các chức năng dành cho sản phẩm
    |
    */

    function addProduct($data){
        $files = $data->file('image');
        $random_name = Str::slug($data->name, '-').'-'.randomCode();
        $i = 0;

        /* remove images (351x420) */
        Storage::makeDirectory('public/product/'.$random_name);
        $link_remove = storage_path().'/app/public/product/'.$random_name;

        foreach ($files as $file){
            if($i <= 3){
                $fileName = $file->getClientOriginalName();
                $image_resize = Image::make($file->getRealPath());
                $image_resize->resize(351, 420);
                $image_resize->save($link_remove.'/'.$fileName);
                $i++;
            }
            else{
                break;
            }
        }

        /* Create folder thumb_lg (470x557) */
        Storage::makeDirectory('public/product/'.'/thumb-lg-'.$random_name);
        $link_remove = storage_path().'/app/public/product/'.'/thumb-lg-'.$random_name;

        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(470, 557);
            $image_resize->save($link_remove.'/'.$fileName);
            break;
        }

        return $random_name;
    }

    function MakeThumbProduct($data){
        $folder_name = Str::slug($data->name, '-').'-'.randomCode();
        Storage::makeDirectory('public/product/'.'/thumb-sm-'.$folder_name);
        $link_remove = storage_path().'/app/public/product/'.'/thumb-sm-'.$folder_name;

        $file = $data->file('thumb');
        $fileName = $file->getClientOriginalName();


        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize(472, 269);
        $image_resize->save($link_remove.'/'.$fileName);

        return $folder_name;
    }

    function firstProductImage($folder){
        $directory = storage_path('app/public/product').'/'.$folder; 
        $files = scandir($directory); 
        return asset('storage/app/public/product').'/'.$folder.'/'.$files[2]; 
    }

    function firstProductThum_SM($folder){
        $directory = storage_path('app/public/product').'/thumb-sm-'.$folder; 
        $files = scandir($directory); 
        return asset('storage/app/public/product').'/thumb-sm-'.$folder.'/'.$files[2]; 
    }

    function firstProductThum_LG($folder){
        $directory = storage_path('app/public/product').'/thumb-lg-'.$folder; 
        $files = scandir($directory); 
        return asset('storage/app/public/product').'/thumb-lg-'.$folder.'/'.$files[2]; 
    }

    function getListProductImage($folder){
        $path = storage_path('app/public/product').'/'.$folder;
        $arr = array();
        $i = 0;

        $before = asset('storage/app/public/product').'/'.$folder;
        $files = scandir($path);
        $files = array_diff(scandir($path), array('.', '..'));
        
        foreach($files as $file){
            if($i < 3){
                $arr[$i] = $before.'/'.$file;
                $i++;
            }
            else{
                break;
            }
        }

        return $arr;
    }

    function deleteProductFolder($image){
        $path_delete = 'public/product'.'/'.$image;
        Storage::deleteDirectory($path_delete);

        $path_delete = 'public/product'.'/'.'thumb-lg-'.$image;
        Storage::deleteDirectory($path_delete);
    }

    function deleteThumb($thumb){
        $path_delete = 'public/product'.'/'.'thumb-sm-'.$thumb;
        Storage::deleteDirectory($path_delete);
    }

    /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    | 
    |
    */

    function removeImages_Resize($files, $folder, $size){
        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize($size, $size);
            $image_resize->save($folder.'/'.$fileName);
        }
    }

    function createFolder($name){
        $link_folder = Str::slug($name, '-').'-'.randomCode();
        Storage::makeDirectory('public/product/'.$link_folder);

        return $link_folder;
    }

    function disCount($discount, $price){
        $new_price = number_format($price);

        if($discount > 0){
            $giam = (1 - ($discount / 100));
            $gia_moi = ($price * $giam);
            $new_price = number_format($gia_moi);
        }

        return $new_price;
    }
