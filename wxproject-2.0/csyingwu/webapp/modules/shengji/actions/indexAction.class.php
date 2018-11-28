<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');

/**
 * 调用核心业务处理流程
 * 待改进:
 * 1.并发的互斥，使用php中文件锁
 * 2.使用异常类，改进数据库操作出错的处理机制和代码结构
 */
class indexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		
		$db = DBAction::getInstance();	
		$type = intval($request->getParameter('type'));
			//余辉修改 2013-05-22
			if($type==3)
			{
				$type=3;
			}
			else if($type==2)
		    {
			 $type=2;
			}
			else
		    {
			  $type=1;
			}

		$sql = "select count(a.id) as c from  zhuce a where type='$type'";
		$r = $db->select($sql);
		$total = $r[0]->c;
		//分页
		$page = intval($request->getParameter('page'));
			
		if($page <= 0){
			$page=isset($_SESSION['_notice_page'])?$_SESSION['_notice_page']:1;
		}
		$pagesize = 10;
		$pager = new ShowPager($total,$pagesize,$page);
		$_SESSION['_notice_page'] = $pager->cur_page;
		$offset = $pager->offset;
		$pagehtml = $pager->num_link('module=shengji$type=$type');
		//分页记录
			$sql = "select a.*,b.user_name  from  zhuce a left join ntb_user b on a.uid=b.user_id  where type='$type' "
		." order by a.id desc  limit $offset,$pagesize";
		$list = $db->select($sql);
		//
		$request->setAttribute('list',$list);
		$request->setAttribute('pagehtml',$pagehtml);

		//2013-05-22
		$request->setAttribute('type',$type);
		return View :: INPUT;
	}

	public function execute(){
	
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>