<?php

namespace App\Models\Shops;

use App\Models\Goods\Goods;
use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'shops';
    // 主键
    public $primaryKey = 'id';
    //允许批量操作的字段
    public $guarded = [];
    //自动维护时间字段
    public $timestamps = false;

    public function goods()
    {
        return $this->hasMany(Goods::class, 'sid','id');
    }

}
