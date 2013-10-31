<?php
// ต้นเดือนจะเป็นวันที่ 1 เสมอ
$first = 1;
// หาวันสุดท้ายของเดือน
$last = cal_days_in_month( CAL_GREGORIAN , date("m") , date("Y") ) ;
// สร้างตัวแปรอะเรย์ไว้เก็บวันจันทร์
$mondays = array();

for( $i=$first; $i<=$last; $i++){
	//เช็กว่าเป็นวันจันทร์หรือเปล่า ถ้าใช่ยัดใส่อะเรย์
	$cur = strtotime(date("m")."/".$i."/".date("Y"));
	//$cur2=date("m")."/".$i."/".date("Y");
	$cur2=date("l", $cur);
	if( date("l", $cur) == "Monday" ){
		array_push($mondays, $cur);
	}
	//echo $cur2."<br>";
	echo $cur."<br>";
}

//เมื่อพ้น loop แสดงอะเรย์ตัวสุดท้าย มันจะเป็นจันทร์สุดท้ายของเดือน
echo date("d-m-Y", $mondays[count($mondays)-1])."<br>";
echo $last."<br>";

