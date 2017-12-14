<?php
/**
 * Created by PhpStorm.
 * User: sunxiaodong
 * Date: 2017/11/30
 * Time: 下午3:38
 */

namespace App\Tools;

use App\Models\District;
use Illuminate\Support\Facades\Cache;

class AreaCache
{
    // 地区id
    public static function get($id)
    {
        $key = config('district.cache.id').$id;
        $data = Cache::rememberForever($key, function () use ($key,$id) {
                $data = District::where('id', $id)->get();
                $data && $data = $data->toJson();
                return  json_decode($data);
            });
        return $data;
    }

    //1.省 2.市 3.县区
    public static function getType($level)
    {

        $key = config('district.cache.level').$level;
        $data = Cache::rememberForever($key, function () use ($key,$level) {
            $data = District::where('level', $level)->get();
            $data && $data = $data->toJson();
            return  json_decode($data);
        });
        return $data;
    }

}