<?php
//php sql防注入代码
if(!defined("ni8")) exit("Access Denied");
class sqlin
{

//dowith_sql($value)
function dowith_sql($str)
{


	  
   $str = str_replace("and","",$str);
   $str = str_replace("execute","",$str);
   $str = str_replace("update","",$str);
   $str = str_replace("count","",$str);
   $str = str_replace("chr","",$str);
   $str = str_replace("script","",$str);
   $str = str_replace("master","",$str);
   $str = str_replace("truncate","",$str);
   $str = str_replace("char","",$str);
   $str = str_replace("declare","",$str);
   $str = str_replace("select","",$str);
   $str = str_replace("create","",$str);
   $str = str_replace("delete","",$str);
   $str = str_replace("insert","",$str);
   $str = str_replace("'","",$str);
   $str = str_replace('\"','"',$str);
   $str = str_replace("alert","",$str);
   //$str = str_replace(">","",$str);
   //$str = str_replace("<","",$str);
   //$str = str_replace("&gt;","",$str);
   //$str = str_replace("&lt;","",$str);
   //$str = str_replace("+"," ",$str);
   //$str = str_replace("or","",$str);
   //$str = str_replace("=","",$str);
   //$str = str_replace("%20","",$str);
   //$str = str_replace(".","",$str);
   //$str = str_replace("/","",$str);
   //echo $str;
   return $str;
}
//aticle()防SQL注入函数

//限制关键字
function xzkey($str)
{
   if(file_exists(APP_PATHCC."filter.inc.php"))
	  {
	  
		  global $find,$replace,$banned,$_CACHE;
		  load('filter',APP_PATHCC,'.inc.php');
		  if(is_array($find)){
			  foreach($find as $key=>$val){
				 $str = preg_replace($val, $replace[$key], $str);
			  }
		  }
		  
		  if(!empty($banned)){		   
			   if (preg_match($banned,$str)){ 		   
				   //echo "<script language='javascript'>alert('".L("keyerr")."');history.go(-1)<script>";
				   echo "关键有不允许!";
				   exit;
			   }			  
		  }
	  }
	return $str;  
}
function sqlin()
{
      //限制IP
	  if(file_exists(APP_PATHCC."stop_ip.php"))
	  {
		  $ip=get_client_ip(0);
		  global $stop_view,$stop_reg;
		  load('stop_ip',APP_PATHCC,'.php');
		  if(is_array($stop_view)){
			  foreach($stop_view as $zip){
				  if($zip==$ip)die("IP被限制");
			  }
		  }
		  if(is_array($stop_reg)){
			  foreach($stop_reg as $zip){
				  if($zip==$ip && ACTION_NAME=="register")die("注册被限制");
			  }
		  }
	  }
	  //
	  //
   unset($_GET['_URL_']);
   $getfilter = "<[^>]*?=[^>]*?&#[^>]*?>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\()|<[^>]*?\\b(onerror|onmousemove|onload|onclick|onmouseover)\\b[^>]*?>|^\\+\\/v(8|9)|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
   foreach ($_GET as $key=>$value)
   {
  
   
       $value = str_replace("|","",$value);
	   $value = str_replace("&","",$value);
	   $value = str_replace(";","",$value);
	   $value = str_replace("$","",$value);
	   $value = str_replace("%","",$value);
	   $value = str_replace("@","",$value);
	   $value = str_replace('"',"",$value);
	   $value = str_replace("\'","",$value);
	   $value = str_replace(">","",$value);
	   $value = str_replace("<","",$value);
	   $value = str_replace("&gt;","",$value);
	   $value = str_replace("&lt;","",$value);
	   $value = str_replace("+"," ",$value);
	   $value = str_replace("or","",$value);
	   $value = str_replace("=","",$value);
	   $value = str_replace("%","",$value);
	  // $value = str_replace(".","",$value);
	   //$value = str_replace("/","",$value);
	   $value = str_replace("alert","",$value);
	   $value = str_replace("(","",$value);
	   $value = str_replace(")","",$value);
	   $value = str_replace("0x0d","",$value);
	   $value = str_replace("0x0a","",$value);
	   $value = str_replace("0x08","",$value);
       $_GET[$key]=$this->xzkey($value);
	   $_GET[$key]=$this->dowith_sql($value);
	   if (preg_match("/".$getfilter."/is",$value)==1){
       unset($_GET[$key]);
	   }
	   if (preg_match("/".$getfilter."/is",$key)==1){
	   unset($_GET[$key]);
	   }
   }
   foreach ($_POST as $key=>$value)
   {
       $_POST[$key]=$this->xzkey($value);
       $_POST[$key]=$this->dowith_sql($value);
   }
}
}
?>