<?php

namespace App\Models\Shops;

use Illuminate\Database\Eloquent\Model;

class S_nav extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 's_nav';
    // 主键
    public $primaryKey = 'id';
    //允许批量操作的字段
    public $guarded = [];
    //自动维护时间字段
    public $timestamps = false;
}
