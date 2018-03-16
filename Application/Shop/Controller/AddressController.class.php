<?php

//decode by QQ:270656184 http://www.yunlu99.com/
namespace Shop\Controller;

use Think\Controller;
class AddressController extends Controller
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
	
	function index()
	{
		$user_id =  $this->user_id;
        $address_info = M('address')->where(" user_id = '$user_id'")->select();
        $this->assign("address_info", $address_info);
        $this->display();

	}
	
	function create(){
		$this->display();
	}
	
	function api_address_add(){
	
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
	
	function update($id){
		
		$address_info = M('address')->where(" address_id= '$id'")->find();
		$this->assign("address_info", $address_info);
		$this->display();
	}
	
	function api_address_set(){
	
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
	
	function get_access_token()
	{
		if (!$_GET['code']) {
			$protocol = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";
			$redirect_uri = "{$protocol}{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
			$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appid . "&redirect_uri=" . $redirect_uri . "&response_type=code&scope=snsapi_base&state=#wechat_redirect";
			redirect($url);
		} elseif ($_GET['code']) {
			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $this->appid . "&secret=" . $this->appserect . "&code=" . $_GET[code] . "&grant_type=authorization_code";
			$res = $this->http_request($url);
			$result = json_decode($res, true);
			$access_token = $result['access_token'];
			$arr = array('access_token' => $access_token);
			return $arr;
		}
	}
	protected function http_request($url, $data = null)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)) {
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
}