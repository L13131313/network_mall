<?php

namespace App\Models\Shops;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'shops';

    // 指定是否模型应该被戳记时间
    public $timestamps = false;

    /**
     * 模型的日期字段保存格式。
     *
     * @var string
     */
    protected $dateFormat = 'U';

    // 可以被批量赋值的属性
    protected $guarded= [];
}
