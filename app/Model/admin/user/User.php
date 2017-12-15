<?php

namespace App\Model\admin\user;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // 表名
    public $table = 'admin_user';

    // 主键
    public $primarykey = 'id';

    // 允许批量操作的字段
    public $fillable = ['name', 'pwd', 'status'];

    // 自动维护世界字段
    public $timestamps = false;
}
