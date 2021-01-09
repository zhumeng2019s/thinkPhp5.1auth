<?php


namespace app\admin\controller;

use app\admin\model\AuthRule as ModelAuthRule;
use think\Db;
use think\facade\View;

class AuthRule extends Common
{
    public function index()
    {
        return View::fetch('admin-rule');
    }
    //添加顶级
    //需要插入字段  name title ico status(可选)
    public function ruleAdd()
    {
        if ((request()->isPost())) {
            $data = $this->request->param();
            $modelAuthRule = new ModelAuthRule();
            $resMdelo = $modelAuthRule->ruleAdd($data);
            if ($resMdelo == 1) {
                $this->success('添加成功');
            } else {
                $this->error($resMdelo);
            }
        }
        return View::fetch('rule-add');
    }

    //二级权限添加
    //需要插入字段  name title  status(可选) fid  pid
    public function levelAdd()
    {
        $id = input('id');
        $listFid = Db::table('think_auth_rule')->find($id);
        if ((request()->isPost())) {
            $data = $this->request->param();
            if($data['fid']){
                $data['fid'] = 2;
            }else{
                $data['fid'] = 1;
            }
//            return $data;
            $modelAuthRule = new ModelAuthRule();
            $resMdelo = $modelAuthRule->ruleAdd($data);
            if ($resMdelo == 1) {
                $this->success('添加成功');
            } else {
                $this->error($resMdelo);
            }
        }
        View::assign('level', $listFid);
        return View::fetch('level-add');
    }

    //删除
    public function ruleDel($id)
    {
        $res = Db::table('think_auth_rule')->where('id', $id)->delete();
        if ($res) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    //更新
    public function ruleUpdata($id)
    {
        $data = [
            'id' => $id,
            'status' => input('status')
        ];
//        return $data;
        $modelAuthRule = new ModelAuthRule();
        $resMdelo = $modelAuthRule->ruleUpdata($data);
        return $resMdelo;
    }
}