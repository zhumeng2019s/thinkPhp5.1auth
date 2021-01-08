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
    //需要插入字段  name title ico
    public function ruleAdd()
    {
        $id = $this->request->param();
        if ($id) {
            if ((request()->isPost())) {
                return $id;
//                $data = $this->request->param();
//                if ($data['pid']) {
//                    $data['fid'] = 1;
//                } else {
//                    $data['fid'] = 2;
//                }
//                return $data;
//            $modelAuthRule = new ModelAuthRule();
//            $resMdelo = $modelAuthRule->ruleAdd($data);
////            return  $resMdelo;
//            if ($resMdelo == 1) {
//                $this->success('添加成功');
//            } else {
//                $this->error($resMdelo);
//            }
//            }
            }
        } else {
            if ((request()->isPost())) {
                return $id;
//                $data = $this->request->param();
//                return  $data;
//            $modelAuthRule = new ModelAuthRule();
//            $resMdelo = $modelAuthRule->ruleAdd($data);
////            return  $resMdelo;
//            if ($resMdelo == 1) {
//                $this->success('添加成功');
//            } else {
//                $this->error($resMdelo);
//            }
//            }
            }
        }


        View::assign('DingJi', $id);

        return View::fetch('rule-add');
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