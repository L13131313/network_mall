<?php

namespace App\Models\shoppingCart;

use Illuminate\Database\Eloquent\Model;

class sp_cart extends Model
{
    //表名
    public $table = 'sp_cart';

    //自动维护时间
    public $timestamps = false;

    //允许批量操作的字段
    public $guarded = [];

}
