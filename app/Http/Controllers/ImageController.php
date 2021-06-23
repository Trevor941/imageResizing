<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class ImageController extends Controller
{
   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function staffImages(){
        
        return view('staff');
    }

    public function productsImages(){
       
        return view('products');
    }

    public function resizeStaffImages(Request $request){
        // $image = $request->file;
        // $filename = $image->getClientOriginalName();
        // $image_resize = Image::make($image->getRealPath());
        // $image_resize->resize(250, 250);
        // $image_resize->save(public_path('images/'.$filename));
        // return "Image has been resized successfully";
        $this->validate($request,[
            'file'=>'required|image|mimes:jpeg,png,jpg'
        ]);
        $imageSize = getimagesize($request->file);
        $width = $imageSize[0];
        $height = $imageSize[1];
        $image = $request->file;
        if($width <= 250){
         $height = $width;
        $filename = $image->getClientOriginalName();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize($height, $width);
        $image_resize->save(public_path('images/'.$filename));
        return back()->with('success',"Image has been resized successfully visit the images folder in public folder in public directory in your project");
                 
     }
     else{
        $filename = $image->getClientOriginalName();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(250, 250);
        $image_resize->save(public_path('images/'.$filename));
        return back()->with('success',"Image has been resized successfully visit the images folder in public folder in public directory in your project");
     }
    }

    public function resizeProductsImages(Request $request){
        $this->validate($request,[
            'file'=>'required|image|mimes:jpeg,png,jpg'
        ]);
        $imageSize = getimagesize($request->file);
        $width = $imageSize[0];
        $height = $imageSize[1];
        $image = $request->file;
        if($width <= 300){
        $filename = $image->getClientOriginalName();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(null, $width, function ($constraint) {
            $constraint->aspectRatio();
       });
        $image_resize->save(public_path('images/'.$filename));
        return back()->with('success',"Image has been resized successfully visit the images folder in public directory in your project");
                 
     }
     else{
        $filename = $image->getClientOriginalName();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
       });
        $image_resize->save(public_path('images/'.$filename));
        return back()->with('success',"Image has been resized successfully visit the images folder in public directory in your project");
     }
    }
   


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resizeImagePost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $image = $request->file('image');
        $imagename = time().'.'.$image->extension();
     
        $destinationPath = public_path('thumbnail');
        $img = Image::make($image->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'\\'.$imagename);
   
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $imagename);
   
        return back()
            ->with('success','Image Upload successful')
            ->with('imageName',$imagename);
    }
}
