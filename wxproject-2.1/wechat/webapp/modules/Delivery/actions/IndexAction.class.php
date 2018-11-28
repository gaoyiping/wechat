<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/SysConst.class.php');

class IndexAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		//查询user表中用户的信息记录
		$sql_1 = "
			select user_name,card_name,address,mobile 
			from ntb_user where user_id = '$userid' ";
		$r_1 = $db->select($sql_1);
		//查询product表中的提货记录
		$sql_2 = "
			select card_name,address,tel,status,product_name,add_date,replay_date 
			from ntb_product where user_id = '$userid' ";
		$r_2 = $db->select($sql_2);
		//验证用户提货信息是否完整
		$info_ok = $r_1 
				&& ($r_1[0]->card_name != '') 
				&& ($r_1[0]->address != '') 
				&& ($r_1[0]->mobile != '');
			
		//验证是否可以提货
		$prod_ok = !$r_2;
		
		$fprice = $this->getFormPrice();
		if($r_1){
			$request->setAttribute('userinfo',$r_1[0]);
		}
		if($r_2){
			$request->setAttribute('prodinfo',$r_2[0]);
		}
		//产品
		$sql = "
			select * from ntb_formproduct
			where (product_type = '$fprice' or product_type = '0') and product_inuse = '1'
			order by product_name ";
		$pros = $db->select($sql);
		$request->setAttribute('info_ok', $info_ok);
		$request->setAttribute('prod_ok', $prod_ok);
		$request->setAttribute('pros', $pros);
		$request->setAttribute('fprice', $fprice);
		return View :: INPUT;
	}	

	public function execute(){
		$request = $this->getContext()->getRequest();
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$prodname = trim($request->getParameter('selproductname'));
		//查询product表中用户是否已经提货
		$sql = "select user_id from tb_product where user_id='$userid'";
		$r = $db->select($sql);
		if($r){
			header('Content-type: text/html;charset=utf-8');
			echo"<script language='javascript'>" . 
				"alert('对不起,您已经提过一次货了,不能再提货！');" . 
				"location.href='index.php?module=Delivery';</script>";
			return;
		}
		//选择信息
		$sql = "select user_id,user_name,card_name,address,mobile " . 
			   "from ntb_user where user_id = '$userid'";
		$r = $db->select($sql);
		if($r == false){
			header('Content-type: text/html;charset=utf-8');
			echo"<script language='javascript'>" . 
				"alert('未知原因,提货失败！');" . 
				"location.href='index.php?module=Delivery';</script>";
			return;
		}
		//选择 报单价
		$fprice = $this->getFormPrice();
		//插入
		$sql = "
			insert into ntb_product
				(user_id, form_price, user_name, card_name, 
					address, tel, status, product_name, add_date)
			values
				('{$r[0]->user_id}', '$fprice', '{$r[0]->user_name}', '{$r[0]->card_name}',
					'{$r[0]->address}', '{$r[0]->mobile}', '0', '$prodname', CURRENT_TIMESTAMP) ";
		$r = $db->insert($sql);
		if($r == 1){
			header("Content-type:text/html;charset=utf-8");
			echo"<script language='javascript'> " . 
				"alert('提货申请成功！请等待管理员审核！');" . 
				"location.href='index.php?module=Delivery';</script>";
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo"<script language='javascript'> " . 
				"alert('未知原因,提货失败！');" . 
				"location.href='index.php?module=Delivery';</script>";
		}
		return;
	}

	public function getFormPrice()
	{
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$db = DBAction::getInstance();
		$sql_1 = "
			select amount from ntb_record
			where type = 1 and accepter = '$userid' ";
		$r_1 = $db->select($sql_1);
		if ($r_1) {
			return $r_1[0]->amount;
		} else {
			return 0;
		}
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}
?>