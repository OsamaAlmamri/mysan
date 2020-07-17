<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Core\Categories;
use App\Models\Core\Images;
use App\Models\Core\Languages;
use App\Models\Core\ProductQuestion;
use App\Models\Core\Products;
use App\Models\Core\Setting;
use App\QuestionReplay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ProductQuestionController extends Controller

{


    public function __construct(Products $products, Languages $language, Images $images, Categories $category, Setting $setting,
                                ProductQuestion $productQuestion)
    {
        $this->category = $category;
        $this->productQuestion = $productQuestion;
        $this->language = $language;
        $this->images = $images;
        $this->products = $products;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myVaralter = new AlertController($setting);
        $this->Setting = $setting;

    }

    public function product_questions(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.product_questions"));
        $result = array();
        $data = $this->productQuestion->paginator();
        $result['productQuestion'] = $data;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.product_questions.index", $title)->with('result', $result);

    }
    public function replay_product_questions(Request $request)
    {
        $dada = array(
            'product_question_id' => $request->ques_ques_id,
            'text' => $request->reply,
            'replay_user_id' => auth()->user()->id,
            'replay_user_type' => 'admin',
        );
        if ($request->ques_ques_replay_id == 0)
            $replay = QuestionReplay::create($dada);
        else {
            $replay = QuestionReplay::find($request->ques_ques_replay_id);
            $replay->update($dada);
        }
        return response($replay, 200);
    }

    public function delete_replay(Request $request)
    {

        $replay = QuestionReplay::find($request->reply_id)->delete();

        return response($replay==true?1:0, 200);
    }

    public function edit_product_questions($id, $status)
    {
        if ($status == 1) {
            DB::table('product_questions')
                ->where('product_question_id', $id)
                ->update([
                    'question_status' => 1,
                ]);
            DB::table('product_questions')
                ->where('product_question_id', $id)
                ->update([
                    'question_read' => 1,
                ]);
        } elseif ($status == 0) {
            DB::table('product_questions')
                ->where('product_question_id', $id)
                ->update([
                    'question_read' => 1,
                ]);
        } else {
            DB::table('product_questions')
                ->where('product_question_id', $id)
                ->update([
                    'question_read' => 1,
                    'question_status' => -1,
                ]);
        }
        $message = Lang::get("labels.product_question_updateMessage");
        return redirect()->back()->withErrors([$message]);

    }
    public function show_product_questions($id)
    {
        $title = array('pageTitle' => Lang::get("labels.product_question_replies"));
        $result['commonContent'] = $this->Setting->commonContent();
        $productQuestion = ProductQuestion::find($id);
        return view("admin.product_questions.show", $title)->with('result', $result)->with('productQuestion', $productQuestion);

    }


}
