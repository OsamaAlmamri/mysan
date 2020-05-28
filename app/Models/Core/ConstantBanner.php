<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;



class constantBanner extends Model
{
    //
    use Sortable;

    public function images(){
        return $this->belongsTo('App\Images');
    }

    public function image_category(){
        return $this->belongsTo('App\Image_category');
    }

    public $sortable = ['banners_id','banners_title','created_at'];

    public static function paginator(){
        $result = array();
		$message = array();

		$banners = DB::table('constant_banners')
		->join('languages','languages.languages_id','=','constant_banners.languages_id')
		->leftJoin('image_categories','constant_banners.banners_image','=','image_categories.image_id')
		->select('constant_banners.*','image_categories.path','languages.name as language_name')
		->groupBy('constant_banners.banners_id')
		->orderBy('constant_banners.banners_id','ASC')
		->paginate(20);

		$result['message'] = $message;
        $result['banners'] = $banners;
        return $result;
    }

    public static function existbanner($request){
        $exist = DB::table('constant_banners')->where([
            'type'					 =>	  $request->type,
            'languages_id'			 =>	  $request->languages_id
            ])->get();


        if(count($exist)>0){
            return 1;
        }else{
            return 0;
        }

    }

    public static function insert($request){

        if($request->image_id){
            $uploadImage = $request->image_id;
        }else{
            $uploadImage = '';
        }
        DB::table('constant_banners')->insert([
                'banners_title'  		 =>   $request->type,
                'date_added'	 		 =>   date('Y-m-d H:i:s'),
                'banners_image'			 =>	  $uploadImage,
                'banners_url'	 		 =>   $request->banners_url,
                'status'	 			 =>   $request->status,
                'type'					 =>	  $request->type,
                'languages_id'			 =>	  $request->languages_id
                ]);
    }


    public static function edit($request){

        $banners = DB::table('constant_banners')
            ->leftJoin('image_categories','constant_banners.banners_image','=','image_categories.image_id')
            ->where('banners_id', $request->id)
            ->select('constant_banners.*','image_categories.path')
            ->groupBy('constant_banners.banners_id')
            ->get();

        return $banners;

    }


    public static function existbannerforupdate($request){
        $exist = DB::table('constant_banners')->where([
            'type'					 =>	  $request->type,
            'languages_id'			 =>	  $request->languages_id
            ])->where('banners_id','!=',$request->id)->get();


        if(count($exist)>0){
            return 1;
        }else{
            return 0;
        }

    }

    public static function updatebanner($request){

        $type = $request->type;

		if($type=='category'){
			$banners_url = $request->categories_id;
		}else if($type=='product'){
			$banners_url = $request->products_id;
		}else{
			$banners_url = '';
        }

        if($request->image_id){
            $uploadImage = $request->image_id;
            DB::table('constant_banners')->where('banners_id', $request->id)->update([
                'banners_title'  		 =>   $request->type,
                'date_added'	 		 =>   date('Y-m-d H:i:s'),
                'banners_image'			 =>	  $uploadImage,
                'banners_url'	 		 =>   $request->banners_url,
                'status'	 			 =>   $request->status,
                'type'					 =>	  $request->type,
                'languages_id'			 =>	  $request->languages_id
                ]);
		}else{
            DB::table('constant_banners')->where('banners_id', $request->id)->update([
                'banners_title'  		 =>   $request->type,
                'date_added'	 		 =>   date('Y-m-d H:i:s'),
                'banners_url'	 		 =>   $request->banners_url,
                'status'	 			 =>   $request->status,
                'type'					 =>	  $request->type,
                'languages_id'			 =>	  $request->languages_id
                ]);
		}
    }

    public static function deletebanners($request){
        DB::table('constant_banners')->where('banners_id', $request->banners_id)->delete();
    }

}
