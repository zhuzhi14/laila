function getsms() {

    var tel = document.getElementById("tel_num").value;
    if (tel) {
        Ajax.call('user.php?act=getsms&type=CHANGEPWD', 'tel=' + tel, sms_callback, 'GET', JSON);
        //alert(tel);

    } else {

        alert("输入手机号为空");
        return false;
    }


}

//获取验证码
function get_sms() {

    var tel = document.getElementById("tel_num").value;
    if (tel) {
        Ajax.call('user.php?act=getsms&type=REG', 'tel=' + tel, sms_callback, 'GET', JSON);
        //alert(tel);

    } else {

        alert("输入手机号为空");
        return false;
    }


}
//获取重置充值密码

function getresetsms() {

    var tel = document.getElementById("phone").value;
    if (tel) {
        Ajax.call('user.php?act=getsms&type=RESET', 'tel=' + tel, sms_callback, 'GET', JSON);
        alert(tel);
    } else {

        alert("输入手机号为空");
        return false;
    }


}


function sms_callback(result) {

    if (result == 'ok') {
        time();

    }else if(result=='num_error'){
        alert("还未注册,请先注册");


    } else {
        alert("发送失败");
    }

}
function change_password() {
    var tel = document.getElementById("tel_num").value;
    var code = document.getElementById("smscode").value;

    var newpass = document.getElementById("newpwd").value;
    var pass_err = document.getElementById("pass_err");

    Ajax.call('user.php?act=change_pwd', 'tel=' + tel + "&code=" + code + "&newpass=" + newpass, change_callback, 'GET', JSON);

}

function change_zf_password() {

    var tel = document.getElementById("tel_num").value;
    var code = document.getElementById("smscode").value;

    var newpass = document.getElementById("newpwd").value;
    var pass_err = document.getElementById("pass_err");

    Ajax.call('user.php?act=change_zf_pwd', 'tel=' + tel + "&code=" + code + "&newpass=" + newpass, change_zf_callback, 'GET', JSON);


}


function change_callback(result) {

    if (result == 'ok') {

        alert("修改成功");

        window.location.href = "user.php";

    } else {

        alert("修改失败");

    }

}


function change_zf_callback(result) {

    if (result == 'ok') {

        alert("修改成功");

        window.location.href = "user.php";

    } else {

        alert("修改失败");

    }

}


var wait = 60;
function time() {

    o = document.getElementById("get_code");
    if (wait == 0) {
        o.removeAttribute("disabled");
        o.innerText = "获取验证码";
        wait = 60;
    } else {
        o.setAttribute("disabled", true);
        o.innerText = "重新发送(" + wait + ")";
        wait--;
        // console.log(wait);
        setTimeout(function () {
                time()
            },
            1000)
    }
}


function showMask() {
    var target = document.getElementById("mask");


    if (target.style.display == "block") {
        target.style.display = "none";
        //  clicktext.innerText="点击查看详细信息";


    } else {
        target.style.display = "block";
        //  clicktext.innerText='关闭详细信息信息';
    }

}
//隐藏遮罩层
function hideMask() {
    var clicktext = document.getElementById("mask_close");
    var target = document.getElementById("mask");
    target.style.display = "none";

}
function showcard() {
    var target = document.getElementById("card");


    if (target.style.display == "block") {
        target.style.display = "none";
        //  clicktext.innerText="点击查看详细信息";


    } else {
        target.style.display = "block";
        // clicktext.innerText='关闭详细信息信息';
    }

}


function hidecard() {
    // var clicktext=document.getElementById("mask_close");
    var target = document.getElementById("card");
    target.style.display = "none";

}

//校验验证码

function check_code() {
    var tel = document.getElementById("tel_num").innerText;
    var code = document.getElementById("code").value;

    Ajax.call('user.php?act=checksms', 'tel=' + tel + '&code=' + code, check_callback, 'GET', JSON);

}

function check_tel_code() {

    var tel = document.getElementById("tel_num").innerText;
    var code = document.getElementById("code").value;

    Ajax.call('user.php?act=checksms&type=REG', 'tel=' + tel + '&code=' + code, check_callback, 'GET', JSON);


}


function check_callback(result) {

    if (result == 'ok') {
        alert("验证成功");
        var target = document.getElementById("mask");
        target.style.display = "none";
        document.getElementById("tel_check").innerText = "<img src='images/success.png'>";
        document.getElementById("phone").disabled = true;

    } else {

        alert("验证失败");


    }


}

function get_tel_sms() {

    var tel = document.getElementById("tel_num").innerText;
    Ajax.call('user.php?act=getsms&type=REG', 'tel=' + tel, sms_callback, 'GET', JSON);
    //  alert(tel);

}



