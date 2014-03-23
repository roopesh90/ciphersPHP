<?php

$alphabet = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
$N = 3;
function encode($msg){

  // Initialization
  global $alphabet, $N;
  $msg = mb_strtoupper($msg);
  //if(explode("||", $msg, 3).);
  $split_msg = explode("||", $msg, 3);
  if(count($split_msg)>1)
  {
	$N = end($split_msg);
	$msg = $split_msg[0];
  }
  
  
  $M = count($alphabet);
  $encrypt = array();
  $encode = array();
  $plain = preg_split("//",$msg, -1, PREG_SPLIT_NO_EMPTY);
  
  //return join('',$plain);
  
  $encode[' '] = ' ';
  foreach ($alphabet as $n=>$v){
    $encode[$v] =  $alphabet[($n+$N) % $M];		// Compute the encoding map for $v
  }

  foreach ($plain as $v){
	if(ctype_alpha($v))
		$encrypt[] = $encode[$v];
	else
		$encrypt[] = $v;
  }

  return join('',$encrypt);
}

function decode($msg){

  // Initialization
  global $alphabet, $N;
  $msg = mb_strtoupper($msg);
  //if(explode("||", $msg, 3).);
  $split_msg = explode("||", $msg, 3);
  if(count($split_msg)>1)
  {
	$N = end($split_msg);
	$msg = $split_msg[0];
  }
  
  $M = count($alphabet);
  $decrypt = array();
  $decode = array();

  $encrypted = preg_split("//",$msg, -1, PREG_SPLIT_NO_EMPTY);

  // Compute the decoding map
  $decode[' '] = ' ';
  foreach ($alphabet as $n=>$v){
    $decode[$v] = $alphabet[($M+($n-$N)) % $M];	  	// Compute the decoding map for $v
  }

  foreach ($encrypted as $v){
	if(ctype_alpha($v))
		$decrypt[] = $decode[$v];
	else
		$decrypt[] = $v;
  }

  return join('',$decrypt);
}

?>
