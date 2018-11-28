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
    OnmouseOverShowdiv: function (id,lt,ct,rt,leftmoney,centermoney,rightmoney, obj,pinwei) {

       
		
        var sb = '<div id="divShowExplain_' + id + '" class="YFT_float_subclass1" style=" position:absolute;display: none;padding:0px;z-index:200;background-color:#CFCFCF; ">';
        sb = sb + '<table id="tbShowExplain_' + id + '" style="color:#1B4B03; BORDER-COLLAPSE: collapse;width:auto!important; min-width:350px;  overflow:visible; line-height:20px;background-color:#FFF;" borderColor="#AC612A" cellSpacing="0" border="1" width="100%"  align="center"  >';
        sb = sb + '<tr>';
		sb = sb + '<td align="center" colspan="4">'+pinwei+'</td></tr>';
		sb = sb + '<tr><td align="center" width="80">单数</td>';
        sb = sb + '<td align="center" width="120">'+lt+'</td><td align="center" width="120">'+ct+'</td><td align="center" width="120">'+rt+'</td></tr>';
        sb = sb + '<td align="center" width="80">结余</td>';
        sb = sb + '<td align="center" width="120">'+leftmoney+'</td><td align="center" width="120">'+centermoney+'</td><td align="center" width="120">'+rightmoney+'</td></tr>';

        sb = sb + '</table></div>';
    
        
        document.getElementById("litl_" + id).innerHTML = sb.toString();
        document.getElementById("litl_" + id).style.display = "";
        if (document.getElementById("divShowExplain_" + id)) {

          

            var e = document.getElementById("divShowExplain_" + id).style;
            e.display = "block";
            e.width = 350;
            e.left = CalendargetPos(obj, "Left") + document.getElementById("divColumnTitle_" + id).offsetWidth - 153 + "px";
            e.top = CalendargetPos(obj, "Top") + (obj.offsetHeight-30) + "px";
            //-----------IE6下div层借助iframe覆盖select   
            var DivRef = document.getElementById('PopupDiv');
            var IfrRef = document.getElementById('DivShim');
            DivRef.style.display = "block";
            DivRef.style.left = e.left;
            DivRef.style.top = e.top;

            IfrRef.style.width =document.getElementById("tbShowExplain_" + id).offsetWidth;
            IfrRef.style.height = 80;
            IfrRef.style.top = DivRef.style.top;
            IfrRef.style.left = DivRef.style.left;
            IfrRef.style.zIndex = DivRef.style.zIndex - 1;
            IfrRef.style.display = "block";
            //------------------------------------------------------------------------------------
        }


    },
    OnmouseHiddiv: function (id,a, colors) {
     
          if (document.getElementById("divShowExplain_" + id)) {
            document.getElementById("divShowExplain_" + id).style.display = "none";
            document.getElementById("litl_" + id).style.display = "none";

          
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

 

