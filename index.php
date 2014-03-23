
<?php
	include 'manip.php';
	if(isset($_POST['action']) && isset($_POST['message'])){
		
		$action = mb_strtolower($_POST['action']);
		$message = $_POST['message'];
		$result = $message.":".$_POST['action'];
		
		if($action=="encode" || $action=="decode"){
			if($action == "encode"){
				$result = encode($message);
			}
			else{
				$result = decode($message);
			}
			
		}
		else
		{
			$result = "error:Invalid argument";
		}
		
		echo trim($result);
		return;
	}
	
?>
<html>
<head>
<title>  Caesar Cipher Encoder/Decoder</title>
</head>
<body>

	<h1>Caesar Cipher Encoder/Decoder</h1>
	<form name="sample" method="POST" onsubmit="onSubmit(this)">
		
		<div id="ceaser-message" class="ceaser-message">
			<label>Message:</label>
			<textarea name="message" type="textarea"  placeholder="Enter the text to be Encoded/Decoded."></textarea>
		</div>
		
		<p id="ceaser-descp" class="ceaser-descp">
			* PS: The default shift Value is Ceaser's favourite 3. For a custom Shift value, Add it at the end of the massage with a double pipe ('||') symbol. e.g. "ANSHHDBG HSF GSVSJ H HS|11".
		</p>
		
		<div id="ceaser-actions" class="ceaser-actions">
			<input type=submit name=submit value='Encode' onclick="onSubmit(this)"/>
			<input type=submit name=submit value='Decode' onclick="onSubmit(this)"/>
			<input type=button value='Clear' onclick="onSubmit(this)"/>
		</div>
		
		<div id="ceaser-result" class="ceaser-result">
			<label>Result:</label>
			<textarea name="result" type="textarea" disabled="true" readonly="true"></textarea>
			<p id="loading" class="">Loading...</p>
		</div>	
		
		<p id="ceaser-descp" class="ceaser-descp">
			* PS: The decoded msg will shown here.
		</p>
		
			
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
			document.forms.sample.result.value=result
			
			
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
		
		var onSubmit = function(elem){
			
			
			if(elem instanceof(HTMLElement))
			{
				console.log(elem);
				
				if(elem.value.toLowerCase() == "encode" || elem.value.toLowerCase() == "decode" )
				{
					document.forms.sample.result.value = "";
					if(document.forms.sample.message.value != "")
					{
						loading();
						
						onReq.open("POST", "", true);
						onReq.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				
						var user_id = "";
						setTimeout(	function(){
							onReq.send("action="+elem.value.toLowerCase()+"&message="+document.forms.sample.message.value);
							}, 800);
					}
					else
						document.forms.sample.result.value = "Message should not be empty";
				}
				else if(elem.value.toLowerCase() == "clear")
				{
					document.forms.sample.reset();
					document.forms.sample.message.value = "";
					document.forms.sample.result.value = "";
				}
			}
			
			event.preventDefault();
			return false;
			
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
		
		.ceaser-message,
		.ceaser-result{
			display: table;
			width: 100%;
		}
		.ceaser-message textarea,
		.ceaser-result textarea
		{
			width:100%;
			height:10em;
			display: table-cell;
			vertical-align: middle;
		}
		
		.ceaser-message label,
		.ceaser-result label
		{
			width: 20ex;
			font-weight: bold;
			display: table-cell;
			vertical-align: middle;
		}
		
		.ceaser-actions{
			display: block;
			text-align: center;
		}
		
		.ceaser-actions input{
			display:inline-block;
			margin:20px;
			width: 100px;
		}
		
		p.ceaser-descp{
			font-style: oblique;
			font-weight: bold;
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
