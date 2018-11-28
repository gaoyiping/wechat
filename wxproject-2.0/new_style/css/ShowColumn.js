//
var expandColumns = new HashTable();
var showcolumntimer;
var ShowColumn = {
    checkeditemid: '-1',
    checkeddir: '-1',
    editwindow: null,
    selectedrow: null,
    selectedid: -1,
    selectedrowindex: -1,
    oldselectforumcount: 0,
    OnClick: function (elmt) {

        if (elmt.id != this.checkeditemid) {
            elmt.style.backgroundColor = '#CCC4A9';
            if (document.getElementById(this.checkeditemid)) {
                document.getElementById(this.checkeditemid).style.backgroundColor = '';
            }
            this.checkeditemid = elmt.id;
            this.checkeddir = elmt.children[1].id;
            EnableMenu('divShowColumnOptMenu');
        }
        else {
            elmt.style.backgroundColor = '';
            this.checkeditemid = '-1';
            this.checkeddir = '-1';
            DisableMenu('divShowColumnOptMenu');
        }
    },
    OnmouseOver: function (elmt) {
        if (elmt.id != this.checkeditemid) {
            elmt.style.backgroundColor = '#EAE7DA';
        }
    },
    OnmouseOut: function (elmt) {
        if (elmt.id != this.checkeditemid) {
            elmt.style.backgroundColor = '';
        }


    },
    getPosition: function (el) {
        for (var lx = 0, ly = 0; el != null; lx += el.offsetLeft, ly += el.offsetTop, el = el.offsetParent);
        return { x: lx, y: ly }
    },
    OnmouseOverShowdiv: function (pid, id, tupian,name,qian,beizhu,jifen,zhuangxiangshu, obj) {

        //var itemarry = StringHelper.StringtoArray(item);
		var url=tupian;
		if(tupian=="")
		{
		  url="/new_style/images/nopic.jpg";
		}else{
			url="/upfile/"+tupian;
		}
        var sb = '<div id="divShowExplain_' + pid + '_' + id + '" class="YFT_float_subclass" style=" position:absolute;display: none;padding:0px;z-index:200;background-color:#CFCFCF; ">';
        sb = sb + '<table id="tbShowExplain_' + pid + '_' + id + '" style="BORDER-COLLAPSE: collapse;width:auto!important; min-width:350px;  overflow:visible; line-height:20px;background-color:#FFF;" borderColor="#CFCFCF" cellSpacing="0" border="1" width="100%"  align="center"  >';
        sb = sb + '<tr><td rowspan="5" class="Width100" align="center"><img  src="' + url + '" style="width:110px;height:85px;" /></td>';
        sb = sb + '<td align="right" style="width:45px;">名称:</td><td align="left" class="Font_green" width="120">' + name + '</td></tr>';
        sb = sb + '<td align="right">采购价:</td><td align="left" >' + qian + ' RMB</td></tr>';
        sb = sb + '<tr><td align="right">市场价:</td><td align="left">' +jifen  + ' RMB</td></tr>';
        sb = sb + '<tr><td align="right">规格:</td><td align="left">' +beizhu  + '</td></tr>';
        sb = sb + '<tr><td align="right">装箱数:</td><td align="left">' + zhuangxiangshu + '</td></tr></table></div>';
    

        document.getElementById("litl_" + pid + "_" + id).innerHTML = sb.toString();

        if (document.getElementById("divShowExplain_" + pid + "_" + id)) {

            document.getElementById("Div_desc_" + id).style.color = "#F16911";

            var e = document.getElementById("divShowExplain_" + pid + "_" + id).style;
            e.display = "block";
            e.width = document.getElementById("tbShowExplain_" + pid + "_" + id).offsetWidth;
            e.left = CalendargetPos(obj, "Left") + document.getElementById("divColumnTitle_" + pid + "_" + id).offsetWidth + 2 + "px";
            e.top = CalendargetPos(obj, "Top") + obj.offsetHeight + "px";
            //-----------IE6下div层借助iframe覆盖select   
            var DivRef = document.getElementById('PopupDiv');
            var IfrRef = document.getElementById('DivShim');
            DivRef.style.display = "block";
            DivRef.style.left = e.left;
            DivRef.style.top = e.top;

            IfrRef.style.width =document.getElementById("tbShowExplain_" + pid + "_" + id).offsetWidth;
            IfrRef.style.height = 95;
            IfrRef.style.top = DivRef.style.top;
            IfrRef.style.left = DivRef.style.left;
            IfrRef.style.zIndex = DivRef.style.zIndex - 1;
            IfrRef.style.display = "block";
            //------------------------------------------------------------------------------------
        }


    },
    OnmouseHiddiv: function (pid, id, colors) {
     
        if (document.getElementById("divShowExplain_" + pid + "_" + id)) {
            document.getElementById("divShowExplain_" + pid + "_" + id).style.display = "none";
            document.getElementById("litl_" + pid + "_" + id).innerHTML = "";

            if (document.getElementById('chkboxpro_' + id)) {
                if (!document.getElementById('chkboxpro_' + id).checked) {
                     document.getElementById("Div_desc_" + id).style.color = colors;
                }
            }
            else {
                document.getElementById("Div_desc_" + id).style.color = colors;
            }
            //---------------------------
            var IfrRef = document.getElementById('DivShim');
            IfrRef.style.display = "none";
        }
    },
    getPosition: function (el) {
        for (var lx = 0, ly = 0; el != null; lx += el.offsetLeft, ly += el.offsetTop, el = el.offsetParent);
        return { x: lx, y: ly }
    },
    OnClick_Two: function (elmt) {


        if (elmt.id != this.checkeditemid) {
            if (document.getElementById(this.checkeditemid)) {
                document.getElementById(this.checkeditemid).style.backgroundColor = '';
            }
            this.checkeditemid = elmt.id;
            this.checkeddir = elmt.children[1].id;
            EnableMenu('divShowColumnOptMenu');
        }
        else {
            this.checkeditemid = '-1';
            this.checkeddir = '-1';
            DisableMenu('divShowColumnOptMenu');
        }
    },
   
    GetParentNode: function (elmt) {
        var pcontainer = elmt.parentNode.parentNode;
        if (pcontainer.id.replace('ChildContainer_', 'divColumnItem_') != pcontainer.id) {
            if (document.getElementById(pcontainer.id.replace('ChildContainer_', 'divColumnItem_'))) {
                var pnode = document.getElementById(pcontainer.id.replace('ChildContainer_', 'divColumnItem_')).id.split('_');
                columntext = document.getElementById(pcontainer.id.replace('ChildContainer_', 'divColumnTitle_')).innerHTML;
                return { text: columntext, value: pnode[1] + '_' + pnode[2] };
            }
        }
    },


    GetChildColumn: function (img) {
	
        var childcontainerid = img.id.replace('imgColumnStatus_', 'ChildContainer_');
        var id = childcontainerid.split('_')[2];
        var foldid = "divColumnDir_1_" + id;
        if (document.getElementById(childcontainerid)) {
            if (img.className == 'collspand') {
                img.className = 'expand';
                //                expandColumns.Add(img.id, img.id);
                document.getElementById(childcontainerid).style.display = 'block';
                document.getElementById(foldid).className = 'expandImg';
            }
            else {
                img.className = 'collspand';
                //                expandColumns.Remove(img.id);
                document.getElementById(childcontainerid).style.display = 'none';
                document.getElementById(foldid).className = 'collspandImg';
            }
        }

    },
    GetStairChildColumn: function (item) {
        //-----------树形菜单只有一级目录
        var itemarry = StringHelper.StringtoArray(item);
        for (var i = 0; i < itemarry.length; i++) {
            var img = document.getElementById(itemarry[i]);
            if (img != null) {
                var childcontainerid = img.id.replace('imgColumnStatus_', 'ChildContainer_');
                var id = childcontainerid.split('_')[2];
                var foldid = "divColumnDir_1_" + id;
                if (document.getElementById(childcontainerid)) {
                    if (img.className == 'collspand') {
                        img.className = 'expand';
                        //                expandColumns.Add(img.id, img.id);
                        document.getElementById(childcontainerid).style.display = 'block';
                        document.getElementById(foldid).className = 'expandImg';
                    }
                    else {
                        img.className = 'collspand';
                        //                expandColumns.Remove(img.id);
                        document.getElementById(childcontainerid).style.display = 'none';
                        document.getElementById(foldid).className = 'collspandImg';
                    }
                }
            }
        }

    },
    GetItemChildColumn: function (item) {
        //---------------树形菜单有二级目录

        var itemarry = StringHelper.StringtoArray(item);
        for (var i = 0; i < itemarry.length; i++) {
            var img = document.getElementById(itemarry[i]);
            if (img != null) {

                var childcontainerid = img.id.replace('imgColumnStatus_', 'ChildContainer_');
                var mid = childcontainerid.split('_')[1];
                var id = childcontainerid.split('_')[2];
                var foldid = "divColumnDir_1_" + id;
                var foldmid = "divColumnDir_1_" + mid;


                //(树形菜单如果有二级目录则)打开一级目录
                var Childcontainermid = "ChildContainer_0_" + mid;
                var MainImgid = "imgColumnStatus_0_" + mid;

                if (document.getElementById(MainImgid)) {
                    var MainImg = document.getElementById(MainImgid);
                    if (MainImg.className == 'collspand') {
                        MainImg.className = 'expand';
                        document.getElementById(Childcontainermid).style.display = 'block';
                        document.getElementById(foldmid).className = 'expandImg';
                    }
                    else {
                        //没有二级目录时
                        if (!document.getElementById(childcontainerid)) {
                            MainImg.className = 'collspand';
                            document.getElementById(Childcontainermid).style.display = 'none';
                            document.getElementById(foldmid).className = 'collspandImg';
                        }
                    }
                }
                //打开二级目录
                if (document.getElementById(childcontainerid)) {
                    if (img.className == 'collspand') {
                        img.className = 'expand';
                        document.getElementById(childcontainerid).style.display = 'block';
                        document.getElementById(foldid).className = 'expandImg';
                    }
                    else {
                        img.className = 'collspand';
                        document.getElementById(childcontainerid).style.display = 'none';
                        document.getElementById(foldid).className = 'collspandImg';
                    }
                }
            }
        }

    }
 


};

 

