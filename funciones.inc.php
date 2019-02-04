<?php

function conectar(){
	$db = "datos_webservice";
	$link = mysqli_connect ("localhost","root","rootroot",$db);
	print gettype($link);
	if (!$link)
	{
		return (FALSE);
	}
	else
	{
		return($link);
	}
}
?>
