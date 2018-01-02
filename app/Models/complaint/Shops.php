<?php

namespace App\Models\complaint;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    //
    public $table = 'shops';

    //不允许批量操作的字段
    public $guarded = [];

    public $timestamps = false;
    //模型的主键
    public $primaryKey = 'id';
}
