<?php

	namespace WpSeoHide\tools;
/**
 * Send debug code to the Javascript console
 */ 
function debugToConsole($data) {
    if(is_array($data) || is_object($data))
	{
		echo("<script>console.log('PHP: " . json_encode($data) . "');</script>");
		// echo("<script>console.log('PHP: ".print_r($data)."');</script>");
	} else {
		echo("<script>console.log('PHP: " . $data . "');</script>");
		// echo("<script>console.log('PHP: ".print_r($data)."');</script>");
	}
}

function debugToConsoleWithMarker($marker, $data) {
    if(is_array($data) || is_object($data))
	{
		echo("<script>console.log('" . $marker . " ". json_encode($data) . "');</script>");
		// echo("<script>console.log('PHP: ".print_r($data)."');</script>");
	} else {
		echo("<script>console.log('" . $marker . " " . $data . "');</script>");
		// echo("<script>console.log('PHP: ".print_r($data)."');</script>");
	}
}
?>