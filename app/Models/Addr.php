<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Addr extends Model
{
           //表名
    public $table = 'addr';
//    主键
    public $primaryKey = 'id';

    //允许批量操作的字段
    public $guarded = ['uid','user_name','user_tel','user_addr','status'];

    //自动维护时间字段
    public $timestamps = false;
}
