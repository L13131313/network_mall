<?php

namespace App\Model\index;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    // 表名
    public $table = 'user';

    // 主键
    public $primarykey = 'id';

    // 允许批量操作的字段
    // public $fillable = ['name', 'pwd', 'status'];
    public $guarded = [];

    // 自动维护世界字段
    public $timestamps = false;
}
