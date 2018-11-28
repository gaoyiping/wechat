var Reg_txt_TuiJian;
var Reg_HidtjExist;
var Reg_txt_AnZhi;
var Reg_HidazExist;
var Reg_txt_Name;
var Reg_txt_PaperNumber;
var Reg_DrpList_Papers;
var Reg_txt_BirthDate;
var Reg_txt_HomeTel;
var Reg_txt_BankCard;
var Reg_RadioList_Level;
var Reg_DrpList_Numbers;
var Reg_HidzjExist;
var Reg_lbTuiJianName;
var Reg_lbAnZhiName;
var Reg_Hid_TuiJianName;
var Reg_Hid_AnZhiName;
var Edition; //系统设别:0国内1国际
var Reg_BranchAddress1; 
//提交判断
var Register =
{

    //提交判断

    SetConfrim: function () {

        if (trim(document.getElementById(Reg_txt_TuiJian.id).value) == "") {
            alert('健康顾问不能为空');
            PublicObject.ClearPostBack();
            document.getElementById(Reg_txt_TuiJian.id).focus();
            return;
        }
        if (document.getElementById(Reg_HidtjExist.id).value == "true") {
            alert('健康顾问编号不存在');
            PublicObject.ClearPostBack();
            document.getElementById(Reg_txt_TuiJian.id).focus();
            return;
        }
        if (trim(document.getElementById(Reg_txt_AnZhi.id).value) == "") {
            alert('销售顾问不能为空');
            PublicObject.ClearPostBack();
            document.getElementById(Reg_txt_AnZhi.id).focus();
            return;
        }
        if (document.getElementById(Reg_HidazExist.id).value == "true") {
            alert('销售顾问编号不存在');
            PublicObject.ClearPostBack();
            document.getElementById(Reg_txt_AnZhi.id).focus();
            return;
        }
        if (trim(document.getElementById(Reg_txt_Name.id).value) == "") {
            alert('会员姓名不能为空');
            PublicObject.ClearPostBack();
            document.getElementById(Reg_txt_Name.id).focus();
            return;
        }
        if (trim(document.getElementById(Reg_txt_PaperNumber.id).value) == "") {
            alert('证件号码不能为空');
            PublicObject.ClearPostBack();
            document.getElementById(Reg_txt_PaperNumber.id).focus();
            return;
        }
        //-----------------------------------------------------------------
        if (document.getElementById(Reg_HidzjExist.id).value == "true") {
            alert('对不起，证件号码重复');
            PublicObject.ClearPostBack();
            document.getElementById(Reg_txt_PaperNumber.id).focus();
            return;
        }
        //---------------------------------------------------------------- 

        var birthdayValue; //出生日期
        var ddlpaper = document.getElementById(Reg_DrpList_Papers.id);
        var paper = ddlpaper.options[ddlpaper.selectedIndex].text;
        if (paper != "身份证") {
            if (document.getElementById(Reg_txt_PaperNumber.id).value.length < 6) {
                alert('证件号码长度不能少于6位');
                PublicObject.ClearPostBack();
                document.getElementById(Reg_txt_PaperNumber.id).focus();
                return;
            }

            if (document.getElementById('ctl00_ContentPlaceHolder1_txt_BirthDate').value == "") {
                alert('出生日期不能为空');
                PublicObject.ClearPostBack();
                document.getElementById('ctl00_ContentPlaceHolder1_txt_BirthDate').focus();
                return;
            }

            birthdayValue = document.getElementById('ctl00_ContentPlaceHolder1_txt_BirthDate').value;
            var reg = /^(\d{4})-(\d{2})-(\d{2})$/;
            var arr = reg.exec(birthdayValue);
            if (!reg.test(birthdayValue) && RegExp.$2 <= 12 && RegExp.$3 <= 31) {
                alert("输入的出生日期格式为yyyy-mm-dd或正确的出生日期!");
                PublicObject.ClearPostBack();
                document.getElementById('ctl00_ContentPlaceHolder1_txt_BirthDate').focus();
                return;
            }

        }
        else {
          
          var papernumber = document.getElementById(Reg_txt_PaperNumber.id).value.toUpperCase();
            var error = GetCheckIdentityCard(papernumber);
            if (error != "验证通过!") {
                alert(error);
                PublicObject.ClearPostBack();
                document.getElementById(Reg_txt_PaperNumber.id).focus();
                return;
            }
            var papernumber = trim(document.getElementById(Reg_txt_PaperNumber.id).value);
            if (papernumber.length == 15) {
                birthdayValue = papernumber.charAt(6) + papernumber.charAt(7);
                if (parseInt(birthdayValue) < 10) {
                    birthdayValue = '20' + birthdayValue;
                }
                else {
                    birthdayValue = '19' + birthdayValue;
                }
                birthdayValue = birthdayValue + '-' + papernumber.charAt(8) + papernumber.charAt(9) + '-' + papernumber.charAt(10) + papernumber.charAt(11);

            }
            if (papernumber.length == 18) {
                birthdayValue = papernumber.charAt(6) + papernumber.charAt(7) + papernumber.charAt(8) + papernumber.charAt(9) + '-' + papernumber.charAt(10) + papernumber.charAt(11) + '-' + papernumber.charAt(12) + papernumber.charAt(13);
            }

        }

        var dt1 = new Date(birthdayValue.replace("-", "/"));
        var dt2 = new Date();
        var age = dt2.getFullYear() - dt1.getFullYear();
        if (age < 18) {
            alert('对不起,您还未满18周岁。');
            PublicObject.ClearPostBack();
            document.getElementById('ctl00_ContentPlaceHolder1_txt_BirthDate').focus();
            return;
        }
        if (document.getElementById('ctl00_ContentPlaceHolder1_BranchAddress1_DrpListBranch').value == "-1") {
            alert('无支行信息，请联系管理员');
            PublicObject.ClearPostBack();
            return;
        }
        if (trim(document.getElementById(Reg_txt_BankCard.id).value) == "") {
            alert('银行账号不能为空');
            PublicObject.ClearPostBack();
            document.getElementById(Reg_txt_BankCard.id).focus();
            return;
        }
        if ((document.getElementById(Reg_txt_BankCard.id).value).length < 16) {

            alert('银行账号必须是16位以上数字');
            PublicObject.ClearPostBack();
            document.getElementById(Reg_txt_BankCard.id).focus();
            return;

        }
        if (trim(document.getElementById(Reg_txt_HomeTel.id).value) != "") {
            var hometel = document.getElementById(Reg_txt_HomeTel.id).value;
            var reg = /^0\d{10,11}$/; //固定电话不带“-”
            var pgd = /^(([0\+]\d{2,3}-)?(0\d{2,3})-)?(\d{7,8})(-(\d{3,}))?$/; //固定电话带“-”
            if ((reg.test(hometel) || pgd.test(hometel)) == false) {
                alert('家庭电话号码格式不正确！');
                PublicObject.ClearPostBack();
                document.getElementById(Reg_txt_HomeTel.id).focus();
                return;
            }
        }
        if (trim(document.getElementById(Reg_txt_MobileTel.id).value) == "") {
            alert('移动电话不能为空');
            PublicObject.ClearPostBack();
            document.getElementById(Reg_txt_MobileTel.id).focus();
            return;
        }
        else {
            var flag_tel = GetCheckMobile(document.getElementById(Reg_txt_MobileTel.id).value);
            if (!flag_tel) {
                alert('移动电话格式不正确');
                PublicObject.ClearPostBack();
                document.getElementById(Reg_txt_MobileTel.id).focus();
                return;
            }



        }
        if (trim(document.getElementById('ctl00_ContentPlaceHolder1_DropdownAddress1_txtkeyWord').value) == "请输入街道、门牌号等详细信息" || trim(document.getElementById('ctl00_ContentPlaceHolder1_DropdownAddress1_txtkeyWord').value) == "") {
            alert('请输入具体的联系地址');
            PublicObject.ClearPostBack();
            document.getElementById('ctl00_ContentPlaceHolder1_DropdownAddress1_txtkeyWord').value = "";
            document.getElementById('ctl00_ContentPlaceHolder1_DropdownAddress1_txtkeyWord').focus();
            return;
        }
        var gvProList = document.getElementById('ctl00_ContentPlaceHolder1_gvProductList');
        var selectvalue = '';
        var selectnum = '';
        var totalPv = 0.00; //总积分
        if (gvProList != null) {
            for (j = 1; j < gvProList.rows.length; j++) {
                var inputArray = gvProList.rows[j].getElementsByTagName("INPUT");
                if (inputArray[3].type == "text") {
                    if (inputArray[3].value == "0") {
                        alert('订购产品数量不能为0');
                        PublicObject.ClearPostBack();
                        break;
                        return;
                    }
                    else {
                        if (inputArray[0].type == "hidden")//产品ID
                        {

                            selectvalue += inputArray[0].value + ',';
                        }
                        if (inputArray[3].type == "text") {
                            selectnum += inputArray[3].value + ',';
                        }
                        if (Edition == '1') {
                            totalPv += parseInt(inputArray[3].value) * parseFloat(inputArray[2].value);
                        }
                        else {
                            totalPv += parseInt(inputArray[3].value) * parseFloat(inputArray[4].value);
                        }

                    }

                }
            }



            if (Edition == '1') {
                var level = GetRblSeletedValue(Reg_RadioList_Level.id);
                if (level > totalPv) {
                    alert("对不起，您所订购产品的总积分与对应的注册级别还差:" + (level - totalPv) + "PV");
                    PublicObject.ClearPostBack();
                    return;
                }
            }
            else {
                if (totalPv < 200) {
                    alert("首次注册总积分不得少于200PV");
                    PublicObject.ClearPostBack();
                    return;
                }
            }

            if (selectvalue != '') {
                selectvalue = selectvalue.substring(0, selectvalue.length - 1);
            }
            if (selectnum != '') {
                selectnum = selectnum.substring(0, selectnum.length - 1);
            }



            document.getElementById('ctl00_ContentPlaceHolder1_HidIdInfo').value = selectvalue;
            document.getElementById('ctl00_ContentPlaceHolder1_HidNumInfo').value = selectnum;


            if (document.getElementById("ctl00_ContentPlaceHolder1_btnConfirm")) {
                document.getElementById("ctl00_ContentPlaceHolder1_btnConfirm").className = "disable";
                document.getElementById("ctl00_ContentPlaceHolder1_btnConfirm").value = '正在提交...';
                document.getElementById("ctl00_ContentPlaceHolder1_btnConfirm").onclick = Function("return false;");
            }

        }
        else {
            alert('您还没有订购产品呢');
            PublicObject.ClearPostBack();
            return;
        }
    },

    //判断证件号码是否重复
    GetPaperNumberRepeat: function () {

        var bianhao = "";
        var papernumber = document.getElementById(Reg_txt_PaperNumber.id).value;
        if (Reg_HidMode.value == "add") {
            bianhao = "-1";
        }
        else {
            var ddlnumber = document.getElementById(Reg_DrpList_Numbers.id);
            var bhnumber = ddlnumber.options[ddlnumber.selectedIndex].text;
            bianhao = bhnumber;
        }

        var url = httpurl + "?OptType=GetPaperNumber&Bianhao=" + bianhao + "&PaperNumber=" + papernumber;
        if (__XmlHttpPool__.GetRemoteData(url, Register.DetectPaperNumber) == null) {
            alert("未启用安全ActiveX控件");
            document.getElementById(Reg_HidzjExist.id).value = "true";
        }
    },
    DetectPaperNumber: function (ret) {

        if (ret == "true") {
            document.getElementById(Reg_HidzjExist.id).value = "true";

        }
        else
            document.getElementById(Reg_HidzjExist.id).value = "false";
    },
    //获取推荐人姓名
    GetTuiJianName: function () {

        if (trim(document.getElementById(Reg_txt_TuiJian.id).value) != "") {
            var bianhao = document.getElementById(Reg_txt_TuiJian.id).value;
            var url = httpurl + "?OptType=GetMemberName&Bianhao=" + bianhao;
            if (__XmlHttpPool__.GetRemoteData(url, Register.DetectTuiJianrName) == null) {
                alert("未启用安全ActiveX控件");
                document.getElementById(Reg_HidtjExist.id).value = "true";
            }
        }

    },
    //获取安置人姓名
    GetAnZhiName: function () {
        if (trim(document.getElementById(Reg_txt_AnZhi.id).value) != "") {
            var bianhao = document.getElementById(Reg_txt_AnZhi.id).value;
            var url = httpurl + "?OptType=GetMemberName&Bianhao=" + bianhao;
            if (__XmlHttpPool__.GetRemoteData(url, Register.DetectAnZhiName) == null) {
                alert("未启用安全ActiveX控件");
                document.getElementById(Reg_HidazExist.id).value = "true";
            }
        }

    },
    DetectTuiJianrName: function (ret) {

        if (ret != "true") {
            document.getElementById(Reg_HidtjExist.id).value = "false";
            document.getElementById(Reg_lbTuiJianName.id).innerHTML = ret;
            document.getElementById(Reg_Hid_TuiJianName.id).value = ret;
        }
        else {
            document.getElementById(Reg_HidtjExist.id).value = "true";
            document.getElementById(Reg_lbTuiJianName.id).innerHTML = "编号输入有误，推荐人姓名不存在";
        }



    },
    DetectAnZhiName: function (ret) {
        if (ret != "true") {
            document.getElementById(Reg_HidazExist.id).value = "false";
            document.getElementById(Reg_lbAnZhiName.id).innerHTML = ret;
            document.getElementById(Reg_Hid_AnZhiName.id).value = ret;

        }
        else {
            document.getElementById(Reg_HidazExist.id).value = "true";
            document.getElementById(Reg_lbAnZhiName.id).innerHTML = "编号输入有误，安置人姓名不存在";
        }

    }

};