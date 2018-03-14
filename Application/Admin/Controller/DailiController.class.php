<?php
namespace Admin\Controller;

use Think\Controller;
class DailiController extends ActionController
{
	function __construct()
	{
		parent::__construct();
		//echo session('admin_id');
		if (!session('admin_id')) {
			$this->error('登录已超时，请重新登录', U('User/index'));
		}
	}

 /*
     * 代理中心
     */
    public function centerlists(){

        $users = M('users');
        $centerlist = M('centerlists');
        $pagecount = 10;
        $count = $centerlist->group('user_name')->count();
        $Page = new \Think\Page($count, $pagecount);

        $info =  $centerlist->group('user_name')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $infos = array();
        foreach($info as $i=>$in){
            $infos[$i] = $users->where("user_name = '{$in['user_name']}'")->find();
            $levelinfo = $this->getlevel($in['level']);
            $infos[$i]['name'] = $levelinfo['name'];
            $infos[$i]['levelid'] = $levelinfo['id'];
            $infos[$i]['type'] =  $infos[$i]['daili']> 1?($infos[$i]['daili']> 2?'审核失败':'审核通过'):'待审核';
        }

        $show = $Page->pc_show();

        $this->assign('info',$infos);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display();
    }

    /*
     * 代理中心详情
     */

    function center_detail(){
        $users =M('users');
        $centerlists =M('centerlists');
        $pagecount = 10;
        $user_id = $_GET['user_name'];
        $count = $centerlists->where(" user_name = '$user_id'")->count();
        $Page = new \Think\Page($count, $pagecount);

        $datail= $centerlists->where("user_name = '$user_id'")
            ->order("user_id desc")
            ->limit($Page->firstRow . ',' . $Page->listRows)->select();
        // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->pc_show();

        $this->assign('datail',$datail);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display();
    }


    /*
     * 申请代理中心
     */

    function center_audit(){
        $centerlists = M('centerlists');
        $center_id  = $_GET['id'];

        $audit = $centerlists->where("id = '$center_id'")->find();

        $this->assign('audit',$audit);
        $this->display();


    }

    /*
     * 代理中心审核
     */

    function api_centerlists_audit(){
    	$users = M("users");
        $centerlists = M('centerlists');
        $center_id  = $_POST['center_id'];
        $genre  = $_POST['genre'];
        $reward  = $_POST['reward'];

		$user =  $centerlists->where(" id = '{$center_id}' ")->find();

        $data['genre'] = $genre;
        $data['reward'] = $reward;        
        $data['sh_time'] = time();
        $res = $centerlists->where(" id = '{$center_id}' ")->save($data);

        if(!$res){
            $msg['Success'] =false;
            $msg['Error'] = '-10000';
            $msg['Data'] = "审核失败";
            echo json_encode($msg);
            exit;
        }else{

			$getbaodanmax = $centerlists->where("user_id = '{$user['user_id']}' and genre =2 ")->max('type');
			$getbaodanmax>0?$getbaodanmax:0;
			if($user['genre'] == '2'){
				if($genre != '2'){
					$edit_data['shoptype'] = $getbaodanmax;
				}
			}else{
				if($genre == '2'){
					$edit_data['shoptype'] = $getbaodanmax;
				}
			}
			$edit_data['daili'] = $genre;
			$resu = $users->where(" user_id = '{$user['user_id']}' ")->save($edit_data);

            $msg['Success'] =true;
            $msg['Error'] = '0';
            $msg['Data'] = "审核成功";
            echo json_encode($msg);
            exit;
        }
    }

    /*
     * 代理中心 会员类别
     */

    function center_info(){

        $centerid = $_GET['user_name'];
        $users =M('users');
        $centerlists =M('centerlists');
        $pagecount = 10;
        $count = $users->where(" centername = '$centerid'")->count();
        $Page = new \Think\Page($count, $pagecount);

        $info= $users->join('wx_memberlevel ON wx_memberlevel.id = wx_users.level')
            ->where("wx_users.centername = '$centerid'")
            ->order("wx_users.user_id desc")
            ->limit($Page->firstRow . ',' . $Page->listRows)->select();
        // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->pc_show();
        $this->assign('info',$info);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('centername',$centerid);
        $this->display();
    }
    
