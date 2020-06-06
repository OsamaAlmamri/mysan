<?php


namespace App\Http\Controllers\API;

use App\BlockedPerson;
use App\CheckPoint;
use App\HaraVil;
use App\QuarantineArea;
use App\QuarantineAreaType;
use App\SubDi;
use App\SubHaraVil;
use App\User;
use App\Zone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProjectApiController extends BaseAPIController
{


    public function createImage($img)
    {

        $folderPath = "images/";

//        $image_parts = explode(";base64,", $img);
//        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type ='png';
        $image_base64 = base64_decode($img);
        $file = $folderPath . uniqid() . '.' . $image_type;


        file_put_contents($file, $image_base64);
        return $file;

    }

    public function getAllBlockPersonsPerZone(Request $request)
    {
        try {
            if ($request->zone_id == null or $request->zone_id == 'all') {
                $data = BlockedPerson::where('quarantine_area_id', '>', 0)->get();
                $messsage = 'بيانات جميع المحجورين  بالمراكز في الــيمن ';
            } else {
                $ids = [];
                $isGovernment = Zone::find($request->zone_id);// اذا اختار محافظة
                if ($isGovernment->parent == 0) {
                    $zones = Zone::all()->where('parent', '=', $isGovernment->id);
                    foreach ($zones as $zone) {
                        $ids[] = $zone->id;
                        $messsage = 'بيانات جميع المحجورين  بالمراكز في محافظة  ' . $isGovernment->name_ar;

                    }
                } else {
                    $ids[] = $isGovernment->id;//اذا اختار مديرية
                    $messsage = 'بيانات جميع المحجورين  بالمراكز في مديرية   ' . $isGovernment->name_ar . '  محافظة ' . $isGovernment->zone->name_ar;

                    $qrs = QuarantineArea::all()->whereIn('zone_id', $ids);
                    $qr_id = [];
                    foreach ($qrs as $qr) {
                        $qr_id[] = $qr->id;
                    }
                    $data = BlockedPerson::whereIn('zone_id', $ids)->get();

                }

            }
            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
//            return $ex->getMessage();
            return $this->sendError('error',$ex->getMessage()) ;
        }
    }

    public function saveIncommingBlockPersion(Request $request)
    {
        try {
//            $project = TempSave::create([
//                'data' => $request->data,
//                'user_id' => auth()->user()->id,
//                'team_work_id' => auth()->user()->work_team->id,
//            ]);


//
            $array = json_decode(($request->data), true);
            $add = 0;
            $notAdd = 0;
            foreach ($array as $temp) {
                if ($temp['id_back_photo'] != null)
                    $temp['id_back_photo'] = $this->createImage($temp['id_back_photo']);
                if ($temp['id_front_photo'] != null)
                    $temp['id_front_photo'] = $this->createImage($temp['id_front_photo']);
                $old = BlockedPerson::all()->where('req_id', '=', $temp['req_id'])
                    ->where('entry_date', '=', $temp['entry_date'])->count();
                if ($old > 0)
                    $notAdd++;
                else {
                    BlockedPerson::create(array_merge($temp, ['created_by' => auth()->user()->id]));
                    $add++;
                }
            }
            return $this->sendResponse([], 'تم حفظ بيانات ' . $add . ' شخص  بنجاح  ' . 'وتجاهل     ' . $notAdd . ' شخص    ');
        } catch (Exception $ex) {
            return $this->sendError('error',$ex->getMessage()) ;
//            return $ex->getMessage();
        }
    }

    public function getAllQuarantineTypes(Request $request)
    {
        try {
            $data = QuarantineAreaType::where('id', '>', 0)->get();
            $messsage = 'بيانات انواع مراكز الحجر ';

            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $this->sendError('error',$ex->getMessage()) ;
//            return $ex->getMessage();
        }
    }

    public function getMyAddBlockPerson(Request $request)
    {
        try {
            $user = auth()->user()->id;

            $data = BlockedPerson::where('created_by', '=', $user)->get();
            $messsage = 'بيانات المحجورين المضافين من هذا الحساب  ';

            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $this->sendError('error',$ex->getMessage()) ;
//            return $ex->getMessage();
        }
    }

    public function getBlockPerson(Request $request)
    {
        try {
            $data = BlockedPerson::find($request->code);
            $messsage = 'بيانات المحجور    ' . $data->name;

            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $this->sendError('error',$ex->getMessage()) ;
//            return $ex->getMessage();
        }


    }

    public function getAllZones(Request $request)
    {
        try {

            switch ($request->type) {

                case 'district':
                    $data = Zone::all()->where('type', 'like', $request->type)->where('parent', '>', 0);
                    break;
                case 'hara_vil':
                    $data = HaraVil::where('type', 'like', $request->type)->where('parent', '>', 0)->get();
                    break;
                case 'sub_hara_vil':
                    $data = SubHaraVil::where('type', 'like', $request->type)->where('parent', '>', 0)->get();
                    break;
                case 'sub_dis':
                    $data = SubDi::where('type', 'like', $request->type)->where('parent', '>', 0)->get();
                    break;
                default:
                    $data = Zone::all()->where('type', 'like', $request->type)->where('parent', 0);
                    break;
            }

            return $this->sendResponse($data, '');
        } catch (Exception $ex) {
            return $this->sendError('error',$ex->getMessage()) ;

        }
    }

    public function getAllUsers(Request $request)
    {
        try {
            $data = User::where('id', '>', 0)->get(['id', 'email', 'password', 'username', 'avatar', 'work_team_id', 'status', 'deleted_by', 'created_by']);
            $messsage = 'بيانات جميع   المستخدمين  ';


            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $this->sendError('error',$ex->getMessage()) ;
//            return $ex->getMessage();
        }
    }

    public
    function getAllQuarantines(Request $request)
    {
        try {
            if ($request->zone_id == null or $request->zone_id == 'all') {
                $data = QuarantineArea::where('id', '>', 0)->get();
                $messsage = 'بيانات مراكز الحجر  في الــيمن ';
            } else {
                $ids = [];
                $isGovernment = Zone::find($request->zone_id);// اذا اختار محافظة
                if ($isGovernment->parent == 0) {
                    $zones = Zone::all()->where('parent', '=', $isGovernment->id);
                    foreach ($zones as $zone) {
                        $ids[] = $zone->id;
                        $messsage = 'بيانات مراكز الحجر  في محافظة  ' . $isGovernment->name_ar;
                    }
                } else {
                    $ids[] = $isGovernment->id;//اذا اختار مديرية
                    $messsage = 'بيانات جميع راكز الحجر  في  مديرية   ' .
                        $isGovernment->name_ar . '  محافظة ' . $isGovernment->zone->name_ar;
                    $data = QuarantineArea::whereIn('zone_id', $ids)->get();
                }
            }
            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $this->sendError('error',$ex->getMessage()) ;
//            return $ex->getMessage();
        }
    }


    public
    function getAllCheckPoint(Request $request)
    {
        try {
            if ($request->zone_id == null or $request->zone_id == 'all') {
                $data = CheckPoint::where('id', '>', 0)->get();
                $messsage = 'بيانات مراكز الحجر  في الــيمن ';
            } else {
                $ids = [];
                $isGovernment = Zone::find($request->zone_id);// اذا اختار محافظة
                if ($isGovernment->parent == 0) {
                    $zones = Zone::all()->where('parent', '=', $isGovernment->id);
                    foreach ($zones as $zone) {
                        $ids[] = $zone->id;
                        $messsage = 'بيانات مراكز التفتيش  في محافظة  ' . $isGovernment->name_ar;
                    }
                } else {
                    $ids[] = $isGovernment->id;//اذا اختار مديرية
                    $messsage = 'بيانات جميع راكز التفتيش  في  مديرية   ' .
                        $isGovernment->name_ar . '  محافظة ' . $isGovernment->zone->name_ar;
                    $data = CheckPoint::whereIn('zone_id', $ids)->get();
                }
            }
            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $this->sendError('error',$ex->getMessage()) ;
//            return $ex->getMessage();
        }
    }

    public
    function getAllBlockPersonsPerCenter(Request $request)
    {
        try {
            $data = BlockedPerson::where('quarantine_area_id', '=', $request->code)->get();
            $messsage = 'بيانات جميع المحجورين  للمركز  رقم  ' . $request->code;

            return $this->sendResponse($data, $messsage);
        } catch (Exception $ex) {
            return $this->sendError('error',$ex->getMessage()) ;
//            return $ex->getMessage();
        }
    }


    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public
    function userInfo()
    {
        try {
            $user = Auth::user();
            return $this->sendResponse($user, 'success');
        } catch (Exception $ex) {
            return $this->sendError('error',$ex->getMessage(),$ex->getCode()) ;
//            return $ex->getMessage();

        }
    }


}
