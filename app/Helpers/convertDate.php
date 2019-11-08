<?php
  function DateThai($strDate)	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear $strHour:$strMinute น.";
	}

  function convertTypeName($str, $strCheck = null, $ind) {
    if ($ind == 1) {
      if ($str == 'writer') {
        $tname = 'เขียนบทความ';
      } elseif ($str == 'reader') {
        $tname = 'อ่านบทความ';
      } elseif ($str == 'approve') {
        $tname = ($strCheck == 'writer')?'เขียนบทความ':'อ่านบทความ';
      } else {
        $tname = '-';
      }
    } else {
      if ($str == 'pending') {
        $tname = ($strCheck == 'noapprove')?"<span class='Ndot'></span>&nbsp;&nbsp;ไม่อนุมัติ":"<span class='Pdot'></span>&nbsp;&nbsp;รออนุมัติ";
      } else {
        if (auth()->user()->role_pending == 'admin') {
          $tname = "<span class='Adot'></span>&nbsp;&nbsp;ใช้งาน";
          return $tname;
        }
      $tname = ($strCheck == 'approve')?"<span class='Adot'></span>&nbsp;&nbsp;อนุมัติ":"<span class='Pdot'></span>&nbsp;&nbsp;ไม่อนุมัติ";
      }
    }
    return $tname;
  }

  function typeAdmin($str) {
    $str = ($str == 'admin')?"<span class='Adot'></span>&nbsp;&nbsp;ใช้งาน":"<span class='Ndot'></span>&nbsp;&nbsp;ไม่ใช้งาน";
    return $str;
  }
