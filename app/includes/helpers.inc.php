<?php 
	//RETURN UN TESTO HTML
	function html($text){ 
		return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');	
	}

	//ECHO TESTO HTML
	function htmlout($text){ 
		echo html($text);	
	}


