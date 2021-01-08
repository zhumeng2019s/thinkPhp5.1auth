<?php


namespace app\admin\controller;

use think\Db;
use think\facade\View;

class Index extends Common
{
    public function index(){

        return View::fetch('index');

    }
    public function welcome(){
        $sum =  Db::table('think_user')->count();
        View::assign('sum',$sum);
//        halt($sum);
        return View::fetch('welcome');
    }
}