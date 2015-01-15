<?php

class logout
{
  static function function_logout()
  {
		$_SESSION = array();
		session_destroy();
	
  }
}
?>