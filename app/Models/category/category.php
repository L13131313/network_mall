<?php

namespace App\Models\category;

use Illuminate\Database\Eloquent\Model;
use DB;

class category extends Model
{
    //表名
    public $table = 'cate';
    //主键
    public $primaryKey = 'catid';
    //自动维护时间
    public $timestamps = false;
    //允许批量操作的字段
    public $guarded = [];

    public function masterTree(){

        $catelist = DB::table("$this->table")->select('listorder','catid','catname','parentid','child')->orderBy('listorder','asc')->get();
        return $this->getTree($catelist,0);
    }


    public function getTree($catelist,$pid){
        $tree = array();
        for ($i = 0;$i < count($catelist);$i++){
            if($catelist[$i]->parentid == $pid){
                $catelist[$i]->child = self::getTree($catelist,$catelist[$i]->catid);
                if($catelist[$i]->child == 0){
                    unset($catelist[$i]->child);
                }
                $tree[] = $catelist[$i];
            }
        }
        return $tree;
    }

    public function doList(){

        $list = self::masterTree();
        $record = [];
        $length = 0;
        for($i = 0; $i < count($list); $i++) {
            $info = [];
            $info[0] = $list[$i]->listorder;
            $info[1] = $list[$i]->catid;
            $info[2] = $list[$i]->catname;
            if(count($list[$i]->child) > 0){
                $info[3] = 1;
            }else{
                $info[3] = 0;
            }
            $record[$length++] = $info;
            for($j = 0;$j < count($list[$i]->child);$j++){
                $info = [];
                $info[0] = ($list[$i]->child)[$j]->listorder;
                $info[1] = ($list[$i]->child)[$j]->catid;
                $info[2] = '|---------'.(($list[$i]->child)[$j]->catname);
                if(count(($list[$i]->child)[$j]->child) > 0){
                    $info[3] = 1;
                }else{
                    $info[3] = 0;
                }
                $record[$length++] = $info;
                for($z = 0;$z < count(($list[$i]->child)[$j]->child);$z++){
                    $info = [];
                    $info[0] = (($list[$i]->child)[$j]->child)[$z]->listorder;;
                    $info[1] = (($list[$i]->child)[$j]->child)[$z]->catid;
                    $info[2] = '|---------|---------'.((($list[$i]->child)[$j]->child)[$z]->catname);
                    if(count( (($list[$i]->child)[$j]->child)[$z]->child ) > 0){
                        $info[3] = 1;
                    }else{
                        $info[3] = 0;
                    }
                    $record[$length++] = $info;
                }
            }
        }

        return $record;

    }

}
