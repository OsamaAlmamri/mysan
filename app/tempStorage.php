<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tempStorage extends Model
{
    //
    protected $fillable = [
        'name', 'val', 'user_id','val2'
    ];


    public function createNewSingleTemp($name, $val=0,$val2=null)
    {

        $old = tempStorage::all()->where('name', 'like', $name)->where('user_id', auth()->user()->id)->first();
        if ($old != null) {
            $old->update(['val' => $val]);
        } else
            $old = tempStorage::create(['name' => $name, 'val' => $val , 'val2' => $val2, 'user_id' => auth()->user()->id]);

        return $old->val;
    }

  public function getSingleTemp($name, $val=0)
    {

        $old = tempStorage::all()->where('name', 'like', $name)->where('user_id', auth()->user()->id)->first();
        if ($old != null) {
         return   $old->val;
        } else
        return $val;
    }

    public function createMultiTemp($name, $val,$val2=null)
    {
        $old = tempStorage::create(['name' => $name, 'val' => $val, 'val2' => $val2, 'user_id' => auth()->user()->id]);
        return $old->val;
    }

    public function getMultiTemp($name)
    {
        $old = tempStorage::all()->where('name', 'like', $name)->where('user_id', auth()->user()->id);
        return $old;
    }

    public function deleteTemp($name)
    {
        $old = tempStorage::where('name', 'like', $name)->where('user_id', auth()->user()->id)->delete();
        return $old;
    }



}
