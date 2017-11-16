<?php

    $function = $_POST['function'];
    
    $log = array();
    
    switch($function) {
    	 case('getState'):
        	 if(file_exists('court.txt')){
               $lines = file('court.txt');
        	 }
             $log['state'] = count($lines); 
        	 break;
			 
    	 case('update'):
        	$state = $_POST['state'];
        	if(file_exists('court.txt')){
        	   $lines = file('court.txt');
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
			 //$no=$_POST['no'];
			 $file_name="court.txt";
        	 $fp=fopen($file_name, 'a');
        	 fwrite($fp, "<div id='test'><p><span style='background-color:black;color:white;font-weight:bold; border-radius:5px;'>". $username . "</span>&nbsp;" . $message = str_replace("\n", " ", $message) . "</p></div>\n"); 
		 }
        	 break;
    	
    }
    
    echo json_encode($log);

?>