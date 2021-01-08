<?php


namespace app\admin\model;

use think\Exception;
use think\Model;
use think\model\concern\RelationShip;

class User extends Model
{
    //登陆
    public function adminSel($data)
    {
        if (empty($data)) {
            return 0;
        }
        $res = $this->where('username', $data['username'])->find();
        if (!$res) {
            return '用户不存在';
        }
        $salt = $res['salt'];
        $dataSalt = md5($salt . $data['password'] . $salt);
        $data['password'] = $dataSalt;
        $resData = $this->where($data)->find();
        if ($resData) {
            if (!$res['status'] == 1) {
                return '账号被禁用';
            }
            $sessionData = [
                'id' => $res['id'],
                'username' => $res['username']
            ];
            session('admin', $sessionData);
            return 1;
        } else {
            return '用户名或密码错误';
        }
    }

    //用户添加
    public function adminAdd($data)
    {
        if (empty($data)) {
            return 0;
        }
        $Salt = $this->salt();
        $this->username = $data['username'];
        $this->password = md5($Salt . $data['password'] . $Salt);
        $this->salt = $Salt;
        $result = $this->save();
        if ($result) {
            $modegroupAccess = new AuthGroupAccess();
            $modegroupAccess->uid = $this->id;
            $modegroupAccess->group_id = $data['like'];
            $modegroupAccess->save();
            return 1;
        } else {
            return '添加失败';
        }
    }

    //修改信息
    public function Edit($data)
    {
        if (empty($data)) {
            return 0;
        }
        $EditData = $this->where('id', $data['id'])->find();
        $Salt = $this->salt();
        $EditData->username = $data['username'];
        $EditData->password = md5($Salt . $data['password'] . $Salt);
        $EditData->salt = $Salt;
        $result = $EditData->save();
        if ($result) {
            $modegroupAccess = new AuthGroupAccess();
            $EditAccess = $modegroupAccess->where('uid', $data['id'])->find();
            $EditAccess->uid = $data['id'];
            $EditAccess->group_id = $data['like'];
            $EditAccess->save();
            return 1;
        } else {
            return 0;
        }
    }

    public function salt()
    {
        // 盐字符集
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ($i = 0; $i < 5; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
}