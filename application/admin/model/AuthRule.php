<?php


namespace app\admin\model;


use think\Model;
class AuthRule extends Model
{
    //添加
    public function  ruleAdd($data){
        if(empty($data)){
            return 0;
        }
        $res = $this->allowField(true)->save($data);
        if($res){
            return  1;
        }else{
            return  '添加失败';
        }
    }
    //更新
    public function ruleUpdata($data){
        if(empty($data)){
            return 0;
        }
        $res = $this->find($data['id']);
        if($res){
            $res['status'] = $data['status'];
            $ress = $res->save();
            if($ress) {
                return ['cond'=>200,'msg'=>'更新成功'];
            }else{
                return ['cond'=>201,'msg'=>'更新失败'];
            }
        }else{
            return ['cond'=>202,'msg'=>'更新失败'];;
        }
    }

}