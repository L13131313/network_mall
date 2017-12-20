<?php

namespace App\Tools;

use App\Models\District;
use App\Models\Shops\Cate;
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

    /**
     *  商品分类
     * @param $id 商品父ID
     * @return mixed
     */
    public static function getCateId($id)
    {

        $key = config('district.cate.id').$id;
        $data = Cache::rememberForever($key, function () use ($key,$id) {
            $data = Cate::where('parentid', $id)->get();
            $data && $data = $data->toJson();
            return  json_decode($data);
        });
        return $data;
    }

    /**
     *  商品分类单条查询
     * @param $id
     * @return mixed
     */
    public static function getOneId($catid)
    {

        $key = config('district.cate.catid').$catid;
        $data = Cache::rememberForever($key, function () use ($key,$catid) {
            $data = Cate::where('catid', $catid)->first();
            $data && $data = $data->toJson();
            return  json_decode($data);
        });
        return $data;
    }


}