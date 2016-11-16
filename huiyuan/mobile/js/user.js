/* $Id : user.js 2015-11-8 create by guo $ */

function sum_award_amount(allamount, inamount, award_bl)
{
//	alert(allamount) ;
	if (inamount > allamount) {
		alert('输入金额错误大于可提款金额,请重新输入!') ;
		return false ;
	}
	if (inamount.length == 0 || inamount < 10) {
		alert('输入金额错误,请重新输入!') ;
		return false ;
	}
	var pamount = (inamount*1).toFixed(2) ;
	if (pamount == null || pamount == 'NaN') {
		alert('输入金额错误,请重新输入!') ;
		return false ;		
	}
	var balance = (pamount * (100 - award_bl) / 100).toFixed(2);
	
	document.getElementById('amount').value=pamount ;
	document.getElementById('s_amount').value=balance ;
	return true ;
}

function sum_gold_amount(balance,award_bal,gold_amt, inamount)
{
//	alert(allamount) ;
	allamount = 0 ;
	tftype = document.getElementById('tftype').value ;
	if (tftype == '0' || tftype == null) {
		alert('请选择转账货币类型!') ;
		return false ;		
	}
	if (tftype == 'balance')
		allamount = balance ;
	else if (tftype == 'award_bal')
		allamount = award_bal ;
	else allamount = gold_amt ;
	
	if (inamount > allamount) {
		alert('输入金额错误大于可提款金额,请重新输入!') ;
		return false ;
	}
	if (inamount.length == 0 || inamount < 10) {
		alert('输入金额错误,请重新输入!') ;
		return false ;
	}
	
	var pamount = (inamount*1).toFixed(2) ;
	if (pamount == null || pamount == 'NaN') {
		alert('输入金额错误,请重新输入!') ;
		return false ;		
	}
	var abalance = 0 ;
	if (tftype == 'balance')
		abalance = pamount ;
	else abalance = (pamount * (0.985)).toFixed(2);
	
	document.getElementById('amount').value=pamount ;
	document.getElementById('s_amount').value=abalance ;
	return true ;
}

/* *
 * 处理用户信息
 */
function get_user_name(user_phone)
{
//  alert(user_phone) ;
  if (user_phone == '')
  { 
	  return false ;
  }

  Ajax.call( 'user.php?act=get_user_name', 'phone=' + user_phone, get_user_name_callback , 'GET', 'TEXT', true, true );
}

function get_user_name_callback(result)
{
  if ( result == 'false' )
  {
	  alert("用户不存在或不能转入金币！") ;
	  document.getElementById('s_username').value = '';
  }
  else
  {
	  document.getElementById('s_username').value = result ;
  }
}

function changeStockDate(stocknum)
{
    var pathName=window.document.location.pathname;
    var projectName=pathName.substring(0,pathName.substr(1).indexOf('/')+1);
    if (stocknum == 1) {
		document.getElementById('imgtitle').innerText = '一周股票走势图';//projectName+
		document.getElementById('imgname').src = projectName+"/images/stocks/week.png";
    } if (stocknum == 2) {
		document.getElementById('imgtitle').innerText = '一月股票走势图';
		document.getElementById('imgname').src = projectName+"/images/stocks/month.png";
    } if (stocknum == 3) {
		document.getElementById('imgtitle').innerText = '三月股票走势图';
		document.getElementById('imgname').src = projectName+"../images/stocks/3month.png";
	}
}

