var instanse = false;
var state;
var mes;
var file;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
	this.getState = getStateOfChat;
}


function getStateOfChat(fdsa){
	if(!instanse){
		 instanse = true;
		 $.ajax({
			   type: "POST",
			   url: "process.php",
			   data: {  
			   			'function': 'getState',
						'file': file,
						'court_no': fdsa
						},
			   dataType: "json",
			
			   success: function(data){
				   console.log(name);
			   console.log(file);
				   state = data.state;
				   instanse = false;
			   },
			});
	}	 
}


function updateChat(fdsa){
	 if(!instanse){
		 instanse = true;
	     $.ajax({
			   type: "POST",
			   url: "process.php",
			   data: {  
			   			'function': 'update',
						'state': state,
						'file': file,
						'court_no': fdsa
						},
			   dataType: "json",
			   success: function(data){
			   console.log(file);
			   console.log(state);
				   if(data.text){
						for (var i = 0; i < data.text.length; i++) {
                            $('#chat-area').append($(data.text[i]));
                            //$('#chat-area').append($("<div>"+ data.text[i] +"</div>"));
                        }								  
				   }
				   document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
				   instanse = false;
				   state = data.state;
			   },
			});
	 }
	 else {
		 setTimeout(updateChat, 1500);
	 }
}


function sendChat(message, username, asdf, fdsa)
{       
    updateChat(no);
      $.ajax({
		   type: "POST",
		   url: "process.php",
		   data: {  
		   			'function': 'send',
					'message': message,
					'username': name,
					'file': file,
					'court_job': asdf,
					'court_no': fdsa,
				 },
		   dataType: "json",
		   success: function(data){
			   console.log(name);
			   console.log(file);
			   console.log(asdf);
			   console.log(fdsa);
			   updateChat(fdsa);
		   },
		});
}
