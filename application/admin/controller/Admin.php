<?php

namespace app\admin\controller;

use app\admin\model\User;
use think\auth\Auth;
use think\Db;
use think\facade\View;
use think\Request;
class Admin extends Common
{
    public function __construct(Request $request)
    {
        parent::__construct(); //使用父类构造方法
        $this->request = $request;
    }
    //管理员列表
    public function adminList(){
       $auth =  new Auth();
       $list =  Db::table('think_user')->where('id','>','1')->order('id')->select();
       foreach ($list as $k => &$v){
           $_groupTitle = $auth->getGroups($v['id']);
           $groupTitle = $_groupTitle[0]['title'];
           $v['groupTitle'] = $groupTitle;


       }

        View::assign('list',$list);
       return View::fetch('admin-list');
    }
    //添加管理员
    public function Add(){
        if(!(request()->isPost())){
            $list = Db::table('think_auth_group')->select();
            View::assign('List',$list);
            return View::fetch('admin-add');
        }
        $data = $this->request->param();
        $model = new User();
        $reslut = $model->adminAdd($data);
        if($reslut == 1){
            $this->success('添加成功');
        }else{
            $this->error($reslut);
        }
    }
    //修改管理员信息
    public function Edit(){
        $id = input('id');
        if((request()->isPost())){
            $data = $this->request->param();
            $model = new User();
            $res = $model->Edit($data);
           if($res == 1){
               $this->success('修改成功');
           }else {
               $this->error('修改失败');
           }
        }
        $Data= Db::table('think_user')->where('id',$id)->find();
        $list = Db::table('think_auth_group')->select();
        View::assign('List',$list);
        View::assign('Data',$Data);
        return View::fetch('admin-edit');
    }
    //删除
    public function Del(){
        $id = input('id');
        $res =  Db::table('think_user')->where('id',$id)->delete();
        if($res){
            $resGroup = Db::table('think_auth_group_access')->where('uid',$id)->delete();
           if($resGroup){
               $this->success('删除成功');
           }else{
               $this->error('删除失败');
           }
        }else{
            $this->error('删除失败');
        }

    }
    //status 启用停用
    public function Status(){
        $data = [
            'id'=>input('id'),
           'status'=>input('status')
        ];
       $res = Db::name('user')
           ->where('id', $data['id'])
           ->update(['status' => $data['status']]);
       return $res;
    }
}