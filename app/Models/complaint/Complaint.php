<?php

namespace App\Models\complaint;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    public $table = 'complaint';

    //不允许批量操作的字段
    public $guarded = [];

    public $timestamps = false;
    //模型的主键
    public $primaryKey = 'id';

    public function User()
    {
        //与用户表关联
        return $this->hasOne('App\Models\complaint\User', 'id', 'uid');
    }

    public function Goods()
    {
        //与商品表关联
        return $this->hasOne('App\Models\complaint\Goods', 'id', 'gid');
    }

    public function Shops()
    {
        //与店铺表关联
        return $this->hasOne('App\Models\complaint\Shops', 'id', 'sid');
    }
}

