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

  function convertTypeName($str, $ind) {
    if ($ind == 1) {
      $tname = ($str == 'writer')?'เขียนบทความ':'อ่านบทความ';
    } else {
      $tname = ($str == 'pending')?'รออุนมัติ':'ไม่อุนมัติ';
    }
    return $tname;
  }
?>
