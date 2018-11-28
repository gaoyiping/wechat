<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/Cart.class.php');

class cartViewAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();

		if ("true" == $request->getParameter('clear')) {
			$this->getContext()->getStorage()->remove('_cart');
		}

		//初始化 零售车
		$cart = $this->getContext()->getStorage()->read('_cart');
		if ($cart == null) {
			$userid = $this->getContext()->getStorage()->read('_user_id');
			$cart = new Cart($userid);
			$this->getContext()->getStorage()->write('_cart', $cart);
		}

		$request->setAttribute("cart", $cart);
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}

}
?>