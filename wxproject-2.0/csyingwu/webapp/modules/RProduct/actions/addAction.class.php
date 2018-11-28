<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class addAction extends Action {

	public function getDefaultView() {
		$request = $this->getContext()->getRequest();
		$pname = trim($request->getParameter('pname'));
		$cost = trim($request->getParameter('cost'));
		$detail = $request->getParameter('detail');
        $jifen = $request->getParameter('jifen');

			$sNo = trim($request->getParameter('sNo'));
			$tiaoma = trim($request->getParameter('tiaoma'));
			$danwei = $request->getParameter('danwei');
			$zhuanmaijia=$request->getParameter('zhuanmaijia');
			$qiyejia=$request->getParameter('qiyejia');
			$sorder=$request->getParameter('sorder');
			$tixingshu=$request->getParameter('tixingshu');
        $good_number=$request->getParameter('good_number');
			$jiesuanjia=$request->getParameter('jiesuanjia');
			$jianyijia=$request->getParameter('jianyijia');
			$guige=$request->getParameter('guige');
			$zhuangxiangshu=$request->getParameter('zhuangxiangshu');
			$lirun=$request->getParameter('lirun');
        //绑定商品分类
		$db = DBAction::getInstance();
		$sql = "select * from ntc_type where tistrue = 0 order by torder";
		$rs = $db->select($sql);




      	$request->setAttribute("rtype",$rs);
		$request->setAttribute('pname', $pname);
     $request->setAttribute('jifen', $jifen);
		$request->setAttribute('cost', $cost);
		$request->setAttribute('detail', $detail);

			$request->setAttribute('sNo', $sNo);
		$request->setAttribute('tiaoma', isset($tiaoma) ? $tiaoma : '');
		$request->setAttribute('danwei', isset($danwei) ? $danwei : '');
		$request->setAttribute('qiyejia', isset($qiyejia) ? $qiyejia : '');
		$request->setAttribute('sorder', isset($sorder) ? $sorder : '');
		$request->setAttribute('tixingshu', isset($tixingshu) ? $tixingshu : '');
		$request->setAttribute('jiesuanjia', isset($jiesuanjia) ? $jiesuanjia : '');
		$request->setAttribute('zhuanmaijia', isset($zhuanmaijia) ? $zhuanmaijia : '');
		$request->setAttribute('jianyijia', isset($jianyijia) ? $jianyijia : '');
		$request->setAttribute('guige', isset($guige) ? $guige : '');

		$request->setAttribute('zhuangxiangshu', isset($zhuangxiangshu) ? $zhuangxiangshu : '');

		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$pname = addslashes(trim($request->getParameter('pname')));
		$cost = floatval(trim($request->getParameter('cost')));
		$detail = ($request->getParameter('detail'));
	    $tbtype = addslashes($request->getParameter('tbtype'));
       	$jifen = addslashes($request->getParameter('jifen'));
		  $zhekou = addslashes($request->getParameter('zhekou'));
		    $isdelete = addslashes($request->getParameter('isdelete'));
			$qidingnum = addslashes($request->getParameter('qidingnum'));
			$recommend = addslashes($request->getParameter('recommend'));
			$like = addslashes($request->getParameter('like'));
				$sNo = trim($request->getParameter('sNo'));

			$danwei = $request->getParameter('danwei');
			$zhuanmaijia=$request->getParameter('zhuanmaijia');
		
			$sorder=$request->getParameter('sorder');
			$tixingshu=$request->getParameter('tixingshu');
        $good_number=$request->getParameter('good_number');


				$jianyijia=$request->getParameter('jianyijia');
			$guige=$request->getParameter('guige');
			$zhuangxiangshu=$request->getParameter('zhuangxiangshu');
			$lirun=floatval(trim($request->getParameter('lirun')));
     

		
		//检查商品名是否重复
		

		//检查是否选择商品分类
		if($tbtype=="0")
		{
		   	header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('请选择产品类别！');" .
				"</script>";
			return $this->getDefaultView();
		}
			
		//检查是否选择了商品图片
	  if($_FILES['photo_dir']['name']=="")
      {
         $phpto_dir_name="";
     	//header("Content-type:text/html;charset=utf-8");
		//	echo "<script type='text/javascript'>" .
		//		"alert('请选择商品图片！');" .
		//		"</script>";
		//	return $this->getDefaultView();
	
      }
	  else
		{
			  //将临时文件复制到upload_image目录下
			 $photo_dir=($_FILES['photo_dir']['tmp_name']);

			 $phpto_dir_name=time().($_FILES['photo_dir']['name']);
		  
			  move_uploaded_file($photo_dir,"../upfile/$phpto_dir_name");
		}
      
	  
        

		//添加商品
		$sql = "insert into ntc_rproducts(pname,detail,cost,is_del,add_date,imgURL,typeID,jifen,zhekou,isdelete,sNo,danwei,
zhuanmaijia,sorder,tixingshu,guige,zhuangxiangshu,qidingnum,lirun,recommend,love,good_number) " .
			"values('$pname',
'$detail','$cost','0',CURRENT_TIMESTAMP,'$phpto_dir_name','$tbtype','$jifen','$zhekou','$isdelete','$sNo','$danwei','$zhuanmaijia','$sorder','$tixingshu','$guige','$zhuangxiangshu','$qidingnum',$lirun,$recommend,$like)";
		$r = $db->insert($sql);	
  
      
		if($r == -1) {
				header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('添加产品失败！');" .
				"location.href='index.php?module=RProduct';</script>";
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('添加产品信息成功！');" .
				"location.href='index.php?module=RProduct';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>