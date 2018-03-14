<?php
namespace Admin\Controller;

use Think\Controller;
class RbacController extends ActionController {

    protected $role_model, $auth_access_model;

    public function __construct() {
        parent::__construct();
        //echo session('admin_id');
        if (!session('admin_id')) {
            $this->error('登录已超时，请重新登录', U('User/index'));
        }
        $this->role_model = D("Common/Role");
    }

    // 角色管理列表
    public function index() {
        $data = $this->role_model->order(array("listorder" => "ASC", "id" => "DESC"))->select();
        $this->assign("roles", $data);
        $this->display();
    }

    // 添加角色
    public function roleadd() {
        $this->display();
    }
    
    // 添加角色提交
    public function roleadd_post() {
    	if (IS_POST) {
            $_POST['name'] = urldecode($_POST['name']);
            $_POST['remark'] = urldecode($_POST['remark']);
    		if ($this->role_model->create()!==false) {
    			if ($this->role_model->add()!==false) {
                    $msg['Success'] =true;
                    $msg['Error'] = 0;
                    $msg['Data'] = '添加角色成功';
                    echo json_encode($msg);
                    exit;
    			} else {
                    $msg['Success'] =false;
                    $msg['Error'] = '-10000';
                    $msg['Data'] = $this->role_model->getError();
                    echo json_encode($msg);
                    exit;
    			}
    		} else {
                $msg['Success'] =false;
                $msg['Error'] = '-10000';
                $msg['Data'] = $this->role_model->getError();
                echo json_encode($msg);
                exit;
    		}
    	}
    }

    // 删除角色
    public function roledelete() {
        $id = I("get.id",0,'intval');
        if ($id == 1) {
            $this->error("超级管理员角色不能被删除！");
        }
        $role_user_model=M("RoleUser");
        $count=$role_user_model->where(array('role_id'=>$id))->count();
        if($count>0){
        	$this->error("该角色已经有用户！");
        }else{
        	$status = $this->role_model->delete($id);
        	if ($status!==false) {
        		$this->success("删除成功！", U('Rbac/index'));
        	} else {
        		$this->error("删除失败！");
        	}
        }
        
    }

    // 编辑角色
    public function roleedit() {
        $id = I("get.id",0,'intval');
        if ($id == 1) {
            $this->error("超级管理员角色不能被修改！");
        }
        $data = $this->role_model->where(array("id" => $id))->find();
        if (!$data) {
        	$this->error("该角色不存在！");
        }
        $this->assign("data", $data);
        $this->display();
    }
    
    // 编辑角色提交
    public function roleedit_post() {
    	$id = I("request.id",0,'intval');
    	if ($id == 1) {
            $msg['Success'] =false;
            $msg['Error'] = '-10000';
            $msg['Data'] = "超级管理员角色不能被修改！";
            echo json_encode($msg);
            exit;
    	}
    	if (IS_POST) {
            $_POST['name'] = urldecode($_POST['name']);
            $_POST['remark'] = urldecode($_POST['remark']);
    		if ($this->role_model->create()!==false) {
    			if ($this->role_model->save()!==false) {
                    $msg['Success'] =true;
                    $msg['Error'] = 0;
                    $msg['Data'] = '修改成功';
                    echo json_encode($msg);
                    exit;
    			} else {
                    $msg['Success'] =false;
                    $msg['Error'] = '-10000';
                    $msg['Data'] = '修改失败';
                    echo json_encode($msg);
                    exit;
    			}
    		} else {
                $msg['Success'] =false;
                $msg['Error'] = '-10000';
                $msg['Data'] = $this->role_model->getError();
                echo json_encode($msg);
                exit;
    		}
    	}
    }

