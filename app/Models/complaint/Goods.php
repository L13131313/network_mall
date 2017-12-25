<?php

namespace App\Models\complaint;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    public $table = 'goods';

    //不允许批量操作的字段
    public $guarded = [];

    public $timestamps = false;
    //模型的主键
    public $primaryKey = 'id';
}
