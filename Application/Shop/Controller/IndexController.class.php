<?php

namespace Shop\Controller;

use Think\Controller;
class IndexController extends Controller
{
	function __construct()
	{

		parent::__construct();
		if (session('user_id')) {
			$user_id = session('user_id');
		} else {
			 $this->error('请重新登录','../../User/Center/index',3);
            exit;
		}
        $this->user_id = $user_id;
        $this->user_name = $_SESSION['user_name'];
		$this->assign('app_info', F('config_info', '', DATA_ROOT));

	}
	public function index()
	{
		$shop_categrey = M('shop_categrey');
		$shop_goods = M('shop_goods');
		$good_pic = M('good_pic');
		$categrey = $shop_categrey->where(" pid = 0 and is_show = 1 ")->order("code desc")->select();
		foreach ($categrey as $k => $v) {
			$good_list[$k]['name'] = $v['cate_name'];
			$good_list[$k]['gid'] = $v['cate_id'];
			$good_list[$k]['info'] = $shop_goods->where(" cate_gid = '{$v['cate_id']}' and is_true = 1 ")->order("code desc")->limit("6")->select();
			foreach ($good_list[$k]['info'] as $key => $val) {
				$good_list[$k]['info'][$key]['pic_url'] = $good_pic->getFieldByGood_id($val['good_id'], "pic_url");
			}
		}
		$bannar = M('shop_bannar')->order("code desc")->select();
		$this->assign('bannar', $bannar);
		$ad = M('shop_ad')->order("code desc")->select();
		$this->assign('ad', $ad);
		$num = M('shop_order_temp')->where(" user_id = '{$this->user_id}' ")->sum('good_num');
		$this->assign("num", $num);
		$this->assign("good_list", $good_list);
		$this->display();
	}
	public function search()
	{
		$shop_categrey = M('shop_categrey');
		$shop_goods = M('shop_goods');
		$good_pic = M('good_pic');
		$where = array();
		if ($_POST) {
			$keyword = $_POST['keyword'];
			$where['good_name'] = array('like', '%' . $keyword . '%');
		}
		if ($_GET['pid'] != null) {
			$where['cate_pid'] = $_GET['pid'];
		}
		if ($_GET['gid'] != null) {
			$where['cate_gid'] = $_GET['gid'];
		}
		$good_list = $shop_goods->where($where)->order("code desc")->select();
		foreach ($good_list as $k => $v) {
			$good_list[$k]['pic_url'] = $good_pic->getFieldByGood_id($v['good_id'], "pic_url");
		}
		$num = M('shop_order_temp')->where(" user_id = '{$this->user_id}' ")->sum('good_num');
		$this->assign("keyword", $keyword);
		$this->assign("num", $num);
		$this->assign("good_list", $good_list);
		$this->display();
	}
	public function good()
	{
		if (!$_GET['good_id']) {
			redirect(index);
			die;
		}
		$shop_goods = M('shop_goods');
		$good_info = $shop_goods->getByGood_id($_GET['good_id']);
		if ($good_info == null) {
			redirect(index);
			die;
		}
		$pic_url = M('good_pic')->where(" good_id = '{$_GET['good_id']}' ")->select();
		$num = M('shop_order_temp')->where(" user_id = '{$this->user_id}' ")->sum('good_num');
		$this->assign("num", $num);
		$this->assign("good_info", $good_info);
		$this->assign("pic_url", $pic_url);
		$this->display();
	}
	function addcategrey()
	{
		$arr = array();
		if ($_POST['good_id'] == null) {
			$arr['success'] = 0;
		} else {
			$shop_order_temp = M('shop_order_temp');
			$res = $shop_order_temp->where(array("good_id" => $_POST['good_id'], "user_id" => $this->user_id))->find();
			if ($res == null) {
				$result = $shop_order_temp->add(array("good_id" => $_POST['good_id'], "user_id" => $this->user_id));
			} else {
				$order_id = $res['order_id'];
				$result = $shop_order_temp->where(" order_id = '{$order_id}' ")->setInc('good_num');
			}
			if ($result) {
				$arr['success'] = 1;
			} else {
				$arr['success'] = 0;
			}
		}
		echo json_encode($arr);
	}
	public function save_address()
	{
		$arr = array();
		$data = $_POST;
		$user_address = M('address');
		$info = $user_address->getByUser_id($this->user_id);
		if ($info) {
			$res = $user_address->where(" user_id = '{$this->user_id}' ")->save($data);
		} else {
			$data['user_id'] = $this->user_id;
			$res = M('address')->add($data);
		}
		echo json_encode($arr);
	}
	public function categrey()
	{
		$user_id =  $this->user_id;
		$address_info = null;
		$users = M('users');
		if(isset($_GET['id'])){
			$address_id= $_GET['id'];
			$address_info = M('address')->where(" user_id = '$user_id'")->find($address_id);
		}else {
			$address_info = M('address')->where(" user_id = '$user_id' AND state =1 ")->find();
		}
		$temp = M('shop_order_temp')->where(" user_id = '{$this->user_id}' ")->order("order_id desc")->select();
		$shop_goods = M('shop_goods');
		$good_pic = M('good_pic');
		foreach ($temp as $k => $v) {
			$temp[$k]['info'] = $shop_goods->getByGood_id($v['good_id']);
			$temp[$k]['info']['pic_url'] = $good_pic->getFieldByGood_id($v['good_id'], 'pic_url');
		}
		$members=M()->table('wx_users u')
                        ->join('wx_memberlevel m ON u.level=m.id')
						->where("u.user_id = '{$user_id}'")
                        ->field('u.*,m.discount')
                        ->find();
		//购买次数
		if($members['buynum'] > 0){
		//新增测试
			$discount = 9;
			if($members['shoptype']== '1' || $members['shoptype']== '2'){
				$discount = 5;
			}
			$discount = $members['discount']>$discount?$discount:$members['discount'];
		}else{
			$discount =0;
		}
		$this->assign("address_info", $address_info);
		$this->assign("temp", $temp);
		$this->assign("discount", $discount);
		$this->display();
	}
	function del_categrey()
	{
		$arr = array();
		if ($_POST['order_id'] == null) {
			$arr['success'] = 0;
		} else {
			$order_id = $_POST['order_id'];
			$result = M('shop_order_temp')->where(" order_id = '{$order_id}' ")->delete();
			if ($result) {
				$arr['success'] = 1;
			} else {
				$arr['success'] = 0;
			}
		}
		echo json_encode($arr);
	}
	function change_categrey()
	{
		if ($_POST['order_id'] == null) {
			$arr['success'] = 0;
		} else {
			$order_id = $_POST['order_id'];
			$shop_order_temp = M('shop_order_temp');
			switch ($_POST['type']) {
				case 'min':
					$result = $shop_order_temp->where(" order_id = '{$order_id}' ")->setDec('good_num');
					break;
				case 'max':
					$result = $shop_order_temp->where(" order_id = '{$order_id}' ")->setInc('good_num');
					break;
				default:
					break;
			}
			if ($result) {
				$arr['success'] = 1;
				$arr['info'] = $result;
			} else {
				$arr['success'] = 0;
			}
		}
		echo json_encode($arr);
	}