    function center_info_ajax(){
    
    	$centerid = $_GET['centerid'];
    	$users =M('users');
    	$where = array();
    	$where['wx_users.centername'] = $centerid;
    	if ($_GET['user_name'] != null) {
    		$user_name = $_GET['user_name'];
    		$where['wx_users.user_name'] = array('like',"%$user_name%");
    	}
    	if ($_GET['truename'] != null) {
    		$truename = $_GET['truename'];
    		$where['wx_users.truename'] = array('like',"%$truename%");
    	}
    	if ($_GET['level'] != null) {
    		$level = $_GET['level']; 	
    		$where['wx_users.level'] = array('like',"%$level%");
    	}
    	
    	if ($_GET['pusername'] != null) {
    		$pusername = $_GET['pusername'];
    		$where['wx_users.pusername'] = array('like',"%$pusername%");
    	}
    	
    	if ($_GET['rusername'] != null) {
    		$rusername = $_GET['rusername'];
    		$where['wx_users.rusername'] = array('like',"%$rusername%");
    	}
    	
    	if ($_GET['type'] != null) {
    		$where['wx_users.register'] = $_GET['type'];
    	}
    	
    	if ($_GET['start'] != 0) {
    		$where[]['reg_time'] = array('eq', $_GET['start']);
    	}
    	 
    	$centerlists =M('centerlists');
    	$pagecount = 10;
    	$count = $users->where($where)->count();
    	$Page = new \Think\Pageajax($count, $pagecount);
    
    	$info= $users->join('wx_memberlevel ON wx_memberlevel.id = wx_users.level')
    	->where($where)
    	->order("wx_users.user_id desc")
    	->limit($Page->firstRow . ',' . $Page->listRows)->select();
    	// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show = $Page->pc_show();
//     	echo $users->getLastSql();
//     	exit;
    	$this->assign('info',$info);
    	$this->assign('count', $count);
    	$this->assign('page', $show);
    	$this->assign('centername',$centerid);
    	$this->display();
    }


    /*
     * 保单中心激或会员
     */

    function recmlist_activate(){

        $activate = A("User/Prize");
        $users = M('users');
        $bonus_info =M('bonus_info');

        $recmlist_id = $_SESSION['admin_id'];

        $user_name = $_POST['user_name'];
        $recmlist = $users->where("user_id = {$recmlist_id}")->find();

       // $bonusinfo = $bonus_info->where('id = 1')->find();

       // if($recmlist['dzb'] < $bonusinfo['first_bdxjf']){
      //      $msg['Error'] = '-30001';
      //      $msg['Data'] ='报单币不足,请及时充值';
      //      echo json_encode($msg);
      //      exit;
//
      //  }
        $userinfo = $users->where("user_name = '{$user_name}'")->find();

      //  $users -> where(" user_id = '{$recmlist_id}' ") -> setDec('dzb',$bonusinfo['first_bdxjf']);

        if($userinfo['single'] == 1){
         //   $activate->baodan($userinfo['user_id'],$userinfo['user_name'],$recmlist['user_id'],$recmlist['user_name'],$userinfo['lsk']);
        }



        if($userinfo['register'] == 1){
            $msg['Error'] = '-30002';
            $msg['Data'] ='激活失败,该会员已激活';
            echo json_encode($msg);
            exit;
        }
        
        // 查询推荐人是否激活
        $pidinfo = $users->where("user_id = '{$userinfo['pid']}'")->find();
        if($pidinfo['register'] == 0){
        	$msg['Error'] = '-30003';
        	$msg['Data'] ='激活失败,推荐人未激活';
        	echo json_encode($msg);
        	exit;
        }
        

        $being = $activate->activateuser($userinfo['user_id']);
        if($being){
            $msg['Error'] = '0';
            $msg['Data'] ='恭喜你,激活成功!';
            echo json_encode($msg);
            exit;
        }else{
            $msg['Error'] = '-30003';
            $msg['Data'] ='其他原因..';
            echo json_encode($msg);
            exit;
        }


    }
    /*
     * 会员级别 name  量奖 封顶
     */
    function  memberlevel(){
        $memberlevel = M('memberlevel');

        if ($_POST) {
            $lvid="id";
            $lvname="name";
            $lvmoney="money";
            $lvreward="reward";
            $capmoney="capmoney";
			$discount = "discount";
			$jdlayer = "jdlayer";
            $yiguanli = "yi_glj";
            $erguanli = "er_glj";
            $sanguanli = "san_glj";

            for($i=1;$i<=$memberlevel->count();$i++){
                $up_ulevel=NULL;
                $up_ulevel['id']=$_POST[$lvid.$i];
                $up_ulevel['name']=$_POST[$lvname.$i];
                $up_ulevel['money']=$_POST[$lvmoney.$i];
                $up_ulevel['reward']=$_POST[$lvreward.$i];
				$up_ulevel['jd_layer']=$_POST[$jdlayer.$i];
				$up_ulevel['discount']=$_POST[$discount.$i];
                $up_ulevel['capdaymoney']=$_POST[$capmoney.$i];
                $up_ulevel['yi_glj']=$_POST[$yiguanli.$i];
                $up_ulevel['er_glj']=$_POST[$erguanli.$i];
                $up_ulevel['san_glj']=$_POST[$sanguanli.$i];
                $memberlevel->save($up_ulevel);
            }

        }

        $memberlevel_info = $memberlevel->select();
        $this->assign("memberlevel_info", $memberlevel_info);
        $this->display();


    }

