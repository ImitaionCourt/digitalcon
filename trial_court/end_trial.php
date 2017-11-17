<?php
	$DB_host="localhost";
	$DB_user="Circler";
	$DB_pw="Circler";
	$DB_name = 'digital_con';
	$DB_connect=mysqli_connect($DB_host,$DB_user,$DB_pw,$DB_name); //$mysqli = new mysqli($host, $user, $pw, $dbName);		
?>
<?php
	require_once('DB_connect_for_trial_court.php');
	$DB_SQL_query="UPDATE trial_board SET is_live=0 WHERE no={$_POST['end_switch']};";
	$result=mysqli_query($DB_connect,$DB_SQL_query);
?>
<?php
	echo "<script>alert('Let\'s end trial!');</script>";
	echo "<meta http-equiv='refresh' content='0;url=/digitalcon/trial_board_past'>";
?>