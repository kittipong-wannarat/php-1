<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');
include("../../include/classes/class.mysql.php");
need_manager();



if ( $_POST ) {

	$mysql = New mysql("localhost", "root", "", "my_dealb", "");


	$sql="SELECT remark,redirect_id,aeon.id,FROM_UNIXTIME(create_time, '%d%m%Y%h%i') AS order_date, ";
	$sql.="origin,member_id,team_id,quantity,price,user_id,price+fare AS amount ";
	$sql.="FROM `aeon` INNER JOIN `order` WHERE aeon.id=order.id AND remark IS NOT NULL";

	$list = array (
			array('Column Type', 'System Redirect ID*', 'EC Order No*', 'Order Date*', 'Payment Date*', 'Total amount* (Order/Item)', 'Payment Amount*', 'System EC ID*', 'System Member ID*', 'EC Product ID', 'System Product ID', 'Quantity*', 'Amount*', 'BIN No.*',  'Approval Code*', 'Ref.1 (EC Shop ID Ref, Item Name)', '(EC Member ID Ref, Item Ref)')
	);


	$mysql->query($sql);


	if ($mysql->num_rows() > 0) {
		//$cols=mysql_num_fields($mysql->rstemp);
		while ($mysql->movenext()) {


			$system_redirect_id=$mysql->getfield("redirect_id");	//O  	sys 	redirect_id	OK
			$ec_order_no=$mysql->getfield("remark");					//OI 	ec   	remark 	OK
			$order_date=$mysql->getfield("order_date"); 			//O 	ec  	create_time OK
			$payment_date=$order_date; 								//O 	ec	''		OK
			$total_amount=$mysql->getfield("origin")*100; 				//OI 	ec     	origin 		OK
			$payment_amount=$total_amount; 							//O  	ec	''		OK
			$system_ec_id="A00001"; 							//OI 	sys 				xxxx
			$system_member_id=$mysql->getfield("member_id"); 		//OI 	sys     member_id	OK
			$ec_product_id=$mysql->getfield("team_id"); 			//I    	ec		team id		OK
			$system_product_id=""; 									//O  	sys 	null   		OK
			$quantity=$mysql->getfield("quantity");					//I 	ec  	quantity    OK
			$amount=$mysql->getfield("amount");							//I 	ec		price + fare		OK
			$bin_no="bin_no"; 										//OI 	ec  				xxxx
			$approval_code="approval_code";  						//OI 	ec 		p ning   	xxxx
			$ref_1=""; 												//OI  	sys 	null
			$ec_member_id=$mysql->getfield("user_id"); 				//OI 	ec  	user_id

			array_push($list,

					array('O', $system_redirect_id, $ec_order_no, $order_date, $payment_date, $total_amount, $payment_amount, $system_ec_id, $system_member_id, '' , $system_product_id, '', '', $bin_no, $approval_code, $ref_1, $ec_member_id),

					array('I', '', $ec_order_no, '', '', $total_amount, '', $system_ec_id, $system_member_id, $ec_product_id , '', $quantity, $amount, $bin_no, $approval_code, $ref_1, $ec_member_id)

			);
		}

	}
	//outputCSV($list);
	//print_r($list);

	header("Content-type: application/vnd.ms-excel");
	// It will be called downloaded.pdf
	header('Content-Disposition: attachment; filename="report_daily'.date('Ymd').'.csv"');

	foreach ($list as $v1) {
		foreach ($v1 as $k => $v2) {
			$s=",";
			if ($k==16){
				$s="";
			}

			echo '"'.$v2.'"'.$s;
		}
		echo substr($output,0,-1)."\015\012";
	}
}
else
	include template('manage_market_downdaeon');
