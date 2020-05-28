<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;


class Images extends Model
{
    //
use Sortable;
public $sortable =['id','name'];

    public function image_category(){

        return $this->hasMany('App\Image_category');
    }

    public function getimages(){


       $allimagesth = DB::table('images')
            ->leftJoin('image_categories', 'images.id', '=', 'image_categories.image_id')
            ->select('path','images.id','image_type')
           ->where('image_categories.image_type','THUMBNAIL')
            ->get();
        $allimages = DB::table('images')
            ->leftJoin('image_categories', 'images.id', '=', 'image_categories.image_id')
            ->select('path','images.id','image_type')
            ->where('image_categories.image_type','ACTUAL')

            ->get();

         $result =$allimages ->merge($allimagesth)->keyBy('id');

       return $result;

    }


    public function getimagedetail($id){

        $imagesdetail = DB::table('images')
            ->leftJoin('image_categories', 'images.id', '=', 'image_categories.image_id')
            ->where('images.id',$id)
            ->get();

        return $imagesdetail;



    }


    public function imagedata($filename, $Path, $width, $height, $user_id = null){

        if(Auth::user()){
            $user_id = Auth::user()->id;
        }else{
            $user_id = $user_id;
        }

        $imagedata = DB::table('images')->insert([
            ['name' => $filename, 'user_id' => $user_id]
        ]);
        $getimage_id =  DB::table('images')->where('name', $filename)->first();

        $image_id = $getimage_id->id;

        $imagecatedata = DB::table('image_categories')->insert([
            ['image_id' => $image_id, 'image_type' => '1', 'height' =>$height,'width' =>$width,'path' =>$Path]
        ]);
        return $image_id;

    }

    public function thumbnailrecord($filename,$Path,$width,$height){
      $getimage_id =  DB::table('images')->where('name', $filename)->first();
      $image_id = $getimage_id->id;

      $imagecatedata = DB::table('image_categories')->insert([
        ['image_id' => $image_id, 'image_type' => '2', 'height' =>$height,'width' =>$width,'path' =>$Path]
      ]);
    }


    public function Mediumrecord($filename,$Path,$width,$height){
        $getimage_id =  DB::table('images')->where('name', $filename)->first();
        $image_id = $getimage_id->id;
        $imagecatedata = DB::table('image_categories')->insert([
            ['image_id' => $image_id, 'image_type' => '4', 'height' =>$height,'width' =>$width,'path' =>$Path]
        ]);



    }


    public function Largerecord($filename,$Path,$width,$height){


        $getimage_id =  DB::table('images')->where('name', $filename)->first();

        $image_id = $getimage_id->id;

        $imagecatedata = DB::table('image_categories')->insert([
            ['image_id' => $image_id, 'image_type' => '3', 'height' =>$height,'width' =>$width,'path' =>$Path]
        ]);



    }






    public function thumbnailHeightWidth()
    {
        $Thumbnail_height = DB::table('settings')->where('name','Thumbnail_height')->get();
        $Thumbnail_width = DB::table('settings')->where('name','Thumbnail_width')->get();


        $thumbnailsetting = array($Thumbnail_height[0],$Thumbnail_width[0]);




    return $thumbnailsetting;
    }

    public function MediumHeightWidth()
    {
        $Medium_height = DB::table('settings')->where('name','Medium_height')->get();
        $Medium_width = DB::table('settings')->where('name','Medium_width')->get();


        $Mediumsetting = array($Medium_height[0],$Medium_width[0]);




        return $Mediumsetting;
    }

    public function LargeHeightWidth()
    {
        $Large_height = DB::table('settings')->where('name','Large_height')->get();
        $Large_width = DB::table('settings')->where('name','Large_width')->get();


        $Largesetting = array($Large_height[0],$Large_width[0]);




        return $Largesetting;
    }

    public function AllimagesHeightWidth()
    {
        $Thumbnail_height = DB::table('settings')->where('name','Thumbnail_height')->get();
        $Thumbnail_width = DB::table('settings')->where('name','Thumbnail_width')->get();
        $Medium_height = DB::table('settings')->where('name','Medium_height')->get();
        $Medium_width = DB::table('settings')->where('name','Medium_width')->get();
        $Large_height = DB::table('settings')->where('name','Large_height')->get();
        $Large_width = DB::table('settings')->where('name','Large_width')->get();


        $AllImagessetting = array($Thumbnail_height[0],$Thumbnail_width[0],$Medium_height[0],$Medium_width[0],$Large_height[0],$Large_width[0]);




        return $AllImagessetting;
    }

    public function imagedelete($id){
        $imagesdetail = DB::table('images')

            ->where('images.id',$id)
             ->delete();

        $imagesdetailcategories = DB::table('image_categories')

            ->where('image_categories.image_id',$id)
            ->delete();
        return  $imagesdetailcategories;
    }

}
