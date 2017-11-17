<?php
	echo "<style>";
	echo "#Plaintiff span{
		 background-color:blue;
		}
		#Defendant span{
		 background-color:red;
		}";
	echo "</style>";
	$file_name="./court_log_{$_GET['no']}.html";
	include($file_name);
?>