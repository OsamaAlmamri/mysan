<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Models\Core\NewsCategory;
use App\Http\Controllers\AdminControllers\AlertController;
use DB;
use Lang;

class Menus extends Model
{

 public static function menus()
 {
   $language_id    =   '1';
   $items = DB::table('menus')
       ->leftJoin('menu_translation','menus.id', '=', 'menu_translation.menu_id')
       ->select('menus.*','menu_translation.menu_name as name', 'menus.parent_id')
       ->where('menu_translation.language_id','=', 1)
       ->orderBy('menus.sort_order', 'ASC')
       ->groupBy('menus.id')
       ->paginate(20);

    if($items->isNotEmpty()){
       $childs = array();
       foreach($items as $item)
           $childs[$item->parent_id][] = $item;

       foreach($items as $item) if (isset($childs[$item->id]))
           $item->childs = $childs[$item->id];

        if(!empty($childs[0])){
            $menus = $childs[0];
         }else{
             $menus = $childs;
         }
    }
   $result["submenus"] = $menus;
   $menus = DB::table('menus')
     ->leftJoin('menu_translation', 'menu_translation.menu_id', '=', 'menus.id')
     ->where([
           ['menu_translation.language_id','=',$language_id],
         ])
         ->where('menus.parent_id','=', 0)
     ->select('menus.*','menu_translation.menu_name as name')
     ->orderBy('menus.sort_order', 'ASC')
     ->paginate(20);

   $result["menus"] = $menus;

   return $result;
 }

