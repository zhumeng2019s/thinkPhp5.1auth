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
        if (!session('?admin.id')) {
            $this->redirect('admin/login/index');
        }
        $auth = new Auth();
        $controller = request()->controller();
        $action = request()->action();
        $pathinfo = "{$controller}/$action";
        //那先权限不受限制
        $name = [
            'Index/index',
            'Index/welcome'
        ];
        //权限限制
        if (!in_array($pathinfo, $name)) {
            if (!$auth->check($pathinfo, session('admin.id'))) {
                $this->error('无权操作','#');
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
//        halt($listData);

        //规则表
        $listFid0 = Db::table('think_auth_rule')->where('fid', 0)->select();
        $listFid1 = Db::table('think_auth_rule')->where('fid', 1)->select();
        $listFid2 = Db::table('think_auth_rule')->where('fid', 2)->select();
        View::assign('List0', $listFid0);
        View::assign('List1', $listFid1);
        View::assign('List2', $listFid2);

    }
}