<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');
require_once(MO_LIB_DIR . '/core/LevelUp.class.php');
class IndexAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$userid = $this->getContext()->getStorage()->read('_user_id');
		$sql1 = "select * from ntb_user  where user_id='$userid' ";
		$r = $db->select($sql1);
		$this->show($r[0]->e_mail,$r[0]->mobile,$r[0]->user_id);
		return View :: INPUT;
	}

	public function execute(){		
		
	}

	public function getRequestMethods(){
		return Request :: NONE;
	}
	
	
	
	function createText($instring) {
		$outstring = "";
		$max = strlen ( $instring );
		for($i = 0; $i < $max; $i ++) {
			$h = ord ( $instring [$i] );
			if ($h >= 160 && $i < $max - 1) {
				$outstring .= substr ( $instring, $i, 2 );
				$i ++;
			} else {
				$outstring .= $instring [$i];
			}
		}
		return $outstring;
	}
	
	function show($name,$phone,$uid) {
		//输出头内容
		Header ( "Content-type: image/png" );
		$font = ($_SERVER['DOCUMENT_ROOT']).'/new_style/SIMHEI.TTF'; //如果没有要自己加载到相应的目录下（本地www）
		
		//建立图象
		$image = imagecreatefrompng ( $_SERVER['DOCUMENT_ROOT']."/new_style/images/bg.png" ); //这里的图片，换成你的图片路径
		//定义颜色
		$red = ImageColorAllocate ( $image, 255, 0, 0 );
		$white = ImageColorAllocate ( $image, 255, 255, 255 );
		$black = ImageColorAllocate ( $image, 0, 0, 0 );
		//填充颜色
		
		$angle = 0;
		$size = 18;
		$showX = 150;
		$showY = 140;
		
		$angle0 = 0;
		$showX0 = 110;
		$showY0 = 210;
		
		$angle1 = 0;
		$showX1 = 110;
		$showY1 = 242;
		
		//显示文字
		$txt = $this->createText ($name);
		$txt0 = $this->createText ($phone );
		$txt1 = $this->createText ($uid);
		
		//写入文字
		imagettftext ( $image, $size, $angle, $showX, $showY, $black, $font, $txt );
		imagettftext ( $image, $size, $angle0, $showX0, $showY0, $white, $font, $txt0 );
		imagettftext ( $image, $size, $angle1, $showX1, $showY1, $white, $font, $txt1 );
		
		//显示图形
		imagepng ( $image );
		ImageDestroy ( $image );
	}
	

}

?>