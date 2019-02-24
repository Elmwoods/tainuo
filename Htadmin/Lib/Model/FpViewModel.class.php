<?php
class FpViewModel extends ViewModel {
	public $viewFields = array(
		'dd' => array('classid','ddbh','addtime', 'qrtime','fktime','zhprice', 'fpid','_type'=>'LEFT'),
		'fp' => array('*','_on'=>'dd.fpid=fp.id'),
	);

	//public function getList($userid, $where = ''){
//
//		$where = "Rebates.tj_id=".$userid.' '.$where;
//		$order = "add_time desc";
//		$arr = $this->where($where)
//				 ->order($order)
//				 ->select();
//
//		return $arr;
//	}

	public function getListPage($per, $where, $order = ''){
		$count = $this->where($where)
				 ->order($order)
				 ->count();

		import('ORG.Util.Page');
		$page = new Page($count, $per);
		$arrs = $this->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();

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
