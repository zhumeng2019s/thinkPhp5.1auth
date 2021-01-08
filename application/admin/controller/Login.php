<?php


namespace app\admin\controller;

use app\admin\model\User;
use think\Controller;
use think\Db;
use think\facade\View;
use think\Request;
class Login extends Controller
{

    public function index(Request $request){
        if(!(request()->isPost())){
           $res =  Db::table('think_config')->select();
           View::assign('ConFig',$res[0]);
            return View::fetch('login');
        }
        $data  = $request->param();
       $model =  new User();
       $result = $model->adminSel($data);
//       return json($result);
       if($result == 1){
           return  $this->success('登陆成功','index/index');
       }else{
           return  $this->error($result);
       }
    }
    //退出
    public function loginout()
    {
        session(null);
        if(session('admin')){
            $this->error('退出失败');
        }else{
            $this->success('退出成功','admin/login/index');
        }
    }
    //
    public function session(){
//      return  session('admin');
        $a = [1,2,3];
        $b = [2,3,7,1,5];
        $arr3 = array_merge(array_diff($a,$b),array_diff($b,$a));
       return json($arr3);
    }
}