	function index()
	{
		$daili_info = M('daili_info');
		$daili_banner = M('daili_banner');
		if ($_POST) {
			$data = $_POST;
			$upload = new \Think\Upload();
			// 实例化上传类
			$upload->rootPath = './Uploads/';
			$upload->maxSize = 3145728;
			// 设置附件上传大小
			$upload->autoSub = false;
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
			// 设置附件上传类型
			$upload->savePath = '';
			// 设置附件上传目录    // 上传文件
			$upload->autoSub = true;
			$upload->subName = date("Ymd");
			$imginfo = $upload->upload();
			//dump($imginfo);exit;
			if ($imginfo) {
				foreach ($imginfo as $k => $v) {
					$arr = array();
					$arr['pic_url'] = "Uploads/" . $v["savepath"] . $v["savename"];
					$res = $daili_banner->add($arr);
				}
			}
			if ($_POST['daili_id'] == null) {
				$res = $daili_info->add($data);
			} else {
				$res = $daili_info->where(" id = '{$_POST['daili_id']}' ")->save($data);
			}
			$this->success("保存成功");
		} else {
			$info = $daili_info->select();
			F('daili_info', $info, DATA_ROOT);
			$qrset = M('qrset')->select();
			//F('daili_info',$info,DATA_ROOT);
			$banner = $daili_banner->select();
			$this->assign("daili_info", $info);
			$this->assign("qrset", $qrset);
			$this->assign("banner", $banner);
			$this->display();
		}
	}
	function delbanner()
	{
		$res = M('daili_banner')->where(" id = '{$_POST['id']}' ")->delete();
		if ($res) {
			$arr['success'] = 1;
		} else {
			$arr['success'] = 0;
		}
		echo json_encode($arr);
	}
	function qr()
	{
		if (!$_POST) {
			die;
		}
		$upload = new \Think\Upload();
		// 实例化上传类
		$upload->rootPath = './Uploads/';
		$upload->maxSize = 3145728;
		// 设置附件上传大小
		$upload->autoSub = false;
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
		// 设置附件上传类型
		$upload->savePath = '';
		// 设置附件上传目录    // 上传文件
		$upload->autoSub = true;
		$upload->subName = date("Ymd");
		$imginfo = $upload->upload();
		if ($imginfo) {
			$_POST['pic_url'] = "Uploads/" . $imginfo['image1']["savepath"] . $imginfo['image1']["savename"];
		}
		if ($_POST[qr] == null) {
			$res = M('qrset')->add($_POST);
		} else {
			$res = M('qrset')->where(" id = '{$_POST['qr']}' ")->save($_POST);
		}
		M('qrcode')->where(" update_time > 0 ")->setField('update_time', '0');
		$this->success("保存成功");
	}