	function order_sure()
	{

		$shop_order_temp = M('shop_order_temp');
		$shop_order = M('shop_order');
		$shop_order_detail = M('shop_order_detail');
		$good_pic = M('good_pic');
		$shop_goods = M('shop_goods');
		$order_temp = $shop_order_temp->where(" user_id = '{$this->user_id}' ")->select();
		if ($order_temp == null) {
			redirect(index);
		}
		if (S('order_sn') && S('order_sn') < 9990) {
			$order_rand = S('order_sn') + 1;
			S('order_sn', $order_rand);
		} else {
			$order_rand = 1111;
			S('order_sn', $order_rand);
		}
		if (S('pay_id')) {
			$pay_id = S('pay_id') + 1;
			S('pay_id', $pay_id);
		} else {
			$pay_id = $shop_order->max("pay_id");
			$pay_id++;
			S('pay_id', $pay_id);
		}
		$order_sn = date('Y') . $order_rand . time();
		$order_time = time();
        $address_id = $_POST['address_id'];

		foreach ($order_temp as $val) {
			$pic_url = $good_pic->getFieldByGood_id($val['good_id'], 'pic_url');
			$good_info = $shop_goods->getByGood_id($val['good_id']);
			$order_data = array();
			$order_data = array("order_sn" => $order_sn, "pay_id" => $pay_id,
                "user_id" => $this->user_id,
                "user_name" => $this->user_name,
                "good_id" => $val['good_id'],
                "address_id" =>$address_id,
                "good_name" => $good_info['good_name'],
                "good_price" => $good_info['good_price'],
                "good_profit" => $good_info['good_profit'],
                "pic_url" => $pic_url, "good_num" => $val['good_num'],
                "time" => $order_time);
			  $res = $shop_order_detail->add($order_data);
			if ($res) {
				$shop_order_temp->where(" order_id = '{$val['order_id']}' ")->delete();
			}
		}
		$arr = array('pay_id' => $pay_id);
		echo json_encode($arr);
	}
	function order_pay()
	{
		if (!$_GET['pay_id']) {
			redirect(index);
			die;
		} else {
			$pay_id = $_GET['pay_id'];
		}
		$shop_order = M('shop_order');
		$shop_order_detail = M('shop_order_detail');
		$order = $shop_order->getByPay_id($pay_id);

        $user_info = M('users')->where("user_id = '$this->user_id'")->find();

		$members=M()->table('wx_users u')
                        ->join('wx_memberlevel m ON u.level=m.id')
						->where("u.user_id = '{$this->user_id}'")
                        ->field('u.*,m.discount')
                        ->find();
		if($members['buynum'] > 0){
			if($members['shoptype']== '1' || $members['shoptype']== '2'){
				$discount = 5;
			}
			$discount = $members['discount']>$discount?$discount:$members['discount'];
			$discount =$discount*0.1;
		}else{
			$discount =1;
		}
		if ($order == null) {
			$order_info = $shop_order_detail->where(" pay_id = '{$pay_id}' ")->select();
			if ($order_info == null) {
				redirect(index);
				die;
			}
			$total_fee = 0;
			$good_name = "";
			$good_num = 0;
			$shop_goods = M('shop_goods');
			$good_pic = M('good_pic');
			foreach ($order_info as $v) {
				$total_fee = $total_fee + $v['good_price'] * $v['good_num'];
				$good_name .= $v['good_name'] . ".";
				$good_num = $good_num + $v['good_num'];
			}
			
			$out_trade_no = $order_info[0]['order_sn'];
			$notify_url = "http://" . $_SERVER['SERVER_NAME'] . U('/Wxapi/Notify/shop');
			$openid = M('users')->getFieldByUser_id($this->user_id, 'openid');
			$order_id = $order_info[0]['order_id'];
            $prepay_id = '';
			//$total_fee = $total_fee * $discount;
			$total_fee = $total_fee * 0.9;
			
			
			$data = array('pay_id' => $pay_id, 'order_sn' => $out_trade_no, 'total_fee' => $total_fee, 'time' => $order_info[0]['time'],
                'user_id' => $order_info[0]['user_id'],
                'address_id' => $order_info[0]['address_id'],
                'user_name' => $_SESSION['user_name'],
                'prepay_id' => $prepay_id);
			$shop_order->add($data);
		} else {
			$prepay_id = $order['prepay_id'];
			$order_info = $shop_order_detail->where(" pay_id = '{$pay_id}' ")->select();
			$total_fee = $order['total_fee'];
		}

		$this->keyong = $user_info['gwb']*0.9;
		$this->bukeyong = $user_info['gwb']*0.1;
		$this->assign("order_info", $order_info);
		$this->assign("pay_id", $pay_id);
		$this->assign("user_info",$user_info);
		$this->assign("total_fee", $total_fee);
		$this->display();
	}

