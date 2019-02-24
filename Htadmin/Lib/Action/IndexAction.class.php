<?php
if(!defined("ni8shop")) exit("Access Denied");
class IndexAction extends PublicAction {

    public function _before_index(){
		if(!empty($_SESSION['admin_id'])){
			$this->redirect('home',"", 0, '');
		}	
	}	

	public function _before_home(){
		if(empty($_SESSION['admin_id'])){
			$this->redirect('index',"", 0, '');
		}	
	}

    public function index(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){	
			$yzm=md5($_POST['code']);
			$pwd=md5($_POST['password']);
			$username=$_POST['username'];
			cookie('htadmin',$username);
			if($_COOKIE['verify']!=$yzm) {
				echo "<script>alert('验证码错误');history.go(-1);</script>";
				exit;
			}
			$row=$this->finds("Admin","username='".$username."' and Password='".$pwd."'","id desc");	
			if ($row){
				if($row['passed']==0){
					echo "<script>alert('此帐户没有审核通过!');history.go(-1);</script>";
					exit;
				}
				$_SESSION['admin_id']=$row['id'];
				$_SESSION['user_name']=$row['username'];
				setcookie('yzdlmyl',md5($row['username'].time()),0,'/','',false,true);
				$this->sess->update_user_info('admin');
				setcookie('verify','',1,'/','',false);
				$this->redirect('home',"", 0, '');	
				exit;
			}
			else{
				setcookie('yzdlmyl','',1,'/','',false);
				echo "<script>alert('没有找到此用户!');history.go(-1);</script>";
				exit;
			}	
		}
		$this->assign('htadmin',cookie('htadmin'));
		$this->display();
    }

	public function home(){
		$this->display();
	}

	public function logout(){
		$this->sess->destroy_session('admin');
		$this->redirect('index',"", 0, '');
	}
}
?>