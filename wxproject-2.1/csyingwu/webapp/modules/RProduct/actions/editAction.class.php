<?php
require_once(MO_LIB_DIR . '/DBAction.class.php');

class editAction extends Action {

	public function getDefaultView() {
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter("id"));
		$editable = $request->getParameter("editable");
		if ($editable == 'true') {
			$pname = trim($request->getParameter('pname'));
			$cost = trim($request->getParameter('cost'));
			$detail = $request->getParameter('detail');
			$imgurl=$request->getParameter('imgurl');
			$typeID=$request->getParameter('typeID');
			$jifen=$request->getParameter('jifen');
			$zhekou=$request->getParameter('zhekou');


			$sNo = trim($request->getParameter('sNo'));
		
			$danwei = $request->getParameter('danwei');
			$zhuanmaijia=$request->getParameter('zhuanmaijia');
	
			$sorder=$request->getParameter('sorder');
			$tixingshu=$request->getParameter('tixingshu');
            $good_number=$request->getParameter('good_number');
		
			$jianyijia=$request->getParameter('jianyijia');
			$guige=$request->getParameter('guige');
			$zhuangxiangshu=$request->getParameter('zhuangxiangshu');
			$qidingnum=$request->getParameter('qidingnum');
					

					
		} else {
			$sql = "select * from ntc_rproducts where id = '$id'";
			$r = $db->select($sql);
			if($r){
				$pname = $r[0]->pname;
				$cost = $r[0]->cost;
				$detail = $r[0]->detail;
				$imgurl = $r[0]->imgURL;
				$typeID= $r[0]->typeID;
				$jifen= $r[0]->jifen;
				$isdelete= $r[0]->isdelete;
				$isrec= $r[0]->recommend;
				$zhekou= $r[0]->zhekou;

				$sNo = $r[0]->sNo;
			
				$danwei = $r[0]->danwei;
				
				$sorder= $r[0]->sorder;
                $tixingshu= $r[0]->tixingshu;
                $good_number= $r[0]->good_number;
				
				$zhuanmaijia= $r[0]->zhuanmaijia;

				$jianyijia= $r[0]->jianyijia;
				$guige= $r[0]->guige;
				$zhuangxiangshu= $r[0]->zhuangxiangshu;
				$qidingnum= $r[0]->qidingnum;
				$lirun= $r[0]->lirun;
			}
		}
		

		//绑定商品分类
		$db = DBAction::getInstance();
		$sql = "select * from ntc_type where tistrue = 0 order by torder";
		$rs = $db->select($sql);

	    $request->setAttribute("rtype",$rs);
		$request->setAttribute('typeID', $typeID);
		$request->setAttribute('id', $id);
		$request->setAttribute('pname', isset($pname) ? $pname : '');
		$request->setAttribute('cost', isset($cost) ? $cost : '');
		$request->setAttribute('detail', isset($detail) ? $detail : '');
		$request->setAttribute('jifen', isset($detail) ? $jifen : '');
		$request->setAttribute('imgurl', isset($imgurl) ? $imgurl : '');
		$request->setAttribute('isdelete', isset($isdelete) ? $isdelete : '');
		$request->setAttribute('isrec', isset($isrec) ? $isrec : '');
		$request->setAttribute('zhekou', isset($zhekou) ? $zhekou : '');

		$request->setAttribute('sNo', $sNo);

		$request->setAttribute('danwei', isset($danwei) ? $danwei : '');
	
		$request->setAttribute('sorder', isset($sorder) ? $sorder : '');
        $request->setAttribute('tixingshu', isset($tixingshu) ? $tixingshu : '');
        $request->setAttribute('good_number', isset($good_number) ? $good_number : '');

		$request->setAttribute('zhuanmaijia', isset($zhuanmaijia) ? $zhuanmaijia : '');

