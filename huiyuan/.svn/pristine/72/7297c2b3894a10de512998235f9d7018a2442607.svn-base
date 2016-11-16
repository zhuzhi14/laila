
function zhifucheck(){

     var  gettime = Date.parse(new Date())/1000;
    Ajax.call( 'user.php?act=checkalreadypassword', 'time=' + gettime, get_pwd_callback , 'GET', 'TEXT', true, true );

}




function  zhifucode(){
    var  password=document.getElementById("box").childNodes;
   var  str='';
    for(var i=0;i<password.length;i++){
        str += password[i].value;

    }
  // alert(str);

   Ajax.call( 'user.php?act=checkzhifupassword', 'password=' + str, check_pwd_callback , 'GET', 'TEXT', true, true );

}

function  get_pwd_callback(result){

    if(result=='ok'){

        document.getElementById("myform_zhifubox").submit();

    }else {

        var box = "<div  id='bg' style='width:200%;height:200%;position:absolute;top:0px;left:0px;opacity:0.3; filter: alpha(opacity=30); background-color:#000;display: none;z-index:999;'></div><div id='mask' class='mask' style='position: absolute; top:400px;margin-left:490px;  background-color: #fff;z-index: 9999; left: 0px;width:200px;height:120px;border: 3px solid #2cb7fe;border-radius: 15px;'> <div><span id='mask_close' onclick='hideMask()' style='margin-left:183px;font-size: 16px;color:#2cb7fe'>x</span> </div> <div  style='margin-top:0px'><h2 style='margin-left:20px'>支付密码：</h2><span id='box' style='margin-left:20px;height: 30px;'><input type='password' id='code' size='1' maxlength='1'><input type='password' id='code'  maxlength='1'><input type='password' id='code' size='1' maxlength='1'><input type='password' id='code' size='1' maxlength='1'><input type='password' id='code'  maxlength='1'><input type='password' id='code' size='1' maxlength='1'></span><div><button  style='margin-top:5px;margin-left:100px' id='check_code' onclick='zhifucode();return false'>提交</button></div></div></div></div>";
        document.getElementById("zhifubox").innerHTML = box;
        document.getElementById("bg").style.display = "block";

        var  box=document.getElementById("box").childNodes;
             box[0].focus();
        var index=0;
        for(var i=0;i<box.length;i++) {
            if(box[i].addEventListener) {
                //绑定键盘事件
                box[i].addEventListener("keypress", function (e) {
                    var e = e || window.event || arguments.callee.caller.arguments[0];

                    if (e.keyCode != 8) {

                        if (this.nextSibling) {
                            this.nextSibling.focus();
                        }


                    }


                });

                box[i].addEventListener('keyup', function (e) {
                    var e = e || window.event || arguments.callee.caller.arguments[0];
                    if (e.keyCode == 8) {
                        if (this.previousSibling) {
                            this.previousSibling.focus();
                        }


                    }
                }, false);





        }else{
            box[i].attachEvent("keypress", function (e) {
                var e = e || window.event || arguments.callee.caller.arguments[0];

                if (e.keyCode != 8) {

                    if (this.nextSibling.type = 'password') {
                        this.nextSibling.focus();
                    }


                }


            });

            box[i].attachEvent('keyup', function (e) {
                var e = e || window.event || arguments.callee.caller.arguments[0];
                if (e.keyCode == 8) {
                    if (this.previousSibling.type = 'password') {
                        this.previousSibling.focus();
                    }


                }
            }, false);


        }





    }


    }


}



function   check_pwd_callback(result){

     if(result=="ok"){

        document.getElementById("myform_zhifubox").submit();
     }else{

         alert('支付密码不正确');


     }


}

function  hideMask(){

    document.getElementById("bg").style.display="none";
    document.getElementById("mask").style.display="none";


}

