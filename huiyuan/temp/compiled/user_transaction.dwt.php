<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
    <meta name="Description" content="<?php echo $this->_var['description']; ?>" />
    
    <title><?php echo $this->_var['page_title']; ?></title>
    
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="animated_favicon.gif" type="image/gif" />
    <link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
    
    <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,common.js,user.js,password.js,zhifubox.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>


<?php echo $this->fetch('library/ur_here.lbi'); ?>


<div class="blank"></div>
<div class="block clearfix">
    
    <div class="AreaL">
        <div class="box">
            <div class="box_1">
                <div class="userCenterBox">
                    <?php echo $this->fetch('library/user_menu.lbi'); ?>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="AreaR">
        <div class="box">
            <div class="box_1">
                <div class="userCenterBox boxCenterList clearfix" style="_height:1%;">
                    
                    <?php if ($this->_var['action'] == 'profile'): ?>
                    <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
                    <script type="text/javascript">
                        <?php $_from = $this->_var['lang']['profile_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                        var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </script>
                    <h5><span><?php echo $this->_var['lang']['profile']; ?></span></h5>
                    <div class="blank"></div>
                    <form name="formEdit" action="user.php" method="post" onSubmit="return userEdit()">
                        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <tr>
                                <td width="28%" align="right" bgcolor="#FFFFFF">用户名： </td>

                                <td width="72%" align="left" bgcolor="#FFFFFF">


                                    <!--<input type="text" name="user_name" value="<?php echo $this->_var['user_name']; ?>" disabled='disabled'> <span style="margin-left:20px"><img src="themes/ecmoban_yihaodian/images/success.png"></span>-->

                                    <input type="text" name="user_name" value="<?php echo $this->_var['username']; ?>"  disabled='disabled' >

                                </td>
                            </tr>
                            <tr>
                                <td width="28%" align="right" bgcolor="#FFFFFF">手机号： </td>
                                <td width="72%" align="left" bgcolor="#FFFFFF">
                                    <?php if ($this->_var['reg_phone'] == 1): ?>
                                    <input type="text" name="phone" value="<?php echo $this->_var['phone']; ?>"  id='phone' disabled='disabled' />
                                    <span  id="tel_check" style="margin-left:20px;position:absolute;margin-top:5px"><img src="themes/ecmoban_yihaodian/images/success.png"></span>
                                    <?php else: ?>

                                    <input type="text" name="phone" value="<?php echo $this->_var['phone']; ?>" id='phone' >
                                    <a onclick="showMask()"><span style="margin-left:20px;position:absolute;" id="tel_check";margin-top:5px><img src="themes/ecmoban_yihaodian/images/error.png"></span></a>
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>


                            <tr>
                                <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['birthday']; ?>： </td>
                                <td width="72%" align="left" bgcolor="#FFFFFF"> <?php echo $this->html_select_date(array('field_order'=>'YMD','prefix'=>'birthday','start_year'=>'-60','end_year'=>'+1','display_days'=>'true','month_format'=>'%m','day_value_format'=>'%02d','time'=>$this->_var['birthday'])); ?> </td>
                            </tr>
                            <tr>
                                <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['sex']; ?>： </td>
                                <td width="72%" align="left" bgcolor="#FFFFFF"><input type="radio" name="sex" value="0" <?php if ($this->_var['profile']['sex'] == 0): ?>checked="checked"<?php endif; ?> />
                                    <?php echo $this->_var['lang']['secrecy']; ?>&nbsp;&nbsp;
                                    <input type="radio" name="sex" value="1" <?php if ($this->_var['profile']['sex'] == 1): ?>checked="checked"<?php endif; ?> />
                                    <?php echo $this->_var['lang']['male']; ?>&nbsp;&nbsp;
                                    <input type="radio" name="sex" value="2" <?php if ($this->_var['profile']['sex'] == 2): ?>checked="checked"<?php endif; ?> />
                                    <?php echo $this->_var['lang']['female']; ?>&nbsp;&nbsp; </td>
                            </tr>
                            <tr>
                                <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['email']; ?>： </td>
                                <td width="72%" align="left" bgcolor="#FFFFFF">
                                    <?php if ($this->_var['mailvali'] == 1): ?>
                                    <input name="email" type="text" value="<?php echo $this->_var['profile']['email']; ?>" size="25" class="inputBg" disabled='disabled' /><span style="margin-left:20px;position:absolute;margin-top:5px;"><img src="themes/ecmoban_yihaodian/images/success.png"></span>
                                    <?php else: ?>
                                    <input name="email" type="text" value="<?php echo $this->_var['profile']['email']; ?>" size="25" class="inputBg" /><span style="margin-left:20px;position:absolute;margin-top:5px"><a href="javascript:sendHashMail()"><img src="themes/ecmoban_yihaodian/images/error.png"></span></a></span>
                                    <?php endif; ?>

                                </td>
                            </tr>
                            <tr>
                                <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['idcard']; ?>： </td>
                                <td width="72%" align="left" bgcolor="#FFFFFF">

                                    <input name="idcard" type="text" value="<?php echo $this->_var['idcard']; ?>" size="25" class="inputBg" />

                                </td>
                            </tr>
                            <tr>
                                <td width="28%" align="right" bgcolor="#FFFFFF">别名：</td>
                                <td width="72%" align="left"  bgcolor="#FFFFFF">
                                    <input name="alias" type="text" value="<?php echo $this->_var['alias']; ?>" size="25" class="inputBg">
                                </td>
                            </tr>
                            <tr>
                                <td width="28%" align="right" bgcolor="#FFFFFF">QQ：</td>
                                <td width="72%" align="left"  bgcolor="#FFFFFF">
                                    <input name="qq_number" type="text" value="<?php echo $this->_var['qq_number']; ?>" size="25" class="inputBg">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="act" type="hidden" value="act_edit_profile" />
                                    <input name="submit" type="submit" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" class="bnt_blue_1" style="border:none;" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    

                    <div id="mask" class="mask" style="display:none;position: absolute; top:400px;margin-left:490px;  background-color: #fff;z-index: 1002; left: 0px;width:300px;height:300px;border: 1px solid #2cb7fe;" >
                        <div>
                            <span id="mask_close" onclick="hideMask()" style="margin-left:250px">关闭</span>
                        </div>
                        <div class='mask_center' style="margin-left:30px;margin-top:30px">
                            <div style="margin-top:40px">
                                <h2>手机号：<span id="tel_num"><?php echo $this->_var['phone']; ?></span></a></h2>
                            </div>
                            <div style="margin-top:40px">
                                <h2>验证码：<input type="text" id="code" size="30"><button id="get_code" onclick="get_tel_sms()">获取验证码</button></h2>
                            </div>
                            <div  style="margin-top:40px">

                                <button  id="check_code" onclick="check_tel_code()">验证</button>

                            </div>
                        </div>

                    </div>
                    <?php endif; ?>
                    
                    <?php if ($this->_var['action'] == "true_info"): ?>


                    <h5><span>实名认证</span></h5>
                    <div class="blank"></div>
                    <div id="card" class="mask" style="top:400px;background-color: #fff;z-index: 1002; left: 0px;width:100%;border: 2px solid #2cb7fe;border-radius:10px;text-align:left" >
                        <form action="user.php" method="post" enctype="multipart/form-data" name="formMsg" onSubmit="return submitMsg()">
                            <div style="margin-left:200px;margin-top:10px">
                                <?php if ($this->_var['status'] == 2): ?>

                                    <div style="margin-top:10px;color:red;font-size:20px">

                                    实名认证没有通过,请重新提交资料
                                    </div>

                                <?php endif; ?>




                                <?php if ($this->_var['status'] == 1 || $this->_var['status'] == 9): ?>
                                <div style="margin-top:10px">开户银行&nbsp;&nbsp;:&nbsp;&nbsp;
                                    <input type="text" name="banks" id="banks" value="<?php echo $this->_var['banks']; ?>" readonly="readonly" > </div>
                                <div style="margin-top:10px">开户银行所在省&nbsp;&nbsp;:&nbsp;&nbsp;
                                    <input type="text" name="provinceinfo" id="provinceinfo" value="<?php echo $this->_var['provincename']; ?>"  readonly="readonly">
                                </div>

                                <div style="margin-top:10px">开户银行所在市

                                    <input type="text" name="cityinfo" id="cityinfo" value="<?php echo $this->_var['cityname']; ?>" readonly="readonly" >
                                </div>
                                <div style="margin-top:10px">开户支行&nbsp;&nbsp;:&nbsp;&nbsp;
                                    <input type="text" name="bankname" id="bankname" value="<?php echo $this->_var['bankname']; ?>"  readonly="readonly" >

                                </div>
                                <div style="margin-top:10px" >具体支行代码号&nbsp;&nbsp;:&nbsp;&nbsp;<input type="text" name="bankno" id="bankno" value="<?php echo $this->_var['bankno']; ?>" readonly="readonly" ></div>
                                <div style="margin-top:10px">银行卡号&nbsp;&nbsp;:&nbsp;&nbsp;<input type="text" name="bankaccount" value="<?php echo $this->_var['bankaccount']; ?>" readonly="readonly"></div>

                                <div style="margin:10px auto">身份证号&nbsp;&nbsp;:<input type="text" name="pidno" value="<?php echo $this->_var['pidno']; ?>"  readonly="readonly"></div>

                                <?php else: ?>
                                <div style="margin-top:10px"> 开户银行&nbsp;&nbsp;:&nbsp;&nbsp;<select id="bankinfo"   onchange="cleanmsg()">


                                    <?php $_from = $this->_var['bankinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>




                                    <?php if ($this->_var['item']['bankid'] == $this->_var['bankid']): ?>

                                    <option  value="<?php echo $this->_var['item']['bankid']; ?>" selected><?php echo $this->_var['banks']; ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo $this->_var['item']['bankid']; ?>"><?php echo $this->_var['item']['bankname']; ?></option>

                                    <?php endif; ?>



                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                                </div>
                                <div style="margin-top:10px">开户银行所在省&nbsp;&nbsp;:&nbsp;&nbsp;<select id="provinceinfo"  onchange="getcity()">
                                    <option value="0">请选择省</option>


                                    <?php $_from = $this->_var['province']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>

                                    <?php if ($this->_var['item']['provinceid'] == $this->_var['provinceid']): ?>

                                    <option  value="<?php echo $this->_var['item']['provinceid']; ?>"  selected><?php echo $this->_var['provincename']; ?></option>


                                    <?php else: ?>


                                    <option value="<?php echo $this->_var['item']['provinceid']; ?>" ><?php echo $this->_var['item']['provincename']; ?></option>



                                     <?php endif; ?>

                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>


                                </select>
                                </div>

                                <div style="margin-top:10px">开户银行所在市&nbsp;&nbsp;:&nbsp;&nbsp;<select  id="cityinfo" onchange="getzhihang()" >
                                    <option value="0">请选择市</option>
                                    <?php if ($this->_var['status'] == 2): ?>

                                    <option><?php echo $this->_var['cityname']; ?></option>
                                    <?php endif; ?>
                                    <option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                </select>
                                </div>
                                <div style="margin-top:10px">开户支行&nbsp;&nbsp;:&nbsp;&nbsp;<select   onchange="getbankname()" id="zhihanginfo" name="bankname">
                                    <option value="0">请选择支行</option>
                                    <?php if ($this->_var['status'] == 2): ?>

                                    <option  value="<?php echo $this->_var['bankbranchid']; ?>" selected><?php echo $this->_var['bankname']; ?></option>
                                    <?php endif; ?>
                                    <option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                </select>
                                </div>
                                <div style="margin-top:10px" >具体支行代码号&nbsp;&nbsp;:&nbsp;&nbsp;<input type="text" name="bankno" id="bankno" 　<?php if ($this->_var['status'] == 2): ?> value="<?php echo $this->_var['bankno']; ?>" <?php endif; ?>　readonly></div>
                                <div style="margin-top:10px">银行卡号&nbsp;&nbsp;:&nbsp;&nbsp;<input type="text" name="bankaccount"  <?php if ($this->_var['status'] == 2): ?> value="<?php echo $this->_var['bankaccount']; ?>" <?php endif; ?>
                                        ></div>

                                <div style="margin:10px auto">身份证号&nbsp;&nbsp;:<input type="text" name="pidno" <?php if ($this->_var['status'] == 2): ?> value="<?php echo $this->_var['pidno']; ?>" <?php endif; ?>></div>
                                <?php endif; ?>
                                <?php if ($this->_var['status'] != 9 && $this->_var['status'] != 1): ?>
                                <div style="margin:10px auto">身份证正面：<input type="file" name="card_img_1"  size="100"  class="inputBg" />

                                    <div>图片示例<img src="themes/ecmoban_yihaodian/images/shili/1.jpg" width="180px" height="150px" style="margin-left:50px;margin-top:20px"></div>
                                </div>
                                <div style="margin:10px auto">身份证反面：<input type="file" name="card_img_2"  size="100"  class="inputBg" />
                                    <div>图片示例<img src="themes/ecmoban_yihaodian/images/shili/2.jpg" width="180px" height="150px" style="margin-left:50px;margin-top:20px"></div>
                                </div>
                                <div style="margin:10px auto">银行卡正面：<input type="file" name="yhcard_img_1"  size="100"  class="inputBg" />
                                    <div>图片示例<img src="themes/ecmoban_yihaodian/images/shili/3.jpg" width="180px" height="150px" style="margin-left:50px;margin-top:20px"></div>
                                </div>
                                <div style="margin:10px auto ">银行卡反面：<input type="file" name="yhcard_img_2"  size="100"  class="inputBg" />
                                    <div>图片示例<img src="themes/ecmoban_yihaodian/images/shili/4.jpg" width="180px" height="150px" style="margin-left:50px;margin-top:20px"></div>

                                </div>
                                <div style="margin:10px auto ">二合一照片：<input type="file" name="ercard_img_1"  size="100"  class="inputBg" />
                                    <div>图片示例<img src="themes/ecmoban_yihaodian/images/shili/5.jpg" width="200px" height="250px" style="margin-left:50px;margin-top:20px"></div>
                                </div>
                                <?php endif; ?>
 
                                <div style="margin-top:20px">
                                    <input type="hidden" name="act" value="act_add_cart" />


                                    <?php if ($this->_var['status'] == 1): ?>
                                    <div style="font-size:20px;color:red">资料已经提交请静待审核</div>
                                    <?php elseif ($this->_var['status'] == 9): ?>
                                    <div style="font-size:20px;color:red">实名认证已经完成</div>
                                    <?php else: ?>
                                    <input type="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_bonus"  style="margin-bottom:40px" />
                                    <?php endif; ?>

                                </div>

                        </form>
                    </div>

                </div>






                <script type="text/javascript">
                    function  change_password(){
                        var tel=document.getElementById("tel_num").innerText;
                        var code=document.getElementById("smscode").value;

                        var newpass=document.getElementById("newpwd").value;
                        var  pass_err=document.getElementById("pass_err");

                        Ajax.call( 'user.php?act=change_pwd', 'tel='+ tel+"&code="+code+"&newpass="+newpass, change_callback , 'GET', 'JSON');

                    }




                    function  change_callback(result){

                        if(result=='ok'){

                            alert("修改成功");

                        }else{

                            alert("修改失败");

                        }


                    }


                    //获取城市
                    function   getcity(){
                        var  bankinfo=document.getElementById("bankinfo").value;
                        var  provinceinfo=document.getElementById("provinceinfo").value;

                        Ajax.call( 'user.php?act=getcity', 'bankinfo='+ bankinfo+"&provinceinfo="+provinceinfo, info_bank, 'GET', JSON);

                    }

                    //获取支行
                    function   getzhihang(){
                        var  bankinfo=document.getElementById("bankinfo").value;
                        var  cityinfo=document.getElementById("cityinfo").value;

                        Ajax.call( 'user.php?act=getzhihang', 'bankinfo='+ bankinfo+"&cityinfo="+cityinfo, zhihang_bank, 'GET', JSON);

                    }

                   function   cleanmsg(){
                       document.getElementById("provinceinfo").options[0].selected=true;
                       document.getElementById("cityinfo").innerHTML = "<option value='0'>请选择市</option>";

                       document.getElementById("zhihanginfo").innerHTML ="<option value='0'>请选择支行</option>";
                       document.getElementById("bankno").value="";

                   }

                    //城市返回数据处理
                    function  info_bank(result) {

                        var arr = [];
                        var obj = new Function("return" + result)();
                       // var obj=result.parseJSON();
//                        var obj = jQuery.parseJSON(result) ;
                        if (obj.length > 0) {
                        	arr.push("<option value='0'>请选择市</option>");
                            for (var f = 0; f < obj.length; f++) {

                                // console.log(obj[f]["cityname"]);

                                arr.push("<option value=" + obj[f]['cityid'] + ">" + obj[f]['cityname'] + "</option>");

                            }


                            document.getElementById("cityinfo").innerHTML = arr.join("");
                        }

                    }

                    //支行数据返回处理
                    function  zhihang_bank(result) {

                        var arr = [];

                        //var  obj = new Function("return" + result)();
                       // var obj=result.parseJSON();
                        var obj=JSON.parse(result);

                        if (obj.length > 0) {
                        	arr.push("<option value='0'>请选择支行</option>");
                            for (var f = 0; f < obj.length; f++) {

                                // console.log(obj[f]["cityname"]);

                                arr.push("<option value=" + obj[f]['bankbranchid'] + ">" + obj[f]['bankbranchname'] + "</option>");

                            }


                            document.getElementById("zhihanginfo").innerHTML = arr.join("");

                        }
                    }

                    function  getbankname(){

                        var  bankno=document.getElementById("zhihanginfo").value;
                        //alert(bankno);
                        document.getElementById("bankno").value=bankno;
                    }


                </script>
                <?php endif; ?>
                <!-- <form name="formPassword" action="user.php" method="post" onSubmit="return editPassword()" >-->
                <!--
            <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                      <tr>
                              <td width="28%" align="right" bgcolor="#FFFFFF">手机号</td>
                              <td width="76%" align="left" bgcolor="#FFFFFF"><span id="tel_num"><?php echo $this->_var['phone']; ?></span></td>

                     </tr>
                     <tr>
                          <td width="15%" align="right" bgcolor="#FFFFFF">验证码</td>
                         <td width="60%" align="left" bgcolor="#FFFFFF"><input type="text" id="smscode" size="25"><button onclick="getsms()" id="get_code" >获取验证码</button></td>

                     </tr>
                     <tr>
                        <td width="15%" align="right" bgcolor="#FFFFFF">新密码</td>
                        <td width="60%" align="left" bgcolor="#FFFFFF"><input  type="password" id="newpwd"><span id="pass_err"></span></td>

                     </tr>
                     <tr>
                            <td></td>

                            <td><button  onclick="change_password()">修改</button></td>

                     </tr>


            </table>

            -->



                <!--
                   <tr>
                     <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['old_password']; ?>：</td>
                     <td width="76%" align="left" bgcolor="#FFFFFF"><input name="old_password" type="password" size="25"  class="inputBg" /></td>
                   </tr>
                   <tr>
                     <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['new_password']; ?>：</td>
                     <td align="left" bgcolor="#FFFFFF"><input name="new_password" type="password" size="25"  class="inputBg" /></td>
                   </tr>
                   <tr>
                     <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['confirm_password']; ?>：</td>
                     <td align="left" bgcolor="#FFFFFF"><input name="comfirm_password" type="password" size="25"  class="inputBg" /></td>
                   </tr>
                   <tr>
                     <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="act" type="hidden" value="act_edit_password" />
                       <input name="submit" type="submit" class="bnt_blue_1" style="border:none;" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" />
                     </td>
                   </tr>-->

                <!--</form>-->

                
                
                <?php if ($this->_var['action'] == "account_list"): ?>
                <h5><span><?php echo $this->_var['theuname']; ?> <?php echo $this->_var['lang']['label_account_list']; ?></span></h5>
                <div class="blank"></div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr align="center">
                        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_realname']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_time']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['surplus_pro_type']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['money']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['change_desc']; ?></td>
                    </tr>
                    <?php $_from = $this->_var['account_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                    <tr>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_realname']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['change_time']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['type']; ?></td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['amount']; ?></td>
                        <td bgcolor="#ffffff" title="<?php echo $this->_var['item']['change_desc']; ?>">&nbsp;&nbsp;<?php echo $this->_var['item']['short_change_desc']; ?></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <tr>
                        <td colspan="5" align="center" bgcolor="#ffffff"><div align="right"><?php echo $this->_var['theuname']; ?><?php echo $this->_var['lang']['current_surplus']; ?><?php echo $this->_var['surplus_amount']; ?></div></td>
                    </tr>
                </table>
                <?php echo $this->fetch('library/pages.lbi'); ?>
                <?php endif; ?>

                

                
                <?php if ($this->_var['action'] == "accountjf_list"): ?>
                <h5><span><?php echo $this->_var['theuname']; ?> <?php echo $this->_var['lang']['label_accountjf_list']; ?></span></h5>
                <div class="blank"></div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr align="center">
                        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_realname']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_time']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['surplus_pro_type']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['money']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['change_desc']; ?></td>
                    </tr>
                    <?php $_from = $this->_var['account_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                    <tr>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_realname']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['change_time']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['type']; ?></td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['amount']; ?></td>
                        <td bgcolor="#ffffff" title="<?php echo $this->_var['item']['change_desc']; ?>">&nbsp;&nbsp;<?php echo $this->_var['item']['short_change_desc']; ?></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <tr>
                        <td colspan="5" align="center" bgcolor="#ffffff"><div align="right"><?php echo $this->_var['theuname']; ?><?php echo $this->_var['lang']['current_surplusjf']; ?><?php echo $this->_var['surplus_amount']; ?></div></td>
                    </tr>
                </table>
                <?php echo $this->fetch('library/pages.lbi'); ?>
                <?php endif; ?>

                



                <?php if ($this->_var['action'] == 'bonus'): ?>
                <script type="text/javascript">
                    <?php $_from = $this->_var['lang']['profile_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                    var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </script>
                <h5><span><?php echo $this->_var['lang']['label_bonus']; ?></span></h5>
                <div class="blank"></div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr>
                        <th align="center" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['bonus_sn']; ?></th>
                        <th align="center" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['bonus_name']; ?></th>
                        <th align="center" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['bonus_amount']; ?></th>
                        <th align="center" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['min_goods_amount']; ?></th>
                        <th align="center" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['bonus_end_date']; ?></th>
                        <th align="center" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['bonus_status']; ?></th>
                    </tr>
                    <?php if ($this->_var['bonus']): ?>
                    <?php $_from = $this->_var['bonus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                    <tr>
                        <td align="center" bgcolor="#FFFFFF"><?php echo empty($this->_var['item']['bonus_sn']) ? 'N/A' : $this->_var['item']['bonus_sn']; ?></td>
                        <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['type_name']; ?></td>
                        <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['type_money']; ?></td>
                        <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['min_goods_amount']; ?></td>
                        <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['use_enddate']; ?></td>
                        <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['status']; ?></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['user_bonus_empty']; ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
                <div class="blank5"></div>
                <?php echo $this->fetch('library/pages.lbi'); ?>
                <div class="blank5"></div>
                <h5><span><?php echo $this->_var['lang']['add_bonus']; ?></span></h5>
                <div class="blank"></div>
                <form name="addBouns" action="user.php" method="post" onSubmit="return addBonus()">
                    <div style="padding: 15px;">
                        <?php echo $this->_var['lang']['bonus_number']; ?>
                        <input name="bonus_sn" type="text" size="30" class="inputBg" />
                        <input type="hidden" name="act" value="act_add_bonus" class="inputBg" />
                        <input type="submit" class="bnt_blue_1" style="border:none;" value="<?php echo $this->_var['lang']['add_bonus']; ?>" />
                    </div>
                </form>
                <?php endif; ?>
                


                
                <?php if ($this->_var['action'] == 'order_list'): ?>
                <h5><span><?php echo $this->_var['lang']['label_order']; ?></span></h5>
                <div class="blank"></div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr align="center">
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['order_number']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['order_addtime']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['order_money']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['order_status']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></td>
                    </tr>
                    <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                    <tr>
                        <td align="center" bgcolor="#ffffff"><a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>" class="f6"><?php echo $this->_var['item']['order_sn']; ?></a></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['order_time']; ?></td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['total_fee']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['order_status']; ?></td>
                        <td align="center" bgcolor="#ffffff"><font class="f6"><?php echo $this->_var['item']['handler']; ?></font></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </table>
                <div class="blank5"></div>
                <?php echo $this->fetch('library/pages.lbi'); ?>
                <div class="blank5"></div>
                <h5><span><?php echo $this->_var['lang']['merge_order']; ?></span></h5>
                <div class="blank"></div>
                <script type="text/javascript">
                    <?php $_from = $this->_var['lang']['merge_order_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                    var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </script>
                <form action="user.php" method="post" name="formOrder" onsubmit="return mergeOrder()">
                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                        <tr>
                            <td width="22%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['first_order']; ?>:</td>
                            <td width="12%" align="left" bgcolor="#ffffff"><select name="to_order">
                                <option value="0"><?php echo $this->_var['lang']['select']; ?></option>

                                <?php echo $this->html_options(array('options'=>$this->_var['merge'])); ?>

                            </select></td>
                            <td width="19%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['second_order']; ?>:</td>
                            <td width="11%" align="left" bgcolor="#ffffff"><select name="from_order">
                                <option value="0"><?php echo $this->_var['lang']['select']; ?></option>

                                <?php echo $this->html_options(array('options'=>$this->_var['merge'])); ?>

                            </select></td>
                            <td width="36%" bgcolor="#ffffff">&nbsp;<input name="act" value="merge_order" type="hidden" />
                                <input type="submit" name="Submit"  class="bnt_blue_1" style="border:none;"  value="<?php echo $this->_var['lang']['merge_order']; ?>" /></td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff">&nbsp;</td>
                            <td colspan="4" align="left" bgcolor="#ffffff"><?php echo $this->_var['lang']['merge_order_notice']; ?></td>
                        </tr>
                    </table>
                </form>
                <?php endif; ?>
                
                
                <?php if ($this->_var['action'] == 'track_packages'): ?>
                <h5><span><?php echo $this->_var['lang']['label_track_packages']; ?></span></h5>
                <div class="blank"></div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" id="order_table">
                    <tr align="center">
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['order_number']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></td>
                    </tr>
                    <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                    <tr>
                        <td align="center" bgcolor="#ffffff"><a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>"><?php echo $this->_var['item']['order_sn']; ?></a></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['query_link']; ?></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </table>
                <script>
                    var query_status = '<?php echo $this->_var['lang']['query_status']; ?>';
                    var ot = document.getElementById('order_table');
                    for (var i = 1; i < ot.rows.length; i++)
                    {
                        var row = ot.rows[i];
                        var cel = row.cells[1];
                        cel.getElementsByTagName('a').item(0).innerHTML = query_status;
                    }
                </script>
                <div class="blank5"></div>
                <?php echo $this->fetch('library/pages.lbi'); ?>
                <?php endif; ?>
                
                
                <?php if ($this->_var['action'] == order_detail): ?>
                <h5><span><?php echo $this->_var['lang']['order_status']; ?></span></h5>
                <div class="blank"></div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr>
                        <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_order_sn']; ?>：</td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['order_sn']; ?>
                            <?php if ($this->_var['order']['extension_code'] == "group_buy"): ?>
                            <a href="./group_buy.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" class="f6"><strong><?php echo $this->_var['lang']['order_is_group_buy']; ?></strong></a>
                            <?php elseif ($this->_var['order']['extension_code'] == "exchange_goods"): ?>
                            <a href="./exchange.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" class="f6"><strong><?php echo $this->_var['lang']['order_is_exchange']; ?></strong></a>
                            <?php endif; ?>
                            <a href="user.php?act=message_list&order_id=<?php echo $this->_var['order']['order_id']; ?>" class="f6">[<?php echo $this->_var['lang']['business_message']; ?>]</a>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_order_status']; ?>：</td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['order_status']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['confirm_time']; ?></td>
                    </tr>
                    <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_pay_status']; ?>：</td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['pay_status']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if ($this->_var['order']['order_amount'] > 0): ?><?php echo $this->_var['order']['pay_online']; ?><?php endif; ?><?php echo $this->_var['order']['pay_time']; ?></td>
                    </tr>
                    <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_shipping_status']; ?>：</td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['shipping_status']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['shipping_time']; ?></td>
                    </tr>
                    <?php if ($this->_var['order']['invoice_no']): ?>
                    <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignment']; ?>：</td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['invoice_no']; ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($this->_var['order']['to_buyer']): ?>
                    <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_to_buyer']; ?>：</td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['to_buyer']; ?></td>
                    </tr>
                    <?php endif; ?>

                    <?php if ($this->_var['virtual_card']): ?>
                    <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['virtual_card_info']; ?>：</td>
                        <td colspan="3" align="left" bgcolor="#ffffff">
                            <?php $_from = $this->_var['virtual_card']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vgoods');if (count($_from)):
    foreach ($_from AS $this->_var['vgoods']):
?>
                            <?php $_from = $this->_var['vgoods']['info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'card');if (count($_from)):
    foreach ($_from AS $this->_var['card']):
?>
                            <?php if ($this->_var['card']['card_sn']): ?><?php echo $this->_var['lang']['card_sn']; ?>:<span style="color:red;"><?php echo $this->_var['card']['card_sn']; ?></span><?php endif; ?>
                            <?php if ($this->_var['card']['card_password']): ?><?php echo $this->_var['lang']['card_password']; ?>:<span style="color:red;"><?php echo $this->_var['card']['card_password']; ?></span><?php endif; ?>
                            <?php if ($this->_var['card']['end_date']): ?><?php echo $this->_var['lang']['end_date']; ?>:<?php echo $this->_var['card']['end_date']; ?><?php endif; ?><br />
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>
                <div class="blank"></div>
                <h5><span><?php echo $this->_var['lang']['goods_list']; ?></span>
                    <?php if ($this->_var['allow_to_cart']): ?>
                    <a href="javascript:;" onclick="returnToCart(<?php echo $this->_var['order']['order_id']; ?>)" class="f6"><?php echo $this->_var['lang']['return_to_cart']; ?></a>
                    <?php endif; ?>
                </h5>
                <div class="blank"></div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr>
                        <th width="23%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_name']; ?></th>
                        <th width="29%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_attr']; ?></th>
                        <!--<th><?php echo $this->_var['lang']['market_price']; ?></th>-->
                        <th width="26%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_price']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?></th>
                        <th width="9%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['number']; ?></th>
                        <th width="20%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['subtotal']; ?></th>
                    </tr>
                    <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                    <tr>
                        <td bgcolor="#ffffff">
                            <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
                            <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a>
                            <?php if ($this->_var['goods']['parent_id'] > 0): ?>
                            <span style="color:#FF0000">（<?php echo $this->_var['lang']['accessories']; ?>）</span>
                            <?php elseif ($this->_var['goods']['is_gift']): ?>
                            <span style="color:#FF0000">（<?php echo $this->_var['lang']['largess']; ?>）</span>
                            <?php endif; ?>
                            <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
                            <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><?php echo $this->_var['goods']['goods_name']; ?><span style="color:#FF0000;">（礼包）</span></a>
                            <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none">
                                <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?>
                                <a href="goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['package_goods_list']['goods_name']; ?></a><br />
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </div>
                            <?php endif; ?>
                        </td>
                        <td align="left" bgcolor="#ffffff"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
                        <!--<td align="right"><?php echo $this->_var['goods']['market_price']; ?></td>-->
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['goods']['goods_price']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['goods']['goods_number']; ?></td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['goods']['subtotal']; ?></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <tr>
                        <td colspan="8" bgcolor="#ffffff" align="right">
                            <?php echo $this->_var['lang']['shopping_money']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?>: <?php echo $this->_var['order']['formated_goods_amount']; ?>
                        </td>
                    </tr>
                </table>
                <div class="blank"></div>
                <h5><span><?php echo $this->_var['lang']['fee_total']; ?></span></h5>
                <div class="blank"></div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr>
                        <td align="right" bgcolor="#ffffff">
                            <?php echo $this->_var['lang']['goods_all_price']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?>: <?php echo $this->_var['order']['formated_goods_amount']; ?>
                            <?php if ($this->_var['order']['discount'] > 0): ?>
                            - <?php echo $this->_var['lang']['discount']; ?>: <?php echo $this->_var['order']['formated_discount']; ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['tax'] > 0): ?>
                            + <?php echo $this->_var['lang']['tax']; ?>: <?php echo $this->_var['order']['formated_tax']; ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['shipping_fee'] > 0): ?>
                            + <?php echo $this->_var['lang']['shipping_fee']; ?>: <?php echo $this->_var['order']['formated_shipping_fee']; ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['insure_fee'] > 0): ?>
                            + <?php echo $this->_var['lang']['insure_fee']; ?>: <?php echo $this->_var['order']['formated_insure_fee']; ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['pay_fee'] > 0): ?>
                            + <?php echo $this->_var['lang']['pay_fee']; ?>: <?php echo $this->_var['order']['formated_pay_fee']; ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['pack_fee'] > 0): ?>
                            + <?php echo $this->_var['lang']['pack_fee']; ?>: <?php echo $this->_var['order']['formated_pack_fee']; ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['card_fee'] > 0): ?>
                            + <?php echo $this->_var['lang']['card_fee']; ?>: <?php echo $this->_var['order']['formated_card_fee']; ?>
                            <?php endif; ?>        </td>
                    </tr>
                    <tr>
                        <td align="right" bgcolor="#ffffff">
                            <?php if ($this->_var['order']['money_paid'] > 0): ?>
                            - <?php echo $this->_var['lang']['order_money_paid']; ?>: <?php echo $this->_var['order']['formated_money_paid']; ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['surplus'] > 0): ?>
                            - <?php echo $this->_var['lang']['use_surplus']; ?>: <?php echo $this->_var['order']['formated_surplus']; ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['integral_money'] > 0): ?>
                            - <?php echo $this->_var['lang']['use_integral']; ?>: <?php echo $this->_var['order']['formated_integral_money']; ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['bonus'] > 0): ?>
                            - <?php echo $this->_var['lang']['use_bonus']; ?>: <?php echo $this->_var['order']['formated_bonus']; ?>
                            <?php endif; ?>        </td>
                    </tr>
                    <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['order_amount']; ?>: <?php echo $this->_var['order']['formated_order_amount']; ?>
                            <?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><br />
                            <?php echo $this->_var['lang']['notice_gb_order_amount']; ?><?php endif; ?></td>
                    </tr>
                    <?php if ($this->_var['allow_edit_surplus']): ?>
                    <tr>
                        <td align="right" bgcolor="#ffffff">
                            <form action="user.php" method="post" name="formFee" id="formFee"><?php echo $this->_var['lang']['use_more_surplus']; ?>:
                                <input name="surplus" type="text" size="8" value="0" style="border:1px solid #ccc;"/><?php echo $this->_var['max_surplus']; ?>
                                <input type="submit" name="Submit" class="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
                                <input type="hidden" name="act" value="act_edit_surplus" />
                                <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>" />
                            </form></td>
                    </tr>
                    <?php endif; ?>
                </table>
                <div class="blank"></div>
                <h5><span><?php echo $this->_var['lang']['consignee_info']; ?></span></h5>
                <div class="blank"></div>
                <?php if ($this->_var['order']['allow_update_address'] > 0): ?>
                <form action="user.php" method="post" name="formAddress" id="formAddress">
                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                        <tr>
                            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>： </td>
                            <td width="35%" align="left" bgcolor="#ffffff"><input name="consignee" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['consignee']); ?>" size="25">
                            </td>
                            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['email_address']; ?>： </td>
                            <td width="35%" align="left" bgcolor="#ffffff"><input name="email" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['email']); ?>" size="25" />
                            </td>
                        </tr>
                        <?php if ($this->_var['order']['exist_real_goods']): ?>
                        
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>： </td>
                            <td align="left" bgcolor="#ffffff"><input name="address" type="text" class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['address']); ?> " size="25" /></td>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['postalcode']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="zipcode" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['zipcode']); ?>" size="25" /></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['phone']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="tel" type="text" class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['tel']); ?>" size="25" /></td>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['backup_phone']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="mobile" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['mobile']); ?>" size="25" /></td>
                        </tr>
                        <?php if ($this->_var['order']['exist_real_goods']): ?>
                        
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['sign_building']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="sign_building" class="inputBg" type="text" value="<?php echo htmlspecialchars($this->_var['order']['sign_building']); ?>" size="25" />
                            </td>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['deliver_goods_time']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="best_time" type="text" class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['best_time']); ?>" size="25" />
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan="4" align="center" bgcolor="#ffffff"><input type="hidden" name="act" value="save_order_address" />
                                <input type="hidden" name="order_id" value="<?php echo $this->_var['order']['order_id']; ?>" />
                                <input type="submit" class="bnt_blue_2" value="<?php echo $this->_var['lang']['update_address']; ?>"  />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php else: ?>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr>
                        <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>：</td>
                        <td width="35%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['consignee']; ?></td>
                        <td width="15%" align="right" bgcolor="#ffffff" ><?php echo $this->_var['lang']['email_address']; ?>：</td>
                        <td width="35%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['email']; ?></td>
                    </tr>
                    <?php if ($this->_var['order']['exist_real_goods']): ?>
                    <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>：</td>
                        <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['address']; ?>
                            <?php if ($this->_var['order']['zipcode']): ?>
                            [<?php echo $this->_var['lang']['postalcode']; ?>: <?php echo $this->_var['order']['zipcode']; ?>]
                            <?php endif; ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['phone']; ?>：</td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['tel']; ?> </td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['backup_phone']; ?>：</td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['mobile']; ?></td>
                    </tr>
                    <?php if ($this->_var['order']['exist_real_goods']): ?>
                    <tr>
                        <td align="right" bgcolor="#ffffff" ><?php echo $this->_var['lang']['sign_building']; ?>：</td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['sign_building']; ?> </td>
                        <td align="right" bgcolor="#ffffff" ><?php echo $this->_var['lang']['deliver_goods_time']; ?>：</td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['best_time']; ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
                <?php endif; ?>
                <div class="blank"></div>

                <div class="blank"></div>
                <h5><span><?php echo $this->_var['lang']['other_info']; ?></span></h5>
                <div class="blank"></div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <?php if ($this->_var['order']['shipping_id'] > 0): ?>
                    <tr>
                        <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['shipping']; ?>：</td>
                        <td colspan="3" width="85%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['shipping_name']; ?></td>
                    </tr>
                    <?php endif; ?>

                    <tr>
                        <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment']; ?>：</td>
                        <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['pay_name']; ?></td>
                    </tr>
                    <?php if ($this->_var['order']['insure_fee'] > 0): ?>
                    <?php endif; ?>
                    <?php if ($this->_var['order']['pack_name']): ?>
                    <tr>
                        <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['use_pack']; ?>：</td>
                        <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['pack_name']; ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($this->_var['order']['card_name']): ?>
                    <tr>
                        <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['use_card']; ?>：</td>
                        <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['card_name']; ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($this->_var['order']['card_message']): ?>
                    <tr>
                        <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['bless_note']; ?>：</td>
                        <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['card_message']; ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($this->_var['order']['surplus'] > 0): ?>
                    <?php endif; ?>
                    <?php if ($this->_var['order']['integral'] > 0): ?>
                    <tr>
                        <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['use_integral']; ?>：</td>
                        <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['integral']; ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($this->_var['order']['bonus'] > 0): ?>
                    <?php endif; ?>
                    <?php if ($this->_var['order']['inv_payee'] && $this->_var['order']['inv_content']): ?>
                    <tr>
                        <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['invoice_title']; ?>：</td>
                        <td width="36%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['inv_payee']; ?></td>
                        <td width="19%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['invoice_content']; ?>：</td>
                        <td width="25%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['inv_content']; ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($this->_var['order']['postscript']): ?>
                    <tr>
                        <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['order_postscript']; ?>：</td>
                        <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['postscript']; ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_process']; ?>：</td>
                        <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['how_oos_name']; ?></td>
                    </tr>
                </table>
                <?php endif; ?>
                
                
                <?php if ($this->_var['action'] == "account_raply" || $this->_var['action'] == "account_log" || $this->_var['action'] == "account_deposit" || $this->_var['action'] == "account_award" || $this->_var['action'] == "account_goldtransfer" || $this->_var['action'] == "account_detailjf" || $this->_var['action'] == "account_detail"): ?>

                <script type="text/javascript">
                    <?php $_from = $this->_var['lang']['account_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                    var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </script>
                <h5><span><?php echo $this->_var['lang']['user_balance']; ?> <?php echo $this->_var['allbalance']; ?> </span></h5>
                <div class="blank"></div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr>
                        <td align="right" bgcolor="#ffffff"><a href="user.php?act=account_deposit" class="f6"><?php echo $this->_var['lang']['surplus_type_0']; ?></a> | <a href="user.php?act=account_raply" class="f6"><?php echo $this->_var['lang']['surplus_type_1']; ?></a> | <a href="user.php?act=account_award" class="f6"><?php echo $this->_var['lang']['surplus_type_2']; ?></a> | <a href="user.php?act=account_goldtransfer" class="f6"><?php echo $this->_var['lang']['surplus_type_3']; ?></a> | <a href="user.php?act=account_detail" class="f6"><?php echo $this->_var['lang']['add_surplus_log']; ?></a>| <a href="user.php?act=account_detailjf" class="f6"><?php echo $this->_var['lang']['add_surplusjf_log']; ?></a> | <a href="user.php?act=account_log" class="f6"><?php echo $this->_var['lang']['view_application']; ?></a> </td>
                    </tr>
                </table>
                <?php endif; ?>
                <?php if ($this->_var['action'] == "account_raply"): ?>
      <?php if ($this->_var['realnameflag'] == 0): ?>          
                <form name="formSurplus" method="post" action="user.php" onSubmit="return submitSurplus()"  id="myform_zhifubox">
                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                        <tr>
                            <td width="15%" bgcolor="#fffff" >提示:</td>
                            <td bgcolor="#fffff" >即时提款功能已经开通，请完成实名认证、提款银行卡注册，可以使用此功能。</td>
                        </tr>
                        <tr>
                            <td width="15%" bgcolor="#fffff" >可提款金额:</td>
                            <td bgcolor="#fffff" ><?php echo $this->_var['surplus_amount']; ?></td>
                        </tr>

                        <tr>
                            <td width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['repay_money']; ?>:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="amount" value="<?php echo htmlspecialchars($this->_var['order']['amount']); ?>" class="inputBg" size="30" />
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" bgcolor="#ffffff">注意信息:</td>
                            <td bgcolor="#ffffff">电子币提现，每月一次，本月提现，下月3号前全部到账。如果电子币账户余额不够，本次提款作废！</td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_notic']; ?>:</td>
                            <td bgcolor="#ffffff" align="left"><textarea name="user_note" cols="55" rows="6" style="border:1px solid #ccc;"><?php echo htmlspecialchars($this->_var['order']['user_note']); ?></textarea></td>
                        </tr>
                        <tr>
                            <td width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['mybankname']; ?>:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="mybankname" value="" class="inputBg" size="30" />
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['mybankaddress']; ?>:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="mybankaddress" value="" class="inputBg" size="30" />
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['myname']; ?>:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="myname" value="<?php echo $this->_var['myrealname']; ?>" class="inputBg" size="30" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['myaccount']; ?>:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="myaccount" value="" class="inputBg" size="30" />
                            </td>
                        </tr>


                        <tr>
                            <td bgcolor="#ffffff" colspan="2" align="center">
                                <input type="hidden" name="surplus_type" value="1" />
                                <input type="hidden" name="act" value="act_account" />
                                <button  class="bnt_blue_1" value="" onclick="zhifucheck();return  false"><?php echo $this->_var['lang']['submit_request']; ?> </button>
                                <input type="reset" name="reset" class="bnt_blue_1" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
                            </td>
                        </tr>
                    </table>
                </form>
                <div id="zhifubox"></div>
       <?php endif; ?>
       <?php if ($this->_var['realnameflag'] == 1): ?>          
                 <form name="formSurplus" method="post" action="user.php" onSubmit="return submitSurplus()">
                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                        <tr>
                            <td align="right" width="15%" bgcolor="#fffff" >提示:</td>
                            <td bgcolor="#fffff" >即时提款，选择提款银行卡并输入提款金额，提款后 2小时内到账, 提现金额需大于100元。</td>
                        </tr>

		                <tr>
		                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['myaccount']; ?>:</td>
		                  <td colspan="3" align="left" bgcolor="#ffffff"><select name="bankaccount" id="selcard_<?php echo $this->_var['sn']; ?>">
		                      <option value="0">请选择卡号</option>
		                      <?php $_from = $this->_var['realnamedata']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'card');if (count($_from)):
    foreach ($_from AS $this->_var['card']):