		$request->setAttribute('jianyijia', isset($jianyijia) ? $jianyijia : '');
		$request->setAttribute('guige', isset($guige) ? $guige : '');
		$request->setAttribute('zhuangxiangshu', isset($zhuangxiangshu) ? $zhuangxiangshu : '');
		$request->setAttribute('qidingnum', isset($qidingnum) ? $qidingnum : '');
		$request->setAttribute('lirun', isset($lirun) ? $lirun:0);
		return View :: INPUT;
	}

	public function execute(){
		$db = DBAction::getInstance();
		$request = $this->getContext()->getRequest();
		$id = intval($request->getParameter('id'));
		$pname = addslashes(trim($request->getParameter('pname')));
		$cost = floatval(trim($request->getParameter('cost')));
		$detail = ($request->getParameter('detail'));
		$imgurl= addslashes($request->getParameter('imgurl'));
		$tbtype = addslashes($request->getParameter('tbtype'));
	    $jifen = addslashes($request->getParameter('jifen'));
	 	$zhekou = addslashes($request->getParameter('zhekou'));
		$isdelete = addslashes($request->getParameter('isdelete'));
		$qidingnum = addslashes($request->getParameter('qidingnum'));
		$lirun = floatval(trim($request->getParameter('lirun')));
		$recommend = addslashes($request->getParameter('recommend'));
		$like = addslashes($request->getParameter('like'));
		$sNo = trim($request->getParameter('sNo'));
			$tiaoma = trim($request->getParameter('tiaoma'));
			$danwei = $request->getParameter('danwei');
			$zhuanmaijia=$request->getParameter('zhuanmaijia');

			$sorder=$request->getParameter('sorder');
			$tixingshu=$request->getParameter('tixingshu');
        $good_number=$request->getParameter('good_number');


				$jianyijia=$request->getParameter('jianyijia');
			$guige=$request->getParameter('guige');

				$zhuangxiangshu=$request->getParameter('zhuangxiangshu');

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


		      if($_FILES['photo_dir']['name']=="")
		      {
		   
			   //更新商品
			$sql = "update ntc_rproducts " .
				"set pname = '$pname', cost = '$cost', love = '$like', recommend = '$recommend', detail = '$detail' ,typeID='$tbtype', jifen='$jifen',zhekou='$zhekou',isdelete='$isdelete',sNo='$sNo',danwei='$danwei',sorder='$sorder',tixingshu='$tixingshu',good_number='$good_number',zhuanmaijia='$zhuanmaijia',jianyijia='$jianyijia',guige='$guige',zhuangxiangshu='$zhuangxiangshu',lirun='$lirun',qidingnum='$qidingnum'  " .
				"where id = '$id'";
			$r = $db->update($sql);
		
		      }
			else
			{
				//将临时文件复制到upload_image目录下
				 $photo_dir=($_FILES['photo_dir']['tmp_name']);
				$phpto_dir_name=($_FILES['photo_dir']['name']);
	  
				 move_uploaded_file($photo_dir,"../upfile/$phpto_dir_name");
				 $imgurl=$phpto_dir_name;
				 
				    //更新商品
				$sql = "update ntc_rproducts " .
					"set pname = '$pname', cost = '$cost', detail = '$detail' ,imgURL ='$imgurl' ,typeID='$tbtype', jifen='$jifen',zhekou='$zhekou',isdelete='$isdelete',sNo='$sNo',danwei='$danwei',sorder='$sorder',tixingshu='$tixingshu',good_number='$good_number',zhuanmaijia='$zhuanmaijia',jianyijia='$jianyijia',guige='$guige',zhuangxiangshu='$zhuangxiangshu',lirun='$lirun',qidingnum='$qidingnum'  " .
					"where id = '$id'";
				$r = $db->update($sql);
			
			}


		

		if($r == -1) {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('未知原因，修改产品信息失败！');" .
				"</script>";
			return $this->getDefaultView();
		} else {
			header("Content-type:text/html;charset=utf-8");
			echo "<script type='text/javascript'>" .
				"alert('修改产品信息成功！');" .
				"location.href='index.php?module=RProduct';</script>";
		}
		return;
	}

	public function getRequestMethods(){
		return Request :: POST;
	}

}

?>