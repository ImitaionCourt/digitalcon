<?php

    $function = $_POST['function'];
    $log = array();
    $file_name="court_log_{$_POST['court_no']}.html";
    //$file_name="akskdhfldlkjh.txt";
    switch($function) {
    	 case('getState'):
        	 if(file_exists($file_name)){
               $lines = file($file_name);
        	 }
             $log['state'] = count($lines); 
        	 break;
			 
    	 case('update'):
        	$state = $_POST['state'];
        	if(file_exists($file_name)){
        	   $lines = file($file_name);
        	 }
        	 $count =  count($lines);
        	 if($state == $count){
        		 $log['state'] = $state;
        		 $log['text'] = false;
        		 
        		 }
        		 else{
        			 $text= array();
        			 $log['state'] = $state + count($lines) - $state;
        			 foreach ($lines as $line_num => $line)
                       {
        				   if($line_num >= $state){
                         $text[] =  $line = str_replace("\n", "", $line);
        				   }
         
                        }
        			 $log['text'] = $text; 
        		 }
        	  
             break;
    	 
    	 case('send'):
		  $username = htmlentities(strip_tags($_POST['username']));
			 $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
			  $message = htmlentities(strip_tags($_POST['message']));
		 if(($message) != "\n"){
        	
			 if(preg_match($reg_exUrl, $message, $url)) {
       			$message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
				} 
        	 $fp=fopen($file_name, 'a');
		 fwrite($fp, "<div id=".$_POST['court_job']."><p><span style='color:white;font-weight:bold; border-radius:5px;'>". $username . "</span>&nbsp;" . $message = str_replace("\n", " ", $message) . "</p></div>\n"); 
		 }
        	 break;
    	
    }
    
    echo json_encode($log);

?>