 public static function addmenus()
{
  $language_id      =   '1';

  $result = array();

  //get function from other controller
  $myVar = new NewsCategory();
  $result['newsCategories'] = $myVar->getter($language_id);

  //get function from other controller
  $myVar = new SiteSettingController();
  $result['languages'] = $myVar->getLanguages();

  $menus = DB::table('menus')
    ->leftJoin('menu_translation', 'menu_translation.menu_id', '=', 'menus.id')
    ->where([
          ['menu_translation.language_id','=',$language_id],
          ['menus.parent_id','=',0],
        ])
    ->select('menus.*','menu_translation.menu_name as name')
    ->orderBy('menus.sort_order', 'ASC')
    ->get();

    $result["menus"] = $menus;

  $pages = DB::table('pages')
    ->leftJoin('pages_description', 'pages_description.page_id', '=', 'pages.page_id')
    ->where([
          ['pages_description.language_id','=',$language_id],
          ['pages.type','=','1']
        ])
    ->orderBy('pages.page_id', 'ASC')
    ->get();

  $result["pages"] = $pages;

  return $result;
}

public static function addnewmenu($request)
{
  		//get function from other controller
  		$myVar = new SiteSettingController();
  		$languages = $myVar->getLanguages();
        $order = DB::table('menus')->max('sort_order');
        $order = $order + 1;

  		$menu_id = DB::table('menus')->insertGetId([
  					'parent_id'		 			 =>   $request->parent_id,
  					'type'		 			 =>   $request->type,
  					'status'		 		 =>   $request->status,
            'external_link' => $request->external_link,
            'link' => $request->link,
  					]);
      if($request->parent_id == 0){
        DB::table('menus')->where('id',$menu_id)
        ->update([
          'sort_order' => $order,
        ]);
      }
      else{
        DB::table('menus')->where('id',$menu_id)
        ->update([
          'sub_sort_order' => $order,
        ]);
      }
      if($request->type == 2){
        DB::table('menus')->where('id',$menu_id)
        ->update([
          'page_id' => $request->page_id
        ]);
      }

      $myVar = new SiteSettingController();
      $languages = $myVar->getLanguages();
      foreach($languages as $languages_data){
        $menu_name = 'menuName_'.$languages_data->languages_id;
        // $checkExist = DB::table('menu_translation')->where('menu_id',)($categories_id,$languages_data);
          $menu_name = $request->$menu_name;
           DB::table('menu_translation')->insert([
                'menu_id'		 			 =>   $menu_id,
                'language_id'		 			 =>   $languages_data->languages_id,
                'menu_name'		 		 =>   $menu_name,
                ]);
        //   if(count($checkExist)>0){
        //     $category_des_update = $this->Categories->updatedescription($categories_name,$languages_data,$categories_id);
        // }else{
        //     $updat_des = $this->Categories->insertcategorydescription($categories_name,$categories_id, $languages_data->languages_id);
        // }
      }

}

public static function editmenu($id)
{
  $language_id      =   '1';
  $menu_id     	  =   $id;

  $result = array();

  //get function from other controller
  $myVar = new SiteSettingController();
  $result['languages'] = $myVar->getLanguages();


    $menus = DB::table('menus')
      ->leftJoin('menu_translation', 'menu_translation.menu_id', '=', 'menus.id')
      ->where([
            ['menu_translation.language_id','=',$language_id],
            ['menus.id','=',$menu_id]
          ])
      ->select('menus.*','menu_translation.menu_name as name')
      ->orderBy('menus.id', 'ASC')
      ->get();

      $result["menus"] = $menus;

      $allmenus = DB::table('menus')
        ->leftJoin('menu_translation', 'menu_translation.menu_id', '=', 'menus.id')
        ->where([
              ['menu_translation.language_id','=',$language_id],
            ])
        ->select('menus.*','menu_translation.menu_name as name')
        ->orderBy('menus.id', 'ASC')
        ->get();
        $result["allmenus"] = $allmenus;


    $pages = DB::table('pages')
      ->leftJoin('pages_description', 'pages_description.page_id', '=', 'pages.page_id')
      ->where([
            ['pages_description.language_id','=',$language_id],
            ['pages.type','=','1']
          ])
      ->orderBy('pages.page_id', 'ASC')
      ->get();

    $result["pages"] = $pages;

    $description_data = array();
    foreach($result['languages'] as $languages_data){

      $description = DB::table('menu_translation')->where([
          ['language_id', '=', $languages_data->languages_id],
          ['menu_id', '=', $menu_id],
        ])->get();

      if(count($description)>0){
        $description_data[$languages_data->languages_id]['name'] = $description[0]->menu_name;
        $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
        $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
      }else{
        $description_data[$languages_data->languages_id]['name'] = '';
        $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
        $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
      }
    }
    $result["description"] = $description_data;


  return $result;
}

public static function updatemenu($request)
{

  		$menu_id      =   $request->id;
  		//get function from other controller
      $myVar = new SiteSettingController();
  		$languages = $myVar->getLanguages();
      $current = DB::table('menus')->where('id',$menu_id)->first();
      if($current->parent_id == 0){
        $this_id = 'is_parent';
        if($request->parent_id == 0){
          $this_id_going_to = 'still_parent';
        }else{
          $this_id_going_to = 'be_child';
        }
      }
      else{
        $this_id = 'is_child';
        if($request->parent_id == 0){
          $this_id_going_to = 'be_parent';
        }else{
          $this_id_going_to = 'still_child';
        }
      }

      if($this_id == 'is_parent' && $this_id_going_to == 'still_parent'){
        $already_exist = DB::table('menus')->where('sort_order',$request->sort_order)->first();
        $current = DB::table('menus')->where('id',$menu_id)->first();

        if($already_exist){
          DB::table('menus')->where('id',$already_exist->id)
            ->update([
              'sort_order' => $current->sort_order,
            ]);

              $order = $request->sort_order;

        }
        else{
          $order = DB::table('menus')->max('sort_order');
          $order = $order + 1;

        }

        DB::table('menus')
         ->where('id',$menu_id)
         ->update([
              'parent_id'		 			 =>   0,
              'type'		 			 =>   $request->type,
              'status'		 		 =>   $request->status,
              'external_link' => $request->external_link,
              'link' => $request->link,
              'page_id' => $request->page_id,
              'sort_order' => $order
           ]);
     }
     if($this_id == 'is_parent' && $this_id_going_to == 'be_child'){
       $order = DB::table('menus')->where('parent_id',$request->parent_id)->max('sub_sort_order');
       $order = $order + 1;

       DB::table('menus')
        ->where('id',$menu_id)
        ->update([
             'parent_id'		 			 =>   $request->parent_id,
             'type'		 			 =>   $request->type,
             'status'		 		 =>   $request->status,
             'external_link' => $request->external_link,
             'link' => $request->link,
             'page_id' => $request->page_id,
             'sub_sort_order' => $request->sort_order,
             'sort_order' => null

          ]);
    }
    if($this_id == 'is_child' && $this_id_going_to == 'be_parent'){

        $order = DB::table('menus')->max('sort_order');
        $order = $order + 1;


      DB::table('menus')
       ->where('id',$menu_id)
       ->update([
            'parent_id'		 			 =>   0,
            'type'		 			 =>   $request->type,
            'status'		 		 =>   $request->status,
            'external_link' => $request->external_link,
            'link' => $request->link,
            'page_id' => $request->page_id,
            'sort_order' => $order,
            'sub_sort_order' => null
         ]);

   }
   if($this_id == 'is_child' && $this_id_going_to == 'still_child'){
     $parent = DB::table('menus')->where('id',$menu_id)->first();
     $parent_id = $parent->parent_id;
     $already_exist = DB::table('menus')->where('parent_id',$parent_id)->where('sub_sort_order',$request->sort_order)->first();
     $current = DB::table('menus')->where('id',$menu_id)->first();
     if($already_exist){
       DB::table('menus')->where('id',$already_exist->id)
         ->update([
           'sub_sort_order' => $current->sub_sort_order,
         ]);


           $order = $already_exist->sub_sort_order;

     }
     else{
       $order = $request->sort_order;

     }
       DB::table('menus')
        ->where('id',$menu_id)
        ->update([
             'parent_id'		 			 =>   $request->parent_id,
             'type'		 			 =>   $request->type,
             'status'		 		 =>   $request->status,
             'external_link' => $request->external_link,
             'link' => $request->link,
             'page_id' => $request->page_id,
             'sub_sort_order' => $order
          ]);
     }
        $myVar = new SiteSettingController();
        $languages = $myVar->getLanguages();
        foreach($languages as $languages_data){
          $menu_name = 'menuName_'.$languages_data->languages_id;

          $checkExist = DB::table('menu_translation')->where('menu_id',$menu_id)->where('language_id',$languages_data->languages_id)->first();
            $menu_namee = $request->$menu_name;
            if($checkExist){
              DB::table('menu_translation')
                ->where('menu_id',$menu_id)
                ->where('language_id',$languages_data->languages_id)
                ->update([
                   'menu_name'		 		 =>   $menu_namee,
                   ]);
              }else{
                DB::table('menu_translation')->insert([
                     'menu_id'		 			 =>   $menu_id,
                     'language_id'		 			 =>   $languages_data->languages_id,
                     'menu_name'		 		 =>   $menu_namee,
                     ]);
          }
        }


}

public static function deletemenu($id){
    DB::table('menus')->where('id',$id)->delete();
    DB::table('menu_translation')->where('menu_id',$id)->delete();
}

public static function pageStatus($request)
{
  if(!empty($request->id)){
    if($request->active=='no'){
      $status = '0';
    }elseif($request->active=='yes'){
      $status = '1';
    }
    DB::table('pages')->where('page_id', '=', $request->id)->update([
      'status'		 =>	  $status
      ]);
    }

}

public static function webpages($request)
{
  $language_id    =   '1';

  $pages = DB::table('pages')
    ->leftJoin('pages_description', 'pages_description.page_id', '=', 'pages.page_id')
    ->where([
          ['pages_description.language_id','=',$language_id],
          ['pages.type','=','2']
        ])
    ->orderBy('pages.page_id', 'ASC')
    ->paginate(20);

  $result["pages"] = $pages;
  return $result;
}

public static function addwebpage($request)
{
  $language_id      =   '1';

  $result = array();

  //get function from other controller
  $myVar = new NewsCategory();
  $result['newsCategories'] = $myVar->getter($language_id);

  //get function from other controller
  $myVar = new SiteSettingController();
  $result['languages'] = $myVar->getLanguages();

  return $result;
}

public static function addnewwebpage($request)
{

  		//get function from other controller
  		$myVar = new SiteSettingController();
  		$languages = $myVar->getLanguages();

  		$slug = str_replace(' ','-' ,trim($request->slug));
  		$slug = str_replace('_','-' ,$slug);

  		$page_id = DB::table('pages')->insertGetId([
  					'slug'		 			 =>   $slug,
  					'type'		 			 =>   2,
  					'status'		 		 =>   $request->status,
  					]);

  		foreach($languages as $languages_data){
  			$name = 'name_'.$languages_data->languages_id;
  			$description = 'description_'.$languages_data->languages_id;

  			DB::table('pages_description')->insert([
  					'name'  	    		 =>   $request->$name,
  					'language_id'			 =>   $languages_data->languages_id,
  					'page_id'				 =>   $page_id,
  					'description'			 =>   addslashes($request->$description)
  					]);
  		}

}

public static function editwebpage($request)
{
  $language_id      =   '1';
  $page_id     	  =   $request->id;

  $result = array();

  //get function from other controller
  $myVar = new SiteSettingController();
  $result['languages'] = $myVar->getLanguages();


  $pages = DB::table('pages')
    ->leftJoin('pages_description', 'pages_description.page_id', '=', 'pages.page_id')
    ->select('pages.*','pages_description.description','pages_description.language_id','pages_description.name' ,'pages_description.page_description_id')
    ->where('pages.page_id','=', $page_id)
    ->get();

  $description_data = array();
  foreach($result['languages'] as $languages_data){

    $description = DB::table('pages_description')->where([
        ['language_id', '=', $languages_data->languages_id],
        ['page_id', '=', $page_id],
      ])->get();

    if(count($description)>0){
      $description_data[$languages_data->languages_id]['name'] = $description[0]->name;
      $description_data[$languages_data->languages_id]['description'] = $description[0]->description;
      $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
      $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
    }else{
      $description_data[$languages_data->languages_id]['name'] = '';
      $description_data[$languages_data->languages_id]['description'] = '';
      $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
      $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
    }
  }

  $result['description'] = $description_data;
  $result['editPage'] = $pages;

  return $result;
}

public static function updatewebpage($request)
{
  $page_id      =   $request->id;

  //get function from other controller
  $myVar = new SiteSettingController();
  $languages = $myVar->getLanguages();

  $slug = str_replace(' ','-' ,trim($request->slug));
  $slug = str_replace('_','-' ,$slug);

  DB::table('pages')->where('page_id','=',$page_id)->update([
        'slug'		 			 =>   $slug,
        'type'		 			 =>   2,
        'status'		 		 =>   $request->status,
        ]);


  foreach($languages as $languages_data){
    $name = 'name_'.$languages_data->languages_id;
    $description = 'description_'.$languages_data->languages_id;

    $checkExist = DB::table('pages_description')->where('page_id','=',$page_id)->where('language_id','=',$languages_data->languages_id)->get();

    if(count($checkExist)>0){
      DB::table('pages_description')->where('page_id','=',$page_id)->where('language_id','=',$languages_data->languages_id)->update([
        'name'  	    		 =>   $request->$name,
        'language_id'			 =>   $languages_data->languages_id,
        'description'			 =>   addslashes($request->$description)
        ]);
    }else{
      DB::table('pages_description')->insert([
        'name'  	    		 =>   $request->$name,
        'language_id'			 =>   $languages_data->languages_id,
        'page_id'				 =>   $page_id,
        'description'			 =>   addslashes($request->$description)
        ]);
    }
  }


}

public static function pageWebStatus($request)
{
  if(!empty($request->id)){
    if($request->active=='no'){
      $status = '0';
    }elseif($request->active=='yes'){
      $status = '1';
    }
    DB::table('pages')->where('page_id', '=', $request->id)->update([
      'status'		 =>	  $status
      ]);
    }

}


}
