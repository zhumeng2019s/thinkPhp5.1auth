<?php


namespace app\admin\model;


use think\Model;
class AuthGroup extends Model
{
    //添加
    public function groupAdd($data){
        if(empty($data)){
            return  0;
        }
       $res =  $this->save($data);
       if($res){
           return  1;
       }else{
           return  '添加失败';
       }
    }
    //修改
    public function groupEdit($data){
        if(empty($data)){
            return  0;
        }
        $res = $this->where('id',$data['id'])->find();
        $res->title = $data['title'];
        $res->rules = $data['rules'];
        $resData = $res->save();
        if($resData){
            return  1;
        }else{
            return '修改失败';
        }
    }
}