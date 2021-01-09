<?php


namespace app\admin\controller;


use think\auth\Auth;
use think\Controller;
use think\Db;
use think\facade\View;

class Common extends Controller
{
    public function __construct()
    {
        parent::__construct();
        //判断session是否存在
        if (!session('?admin.id')) {
            $this->redirect('admin/login/index');
        }
        //权限开始
        $auth = new Auth();
        $controller = request()->controller();
        $action = request()->action();
        $pathinfo = "{$controller}/$action";
        //定义不受限制路径
        $name = [
            'Index/index',
            'Index/welcome'
        ];
        //权限限制
        //---->判断是否是超级管理员
        if (session('admin.id') != 1) {
            //------>判断那先路由不受限制
            if (!in_array($pathinfo, $name)) {
                //------>判断权限
                if (!$auth->check($pathinfo, session('admin.id'))) {
                    $this->error('无权操作', '#');
                }
            }
        }
        //菜单显示
        $list = Db::table('think_user')->where('id', session('admin.id'))->select();
        foreach ($list as $k => &$v) {
            $_groupTitle = $auth->getGroups($v['id']);
            $groupTitle = $_groupTitle[0]['rules'];
            $v['groupurl'] = $groupTitle;
        }
        $array = explode(",", $list[0]['groupurl']);
        $auth_url = new \app\admin\model\AuthRule();
        $res = $auth_url->select();
        $listData = [];
        foreach ($res as $k => $v) {
            foreach ($array as $a => $b) {
                if ($v['id'] == $b) {
                    array_push($listData, $v);
                }
            }
        }
        View::assign('listData', $listData);

        //规则渲染
        //->顶级
        $listFid0 = Db::table('think_auth_rule')->where('fid', 0)->select();
        //->一级
        $listFid1 = Db::table('think_auth_rule')->where('fid', 1)->select();
        //->二级
        $listFid2 = Db::table('think_auth_rule')->where('fid', 2)->select();
        View::assign('List0', $listFid0);
        View::assign('List1', $listFid1);
        View::assign('List2', $listFid2);

    }
}