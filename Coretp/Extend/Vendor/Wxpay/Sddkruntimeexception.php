<?php

class  Sdkruntimeexception extends Exception {
	public function errorMessage()
	{
		//return $this->getMessage();
		        echo "<script language='javascript' type='text/javascript'>";
				echo "window.location.href='http://cj.tojoy.com/wz.php/member'";  
                echo "</script>"; 
				exit;
	}

}

?>