?>
		                      <option value="<?php echo $this->_var['card']['bankaccount']; ?>" <?php if ($this->_var['card']['cardtype'] == 2): ?>selected<?php endif; ?>><?php echo $this->_var['card']['bankaccount']; ?></option>
		                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		                    </select>
		                  </td>
		                </tr>
		               <tr>
                            <td align="right" width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['myname']; ?>:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="myname" value="<?php echo $this->_var['myrealname']; ?>" class="inputBg" size="30" readonly />
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="15%" bgcolor="#fffff" >可提款金额:</td>
                            <td bgcolor="#fffff" ><?php echo $this->_var['surplus_amount']; ?></td>
                        </tr>
                        
                       <tr>
                            <td align="right" idth="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['repay_money']; ?>:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="amount" value="<?php echo htmlspecialchars($this->_var['order']['amount']); ?>" class="inputBg" size="30" />
                            </td>
                        </tr>
 
                        <tr>
                            <td bgcolor="#ffffff" colspan="2" align="center">
                                <input type="hidden" name="surplus_type" value="1" />
                                <input type="hidden" name="act" value="act_account" />
                                <button type="submit" name="submit"  class="bnt_blue_1"  onclick="zhifucheck();return  false"><?php echo $this->_var['lang']['submit_request']; ?> </button>
                                <input type="reset" name="reset" class="bnt_blue_1" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
                            </td>
                        </tr>
                    </table>
                </form>
                <div id="zhifubox"></div>
       <?php endif; ?>
                <?php endif; ?>

                <?php if ($this->_var['action'] == "account_award"): ?>
                <form name="formSurplus" method="post" action="user.php" onSubmit="return submitSurplus()" id="myform_zhifubox">
                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                        <tr>
                            <td width="15%" bgcolor="#fffff" >积分余额:</td>
                            <td bgcolor="#fffff" ><?php echo $this->_var['award_amount']; ?></td>
                            </td>
                        </tr>

                        <tr>
                            <td width="15%" bgcolor="#ffffff">转提积分:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="amount" id="amount" value=""  onblur="sum_award_amount(<?php echo $this->_var['award_balance']; ?>,this.value,<?php echo $this->_var['award_bl']; ?>);" class="inputBg" size="30" />
                            </td>
                        </tr>

                        <tr>
                            <td width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['arrival_money']; ?>:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="s_amount" id="s_amount" class="inputBg" size="30" readonly />
                            </td>
                        </tr>

                        <tr>
                            <td width="15%" bgcolor="#ffffff">注意信息:</td>
                            <td bgcolor="#ffffff">积分转提收取<?php echo $this->_var['award_bl']; ?>%手续费，比如：转提10000元，实际到电子币账户金额<?php echo $this->_var['award_je']; ?>元！</td>
                            </td>
                        </tr>

                        <tr>
                            <td bgcolor="#ffffff" colspan="2" align="center">
                                <input type="hidden" name="surplus_type" value="2" />
                                <input type="hidden" name="act" value="act_account" />
                                <button    class="bnt_blue_1"  onclick="zhifucheck();return  false"><?php echo $this->_var['lang']['submit_request']; ?> </button>
                                <input type="reset" name="reset" class="bnt_blue_1" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
                            </td>
                        </tr>
                    </table>
                </form>
                <div id="zhifubox"></div>
                <?php endif; ?>

                <?php if ($this->_var['action'] == "account_goldtransfer"): ?>
                <form name="formSurplus" method="post" action="user.php" onSubmit="return submitSurplus()"  id="myform_zhifubox">
                    <table width="80%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                        <tr>
                            <td width="15%" bgcolor="#fffff"  align="right">选择转账货币类型:</td>
                            <td colspan="3" align="left" bgcolor="#ffffff"><select name="tftype" id="tftype">
                                <option value="0">请选择货币</option>
                                <?php $_from = $this->_var['transferlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tf');if (count($_from)):
    foreach ($_from AS $this->_var['tf']):
