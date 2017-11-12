<?php
	require_once('DB_connect_for_trial_board_live.php');
	$DB_SQL_query="select * from trial_board where is_live=1";
	$result=mysqli_query($DB_connect,$DB_SQL_query);
	if($result){
		$cnt=mysqli_num_rows($result);
		echo $cnt."<br>";
		while($R=mysqli_fetch_assoc($result)){
			echo "asdf~~~".$R['no']." | ".$R['Profession']." | ".$R['time']."<br>";
		}
	}
	else{
		echo "Query error";
	}
?>