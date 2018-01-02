<?php

namespace App\Models\Shops;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'cate';

    // 主键
    public $primaryKey = 'catid';

    //允许批量操作的字段
    public $guarded = [];

    //自动维护时间字段
    public $timestamps = false;

}
