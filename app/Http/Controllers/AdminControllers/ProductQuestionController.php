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
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.product_questions.index2", $title)->with('result', $result);
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

        return response($replay == true ? 1 : 0, 200);
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

    public
    function changeOrder(Request $request)
    {
        $sortData = ProductQuestion::all();
        changeOrder($request, $sortData, 'product_question_id','sort');
        return response('Update Successfully.', 200);
    }


    public function show_product_questions($id)
    {
        $title = array('pageTitle' => Lang::get("labels.product_question_replies"));
        $result['commonContent'] = $this->Setting->commonContent();
        $productQuestion = ProductQuestion::find($id);
        return view("admin.product_questions.show", $title)->with('result', $result)->with('productQuestion', $productQuestion);

    }


    public function getData($product, $main, $sub, $from_date = '1970-01-01', $to_date = '9999-09-09')
    {
        if ($main == 'all' and $sub == 'all' and $product == 'all')
            $ids = 'all';
        elseif ($main > 0 and $sub == 'all' and $product == 'all')
            $ids = getProductsIdsAccordingForMainCategory($main);
        elseif (
            ($main == 'all' and $sub > 0 and $product == 'all') or
            ($main > 0 and $sub > 0 and $product == 'all'))
            $ids = getProductsIdsAccordingForSubCategory($sub);
        else
            $ids = [$product];
        //            $table->integer('question_products_id')->index('products_images_questions_id');
        //            $table->integer('question_customers_id')->index('idx_questions_customers_id');
        //            $table->string('question_image')->nullable();
        //            $table->text('text', 65535)->nullable();
        //            $table->smallInteger('question_read')->default(0);
        //            $table->integer('sort')->default(1);;
        //            $table->integer('question_status')->default(0);
        $data = DB::table('product_questions')
            ->leftJoin('users', 'product_questions.question_customers_id', 'users.id')
            ->leftJoin('products_description', 'product_questions.question_products_id', 'products_description.products_id')
            ->select('product_questions.*',
                DB::raw("CONCAT(COALESCE(users.first_name,'') , '  ' ,COALESCE(users.last_name,'')) AS user"),
                'products_description.products_name',
                DB::raw("(select count(question_replays.product_question_id) from question_replays where question_replays.product_question_id = product_questions.product_question_id) AS replyes")
            );
        if (!($main == 'all' and $sub == 'all' and $product == 'all'))
            $data = $data->whereIn('product_questions.question_products_id', $ids);
        $data = $data
            ->whereBetween('product_questions.created_at', [$from_date, $to_date])
            ->where('products_description.language_id', '=', 2)
            ->groupBy('product_questions.product_question_id')
            ->orderBy('sort')
            ->get();
        return $data;
    }

    public function filter2(Request $request)
    {
        $from = ($request->from_date == null) ? date('1974-01-01') : date($request->from_date);
        $to = ($request->to_date == null) ? date('9999-01-01') : date($request->to_date);
        $data = $this->getData($request->product, $request->main, $request->sub, $from, $to);
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('manage', 'admin.product_questions.btn.manage')
            ->addColumn('btn_id', 'admin.product_questions.btn.id')
            ->addColumn('btn_sort', 'admin.sortFiles.btn_sort')

            ->rawColumns(['manage','btn_sort', 'btn_id'])
            ->make(true);
    }


}
