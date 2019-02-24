<?php
if(!defined("ni8")) exit("Access Denied");
class cls_session extends Action
{
    var $session_table  = '';
    var $max_life_time  = 2592000; // SESSION失效时间
    var $session_name   = '';
    var $session_id     = '';
    var $session_expiry = '';
    var $session_md5    = '';
    var $session_cookie_path   = '/';
    var $session_cookie_domain = '';
    var $session_cookie_secure = false;

    var $_ip   = '';
    var $_time = 0;

    //function _initialize($session_table,$session_name = 'USER_ID',$session_id='')
//    {
//	 $this->cls_session($session_table, $session_name, $session_id);
//    }

    function session($session_table, $session_name = 'USER_ID', $session_id = '')
    {   
	    $GLOBALS['_SESSION'] = array();
        $cookie_path=C('COOKIE_PATH');
		$cookie_domain=C('COOKIE_DOMAIN');
		$cookie_secure=C('COOKIE_SECURE');
        if (!empty($cookie_path))
        {
            $this->session_cookie_path = $cookie_path;
        }
        else
        {
            $this->session_cookie_path = '/';
        }

        if (!empty($cookie_domain))
        {
            $this->session_cookie_domain = $cookie_domain;
        }
        else
        {
            $this->session_cookie_domain = '';
        }

        if (!empty($cookie_secure))
        {
            $this->session_cookie_secure = $cookie_secure;
        }
        else
        {
            $this->session_cookie_secure = false;
        }
		
        $this->session_name       = $session_name;
        $this->session_table      = $session_table;
        $this->_ip =$this->real_ip();
		//echo $this->_ip;
		if($this->_ip=='183.12.112.192'){
        //print_r($_COOKIE);		
		}
        if ($session_id == '' && !empty($_COOKIE[$this->session_name]))
        {
		
            $this->session_id = $_COOKIE[$this->session_name];
        }
        else
        {
            $this->session_id = $session_id;
        }

        if ($this->session_id)
        {
            $tmp_session_id = substr($this->session_id, 0, 32);
            if ($this->gen_session_key($tmp_session_id) == substr($this->session_id, 32))
            {
                $this->session_id = $tmp_session_id;
            }
            else
            {
                $this->session_id = '';
            }
        }
        $this->_time = time();
        if ($this->session_id)
        {
            $this->load_session();
        }
        else
        {
            $this->gen_session_id();

            setcookie($this->session_name, $this->session_id . $this->gen_session_key($this->session_id), 0, $this->session_cookie_path, $this->session_cookie_domain, $this->session_cookie_secure);
        }
		$this->close_session("120");
        register_shutdown_function(array(&$this, 'close_session'));
		
    }
//获取SESSION id  11
    function gen_session_id()
    {
        $this->session_id = md5(uniqid(mt_rand(), true));

        return $this->insert_session();
    }
//转换SESSION ID  11
    function gen_session_key($session_id)
    {
        static $ip = '';

        if ($ip == '')
        {
            $ip = substr($this->_ip, 0, strrpos($this->_ip, '.'));
        }
        return sprintf('%08x', crc32(ROOT_PATH . $ip . $session_id));
    }
//插入SESSION 数据 11
    function insert_session()
    {
	$sj=array();
	$insession=M($this->session_table);
	$sj['sesskey']=$this->session_id;
	$sj['expiry']=$this->_time;
	$sj['ip']=$this->_ip;
	$sj['data']='a:0:{}';
	return $insession->add($sj);       
    }
//加载SESSION 11
    function load_session()
    {
	    $loadsession=M($this->session_table);
        $session =$loadsession->where("sesskey='".$this->session_id."'")->find();
        if (empty($session))
        {
		
            $this->insert_session();

            $this->session_expiry = 0;
            $this->session_md5    = '40cd750bba9870f18aada2478b24840a';
            $GLOBALS['_SESSION']  = array();
        }
        else
        {
            if (!empty($session['data']) && $this->_time - $session['expiry'] <= $this->max_life_time)
            {
                $this->session_expiry = $session['expiry'];
                $this->session_md5    = md5($session['data']);
                $GLOBALS['_SESSION']  = unserialize($session['data']);
                $GLOBALS['_SESSION']['user_id'] = $session['userid'];
                $GLOBALS['_SESSION']['admin_id'] = $session['adminid'];
                $GLOBALS['_SESSION']['user_name'] = $session['user_name'];
                $GLOBALS['_SESSION']['user_rank'] = $session['user_rank'];
                $GLOBALS['_SESSION']['discount'] = $session['discount'];
                $GLOBALS['_SESSION']['email'] = $session['email'];
            }
            else
            {
               
                    $this->session_expiry = 0;
                    $this->session_md5    = '40cd750bba9870f18aada2478b24840a';
                    $GLOBALS['_SESSION']  = array();

            }
        }
    }
//更新session
    function update_session()
    {
        $adminid = !empty($GLOBALS['_SESSION']['admin_id']) ? intval($GLOBALS['_SESSION']['admin_id']) : 0;
        $userid  = !empty($GLOBALS['_SESSION']['user_id'])  ? intval($GLOBALS['_SESSION']['user_id'])  : 0;
        $user_name  = !empty($GLOBALS['_SESSION']['user_name'])  ? trim($GLOBALS['_SESSION']['user_name'])  : 0;
        $user_rank  = !empty($GLOBALS['_SESSION']['user_rank'])  ? intval($GLOBALS['_SESSION']['user_rank'])  : 0;
        $discount  = !empty($GLOBALS['_SESSION']['discount'])  ? round($GLOBALS['_SESSION']['discount'], 2)  : 0;
        $email  = !empty($GLOBALS['_SESSION']['email'])  ? trim($GLOBALS['_SESSION']['email'])  : 0;
        unset($GLOBALS['_SESSION']['admin_id']);
        unset($GLOBALS['_SESSION']['user_id']);
        unset($GLOBALS['_SESSION']['user_name']);
        unset($GLOBALS['_SESSION']['user_rank']);
        unset($GLOBALS['_SESSION']['discount']);
        unset($GLOBALS['_SESSION']['email']);
        // 数组序列化
        $data        = serialize($GLOBALS['_SESSION']);
        $this->_time = time();
        if ($this->session_md5 == md5($data) && $this->_time < $this->session_expiry + 10)
        {
            return true;
        }

        $data = addslashes($data);
		$sj=array();
		$gxsession = M($this->session_table);
        $sj['expiry'] =$this->_time;
        $sj['ip'] =$this->_ip;
		$sj['userid'] =$userid;
		$sj['adminid'] =$adminid;
		$sj['user_name'] =$user_name;
		$sj['user_rank'] =$user_rank;
		$sj['discount'] =$discount;
		$sj['email'] =$email;
		//$sj['data'] =$data;
        return $gxsession->where("sesskey='".$this->session_id."'")->limit(1)->save($sj);    
       
    }
//删除 sessions_data/sessions 时间范围内数据 11
    function close_session($time="1")
    {
	    if($time==1){
        $this->update_session();
        }
        /* 删除 sessions 时间范围内数据 */
        if ((time() % 2) == 0)
        {
		$desession = M($this->session_table);
		if($time==1){
		return $desession->where('expiry <'.($this->_time - $this->max_life_time))->delete(); 
		}
		else{
		return $desession->where('userid=0 and expiry <'.($this->_time - $time))->delete(); 
		}      
        }

        return true;
    }
//删除指定管理员的SESSION表的数据 11
    function delete_spec_admin_session($userid)
    {
        if (!empty($GLOBALS['_SESSION']['user_id']) && $userid)
        {
			$desession = M($this->session_table);
		    return $desession->where("userid=".$userid)->delete();      
        }
        else
        {
            return false;
        }
    }
//删除SESSION与cookie 11
    function destroy_session($db)
    {
	
	    $sjj=date("Y-m-d H:i:s");
		$sj=array();
		$gxsession = M($db);
        $sj['LastLogoutTime'] =$sjj;
        $gxsession->where("id=".$GLOBALS['_SESSION']['user_id']."")->limit(1)->save($sj); 
		
        $GLOBALS['_SESSION'] = array();

        setcookie($this->session_name, $this->session_id, 1, $this->session_cookie_path, $this->session_cookie_domain, $this->session_cookie_secure);

       /* 删除SESSION数据表 */
		$desession = M($this->session_table);
		return $desession->where("sesskey='".$this->session_id."'")->delete();
    }
//获取session sesskey  11
    function get_session_id()
    {
        return $this->session_id;
    }
//统计session数量 11
    function get_users_count()
    {
		$tjsession = M($this->session_table);
        return $tjsession->count();

    }
	
