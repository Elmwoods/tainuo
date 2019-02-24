<?php
class ProsaleViewModel extends ViewModel {
	public $viewFields = array(
		'Pro' => array('id','title','price','link_id','_type'=>' LEFT OUTER'),
		'Ddp' => array('SUM(Ddp.sl)'=>'num','SUM(Ddp.price)'=>'pro_max_money','_on'=>'Pro.id=Ddp.pr_id')
	);
	public function getListPage($per, $where, $order = ''){
		$count = $this->where($where)
		         ->group("id")
				 ->order($order)
				 ->select();
				 //->count();
        $count=count($count);
		import('ORG.Util.Page');
		$page = new Page($count, $per);
		$arrs = $this->where($where)->group("id") ->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();
//echo $this->getLastSql();
		$arr['list'] = $arrs;
		import('Common.Pages', APP_PATH, '.php');
		$web_page = new Pager($count, $per, (int)$_GET['page']);
		$arr['show'] = $web_page->pagenr;
		$arr['count'] = $count;
		$arr['cpage'] = $page->totalPages;
		return $arr;
	}
}
?>