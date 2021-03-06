// reg
var cardnumber_reg = /^[ 0-9]*$/;
var tel_reg = /^(\d{3,4}\-)?\d{7,}$/;
var mobile_reg = /^1\d{10}$/;
var email_reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9])+((\.[a-zA-Z0-9]+)+)$/;
// message
var username_init = '';
var username_error = '请输入消费会员姓名';
var cardnumber_init = '';
var cardnumber_error = '请输入有效地银行账号或可以不用填写';
var tel_init = '';
var tel_error = '请输入有效地联系电话';
var mobile_init = '请填写联系电话';
var mobile_error = '请输入有效地联系电话';
var email_init = '';
var email_error = '请输入有效地电子邮箱或可以不用填写';
var pwd1_init = '不区分大小写,至少6位,包含字母和数字';
var pwd1_error = ['密码长度不足6位', '您的密码设置过于简单,请重新设置'];
var repwd1_init = '';
var repwd1_error = '两次输入密码不一致';
var pwd2_init = '不区分大小写,至少6位,包含字母和数字';
var pwd2_error = ['密码长度不足6位', '您的密码设置过于简单,请重新设置'];
var repwd2_init = '';
var repwd2_error = '两次输入密码不一致';

//检测密码可用
function checkPassValid(pass){
  pass = pass.toLowerCase();
  return (/[0-9]/.test(pass) && /[a-z]/.test(pass)) ? true : false;
}

// bind 
function bind(f){
  if(!f) return;

  if(f.cardnumber){
    f.cardnumber.onfocus = function(){
      if(document.getElementById('span_cardnumber')){
        document.getElementById('span_cardnumber').style.color = 'black';
        document.getElementById('span_cardnumber').innerHTML = cardnumber_init;
      }
    }
    f.cardnumber.onblur = function(){
      if(document.getElementById('span_cardnumber')){
        if(Trim(f.cardnumber.value) == '') return;
        if(!cardnumber_reg.test(Trim(f.cardnumber.value))){
          document.getElementById('span_cardnumber').style.color = 'red';
          document.getElementById('span_cardnumber').innerHTML = cardnumber_error;
        }        
      }
    }
  }
  if(f.tel){
    f.tel.onfocus = function(){
      if(document.getElementById('span_tel')){
        document.getElementById('span_tel').style.color = 'black';
        document.getElementById('span_tel').innerHTML = tel_init;
      }
    }
    f.tel.onblur = function(){
      if(document.getElementById('span_tel')){
        if(Trim(f.tel.value) == '') return;
        if(!tel_reg.test(Trim(f.tel.value))){
          document.getElementById('span_tel').style.color = 'red';
          document.getElementById('span_tel').innerHTML = tel_error;
        }        
      }
    }
  }
  if(f.mobile){
    f.mobile.onfocus = function(){
      if(document.getElementById('span_mobile')){
        document.getElementById('span_mobile').style.color = 'black';
        document.getElementById('span_mobile').innerHTML = mobile_init;
      }
    }
    f.mobile.onblur = function(){
      if(document.getElementById('span_mobile')){
        if(Trim(f.mobile.value) == '') return;
        if(!mobile_reg.test(Trim(f.mobile.value))){
          document.getElementById('span_mobile').style.color = 'red';
          document.getElementById('span_mobile').innerHTML = mobile_error;
        }        
      }
    }
  }
  if(f.email){
    f.email.onfocus = function(){
      if(document.getElementById('span_email')){
        document.getElementById('span_email').style.color = 'black';
        document.getElementById('span_email').innerHTML = email_init;
      }
    }
    f.email.onblur = function(){
      if(document.getElementById('span_email')){
        if(Trim(f.email.value) == '') return;
        if(!email_reg.test(Trim(f.email.value))){
          document.getElementById('span_email').style.color = 'red';
          document.getElementById('span_email').innerHTML = email_error;
        }        
      }
    }
  }

}

function bind_check(f){
  if(f.username){
    if(Trim(f.username.value)==''){
      alert(username_error);
      return false;
    }
  }
  if(f.cardnumber){
    if(Trim(f.cardnumber.value)!='' && !cardnumber_reg.test(Trim(f.cardnumber.value))){
      alert(cardnumber_error);
      return false;
    }
  }
  if(f.tel){
    if(Trim(f.tel.value)!='' && !tel_reg.test(Trim(f.tel.value))){
      alert(tel_error);
      return false;
    }
  }
  if(f.mobile){
    if(Trim(f.mobile.value)!='' && !mobile_reg.test(Trim(f.mobile.value))){
      alert(mobile_error);
      return false;
    }
  }
  if(f.email){
    if(Trim(f.email.value)!='' && !email_reg.test(Trim(f.email.value))){
      alert(email_error);
      return false;
    }
  }
  if(f.pwd1){
    if(f.pwd1.value.length < 6){
      alert(pwd1_error[0]);
      return false;
    }
    // add for pass valid
   
  }
  if(f.repwd1){
    if(f.repwd1.value != f.pwd1.value){
      alert(repwd1_error);
      return false;
    }
  }
  if(f.pwd2){
    if(f.pwd2.value.length < 6){
      alert(pwd2_error[0]);
      return false;
    } 
    // add for pass valid
   
  }
  if(f.repwd2){
    if(f.repwd2.value != f.pwd2.value){
      alert(repwd2_error);
      return false;
    }  
  }
  if(f.tel && Trim(f.tel.value) == "" && 
      f.mobile && Trim(f.mobile.value) == ""){
    alert("请填写联系电话");
    return false;
  }
  return true;
}