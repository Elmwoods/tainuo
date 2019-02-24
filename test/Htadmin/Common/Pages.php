<?php
if(!defined("ni8shop")) exit("Access Denied");
class Pager
{
	var $centerNum=5;
    var $pagenr="";
	var $page=1;
	function Pager($num_row,$pagesize,$page)

	{

		//总页数

		$AllNum=($num_row%$pagesize==0) ? $num_row/$pagesize  : (int)($num_row/$pagesize)+1;

        $page=(empty($page))?1:$page;
        $this->page=$page;
		$startNum = $page-$this->centerNum;

		$endNum = $page+$this->centerNum;

		if($startNum<1)

		{

			$endNum = $endNum-($startNum);

			$startNum=1;

		}

		

		if($endNum>$AllNum)

		{

			$startNum = $startNum-($endNum-$AllNum);

			$endNum=$AllNum;

			if($startNum<=0) $startNum=1;

		}

		

		//$this->pagenr.= '<div class="pageJump"><div class="number">';
        //$this->pagenr.= '共'.$AllNum.'页&nbsp;&nbsp;&nbsp;&nbsp;';
		//if($AllNum>1){
		$this->pagenr.= '<a href="'.$this->getUrl(1).'" class="page_a">首页</a> ';
		if($page>1){
		$this->pagenr.='<a href="'.$this->getUrl($page-1).'" class="page_a">上一页</a> ';
		}
		else{
		$this->pagenr.= '<a href="'.$this->getUrl(1).'" class="page_a">上一页</a> ';
		}
        $this->pagenr.= '';
		for($i=$startNum;$i<=$endNum;$i++)

		{


			$this->pagenr.= ($page==$i) ? '<a   class="page_hover" style="color:#FF0000;">'.$i.'</a>' : '<a href="'.$this->getUrl($i).'" class="page_hover" >'.$i.'</a> ';

			

		}
		$this->pagenr.= '';
		if($page<$AllNum){
		$this->pagenr.= '<a href="'.$this->getUrl($page+1).'" class="page_a" >下一页</a> ';
		}
		else
		{
		$this->pagenr.= '<a href="'.$this->getUrl($AllNum).'" class="page_a">下一页</a>';
		}
		//$this->pagenr.= '&nbsp;|&nbsp;';
		$this->pagenr.= '<a href="'.$this->getUrl($AllNum).'" class="page_a">尾页</a>';
		
//}
		//$this->xption($AllNum);

		//echo '</td></tr></table>';

	

	}

	

	function getUrl($page)

	{
	$list = explode("&",$_SERVER['QUERY_STRING']);
	$url="page=".$page;
	foreach ($list as $v)
		{
			$temp=explode("=",$v);
			if($temp[0]!="page" && !empty($temp[0])) $url.="&".$v;

		}
	return '?'.$url;	
	}

	

	function xption($total)

	{

		$this->pagenr.= '<select onchange="javascript:location=this.options[this.selectedIndex].value;" ><option>跳转</option>';

		for($i=1;$i<=$total;$i++)

		{
		if($i==$this->page){
		$this->pagenr.= '<option value="'.$this->getUrl($i).'" selected="selected">'.$i.'</option>';
		}
		else
		{
		$this->pagenr.= '<option value="'.$this->getUrl($i).'" >'.$i.'</option>';
		}

		}

		$this->pagenr.= '</select>';

	}

}
?>