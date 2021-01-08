<?php


namespace app\admin\controller;

use think\facade\View;

class UserConfig extends  Common
{
    public function  index(){
        View::fetch('usermeassage');
    }
}