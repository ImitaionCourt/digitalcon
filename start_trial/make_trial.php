<?php
	@session_start();
	if(!$_SESSION){
		echo '<script>';
		echo "alert('You need Login!'); history.go(-1);";
		echo '</script>';
	}
?>
<?php
	$EventName = $_POST['EventName'];
	$Profession = $_POST['Profession'];
	$Time = $_POST['Time'];
	if($Profession==='Plaintiff'){
		 /*방장이 Plaintiff*/$DB_SQL_query="INSERT INTO trial_board (`no`, `EventName`, `Plaintiff`, `Defendant`, `time`, `vote_agree`, `vote_disagree`,`is_live`,`vote_total`) VALUES (NULL, '{$EventName}', '{$_SESSION['username']}', '', '{$Time}', '0', '0','1','100');";
	}
	else if($Profession==='Defendant'){
		/*방장이 Defendant*/$DB_SQL_query="INSERT INTO trial_board (`no`, `EventName`, `Plaintiff`, `Defendant`, `time`, `vote_agree`, `vote_disagree`,`is_live`, `vote_total`) VALUES (NULL, '{$EventName}', '', '{$_SESSION['username']}', '{$Time}', '0', '0','1','100');";
	}
	else die("NOP");
	
		
	
	require_once('DB_connect_for_start_trial.php');
	if($DB_connect){	
		//echo $DB_SQL_query."<br>";
		mysqli_query($DB_connect,$DB_SQL_query) or die('query error');
		$Sub_DB_SQL_query="select max(no) from trial_board;";
		$Sub_result = mysqli_query($DB_connect,$Sub_DB_SQL_query) or die('query error2');
		$Sub_R=mysqli_fetch_assoc($Sub_result);
		echo "<script>alert('Go~');</script>";
		echo "<meta http-equiv='refresh' content='0;url=/digitalcon/trial_court?no={$Sub_R['max(no)']}'>";
	}
	else{
		die("Connect Failed OTL");
	}
?>



<?php
?>