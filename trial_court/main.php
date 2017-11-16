<?php
	//세션설정
	@session_start();
	if(!$_SESSION){
		echo '<script>';
		echo "alert('You need Login'); history.go(-1);";
		echo '</script>';
	}
?>
<?php
	require_once('DB_connect_for_trial_court.php');
	$DB_SQL_query="select * from trial_board where no={$_GET['no']}";
	$result=mysqli_query($DB_connect,$DB_SQL_query);
	$R=mysqli_fetch_assoc($result);
	if($R['is_live']==0){
		include('trial_court_past.php');
	}
	else{
		include('trial_court_live.php');
	}
?>