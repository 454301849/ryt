<?php
namespace User\Controller;
use Think\Controller;
class ProductController extends Controller{

	function place(){
		$address = M('address');
		$address_info = $address->select();
		$this->assign('info',$address_info);
		$this->display();
	}
	
	function placeadd(){
	
		$this->display();
	}
	
	function api_place_add(){
		
		$users = M('users');
		$user_name = $_SESSION['user_name'];
		$user_id = $users->where("user_name='$user_name'")->getField('user_id');
		
		$address = M('address');
		$state_data = array();
		if ($_POST['state'] == 1) {
			$state_data['state'] = 0;
			$address->where("address_id > 0")->save($state_data);
		}
		$add_data = array();
		$add_data['user_id'] = $user_id ;
		$add_data['username'] = urldecode($_POST['name']);
		$add_data['email'] = urldecode($_POST['email']);
		$add_data['telphone'] = urldecode($_POST['moblie']);
		$add_data['address'] = urldecode($_POST['address']);
		$add_data['state'] = urldecode($_POST['state']);
		$address_res = $address->add($add_data);
		if (!$address_res) {
			$msg['Success'] =false;
            $msg['Error'] = '-10000';
            $msg['Data'] = "新增地址失败";
            echo json_encode($msg);
            exit;
        }else{
            $msg['Error'] = '0';
            $msg['Data'] = '新增地址成功';
            echo json_encode($msg);
            exit;
        }
        exit;
	}

	function placeedit($id){
		
		$address = M('address');
		$address_info = $address->where(" address_id = '$id'")->find();
		$this->assign('info',$address_info);
		$this->assign('province',$address_info['province']);
		$this->assign('city',$address_info['city']);
		$this->assign('place',$address_info['county']);
		$this->display();
	}
	
	function api_place_set(){
		
		$address = M('address');
		$address_id = $_POST['id'];
		$edit_data = array();
		$edit_data['username'] = urldecode($_POST['name']);
		$edit_data['email'] = urldecode($_POST['email']);
		$edit_data['telphone'] = urldecode($_POST['moblie']);
		$edit_data['address'] = urldecode($_POST['address']);
		$edit_data['state'] = urldecode($_POST['state']);
		$address_res = $address->where(" address_id = '$address_id' ")->save($edit_data);
		$state_data = array();
		if ($_POST['state'] == 1) {
			$state_data['state'] = 0;
			$address->where(" address_id != '$address_id' ")->save($state_data);
		}
		if(!$address_res){
			$msg['Success'] =false;
			$msg['Error'] = '-10000';
			$msg['Data'] = "修改失败";
			echo json_encode($msg);
			exit;
		}else{
			$msg['Error'] = '0';
			$msg['Data'] = '修改成功';
			echo json_encode($msg);
			exit;
		}
		exit;
		
	}
	
	function api_place_delete(){
		
		$address = M('address');
		$id = urldecode($_POST['id']);
		$address_res = $address->delete($id);
		if(!$address_res){
			$msg['Success'] =false;
			$msg['Error'] = '-10000';
			$msg['Data'] = "删除地址失败";
			echo json_encode($msg);
			exit;
		}else{
				$msg['Error'] = '0';
				$msg['Data'] = '删除地址成功';
				echo json_encode($msg);
				exit;
			}
			exit;
	}
	
	function order(){

	    if(!$_SESSION['user_name']){
            $this->display('Center_login');
            exit;
        }

		$users = M('users');
		$user_name = $_SESSION['user_name'];
		$user_id = $users->where("user_name='$user_name'")->getField('user_id');

		$order = M('shop_order');	
		$pagecount = 10;
		$count = $order->where("user_id = '$user_id' ")->count();
		$Page = new \Think\Page($count, $pagecount);
		$order_info = $order->where("user_id = '$user_id' ")
		->order("order_id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
		$show = $Page->wap_show();
		$this->assign('info',$order_info);

		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->display();
	}
	
	function orderdetail($id){
		
		$order = M('shop_order');
		$order_info = $order->where("order_id = '$id' ")->find();
		$detail = M('shop_order_detail');
		$order_sn = $order_info['order_sn'];
		$detail_info = $detail->where("order_sn='$order_sn'")->select();
		$this->assign('info',$order_info);
		$this->assign('detail',$detail_info);
		$this->display();
	}

	// 确认收货
	function api_confirm_recipient(){
		$order = M('shop_order');
		$activate = A("User/Prize");
		$users = M('users');
		$order_id = urldecode($_POST['order_id']);
		$order_info = $order->where("order_sn = '$order_id' ")->find();
		$user_id = $order_info['user_id'];

		if($order_info['state'] == '2'){
			$msg['Success'] =false;
			$msg['Error'] = '-10400';
			$msg['Data'] = '已确人收货';
			echo json_encode($msg);
			exit;
		}
		
		$state_data['state'] = 2;
		$order_res = $order->where(" order_sn = '$order_id' ")->save($state_data);

		if(!$order_res){
			$msg['Success'] =false;
			$msg['Error'] = '-10400';
			$msg['Data'] = "确人收货失败";
			echo json_encode($msg);
			exit;
		}else{
			$users -> where(" user_id = '$user_id' ") -> setInc('buynum',1);
			$user_buynum = $order->where("user_id = '$user_id' and  state=2 and is_true=1 ")->count();
			if($user_buynum){
				$activate->buytuijian($user_id,$order_info['total_fee']);
			}
            $info =  M('users')->where(" user_id = '{$user_id}' ")->find();
            $activate->jdj($info['user_id'],$info['user_name'],$info['ppath'],$info['plevel']);
			$activate->yejitongji(0,0,0,0,0,0,$order_info['total_fee'],0);
			$msg['Success'] = true;
			$msg['Data'] = '收货成功';
			echo json_encode($msg);
			exit;
		}
		exit;
	}
}