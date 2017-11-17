<?php
	@session_start();
	if(!$_SESSION){
		echo '<script>';
		echo "alert('You need Login!'); history.go(-1);";
		echo '</script>';
	}
?>
<?php
	require_once('DB_connect_for_vote_log.php');
	$DB_SQL_query="select * from trial_board where is_live=0 and no={$_POST['no']}";
	$result=mysqli_query($DB_connect,$DB_SQL_query);
	if($result){
		$R=mysqli_fetch_assoc($result);
		if($R['vote_total']<=0){
			echo "<script>alert('더는 투표를 진행할수 없습니다.'); location.go(-1);</script>";
		}
		else{
			if($_POST['vote_side']=='vote_agree'){
				$temp_cnt=$R['vote_agree']+1;
				$temp_cnt_total=$R['vote_total']-1;
				$SUB_DB_SQL_query="UPDATE trial_board SET vote_agree = {$temp_cnt} WHERE no = {$_POST['no']};";
				mysqli_query($DB_connect,$SUB_DB_SQL_query);
				$SUB_DB_SQL_query="UPDATE trial_board SET vote_total = {$temp_cnt_total} WHERE no = {$_POST['no']};";
				mysqli_query($DB_connect,$SUB_DB_SQL_query);
			}
			else{
				$temp_cnt=$R['vote_disagree']+1;
				$temp_cnt_total=$R['vote_total']-1;
				$SUB_DB_SQL_query="UPDATE trial_board SET vote_disagree = {$temp_cnt} WHERE no = {$_POST['no']};";
				mysqli_query($DB_connect,$SUB_DB_SQL_query);
				$SUB_DB_SQL_query="UPDATE trial_board SET vote_total = {$temp_cnt_total} WHERE no = {$_POST['no']};";
				mysqli_query($DB_connect,$SUB_DB_SQL_query);
			}
		}
	}
	echo "<meta http-equiv='refresh' content='0;url=/digitalcon/trial_board_past'>";
?>