	/**
 * 更新用户SESSION,COOKIE及登录时间、登录次数。11
 *
 * @access  public
 * @return  void
 */
function update_user_info($db)
{
    if (!$GLOBALS['_SESSION']['user_id'])
    {
        return false;
    }

    /* 查询会员信息 */
      $time = date('Y-m-d');
	  $loadsession=M($db);
      $row =$loadsession->where("id=".$GLOBALS['_SESSION']['user_id']."")->find();
    if ($row)
    {
       /* 更新SESSION */
		$_SESSION['user_id'] = $row['id'];
		$_SESSION['user_name']= $row['username'];       
		$_SESSION['user_rank']= $row['level'];
		$_SESSION['discount'] = '0.00';		
		$_SESSION['email'] = $row['email'];
    }
	else
	{
	exit;
	}
	

    /* 更新登录时间，登录次数及登录ip */
            $ip=$_SERVER['REMOTE_ADDR'];
			$sjj=date("Y-m-d H:i:s");

	    $sj=array();
		$gxsession = M($db);
        $sj['lastLoginIip'] =$ip;
		$sj['LoginTimes'] =$row['LoginTimes']+1;
		$sj['LastLoginTime'] =$sjj;		
        $gxsession->where("id=".$_SESSION['user_id']."")->limit(1)->save($sj);    
				
	    $adminid = !empty($GLOBALS['_SESSION']['admin_id']) ? intval($GLOBALS['_SESSION']['admin_id']) : 0;
        $userid  = !empty($GLOBALS['_SESSION']['user_id'])  ? intval($GLOBALS['_SESSION']['user_id'])  : 0;
        $user_name  = !empty($GLOBALS['_SESSION']['user_name'])  ? trim($GLOBALS['_SESSION']['user_name'])  : 0;
        $user_rank  = !empty($GLOBALS['_SESSION']['user_rank'])  ? intval($GLOBALS['_SESSION']['user_rank'])  : 0;
        $discount  = !empty($GLOBALS['_SESSION']['discount'])  ? round($GLOBALS['_SESSION']['discount'], 2)  : 0;
        $email  = !empty($GLOBALS['_SESSION']['email'])  ? trim($GLOBALS['_SESSION']['email'])  : 0;
		$data        = serialize($GLOBALS['_SESSION']);
		$data = addslashes($data);
		
	    $time =time();
	    $datasj=array();
		$scsession =M($this->session_table);
        $datasj['expiry'] =$time;
		$datasj['ip'] =$this->_ip;
		$datasj['userid'] =$userid;	
		$datasj['adminid'] =$adminid;		
		$datasj['user_name'] =$user_name;		
		$datasj['user_rank'] =$user_rank;	
		$datasj['discount'] =$discount;
		$datasj['email'] =$email;
		//$datasj['data'] =$data;		
        return $scsession->where("sesskey ='".$this->session_id."'")->save($datasj); 			

}

/**
 *  获取用户信息数组11
 *
 * @access  public
 * @param
 *
 * @return array        $user       用户信息数组
 */
function get_user_info($db,$id=0)
{
    if ($id == 0)
    {
        $id = $GLOBALS['_SESSION']['user_id'];
    }
	$loadsession=M($db);
    $user =$loadsession->where("id=".$id."")->find();	
    return $user;
}

function real_ip()
{
    static $realip = NULL;

    if ($realip !== NULL)
    {
        return $realip;
    }
//加	
if(isset($_COOKIE['real_ipd']) && !empty($_COOKIE['real_ipd'])){
  $realip = $_COOKIE['real_ipd'];  
  return $realip;
 }
//加

    if (isset($_SERVER))
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
            foreach ($arr AS $ip)
            {
                $ip = trim($ip);

                if ($ip != 'unknown')
                {
                    $realip = $ip;

                    break;
                }
            }
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $realip = '0.0.0.0';
            }
        }
    }
    else
    {
        if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_CLIENT_IP'))
        {
            $realip = getenv('HTTP_CLIENT_IP');
        }
        else
        {
            $realip = getenv('REMOTE_ADDR');
        }
    }

    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
    //加
    //setcookie("real_ipd", $realip, time()+36000, "/");
	setcookie("real_ipd",$realip, time()+36000, $this->session_cookie_path, $this->session_cookie_domain, $this->session_cookie_secure);
	//加
    return $realip;
}


}

?>