	/*
	 * 确定付款
	 */

	public function api_report_submit(){
        $activate = A("User/Prize");
        $users = M('users');
        $shop_order =M('shop_order');
        $shop_order_detail =M('shop_order_detail');

        $user_id = $_SESSION['user_name'];
        $password = $_POST['safeword'];
        $pay_id = $_POST['pay_id'];

        $info =$users->where("user_name= '{$user_id}' ")->find();
        if ($info['second_password'] != md5($password)) {
            $msg['Error'] = '-1';
            $msg['Data'] = "二级密码错误";
            echo json_encode($msg);
            exit;
        }

        $order =$shop_order -> getByPay_id($pay_id);

        if($order['is_true'] == 1)
        {
            $msg['Error'] = '-1';
            $msg['Data'] = "已付款";
            echo json_encode($msg);
            exit;
        }

        $users->where("user_id ='{$order['user_id']}'")->setDec('gwb',$order['total_fee']); //
       // $activate->bonus_xiaofei($order['user_id'],$order['user_name'],$order['user_id'],$order['user_name'],$order['total_fee'],'购物消费');
        $update_pay = $shop_order -> where(" pay_id = '$pay_id' ")->save(array('is_true'=>1,'pay_time'=>time()));
        if($update_pay){
            $msg['Success'] =true;
            $msg['Data'] = "已付款";
            echo json_encode($msg);
            exit;
        }


    }

	public function catelist()
	{
		$shop_categrey = M('shop_categrey');
		$categrey = $shop_categrey->where(" pid = 0 and hidden = 0 ")->order("code desc")->select();
		foreach ($categrey as $k => $v) {
			$categrey[$k]['arr'] = $shop_categrey->where(" pid = '{$v['cate_id']}' and hidden = 0 ")->order("code desc")->select();
		}
		$num = M('shop_order_temp')->where(" user_id = '{$this->user_id}' ")->sum('good_num');
		$this->assign("num", $num);
		$this->assign("categrey", $categrey);
		$this->display();
	}


}