?>
                                <option value="<?php echo $this->_var['tf']['tftype']; ?>" <?php if ($this->_var['tftype'] == $this->_var['tf']['tftype']): ?>selected<?php endif; ?>><?php echo $this->_var['tf']['tfname']; ?></option>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </select>
                            </td>
                        </tr>

                        <tr>
                            <td width="15%" bgcolor="#ffffff" align="right">转账金额:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="amount" id="amount" value=""  onblur="sum_gold_amount(<?php echo $this->_var['balance']; ?>,<?php echo $this->_var['award_bal']; ?>,<?php echo $this->_var['gold_balance']; ?>,this.value);" class="inputBg" size="30" />
                            </td>
                        </tr>

                        <tr>
                            <td width="15%" bgcolor="#ffffff" align="right"><?php echo $this->_var['lang']['arrival_goldamt']; ?>:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="s_amount" id="s_amount" class="inputBg" size="30" readonly />
                            </td>
                        </tr>

                        <tr>
                            <td width="15%" bgcolor="#fffff"  align="right">转出用户:</td>
                            <td bgcolor="#fffff" id="myphone" ><?php echo $this->_var['myphone']; ?></td>
                            </td>
                        </tr>

                        <!--
                                   <tr>
                                   <td width="29%" align="right">验证码</td>
                                   <td width="61%"><input type="text" id="smscode" size="25"><button onclick="getgoldsms()"   id="get_code" >获取验证码</button></td>
                                   </tr>
                        -->
                        <tr>
                            <td width="15%" bgcolor="#ffffff" align="right">转入账户:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="tocode" id="tocode" value=""  onblur="get_user_name(this.value);" class="inputBg" size="30" />
                            </td>
                        </tr>

                        <tr>
                            <td width="15%" bgcolor="#ffffff" align="right">转入名称:</td>
                            <td bgcolor="#ffffff" align="left"><input type="text" name="s_username" id="s_username" class="inputBg" size="30" readonly />
                            </td>
                        </tr>

                        <tr>
                            <td width="15%" bgcolor="#ffffff" align="right">注意信息:</td>
                            <td bgcolor="#ffffff">电子币转账无手续费，积分、金币转出收取1.5%手续费，比如：转提10000金币，实际到目标账户金额9985元！<br \>请详细核对用户号与姓名，以防转错账户。</td>
                            </td>
                        </tr>

                        <tr>
                            <td bgcolor="#ffffff" colspan="2" align="center">
                                <input type="hidden" name="surplus_type" value="3" />
                                <input type="hidden" name="act" value="act_account" />
                                <button   class="bnt_blue_1"  onclick="zhifucheck();return  false"><?php echo $this->_var['lang']['submit_request']; ?> </button>
                                <input type="reset" name="reset" class="bnt_blue_1" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
                            </td>
                        </tr>

                    </table>
                </form>
                <div  id="zhifubox"></div>
                <?php endif; ?>

                <?php if ($this->_var['action'] == "account_deposit"): ?>
                <form name="formSurplus" method="post" action="user.php" onSubmit="return submitSurplus()">
                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                        <tr>
                            <td bgcolor="#ffffff">填写说明:</td>
                            <td bgcolor="#ffffff">1、小额资金可以选择支付宝在线支付方式，金额限制请查询支付宝规范，如果汇款金额超过支付宝在线支付限制，推荐使用银行汇款方式。<br>2、大额资金请选择汇款方式。汇款户名：上海创锦信息科技有限公司，汇款账号：999011490710606。<br>可以使用银行汇款、网银汇款、支付宝转账等多种方式进行汇款。<br>汇款成功后在此填写汇款确认单，备注内容：汇款人名，汇款账号，汇款金额。</td>
                        </tr>
                        <tr>
                            <td width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['deposit_money']; ?>:</td>
                            <td align="left" bgcolor="#ffffff"><input type="text" name="amount"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['amount']); ?>" size="30" /></td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_notic']; ?>:</td>
                            <td align="left" bgcolor="#ffffff"><textarea name="user_note" cols="55" rows="6" style="border:1px solid #ccc;"><?php echo htmlspecialchars($this->_var['order']['user_note']); ?></textarea></td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                        <tr align="center">
                            <td bgcolor="#ffffff"  colspan="3" align="left"><?php echo $this->_var['lang']['payment']; ?>:</td>
                        </tr>
                        <tr align="center">
                            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['pay_name']; ?></td>
                            <td bgcolor="#ffffff" width="60%"><?php echo $this->_var['lang']['pay_desc']; ?></td>
                            <td bgcolor="#ffffff" width="17%"><?php echo $this->_var['lang']['pay_fee']; ?></td>
                        </tr>
                        <?php $_from = $this->_var['payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                        <tr>
                            <td bgcolor="#ffffff" align="left">
                                <input type="radio" name="payment_id" value="<?php echo $this->_var['list']['pay_id']; ?>" /><?php echo $this->_var['list']['pay_name']; ?></td>
                            <td bgcolor="#ffffff" align="left"><?php echo $this->_var['list']['pay_desc']; ?></td>
                            <td bgcolor="#ffffff" align="center"><?php echo $this->_var['list']['pay_fee']; ?></td>
                        </tr>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <tr>
                            <td bgcolor="#ffffff" colspan="3"  align="center">
                                <input type="hidden" name="surplus_type" value="0" />
                                <input type="hidden" name="rec_id" value="<?php echo $this->_var['order']['id']; ?>" />
                                <input type="hidden" name="act" value="act_account" />
                                <input type="submit" class="bnt_blue_1" name="submit" value="<?php echo $this->_var['lang']['submit_request']; ?>" />
                                <input type="reset" class="bnt_blue_1" name="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php endif; ?>
                <?php if ($this->_var['action'] == "act_account"): ?>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr>
                        <td width="25%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['surplus_amount']; ?></td>
                        <td width="80%" bgcolor="#ffffff"><?php echo $this->_var['amount']; ?></td>
                    </tr>
                    <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment_name']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['payment']['pay_name']; ?></td>
                    </tr>
                    <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment_fee']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['pay_fee']; ?></td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment_desc']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['payment']['pay_desc']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" bgcolor="#ffffff"><?php echo $this->_var['payment']['pay_button']; ?></td>
                    </tr>
                </table>
                <?php endif; ?>
                <?php if ($this->_var['action'] == "account_detail"): ?>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr align="center">
                        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_realname']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_time']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['surplus_pro_type']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['money']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['paypoints']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['gold_amt']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['change_desc']; ?></td>
                    </tr>
                    <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                    <tr>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_realname']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['change_time']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['type']; ?></td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['amount']; ?></td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['award_bal']; ?></td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['pay_points']; ?></td>
                        <td bgcolor="#ffffff" title="<?php echo $this->_var['item']['change_desc']; ?>">&nbsp;&nbsp;<?php echo $this->_var['item']['short_change_desc']; ?></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <tr>
                        <td colspan="5" align="center" bgcolor="#ffffff"><div align="right"><?php echo $this->_var['lang']['current_surplus']; ?><?php echo $this->_var['surplus_amount']; ?></div></td>
                    </tr>
                </table>
                <?php echo $this->fetch('library/pages.lbi'); ?>
                <?php endif; ?>
                <?php if ($this->_var['action'] == "account_detailjf"): ?>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr align="center">
                        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_realname']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_time']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['money']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['paypoints']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['gold_amt']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['change_desc']; ?></td>
                    </tr>
                    <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                    <tr>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_name']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['change_time']; ?></td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['user_money']; ?></td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['award_bal']; ?></td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['pay_points']; ?></td>
                        <td bgcolor="#ffffff" title="<?php echo $this->_var['item']['change_desc']; ?>">&nbsp;&nbsp;<?php echo $this->_var['item']['short_change_desc']; ?></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <tr>
                        <td colspan="5" align="center" bgcolor="#ffffff"><div align="right"><?php echo $this->_var['lang']['current_surplus']; ?><?php echo $this->_var['surplus_amount']; ?></div></td>
                    </tr>
                </table>
                <?php echo $this->fetch('library/pages.lbi'); ?>
                <?php endif; ?>

                <?php if ($this->_var['action'] == "account_log"): ?>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr align="center">
                        <td  bgcolor="#ffffff"><?php echo $this->_var['lang']['myuser_realname']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_time']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['surplus_pro_type']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['money']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['mybankname']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['mybankaddress']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['myname']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['myaccount']; ?></td>

                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_notic']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['admin_notic']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['is_paid']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></td>
                    </tr>
                    <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                    <tr>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['user_name']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['add_time']; ?></td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['type']; ?></td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['amount']; ?></td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['bankname']; ?></td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['bankaddress']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['myname']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['myaccount']; ?></td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['short_user_note']; ?></td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['short_admin_note']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['pay_status']; ?></td>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['handle']; ?>
                            <?php if (( $this->_var['item']['is_paid'] == 0 && $this->_var['item']['process_type'] == 1 ) || $this->_var['item']['handle']): ?>
                            <a href="user.php?act=cancel&id=<?php echo $this->_var['item']['id']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_remove_account']; ?>')) return false;"><?php echo $this->_var['lang']['is_cancel']; ?></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <tr>
                        <td colspan="12" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['current_surplus']; ?><?php echo $this->_var['surplus_amount']; ?></td>
                    </tr>
                </table>
                <?php echo $this->fetch('library/pages.lbi'); ?>
                <?php endif; ?>
                
                
                
                <?php if ($this->_var['action'] == 'address_list'): ?>
                <h5><span><?php echo $this->_var['lang']['consignee_info']; ?></span></h5>
                <div class="blank"></div>
                
                <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,transport.js,region.js,shopping_flow.js')); ?>
                <script type="text/javascript">
                    region.isAdmin = false;
                    <?php $_from = $this->_var['lang']['flow_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                    var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    
                    onload = function() {
                        if (!document.all)
                        {
                            document.forms['theForm'].reset();
                        }
                    }
                    
                </script>
                <?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'consignee');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['consignee']):
