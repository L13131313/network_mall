<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoLogin extends Model
{
    // 与模型关联的数据表
    protected $table = 'phpll';

    public function getqq()
    {
        return $this->belongsTo(qq::class,'user_id');
    }

    // 指定是否模型应该被戳记时间
    public $timestamps = false;

    public function doLogin($request)
    {
        $name = $request->input('name');
        $pwd = $request->input('password');
        $username = $this->where('name', $name)->first();

        if ($username) {
            if ($pwd == $username->pwd) {
                return $username;
            }
        }
        return false;
    }
}
