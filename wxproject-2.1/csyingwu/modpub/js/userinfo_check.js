// reg
var cardnumber_reg = /^[ 0-9]*$/;
var tel_reg = /^(\d{3,4}\-)?\d{7,}$/;
var mobile_reg = /^1\d{10}$/;
var email_reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9])+((\.[a-zA-Z0-9]+)+)$/;
// message
var cardnumber_init = '';
var cardnumber_error = '请输入有效地银行账号！或可以不用填写！';
var tel_init = '';
var tel_error = '请输入有效地电话号码！';
var mobile_init = '座机和手机至少要添一项！';
var mobile_error = '请输入有效地手机号码！';
var email_init = '';
var email_error = '请输入有效地电子邮箱！或可以不用填写';
var pwd1_init = '不区分大小写,至少6位！';
var pwd1_error = '密码长度不足6位！';
var repwd1_init = '';
var repwd1_error = '两次输入密码不一致！';
var pwd2_init = '不区分大小写,至少6位！';
var pwd2_error = '密码长度不足6位！';
var repwd2_init = '';
var repwd2_error = '两次输入密码不一致！';
// bind 


function bind_check(f){
 
  return true;
}