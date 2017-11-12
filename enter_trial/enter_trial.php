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
	require_once('DB_connect_for_enter_trial.php');
	$DB_SQL_query="select * from trial_board where is_live=1 and no={$_POST['no']}";
	$result=mysqli_query($DB_connect,$DB_SQL_query);
	if($result){
		$R=mysqli_fetch_array($result);
			if(empty($R['Defendant'])==0 && empty($R['Plaintiff'])==0){ // 둘 다 자리가 찼으면
				echo "<script>";
				echo "alert('There is no play you can do... Please refresh.')";
				echo "history.go(-1);";
				echo "</script>";
			}
			else{
				if(empty($R['Defendant'])){
					$DB_SQL_query="UPDATE trial_board SET Defendant = '{$_SESSION['username']}' WHERE no = {$_POST['no']};";
					mysqli_query($DB_connect,$DB_SQL_query);
				}
				else{
					$DB_SQL_query="UPDATE trial_board SET Plaintiff = '{$_SESSION['username']}' WHERE no = {$_POST['no']};";
					mysqli_query($DB_connect,$DB_SQL_query);
				}
				echo "<script>alert('Let\'s trial~');</script>";
				echo "<meta http-equiv='refresh' content='0;url=/digitalcon/trial_board_live'>";
			}
	}
	else{
		echo "<script>";
		echo "alert('There is no play you can do... Please refresh.')";
		echo "history.go(-1);";
		echo "</script>";
	}
?>