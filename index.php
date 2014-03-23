<html>
<head>
<title>  Caesar Cipher Encoder/Decoder</title>
</head>
<body>

<?php

	echo '<h1>Caesar Cipher Encoder/Decoder</h1>';
	
?>
<form name="sample">
	<table width=100%>
	
	<div id="ceaser-message" class="ceaser-message">
		<label>Message:</label>
		<textarea name="message" type="textarea"></textarea>
	</div>
	
	<p id="ceaser-descp" class="ceaser-descp">
		* PS: The default shift Value is Ceaser's favourite 3. For a custom Shift value, Add it at the end of the massage with a pipe ('|') symbol. e.g. "ANSHHDBG HSF GSVSJ H HS|11".
	</p>
	
	<input type=submit name=submit value='Decode'> <input type=button value='Clear' onclick='this.form.elements.msg.value=""'>
	
	<div id="ceaser-result" class="ceaser-result">
		<label>Result:</label>
		<div class="ceaser-result inner">
			
		</div>
		<p id="loading" class="">Loading...</p>
	</div>	
	
	<p id="ceaser-descp" class="ceaser-descp">
		* PS: The decoded msg will shown here.
	</p>
	
	<tr><th style='width:20ex'>Message:</th><td><textarea onfocus='this.select()'name=msg style='width:100%;height:10em'>CAN YOU ATTACK THE LEFT FLANK OF THE ARMY DURING THE SECOND HOUR TOMORROW. WE WILL BE ABLE TO SEND REINFORCEMENTS BY NOON. HOW MANY MEN DO YOU HAVE? DO YOU NEED SUPPLIES? SEND YOUR REPLY TO THE RIVER.</textarea></td></tr>
	<tr><th>Shift Parameter:</th><td><input type=text size=2 name=sp value=11></td></tr>
	<tr><td></td><td><input type=submit name=submit value='Encode'>
	<input type=submit name=submit value='Decode'> <input type=button value='Clear' onclick='this.form.elements.msg.value=""'></td></tr>
	</table>
		
		<br/>
		<label>Assignable</label>
		<input name="ass1" value="" >
		
		<label>Assiged</label>
		<input name="ass2" value="" >
		
</form>





<script>
	
	var reqListener = function(){
		//alert(onReq.responseText);
		result = onReq.responseText;
		console.log("AJAX Status: "+ onReq.status);
		console.log("AJAX StatusText: "+ onReq.statusText);
		/*The response stored in result is plit using
		 *delimeter ',' and the numbes are populated in the input boxes
		 */
		document.forms.sample.ass1.value=result.split(',')[0]
		document.forms.sample.ass2.value=result.split(',')[1]
		
		loading();
	}
	
	var reqError = function(){
		loading();
		alert("Sorry, But something went wrong");
		console.log("AJAX Status: "+ onReq.status);
		console.log("AJAX StatusText: "+ onReq.statusText);
	}
		
	var onReq = new XMLHttpRequest();
	onReq.onload = reqListener;
	onReq.onerror = reqError;
	/*
	 *Always remember, sending data to the server
	 *using ajax is done preferable through post
	 *otherwise the .send() will not yeild. 
	 *For get, pass data through the url itself
	 *with the help of '&'
	 *Refer: http://www.w3schools.com/ajax/ajax_xmlhttprequest_send.asp
	 */
	
	var companyChanged = function(company){
		document.forms.sample.ass1.value=""
		document.forms.sample.ass2.value=""
		
		if(company != "init")
		{
			loading();
			onReq.open("POST", "get_data.php", true);
			onReq.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	
			var user_id = <?php echo "'$user_id'"?>;
			setTimeout(	function(){
				onReq.send("id="+user_id+"&company="+company);
				}, 800);
		}
	}
	
	var loading = function(){
		var anim_elem = document.getElementById('loading');
		anim_elem.className = anim_elem.className == ""? "activate" : "";
	}
	
</script>

<style>
	#loading{
		font-size: 24px;
		font-weight: bold;
		opacity: 0;
	}
	
	.activate {
		-webkit-animation-name: blinker;
		-webkit-animation-duration: 0.5s;
		-webkit-animation-timing-function: linear;
		-webkit-animation-iteration-count: infinite;
		
		-moz-animation-name: blinker;
		-moz-animation-duration: 1s;
		-moz-animation-timing-function: linear;
		-moz-animation-iteration-count: infinite;
		
		animation-name: blinker;
		animation-duration: 1s;
		animation-timing-function: linear;
		animation-iteration-count: infinite;
	}

	@-moz-keyframes blinker {  
		0% { opacity: 1.0; }
		50% { opacity: 0.0; }
		100% { opacity: 1.0; }
	}

	@-webkit-keyframes blinker {  
		0% { opacity: 1.0; }
		50% { opacity: 0.0; }
		100% { opacity: 1.0; }
	}

	@keyframes blinker {  
		0% { opacity: 1.0; }
		50% { opacity: 0.0; }
		100% { opacity: 1.0; }
	}
</style>
</body>
</html>
