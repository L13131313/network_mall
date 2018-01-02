<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
       //表名
    public $table = 'OrderList';
//    主键
    public $primaryKey = 'id';

    //允许批量操作的字段
    public $guarded = ['id','o_name','uid','solder_id','g_id','g_name','g_pirce','g_spec','s_name','g_pic','o_count','o_prices','o_mtime','o_ptime','o_otime','o_ctime','o_rtime','express_id','comment_status','return_status','y_money','express_num','addr','o_tell'];

    //自动维护时间字段
    public $timestamps = false;
}