	function imgtest()
	{
		$info = M('qrset')->select();
		if (!$info) {
			$text = "发现您还没有设置推广二维码相关参数，请先行设置后再查看";
			$this->assign("text", $text);
		} else {
			$weixin = A("Wxapi/Qrimg");
			$res = $weixin->index(0, 0, "未知用户");
			$url = __ROOT__ . "/" . $res;
			$this->assign("url", $url);
		}
		$this->display();
	}
	function users()
	{
		$pagecount = 2;
		$count = M('users')->count();
		$Page = new \Think\Page($count, $pagecount);
		$info = M('users')->order("user_id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$Page->setConfig('first', '首页');
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('last', '尾页');
		$Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 ' . I('p', 1) . ' 页/共 %TOTAL_PAGE% 页 ( ' . $pagecount . ' 条/页 共 %TOTAL_ROW% 条)');
		foreach ($info as $key => $value) {
			$info[$key]['subscribe_time'] = date("Y-m-d H:i:s", $value['subscribe_time']);
		}
		$info = $this->infoto($info);
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();
		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->assign("info", $info);
		$this->display();
	}
	function users_ajax()
	{
		if ($_GET['nickname']) {
			$where['nickname'] = array('like', '%' . $_GET['nickname'] . '%');
		} elseif ($_GET['user_id']) {
			$where = array('user_id' => $_GET['user_id']);
		} elseif ($_GET['subscribe'] != null) {
			$where = array('subscribe' => $_GET['subscribe']);
		} else {
			$where = array();
		}
		$pagecount = 2;
		$count = M('users')->where($where)->count();
		$Page = new \Think\Pageajax($count, $pagecount);
		$info = M('users')->where($where)->order("user_id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$Page->setConfig('first', '首页');
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('last', '尾页');
		$Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 ' . I('p', 1) . ' 页/共 %TOTAL_PAGE% 页 ( ' . $pagecount . ' 条/页 共 %TOTAL_ROW% 条)');
		foreach ($info as $key => $value) {
			$info[$key]['subscribe_time'] = date("Y-m-d H:i:s", $value['subscribe_time']);
		}
		$info = $this->infoto($info);
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();
		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->assign("info", $info);
		$this->display();
	}
	function contact()
	{
		$user_id = $_GET['user_id'];
		if (!$user_id) {
			die;
		}
		$users = M('users');
		$user_contact = M('user_contact');
		$user_info = $users->field("nickname,headimgurl")->where(" user_id = {$user_id} ")->find();
		//上级信息
		$pid = $user_contact->where(" level = 1 ")->getFieldByChildren_id($user_id, 'user_id');
		//第1层
		$first_id = $user_contact->field("children_id")->where(" user_id = '{$user_id}' and level = 1 ")->select();
		//第2层
		$second_id = $user_contact->field("children_id")->where(" user_id = '{$user_id}' and level = 2 ")->select();
		//第3层
		$third_id = $user_contact->field("children_id")->where(" user_id = '{$user_id}' and level = 3 ")->select();
		//第4层
		$four_id = $user_contact->field("children_id")->where(" user_id = '{$user_id}' and level = 4 ")->select();
		//第5层
		$five_id = $user_contact->field("children_id")->where(" user_id = '{$user_id}' and level = 5 ")->select();
		//第6层
		$six_id = $user_contact->field("children_id")->where(" user_id = '{$user_id}' and level = 6 ")->select();
		//第7层
		$seven_id = $user_contact->field("children_id")->where(" user_id = '{$user_id}' and level = 7 ")->select();
		//第8层
		$eight_id = $user_contact->field("children_id")->where(" user_id = '{$user_id}' and level = 8 ")->select();
		//第9层
		$nine_id = $user_contact->field("children_id")->where(" user_id = '{$user_id}' and level = 9")->select();
		$this->assign("user_info", $user_info);
		$pid_info = $users->field("user_id,nickname,headimgurl")->where(" user_id = '{$pid}' ")->select();
		$this->assign("pid_info", $pid_info);
		$this->assign("first_info", $this->contact_info($first_id));
		$this->assign("second_info", $this->contact_info($second_id));
		$this->assign("third_info", $this->contact_info($third_id));
		$this->assign("four_info", $this->contact_info($four_id));
		$this->assign("five_info", $this->contact_info($five_id));
		$this->assign("six_info", $this->contact_info($six_id));
		$this->assign("seven_info", $this->contact_info($seven_id));
		$this->assign("eight_info", $this->contact_info($eight_id));
		$this->assign("nine_info", $this->contact_info($nine_id));
		$this->display();
	}
	function contact_info($arr)
	{
		$users = M('users');
		$result = array();
		foreach ($arr as $k => $v) {
			$result[$k] = $users->field("user_id,nickname,headimgurl")->getByUser_id($v['children_id']);
		}
		return $result;
	}
	function daili()
	{
		$pagecount = 11;
		$count = M('users')->where("agent >0 and daili = 1")->count();
		$Page = new \Think\Page($count, $pagecount);
		$info = M('users')->where("agent >0 and daili = 1")->order("user_id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$Page->setConfig('first', '首页');
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('last', '尾页');
		$Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 ' . I('p', 1) . ' 页/共 %TOTAL_PAGE% 页 ( ' . $pagecount . ' 条/页 共 %TOTAL_ROW% 条)');
		foreach ($info as $key => $value) {
			$info[$key]['subscribe_time'] = date("Y-m-d H:i:s", $value['subscribe_time']);
		}
		$info = $this->infoto($info);
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();
		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->assign("info", $info);
		$this->display();
	}
	function daijin()
	{
		$this->display();
	}
	function daijin_ajax()
	{
		$daijin = M('daijin');
		$users = M('users');
		$pagecount = 10;
		$count = $daijin->count();
		$Page = new \Think\Pageajax($count, $pagecount);
		$info = $daijin->order("time desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$Page->setConfig('first', '首页');
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('last', '尾页');
		$Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 ' . I('p', 1) . ' 页/共 %TOTAL_PAGE% 页 ( ' . $pagecount . ' 条/页 共 %TOTAL_ROW% 条)');
		foreach ($info as $k => $v) {
			$del_user_id = $v['del_user_id'];
			$user_id = $v['user_id'];
			$info[$k]['del_user'] = $users->field("nickname,headimgurl")->where(" user_id = '{$del_user_id}' ")->find();
			$info[$k]['user'] = $users->field("nickname,headimgurl")->where(" user_id = '{$user_id}' ")->find();
			$info[$k]['time'] = date("Y-m-d H:i:s", $v['time']);
		}
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();
		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->assign("info", $info);
		$this->display();
	}
	function dailichange()
	{
		$user_id = $_POST['id'];
		if (intval($_POST['type']) > 1) {
			die;
		}
		M('users')->where(" user_id = '{$user_id}' ")->setField('daili', intval($_POST['type']));
		echo json_encode($arr);
	}
	function daili_ajax()
	{
		if ($_GET['nickname']) {
			$where['nickname'] = array('like', '%' . $_GET['nickname'] . '%');
		} elseif ($_GET['user_id']) {
			$where = array('user_id' => $_GET['user_id']);
		} else {
			$where = array();
		}
		$pagecount = 10;
		$count = M('users')->where($where)->count();
		$Page = new \Think\Pageajax($count, $pagecount);
		$info = M('users')->where($where)->order("user_id desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$Page->setConfig('first', '首页');
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('last', '尾页');
		$Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 ' . I('p', 1) . ' 页/共 %TOTAL_PAGE% 页 ( ' . $pagecount . ' 条/页 共 %TOTAL_ROW% 条)');
		foreach ($info as $key => $value) {
			$info[$key]['subscribe_time'] = date("Y-m-d H:i:s", $value['subscribe_time']);
		}
		$info = $this->infoto($info);
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();
		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->assign("info", $info);
		$this->display();
	}
	function get_address()
	{
		$user_id = $_POST['id'];
		$info = M('user_address')->getByUser_id($user_id);
		$arr['info'] = '<h5>姓名：' . $info['username'] . '</h5><h5>电话：' . $info['telphone'] . '</h5><h5>地址：' . $info['address'] . '</h5>';
		echo json_encode($arr);
	}
	function orders()
	{
		$pagecount = 10;
		if ($_POST['order_sn']) {
			$where = array('order_sn' => $_POST['order_sn']);
		} elseif ($_POST['user_id']) {
			$where = array('user_id' => $_POST['user_id']);
		} elseif ($_POST['is_true'] != null) {
			$where = array('is_true' => $_POST['is_true']);
		} else {
			$where = array();
		}
		$count = M('agent_orders')->where($where)->count();
		$Page = new \Think\Page($count, $pagecount);
		$info = M('agent_orders')->where($where)->order("time desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$Page->setConfig('first', '首页');
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('last', '尾页');
		$Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 ' . I('p', 1) . ' 页/共 %TOTAL_PAGE% 页 ( ' . $pagecount . ' 条/页 共 %TOTAL_ROW% 条)');
		$users = M('users');
		foreach ($info as $key => $value) {
			$info[$key]['time'] = date("Y-m-d H:i:s", $value['time']);
			$info[$key]['nickname'] = $users->getFieldByUser_id($value['user_id'], "nickname");
			if (empty($info[$key]['nickname'])) {
				$info[$key]['nickname'] = "未知用户";
			}
			switch ($value['type']) {
				case 1:
					$info[$key]['desc'] = "套餐1";
					break;
				case 2:
					if ($value['bucha'] == 0) {
						$info[$key]['desc'] = "套餐2";
					} else {
						$info[$key]['desc'] = "套餐2从套餐1补差价";
					}
					break;
				case 3:
					if ($value['bucha'] == 0) {
						$info[$key]['desc'] = "套餐3";
					} elseif ($value['bucha'] == 1) {
						$info[$key]['desc'] = "套餐3从套餐2补差价";
					} else {
						$info[$key]['desc'] = "套餐3从套餐1补差价";
					}
					break;
				default:
					$info[$key]['desc'] = "未知";
					break;
			}
		}
		$info = $this->infoto($info);
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();
		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->assign("info", $info);
		$this->display();
	}
	function orders_ajax()
	{
		$pagecount = 10;
		if ($_GET['sn']) {
			$where = array('order_sn' => $_GET['sn']);
		} elseif ($_GET['user_id']) {
			$where = array('user_id' => $_GET['user_id']);
		} elseif ($_GET['is_true'] != null) {
			$where = array('is_true' => $_GET['is_true']);
		} else {
			$where = array();
		}
		$count = M('agent_orders')->where($where)->count();
		$Page = new \Think\Pageajax($count, $pagecount);
		$info = M('agent_orders')->where($where)->order("time desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$Page->setConfig('first', '首页');
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('last', '尾页');
		$Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 ' . I('p', 1) . ' 页/共 %TOTAL_PAGE% 页 ( ' . $pagecount . ' 条/页 共 %TOTAL_ROW% 条)');
		$users = M('users');
		foreach ($info as $key => $value) {
			$info[$key]['time'] = date("Y-m-d H:i:s", $value['time']);
			$info[$key]['nickname'] = $users->getFieldByUser_id($value['user_id'], "nickname");
			if (empty($info[$key]['nickname'])) {
				$info[$key]['nickname'] = "未知用户";
			}
			switch ($value['type']) {
				case 1:
					$info[$key]['desc'] = "套餐1";
					break;
				case 2:
					if ($value['bucha'] == 0) {
						$info[$key]['desc'] = "套餐2";
					} else {
						$info[$key]['desc'] = "套餐2从套餐1补差价";
					}
					break;
				case 3:
					if ($value['bucha'] == 0) {
						$info[$key]['desc'] = "套餐3";
					} elseif ($value['bucha'] == 1) {
						$info[$key]['desc'] = "套餐3从套餐2补差价";
					} else {
						$info[$key]['desc'] = "套餐3从套餐1补差价";
					}
					break;
				default:
					$info[$key]['desc'] = "未知";
					break;
			}
		}
		$info = $this->infoto($info);
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();
		$this->assign('count', $count);
		$this->assign('page', $show);
		$this->assign("info", $info);
		$this->display();
	}
	private function infoto($info)
	{
		if (F('daili_info', '', DATA_ROOT)) {
			$daili_info = F('daili_info', '', DATA_ROOT);
		} else {
			$daili_info = M('daili_info')->select();
			F('daili_info', $daili_info, DATA_ROOT);
		}
		foreach ($info as $k => $v) {
			switch ($v['agent']) {
				case 0:
					$info[$k]['agent'] = "普通会员";
					break;
				case 1:
					$info[$k]['agent'] = $daili_info[0]['first_name'];
					break;
				case 2:
					$info[$k]['agent'] = $daili_info[0]['second_name'];
					break;
				case 3:
					$info[$k]['agent'] = $daili_info[0]['third_name'];
					break;
			}
		}
		return $info;
	}
	function excel_down()
	{
		//dump($info);exit;
		$excel = A('Admin/Excel');
		$excel->index($info, $username);
	}
	function hongbao()
	{
		$this->display();
	}
	function hongbao_ajax()
	{
		$pagecount = 10;
		if ($_GET['from_user_id']) {
			$where = array('from_user_id' => $_GET['from_user_id']);
		} elseif ($_GET['user_id']) {
			$where = array('user_id' => $_GET['user_id']);
		} else {
			$where = array();
		}
		$agent_orders = M('agent_orders');
		$hbrecord = M('hbrecord');
		$users = M('users');
		$count = $hbrecord->where($where)->count();
		$Page = new \Think\Pageajax($count, $pagecount);
		$info = $hbrecord->where($where)->order("time desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$Page->setConfig('first', '首页');
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('last', '尾页');
		$Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 ' . I('p', 1) . ' 页/共 %TOTAL_PAGE% 页 ( ' . $pagecount . ' 条/页 共 %TOTAL_ROW% 条)');
		foreach ($info as $key => $value) {
			$info[$key]['time'] = date("Y-m-d H:i:s", $value['time']);
			$info[$key]['tonickname'] = $users->getFieldByUser_id($value['user_id'], "nickname");
			$info[$key]['fromnickname'] = $users->getFieldByUser_id($value['from_user_id'], "nickname");
			$info[$key]['order_sn'] = $agent_orders->getFieldByOrder_id($value['order_id'], "order_sn");
			if (empty($info[$key]['tonickname'])) {
				$info[$key]['nickname'] = "未知用户";
			}
			if (empty($info[$key]['fromnickname'])) {
				$info[$key]['nickname'] = "未知用户";
			}
		}
		$info = $this->infoto($info);
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();
		$this->assign('page', $show);
		$this->assign("info", $info);
		$this->display();
	}
	function del()
	{
		if ($_POST['id']) {
			$user_id = $_POST['id'];
			M('users')->where(" user_id = '{$user_id}' ")->delete();
			$arr = array();
			echo json_encode($arr);
		}
	}

    /*
    * $level
    * 查询会员级别
    * return $levelinfo['name']
    */
    protected  function getlevel($level)
    {
        $levelinfo =M('memberlevel')->where(" id = '{$level}' ")->find();
        return $levelinfo;
    }


    /*
     * 积分参数设置
     */
    function system(){

        $bonus_info = M('bonus_info');
        if($_POST){
            $data = $_POST;
            $res = $bonus_info->where(" id = '{$_POST['daili_id']}' ")->save($data);
            $this->success("修改成功");
        }else{
            $info = $bonus_info->select();
            F('bonus_info', $info, DATA_ROOT);
            $this->assign("daili_info", $info);
            $this->display();
        }

    }
	
    /*
     * 重置页面
     */
	function eliminate(){

            $this->display();
	}
	function eliminate_info(){
			  $checkcode = $_POST['checkcode'];
			  $zidong = $_POST['zidong'];

			 //验证验证码
		//	if(!$this->check_verify($checkcode)){
			//	$msg['Error'] = '-10003';
			//	$msg['Data'] = "验证码错误";
			//	$msg['Success'] = false;
			//	echo json_encode($msg);
			//	 exit;
			//}
			$datasql ="
			  truncate table wx_centerlists;
			  truncate table wx_shop_order;
			  truncate table wx_shop_order_detail;
			  truncate table wx_systemyeji;
			  truncate table wx_bonustime;
			  truncate table wx_bonus;
			  truncate table wx_upgrade;
			  truncate table wx_users;
			  truncate table wx_broke_record;
			  INSERT INTO `wx_centerlists` VALUES ('1', '1', 'M000001', '公司1', '2', '2', '3', '申请保单中心', '申请保单中心', '1490162800', '1490178050');
			  INSERT INTO `wx_users` (`user_id`, `user_name`, `openid`, `wxid`, `nickname`, `truename`, `password`, `second_password`, `headimgurl`, `sex`, `province`, `city`, `country`, `subscribe`, `subscribe_time`, `register`, `pid`, `repath`, `rusername`, `rlevel`, `recount`, `parentid`, `ppath`, `pusername`, `plevel`, `centerid`, `centername`, `area`, `area1`, `area2`, `yarea1`, `jjb`, `gwb`, `dzb`, `axjj`, `sh`, `yarea2`, `chl`, `chr`, `level`, `lsk`, `zb1`, `agent`, `shop_income`, `shop_outcome`, `mey`, `huzhu`, `single`, `maxmey`, `b0`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `daijin`, `daili`, `rank`, `idcard`, `bankid`, `bankno`, `bankuser`, `bankname`, `moblie`, `email`, `zipcode`, `address`, `place`, `last_time`, `reg_time`, `activate_time`, `after_time`) VALUES ('1', 'M000001', 'odUDzsqRHu3bnIUAGS1njwePHcz0', '', 'admin', '公司1', '21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', 'http://wx.qlogo.cn/mmopen/kiaXicXJs2M4dxtxRkYUC7vKbxL80vUr1zvkKRrySkUFzdjFGPGhWXLncCV2cPB6J1iajg7z8DakreFyqFqD2x4kMcIHDSh63Vy/0', '1', '16', '170', '中国', '1', '1488950385', '1', '0', '', '', '0', '0', '0', '', '', '0', '0', '0', '', '0', '0', '0', '0.00', '0.00', '5000000.00', '0.00', '0.00', '0', '0', '0', '3', '9980.00', '0.00', '0', '0.00', '0.00', '0.00', '0.00', '1', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '2', '0', '111', '1', '1', '11', '111', '15098890705', '123', '12', '1', '1726', '1490937826', '0', '0', '0');
";
			$Model = M();
			$result = $Model->execute($datasql);
			if($zidong == '2'){
				$this->zidong();
			}
				$msg['Error'] = '0';
				$msg['Success'] = true;
				echo json_encode($msg);
				 exit;
	}

	public function zidong(){
	  $users = M('users');
      $memberlevel = M('memberlevel')->field('id,money')->select();
	  
		
      
	 for($i=0;$i<9;$i++){
		$users_ceng = $users->where("rlevel = '{$i}'")->select();
		
		foreach($users_ceng as $u=>$ceng){
			$random_memberlevel=array_rand($memberlevel,1);
		    $rand_level = $memberlevel[$random_memberlevel]['id'];
	 	    $rand_level_money = $memberlevel[$random_memberlevel]['money'];
			$code = $users->field("max(user_name) as newno")->find();
			$Newcode = 'M'.str_pad(substr($code['newno'],1,6)+1,6,"0",STR_PAD_LEFT);
			$Newcode2 = 'M'.str_pad(substr($code['newno'],1,6)+2,6,"0",STR_PAD_LEFT);
			
			$add_data['user_name'] = $Newcode;
		    $add_data['centerid'] = '1';
		    $add_data['centername'] ='M000001';
			$add_data['level'] = $rand_level;
			$add_data['single'] = 1;
			$add_data['lsk'] = $rand_level_money;
			$add_data['password'] = md5('admin');
			$add_data['second_password'] = md5('admin');
			$add_data['moblie'] = time();
			$add_data['reg_time'] = time();
			$add_data['after_time'] = time();
			// 推荐人
			$add_data['pid'] = $ceng['user_id'];
			$add_data['rusername'] = $ceng['user_name'];
			$add_data['repath']=$ceng['repath'].$ceng['user_id'].",";
			$add_data['rlevel']=$ceng['rlevel']+1;
			//安置人
			 $add_data['area'] = 1;
			 $add_data['parentid'] = $ceng['user_id'];
			 $add_data['pusername'] = $ceng['user_name'];
			 $add_data['ppath']=$ceng['ppath'].$ceng['user_id'].",";
			 $add_data['plevel']=$ceng['plevel']+1;
			 $add_user_id = $users -> add($add_data);
			 $add_data2 = $add_data;
			 $random_memberlevel=array_rand($memberlevel,1);
		    $rand_level = $memberlevel[$random_memberlevel]['id'];
	 	    $rand_level_money = $memberlevel[$random_memberlevel]['money'];
			$add_data2['user_name'] = $Newcode2;
			$add_data2['level'] = $rand_level;
			 $add_data2['lsk'] = $rand_level_money;
			 $add_data2['area'] = 2;
			$add_data2['moblie'] = time();
			$add_data2['reg_time'] = time();
			$add_data2['after_time'] = time();
			$add_user_id2 = $users -> add($add_data2);

			$area_info['chl'] = $add_user_id;
			$area_info['chr'] = $add_user_id2;

            $res = $users -> where(" user_name = '{$ceng['user_name']}' ") -> save($area_info);

		}
	 }


	}

	    /**
     *
     * 验证码生成
     */
    public function builder_verify_img(){
        ob_end_clean();
        $Verify = new \Think\Verify();
        $Verify->fontSize = 18;
        $Verify->length   = 5;
        $Verify->useNoise = true;
        $Verify->codeSet = '0123456789';
        $Verify->imageW = 0;
        $Verify->imageH = 0;
        //$Verify->expire = 600;
        $Verify->entry();
        exit;
    }


    /**
     * 验证码检查
     */
    function check_verify($code){
        $verify = new \Think\Verify();
        return $verify->check($code);
    }

}