    // 角色授权
    public function authorize() {
        $this->auth_access_model = D("Common/AuthAccess");
       //角色ID
        $roleid = I("get.id",0,'intval');
        if (empty($roleid)) {
        	$this->error("参数错误！");
        }
        import('Org.Util.Tree');

        $menu = new \Tree();
        $menu->icon = array('│ ', '├─ ', '└─ ');
        $menu->nbsp = '&nbsp;&nbsp;&nbsp;';

        $result = $this->initMenu();
        $newmenus=array();
        $priv_data=$this->auth_access_model->where(array("role_id"=>$roleid))->getField("rule_name",true);//获取权限表数据

        foreach ($result as $m){
        	$newmenus[$m['id']]=$m;
        }

        foreach ($result as $n => $t) {
        	$result[$n]['checked'] = ($this->_is_checked($t, $roleid, $priv_data)) ? ' checked' : '';
        	$result[$n]['level'] = $this->_get_level($t['id'], $newmenus);
        	$result[$n]['style'] = empty($t['parentid']) ? '' : 'display:none;';
        	$result[$n]['parentid_node'] = ($t['parentid']) ? ' class="child-of-node-' . $t['parentid'] . '"' : '';
        }
        $str = "<tr id='node-\$id' \$parentid_node  style='\$style'>
                   <td style='padding-left:30px;'>\$spacer<input type='checkbox' name='menuid[]' value='\$id' level='\$level' \$checked onclick='javascript:checknode(this);'> \$name</td>
    			</tr>";
        $menu->init($result);
        $categorys = $menu->get_tree(0, $str);
        
        $this->assign("categorys", $categorys);
        $this->assign("roleid", $roleid);
        $this->display();
    }
    
    // 角色授权提交
    public function authorize_post() {
    	$this->auth_access_model = D("Common/AuthAccess");
    	if (IS_POST) {
    		$roleid = I("post.roleid",0,'intval');
    		if(!$roleid){
    			$this->ajaxReturn("需要授权的角色不存在！",'json');
    		}
    		if (is_array($_POST['menuid']) && count($_POST['menuid'])>0) {
    			
    			$menu_model=M("Menu");
    			$auth_rule_model=M("AuthRule");
    			$this->auth_access_model->where(array("role_id"=>$roleid,'type'=>'admin_url'))->delete();
    			foreach ($_POST['menuid'] as $menuid) {
    				$menu=$menu_model->where(array("id"=>$menuid))->field("app,model,action")->find();
    				if($menu){
    					$app=$menu['app'];
    					$model=$menu['model'];
    					$action=$menu['action'];
    					$name=strtolower("$app/$model/$action");
    					$this->auth_access_model->add(array("role_id"=>$roleid,"rule_name"=>$name,'type'=>'admin_url'));
    				}
    			}

    			$this->ajaxReturn("授权成功！",'JSON');
    		}else{
    			//当没有数据时，清除当前角色授权
    			$this->auth_access_model->where(array("role_id" => $roleid))->delete();
    			$this->ajaxReturn("没有接收到数据，执行清除授权成功！",'JSON');
    		}
    	}
    }
    
    /**
     *  检查指定菜单是否有权限
     * @param array $menu menu表中数组
     * @param int $roleid 需要检查的角色ID
     */
    private function _is_checked($menu, $roleid, $priv_data) {
    	
    	$app=$menu['app'];
    	$model=$menu['model'];
    	$action=$menu['action'];
    	$name=strtolower("$app/$model/$action");
    	if($priv_data){
	    	if (in_array($name, $priv_data)) {
	    		return true;
	    	} else {
	    		return false;
	    	}
    	}else{
    		return false;
    	}
    	
    }

    /**
     * 获取菜单深度
     * @param $id
     * @param $array
     * @param $i
     */
    protected function _get_level($id, $array = array(), $i = 0) {
        
        	if ($array[$id]['parentid']==0 || empty($array[$array[$id]['parentid']]) || $array[$id]['parentid']==$id){
        		return  $i;
        	}else{
        		$i++;
        		return $this->_get_level($array[$id]['parentid'],$array,$i);
        	}
        		
    }
    
    //角色成员管理
    public function member(){
    	//TODO 添加角色成员管理
    	
    }

}

