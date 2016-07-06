/* 
version :1.0
requeriment: jquery-1.10.2.js
creator: omar Angelino
url : www.zuaru.com

method includes:
CreateChat(user_invite) // Crea un chat entre el usuario creado  y el usuario invitado y se abre automaticamente
OpenChat(code_chat); //  abre un chat ya existente
*/
// jQuery Document
$(document).ready(function(){
	function createMsg()
	{
		var chatContainer = $("<div></div>");
		chatContainer.attr('id',"chat_container");
		
		var audioc = $("<audio id='audio' src='messagealert.mp3' autostart='false' ></audio>");
		chatContainer.append(audioc);
		
		$("body").append(chatContainer);
		setInterval (checkNewChat, 5000);
	}
	
	createMsg ();
});

//Load the file containing the chat log
	function checkNewChat(){
		var chatcode = new Array(); 
		for (var i=0 ; i<$(".chatcode").length ; i++){
			var idchat = $(".chatcode")[i].value;
			chatcode.push(idchat);   
		}
		$.ajax({
			url: "/execution/zuaruchat/",
			cache: false,
			dataType: "json",
			method:"post",
			data: {'chatcodes': chatcode, "chatmethod": "check" },
			success: function(data)
			{	
				if(data.newdata)
				{
					for(var i=0; i<data.row.length ; i++)
					{
						addChat(data.row[i],data.username);
					}
				}
			},
		});
	}
	

	function createClickEvent(chatContainer,inputsubmit,inputchatcode,inputmsg,chatbox,logout,chatMenu,chatc,chatMenuIcon,idchat)
	{	//If user click the menu bar
		chatMenu.click(function()
		{	
			if(chatc.hasClass( "message_container_close" ))
			{	
				chatc.addClass("message_container_open");
				chatc.removeClass("message_container_close");
			}else{
				chatc.addClass("message_container_close");
				chatc.removeClass("message_container_open");
			}
		});
		//If user submits the form
		inputsubmit.click(function()
		{	
			var clientmsg = inputmsg.val();
			var chat = inputchatcode.val();
			inputmsg.val("");
			$.ajax({
				method:"post",
				url: "/execution/zuaruchat/",
				cache: false,
				data:'text='+clientmsg+'&chatcode='+idchat+"&chatmethod=write",
				datatype: 'json',
				success: function(data){
				},
			});
			return false;
		});
		
		//check if there are new msg 
		var refreshIntervalId = setInterval(function ()
		{ 
			var oldscrollHeight = chatbox.attr("scrollHeight") - 20; //Scroll height before the request
			$.ajax({
				method:"post",
				url: "/execution/zuaruchat/",
				cache: false,
				data:'chatcode='+idchat+"&chatmethod=read",
				dataType: 'json',
				success: function(data){		
					chatbox.html(data.message); //Insert chat log into the #chatbox div	
					
					if(data.isonline)
					{
						chatMenuIcon.addClass("online");
						chatMenuIcon.removeClass("offline");
					}else{
						chatMenuIcon.addClass("offline");
						chatMenuIcon.removeClass("online");
					}
					
					if(data.newdata)
					{	
						//Auto-scroll		
						chatbox.scrollTop(9999);
						if(chatc.hasClass( "message_container_close" ))
						{
							var colorIntervalId = setInterval(function ()
							{
								if(chatMenu.hasClass( "normal" ))
								{	
									chatMenu.addClass("alert");
									chatMenu.removeClass("normal");
								}else{
									chatMenu.addClass("normal");
									chatMenu.removeClass("alert");
								}
							}, 500);
							chatMenu.click(function()
							{	
								if(!chatMenu.hasClass( "normal" ))
								{	
									chatMenu.addClass("normal");
									chatMenu.removeClass("alert");
								}
								clearInterval(colorIntervalId);
							});
						}
						beep();
					}						
				},
			});
		}, 2500);
		
		logout.click(function()
		{	
			clearInterval(refreshIntervalId);
			chatContainer.remove();
		});
	}
	
	function addChat(chatCode,username)
	{
		var chatContainer = $("<div></div>");
		chatContainer.addClass( "chat_container");
		chatContainer.attr('id',"wrapper_"+chatCode);
		// menu
		var chatMenu = $("<div></div>");
		chatMenu.addClass("menu");
		chatMenu.addClass("normal");
						
		var chatMenuName = $("<p></p>");
		var chatMenuIcon = $("<div></div>");
		chatMenuName.addClass("welcome");
						
		var chatMenuIcon = $("<div></div>");
		chatMenuIcon.addClass("offline");
		chatMenuName.append( chatMenuIcon );
						
		var chatMenuNameBolt = $("<b> "+username+" </b>");
		chatMenuName.append( chatMenuNameBolt );
						
		var logout = $("<p></p>"); 
		logout.addClass("logout");
						
		var logoutIcon = $("<div>X</div>");
		logoutIcon.addClass("logouticon");
		logout.append( logoutIcon );
						
		chatMenuName.append( logout );
						
		var divmenu = $("<div style='clear:both'></div>"); 
						
		chatMenu.append( chatMenuName );
		chatMenu.append( logout );
		chatMenu.append( divmenu);
		chatContainer.append( chatMenu);
		//end menu
		//chatcointaner
		var chatc = $("<div></div>");
		chatc.addClass( "message_container_close");
		//chatbox
		var chatbox = $("<div></div>");
		chatbox.addClass( "chatbox");
		chatbox.attr('id',"chatbox_"+chatCode);
		chatc.append(chatbox);
		// end chatbox
		//form
		var form = $("<form name='message' action='/post.php' method='post'></form>");
						
		var inputmsg = $("<input name='usermsg' type='text' id='usermsg_"+chatCode+"' size='63' autocomplete='off'/>");
		inputmsg.addClass( "usermsg");
		var inputchatcode = $("<input name='chatcode' type='hidden' value="+chatCode+" class='chatcode' />");
		var inputsubmit = $("<input name='submitmsg' type='submit'  id='"+chatCode+"' value='Send' />");
		createClickEvent(chatContainer,inputsubmit,inputchatcode,inputmsg,chatbox,logout,chatMenu,chatc,chatMenuIcon,chatCode);
		form.append(inputmsg);
		form.append(inputchatcode);
		form.append(inputsubmit);
		chatc.append(form);
		//end form
		chatContainer.append(chatc);
		//chatcointaner
		$("#chat_container").append(chatContainer);
	}
	function beep() {
	   var sound = document.getElementById("audio");
	   sound.play()
	}

	function CreateChat(id_user_invite)
	{
		$.ajax({
				method:"post",
				url: "/execution/zuaruchat/",
				cache: false,
				data:'user_invite='+id_user_invite+"&chatmethod=create",
				dataType: 'json',
				success: function(data){
				addChat(data.chatcode,data.username);
			},
		});
	}

	function OpenChat(code_chat)
	{
		$.ajax({
				method:"post",
				url: "/execution/zuaruchat/",
				cache: false,
				data:'code_chat='+code_chat+"&chatmethod=open",
				dataType: 'json',
				success: function(data){
					addChat(data.chatcode,data.username);
			},
		});
	}

