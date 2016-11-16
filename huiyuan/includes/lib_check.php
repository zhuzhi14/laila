<?php 

	//银行卡号校验
    //Description:  银行卡号Luhm校验
    //Luhm校验规则：16位银行卡号（19位通用）:
    // 1.将未带校验位的 15（或18）位卡号从右依次编号 1 到 15（18），位于奇数位号上的数字乘以 2。
    // 2.将奇位乘积的个十位全部相加，再加上所有偶数位上的数字。
    // 3.将加法和加上校验位能被 10 整除。


function luhmCheck($s) {
  $n = 0;
  $len=(strlen($s)-1) % 2 ;
//  var_dump(strlen($s)) ;
  for ($i = strlen($s); $i >= 1; $i--) {
    $index=$i-1;
    //偶数位
    if (($index % 2)==$len) {
      $n += $s{$index};
    } else {//奇数位
      $t = $s{$index} * 2;
      if ($t > 9) {
        $t = (int)($t/10)+ $t%10;
      }
      $n += $t;
    }
  }
  return ($n % 10) == 0;
}

/**
 * 验证身份证号
 * @param $vStr
 * @return bool
 */
function isPidNo($vStr)
{
    $vCity = array(
        '11','12','13','14','15','21','22',
        '23','31','32','33','34','35','36',
        '37','41','42','43','44','45','46',
        '50','51','52','53','54','61','62',
        '63','64','65','71','81','82','91'
    );

    if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) return false;

    if (!in_array(substr($vStr, 0, 2), $vCity)) return false;

    $vStr = preg_replace('/[xX]$/i', 'a', $vStr);
    $vLength = strlen($vStr);

    if ($vLength == 18)
    {
        $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
    } else {
        $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
    }

    if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;
    if ($vLength == 18)
    {
        $vSum = 0;

        for ($i = 17 ; $i >= 0 ; $i--)
        {
            $vSubStr = substr($vStr, 17 - $i, 1);
            $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr , 11));
        }

        if($vSum % 11 != 1) return false;
    }

    return true;
}

?>
