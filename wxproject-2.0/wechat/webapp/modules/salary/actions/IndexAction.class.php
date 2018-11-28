<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/ShowPager.class.php');
require_once(MO_LIB_DIR . '/Tools.class.php');

class IndexAction extends Action {
	
	public function getDefaultView() {
			
			$db = DBAction::getInstance ();
			$request = $this->getContext ()->getRequest ();
			$user_id = $this->getContext()->getStorage()->read('_user_id');

			$sql = "SELECT * FROM ntb_user a where a.user_id='$user_id'";
			$r = $db->select($sql);
			$user = $r[0];
			$request->setAttribute ( "user", $user);

			
			$sql = "SELECT sum(money) m FROM ntb_money_point a WHERE type=0 and userid='$user_id'";
			$r = $db->select($sql);
			$cj = $r[0]->m;
			
			$sql = "SELECT sum(money) m FROM ntb_money_point a WHERE type=1 and userid='$user_id'";
			$r = $db->select($sql);
			$jdj = $r[0]->m;
			
			$sql = "SELECT sum(money) m FROM ntb_money_point a WHERE type=2 and userid='$user_id'";
			$r = $db->select($sql);
			$fxj = $r[0]->m;
			
			$sql = "SELECT sum(money) m FROM ntb_money_point a WHERE type=3 and userid='$user_id'";
			$r = $db->select($sql);
			$bdj = $r[0]->m;

			$sql = "SELECT sum(tax_money) m FROM ntb_money_point a WHERE  userid='$user_id'";
			$r = $db->select($sql);
			$sj = $r[0]->m;

			$sql = "SELECT sum(fx_money) m FROM ntb_money_point a WHERE  userid='$user_id'";
			$r = $db->select($sql);
			$gwb = $r[0]->m;

			


			
			
			/*
<th>累计订单积分</th>
                            <th>累计培育奖</th>
                            <th>累计贡献奖</th>
                            <th>累计全球分红</th>
			*/
			$request->setAttribute ( "gwb", $gwb );
			$request->setAttribute ( "cj", $cj );
			$request->setAttribute ( "jdj", $jdj );
			$request->setAttribute ( "fxj", $fxj );
			$request->setAttribute ( "bdj", $bdj );
			$request->setAttribute ( "sj", $sj );

		return View::INPUT;
	}
	



	public function execute() {

	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}

?>