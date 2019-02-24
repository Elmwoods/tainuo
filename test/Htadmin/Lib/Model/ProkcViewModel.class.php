<?php
class ProkcViewModel extends ViewModel {
	public $viewFields = array(
		'Pro' => array('id','title','model','passed','tj','isnew','istg','tgprice','link_id','classid','ppclassid','price','addtime','sort','point','yjprice','isjf','kc','tgkc','jfkc','isprice','pricecs','_type'=>'LEFT'),
		'Typepro' => array('class_name_cn'=>'typeprot','_on'=>'Pro.classid=Typepro.classid','_type'=>'LEFT'),
		'Typebrand' => array('class_name_cn','_on'=>'Pro.ppclassid=Typebrand.classid','_type'=>'LEFT'),
		'Sku' => array('cs','price'=>'cskc','count','_on'=>'Pro.id=Sku.pro_id'),
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
		         ->group("id")
				 ->order($order)
				 ->select();
				 //->count();
        $count=count($count);
		import('ORG.Util.Page');
		$page = new Page($count, $per);
		$arrs = $this->where($where)->group("id")->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();

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
