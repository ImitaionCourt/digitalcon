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
?>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Court</title>
    
    <link rel="stylesheet" href="style.css" type="text/css" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">
    
        // ask user for name with popup prompt    
        var name = "<?php echo $_SESSION['username']; ?>";
    	
    	// strip tags
    	name = name.replace(/(<([^>]+)>)/ig,""); // 이름에 태그 들어가는거 삭제함
    	
    	// display name on page
    	$("#name-area").html("You are: <span>" + name + "</span>"); // 화면에 이름 출력해 주는건데 오류난다 ㅠㅠ
    	
    	// kick off chat
        var chat =  new Chat();
    	$(function() {
    	
    		 chat.getState(); 
    		 
    		 // watch textarea for key presses
             $("#sendie").keydown(function(event) {  
             
                 var key = event.which;  
           
                 //all keys including return.  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength");  
                     var length = this.value.length;  
                     
                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                  }  
    		 																																																});
    		 // watch textarea for release of key press
    		 $('#sendie').keyup(function(e) {	
    		 					 
    			  if (e.keyCode == 13) { 
    			  
                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
    			        chat.send(text, name);	
    			        $(this).val("");
    			        
                    } else {
                    
    					$(this).val(text.substring(0, maxLength));
    					
    				}	
    				
    				
    			  }
             });
            
    	});
    </script>

</head>

<body onload="setInterval('chat.update()', 1000)">

    <div id="page-wrap">
    
        <h2>Court</h2>
        
        <p id="name-area"></p>
        
        <div id="chat-wrap"><div id="chat-area"></div></div>
        
        <form id="send-message-area">
		<?php
			if($_SESSION['username']==$R['Plaintiff'] || $_SESSION['username']==$R['Defendant']){
			echo "<p>Your Speaking: </p>";
            echo "<textarea id='sendie' maxlength = '10000' ></textarea>";
			}
			?>
        </form>
    
    </div>

</body>

</html>