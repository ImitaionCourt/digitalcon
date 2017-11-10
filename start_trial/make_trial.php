<?php
	$EventName = $_POST['EventName'];
	$Profession = $_POST['Profession'];
	$Time = $_POST['Time'];
	require_once('DB_connect_for_start_trial.php');
	if($DB_connect){	
		$DB_SQL_query="INSERT INTO trial_board (`no`, `EventName`, `Profession`, `Profession2`, `time`, `vote_agree`, `vote_disagree`,`is_live`) VALUES (NULL, '{$EventName}', '{$Profession}', '', '{$Time}', '0', '0','1');";
		//echo $DB_SQL_query."<br>";
		mysqli_query($DB_connect,$DB_SQL_query) or die('query error');
		echo "<script>alert('Go~');</script>";
		echo "<meta http-equiv='refresh' content='0;url=/digitalcon/trial_board_live'>";
	}
	else{
		die("Connect Failed OTL");
	}
?>