?>
                <form action="user.php" method="post" name="theForm" onsubmit="return checkConsignee(this)">
                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['country_province']; ?>：</td>
                            <td colspan="3" align="left" bgcolor="#ffffff"><select name="country" id="selCountries_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 1, 'selProvinces_<?php echo $this->_var['sn']; ?>')">
                                <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></option>
                                <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
                                <option value="<?php echo $this->_var['country']['region_id']; ?>" <?php if ($this->_var['consignee']['country'] == $this->_var['country']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['country']['region_name']; ?></option>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </select>
                                <select name="province" id="selProvinces_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 2, 'selCities_<?php echo $this->_var['sn']; ?>')">
                                    <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></option>
                                    <?php $_from = $this->_var['province_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province');if (count($_from)):
    foreach ($_from AS $this->_var['province']):
?>
                                    <option value="<?php echo $this->_var['province']['region_id']; ?>" <?php if ($this->_var['consignee']['province'] == $this->_var['province']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['province']['region_name']; ?></option>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                                <select name="city" id="selCities_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 3, 'selDistricts_<?php echo $this->_var['sn']; ?>')">
                                    <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></option>
                                    <?php $_from = $this->_var['city_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
                                    <option value="<?php echo $this->_var['city']['region_id']; ?>" <?php if ($this->_var['consignee']['city'] == $this->_var['city']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['city']['region_name']; ?></option>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                                <select name="district" id="selDistricts_<?php echo $this->_var['sn']; ?>" <?php if (! $this->_var['district_list'][$this->_var['sn']]): ?>style="display:none"<?php endif; ?>>
                                <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></option>
                                <?php $_from = $this->_var['district_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
                                <option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['consignee']['district'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['district']['region_name']; ?></option>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                                <?php echo $this->_var['lang']['require_field']; ?> </td>
                        </tr>
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="consignee" type="text" class="inputBg" id="consignee_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?>" />
                                <?php echo $this->_var['lang']['require_field']; ?> </td>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['email_address']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="email" type="text" class="inputBg" id="email_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['email']); ?>" />
                                <?php echo $this->_var['lang']['require_field']; ?></td>
                        </tr>
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="address" type="text" class="inputBg" id="address_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['address']); ?>" />
                                <?php echo $this->_var['lang']['require_field']; ?></td>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['postalcode']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="zipcode" type="text" class="inputBg" id="zipcode_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['zipcode']); ?>" /></td>
                        </tr>
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['phone']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="tel" type="text" class="inputBg" id="tel_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['tel']); ?>" />
                                <?php echo $this->_var['lang']['require_field']; ?></td>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['backup_phone']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="mobile" type="text" class="inputBg" id="mobile_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['mobile']); ?>" /></td>
                        </tr>
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['sign_building']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="sign_building" type="text" class="inputBg" id="sign_building_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['sign_building']); ?>" /></td>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['deliver_goods_time']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="best_time" type="text"  class="inputBg" id="best_time_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['best_time']); ?>" /></td>
                        </tr>
                        <tr>
                            <td align="right" bgcolor="#ffffff">&nbsp;</td>
                            <td colspan="3" align="center" bgcolor="#ffffff"><?php if ($this->_var['consignee']['consignee'] && $this->_var['consignee']['email']): ?>
                                <input type="submit" name="submit" class="bnt_blue_1" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" />
                                <input name="button" type="button" class="bnt_blue"  onclick="if (confirm('<?php echo $this->_var['lang']['confirm_drop_address']; ?>'))location.href='user.php?act=drop_consignee&id=<?php echo $this->_var['consignee']['address_id']; ?>'" value="<?php echo $this->_var['lang']['drop']; ?>" />
                                <?php else: ?>
                                <input type="submit" name="submit" class="bnt_blue_2"  value="<?php echo $this->_var['lang']['add_address']; ?>"/>
                                <?php endif; ?>
                                <input type="hidden" name="act" value="act_edit_address" />
                                <input name="address_id" type="hidden" value="<?php echo $this->_var['consignee']['address_id']; ?>" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                <?php endif; ?>
                
                
                
                <?php if ($this->_var['action'] == 'send_inq_gpos'): ?>
                <h5><span>填写gpos配送地址、收件人等信息</span></h5>
                <div class="blank"></div>
                
                <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,transport.js,region.js,shopping_flow.js')); ?>
                <script type="text/javascript">
                    region.isAdmin = false;
                    <?php $_from = $this->_var['lang']['flow_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                    var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    
                    onload = function() {
                        if (!document.all)
                        {
                            document.forms['theForm'].reset();
                        }
                    }
                    
                </script>
                <?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'consignee');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['consignee']):
?>
                <form action="user.php" method="post" name="theForm" onsubmit="return checkConsignee(this)">
                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['country_province']; ?>：</td>
                            <td colspan="3" align="left" bgcolor="#ffffff"><select name="country" id="selCountries_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 1, 'selProvinces_<?php echo $this->_var['sn']; ?>')">
                                <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></option>
                                <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
                                <option value="<?php echo $this->_var['country']['region_name']; ?>" <?php if ($this->_var['consignee']['country'] == $this->_var['country']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['country']['region_name']; ?></option>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </select>
                                <select name="province" id="selProvinces_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 2, 'selCities_<?php echo $this->_var['sn']; ?>')">
                                    <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></option>
                                    <?php $_from = $this->_var['province_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province');if (count($_from)):
    foreach ($_from AS $this->_var['province']):
?>
                                    <option value="<?php echo $this->_var['province']['region_id']; ?>" <?php if ($this->_var['consignee']['province'] == $this->_var['province']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['province']['region_name']; ?></option>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                                <select name="city" id="selCities_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 3, 'selDistricts_<?php echo $this->_var['sn']; ?>')">
                                    <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></option>
                                    <?php $_from = $this->_var['city_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
                                    <option value="<?php echo $this->_var['city']['region_id']; ?>" <?php if ($this->_var['consignee']['city'] == $this->_var['city']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['city']['region_name']; ?></option>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                                <select name="district" id="selDistricts_<?php echo $this->_var['sn']; ?>" <?php if (! $this->_var['district_list'][$this->_var['sn']]): ?>style="display:none"<?php endif; ?>>
                                <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></option>
                                <?php $_from = $this->_var['district_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
                                <option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['consignee']['district'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['district']['region_name']; ?></option>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                                <?php echo $this->_var['lang']['require_field']; ?> </td>
                        </tr>
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="consignee" type="text" class="inputBg" id="consignee_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?>" />
                                <?php echo $this->_var['lang']['require_field']; ?> </td>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['email_address']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="email" type="text" class="inputBg" id="email_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['email']); ?>" />
                                <?php echo $this->_var['lang']['require_field']; ?></td>
                        </tr>
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="address" type="text" class="inputBg" id="address_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['address']); ?>" />
                                <?php echo $this->_var['lang']['require_field']; ?></td>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['postalcode']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="zipcode" type="text" class="inputBg" id="zipcode_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['zipcode']); ?>" /></td>
                        </tr>
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['phone']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="tel" type="text" class="inputBg" id="tel_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['tel']); ?>" />
                                <?php echo $this->_var['lang']['require_field']; ?></td>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['backup_phone']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="mobile" type="text" class="inputBg" id="mobile_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['mobile']); ?>" /></td>
                        </tr>
                        <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['sign_building']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="sign_building" type="text" class="inputBg" id="sign_building_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['sign_building']); ?>" /></td>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['deliver_goods_time']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><input name="best_time" type="text"  class="inputBg" id="best_time_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['best_time']); ?>" /></td>
                        </tr>
                        <tr>
                            <td align="right" bgcolor="#ffffff">&nbsp;</td>
                            <td colspan="3" align="center" bgcolor="#ffffff"><?php if ($this->_var['consignee']['consignee'] && $this->_var['consignee']['email']): ?>
                                <input type="submit" name="submit" class="bnt_blue_1" value="配送到此处" />
                                <input name="button" type="button" class="bnt_blue"  onclick="if (confirm('<?php echo $this->_var['lang']['confirm_drop_address']; ?>'))location.href='user.php?act=drop_consignee&id=<?php echo $this->_var['consignee']['address_id']; ?>'" value="<?php echo $this->_var['lang']['drop']; ?>" />
                                <?php else: ?>
                                <input type="submit" name="submit" class="bnt_blue_2"  value="配送到这个地址"/>
                                <?php endif; ?>
                                <input type="hidden" name="act" value="act_gpos" />
                                <input name="address_id" type="hidden" value="<?php echo $this->_var['consignee']['address_id']; ?>" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                <?php endif; ?>
                
                                
                
                <?php if ($this->_var['action'] == 'transform_points'): ?>
                <h5><span><?php echo $this->_var['lang']['transform_points']; ?></span></h5>
                <div class="blank"></div>
                <?php if ($this->_var['exchange_type'] == 'ucenter'): ?>
                <form action="user.php" method="post" name="transForm" onsubmit="return calcredit();">
                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                        <tr>
                            <th width="120" bgcolor="#FFFFFF" align="right" valign="top"><?php echo $this->_var['lang']['cur_points']; ?>:</th>
                            <td bgcolor="#FFFFFF">
                                <label for="pay_points"><?php echo $this->_var['lang']['exchange_points']['1']; ?>:</label><input type="text" size="15" id="pay_points" name="pay_points" value="<?php echo $this->_var['shop_points']['pay_points']; ?>" style="border:0;border-bottom:1px solid #DADADA;" readonly="readonly" /><br />
                                <div class="blank"></div>
                                <label for="rank_points"><?php echo $this->_var['lang']['exchange_points']['0']; ?>:</label><input type="text" size="15" id="rank_points" name="rank_points" value="<?php echo $this->_var['shop_points']['rank_points']; ?>" style="border:0;border-bottom:1px solid #DADADA;" readonly="readonly" />
                            </td>
                        </tr>
                        <tr><td bgcolor="#FFFFFF">&nbsp;</td>
                            <td bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                            <th align="right" bgcolor="#FFFFFF"><label for="amount"><?php echo $this->_var['lang']['exchange_amount']; ?>:</label></th>
                            <td bgcolor="#FFFFFF"><input size="15" name="amount" id="amount" value="0" onkeyup="calcredit();" type="text" />
                                <select name="fromcredits" id="fromcredits" onchange="calcredit();">
                                    <?php echo $this->html_options(array('options'=>$this->_var['lang']['exchange_points'],'selected'=>$this->_var['selected_org'])); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th align="right" bgcolor="#FFFFFF"><label for="desamount"><?php echo $this->_var['lang']['exchange_desamount']; ?>:</label></th>
                            <td bgcolor="#FFFFFF"><input type="text" name="desamount" id="desamount" disabled="disabled" value="0" size="15" />
                                <select name="tocredits" id="tocredits" onchange="calcredit();">
                                    <?php echo $this->html_options(array('options'=>$this->_var['to_credits_options'],'selected'=>$this->_var['selected_dst'])); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['exchange_ratio']; ?>:</th>
                            <td bgcolor="#FFFFFF">1 <span id="orgcreditunit"><?php echo $this->_var['orgcreditunit']; ?></span> <span id="orgcredittitle"><?php echo $this->_var['orgcredittitle']; ?></span> <?php echo $this->_var['lang']['exchange_action']; ?> <span id="descreditamount"><?php echo $this->_var['descreditamount']; ?></span> <span id="descreditunit"><?php echo $this->_var['descreditunit']; ?></span> <span id="descredittitle"><?php echo $this->_var['descredittitle']; ?></span></td>
                        </tr>
                        <tr><td bgcolor="#FFFFFF">&nbsp;</td>
                            <td bgcolor="#FFFFFF"><input type="hidden" name="act" value="act_transform_ucenter_points" /><input type="submit" name="transfrom" value="<?php echo $this->_var['lang']['transform']; ?>" /></td></tr>
                    </table>
                </form>
                <script type="text/javascript">
                    <?php $_from = $this->_var['lang']['exchange_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'lang_js');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['lang_js']):
?>
                    var <?php echo $this->_var['key']; ?> = '<?php echo $this->_var['lang_js']; ?>';
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

                    var out_exchange_allow = new Array();
                    <?php $_from = $this->_var['out_exchange_allow']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'ratio');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['ratio']):
?>
                    out_exchange_allow['<?php echo $this->_var['key']; ?>'] = '<?php echo $this->_var['ratio']; ?>';
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

                    function calcredit()
                    {
                        var frm = document.forms['transForm'];
                        var src_credit = frm.fromcredits.value;
                        var dest_credit = frm.tocredits.value;
                        var in_credit = frm.amount.value;
                        var org_title = frm.fromcredits[frm.fromcredits.selectedIndex].innerHTML;
                        var dst_title = frm.tocredits[frm.tocredits.selectedIndex].innerHTML;
                        var radio = 0;
                        var shop_points = ['rank_points', 'pay_points'];
                        if (parseFloat(in_credit) > parseFloat(document.getElementById(shop_points[src_credit]).value))
                        {
                            alert(balance.replace('{%s}', org_title));
                            frm.amount.value = frm.desamount.value = 0;
                            return false;
                        }
                        if (typeof(out_exchange_allow[dest_credit+'|'+src_credit]) == 'string')
                        {
                            radio = (1 / parseFloat(out_exchange_allow[dest_credit+'|'+src_credit])).toFixed(2);
                        }
                        document.getElementById('orgcredittitle').innerHTML = org_title;
                        document.getElementById('descreditamount').innerHTML = radio;
                        document.getElementById('descredittitle').innerHTML = dst_title;
                        if (in_credit > 0)
                        {
                            if (typeof(out_exchange_allow[dest_credit+'|'+src_credit]) == 'string')
                            {
                                frm.desamount.value = Math.floor(parseFloat(in_credit) / parseFloat(out_exchange_allow[dest_credit+'|'+src_credit]));
                                frm.transfrom.disabled = false;
                                return true;
                            }
                            else
                            {
                                frm.desamount.value = deny;
                                frm.transfrom.disabled = true;
                                return false;
                            }
                        }
                        else
                        {
                            return false;
                        }
                    }
                </script>
                <?php else: ?>
                <b><?php echo $this->_var['lang']['cur_points']; ?>:</b>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr>
                        <td width="30%" valign="top" bgcolor="#FFFFFF"><table border="0">
                            <?php $_from = $this->_var['bbs_points']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'points');if (count($_from)):
    foreach ($_from AS $this->_var['points']):
?>
                            <tr>
                                <th><?php echo $this->_var['points']['title']; ?>:</th>
                                <td width="120" style="border-bottom:1px solid #DADADA;"><?php echo $this->_var['points']['value']; ?></td>
                            </tr>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </table></td>
                        <td width="50%" valign="top" bgcolor="#FFFFFF"><table>
                            <tr>
                                <th><?php echo $this->_var['lang']['pay_points']; ?>:</th>
                                <td width="120" style="border-bottom:1px solid #DADADA;"><?php echo $this->_var['shop_points']['pay_points']; ?></td>
                            </tr>
                            <tr>
                                <th><?php echo $this->_var['lang']['rank_points']; ?>:</th>
                                <td width="120" style="border-bottom:1px solid #DADADA;"><?php echo $this->_var['shop_points']['rank_points']; ?></td>
                            </tr>
                        </table></td>
                    </tr>
                </table>
                <br />
                <b><?php echo $this->_var['lang']['rule_list']; ?>:</b>
                <ul class="point clearfix">
                    <?php $_from = $this->_var['rule_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'rule');if (count($_from)):
    foreach ($_from AS $this->_var['rule']):
?>
                    <li><font class="f1">·</font>"<?php echo $this->_var['rule']['from']; ?>" <?php echo $this->_var['lang']['transform']; ?> "<?php echo $this->_var['rule']['to']; ?>" <?php echo $this->_var['lang']['rate_is']; ?> <?php echo $this->_var['rule']['rate']; ?>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>

                <form action="user.php" method="post" name="theForm">
                    <table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" style="border-collapse:collapse;border:1px solid #DADADA;">
                        <tr style="background:#F1F1F1;">
                            <th><?php echo $this->_var['lang']['rule']; ?></th>
                            <th><?php echo $this->_var['lang']['transform_num']; ?></th>
                            <th><?php echo $this->_var['lang']['transform_result']; ?></th>
                        </tr>
                        <tr>
                            <td>
                                <select name="rule_index" onchange="changeRule()">
                                    <?php $_from = $this->_var['rule_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'rule');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['rule']):
?>
                                    <option value="<?php echo $this->_var['key']; ?>"><?php echo $this->_var['rule']['from']; ?>-><?php echo $this->_var['rule']['to']; ?></option>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="num" value="0" onkeyup="calPoints()"/>
                            </td>
                            <td><span id="ECS_RESULT">0</span></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center"><input type="hidden" name="act" value="act_transform_points"  /><input type="submit" value="<?php echo $this->_var['lang']['transform']; ?>" /></td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    //<![CDATA[
                    var rule_list = new Object();
                    var invalid_input = '<?php echo $this->_var['lang']['invalid_input']; ?>';
                    <?php $_from = $this->_var['rule_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'rule');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['rule']):
?>
                    rule_list['<?php echo $this->_var['key']; ?>'] = '<?php echo $this->_var['rule']['rate']; ?>';
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    function calPoints()
                    {
                        var frm = document.forms['theForm'];
                        var rule_index = frm.elements['rule_index'].value;
                        var num = parseInt(frm.elements['num'].value);
                        var rate = rule_list[rule_index];

                        if (isNaN(num) || num < 0 || num != frm.elements['num'].value)
                        {
                            document.getElementById('ECS_RESULT').innerHTML = invalid_input;
                            rerutn;
                        }
                        var arr = rate.split(':');
                        var from = parseInt(arr[0]);
                        var to = parseInt(arr[1]);

                        if (from <=0 || to <=0)
                        {
                            from = 1;
                            to = 0;
                        }
                        document.getElementById('ECS_RESULT').innerHTML = parseInt(num * to / from);
                    }

                    function changeRule()
                    {
                        document.forms['theForm'].elements['num'].value = 0;
                        document.getElementById('ECS_RESULT').innerHTML = 0;
                    }
                    //]]>
                </script>
                <?php endif; ?>
                <?php endif; ?>
                




            </div>
        </div>
    </div>
</div>

</div>
<div class="blank"></div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
<script type="text/javascript">
    <?php $_from = $this->_var['lang']['clips_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
    var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</script>
</html>
