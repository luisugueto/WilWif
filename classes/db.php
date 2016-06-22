<?php


class DB{

//$2y$10$uka1A.bW8FZEEYltklZCBeOgHF4CF1h55p0/LIqiFV88hmcOYbQlm

	public function login($username, $password){
		$sql = 'SELECT username, password, memberID FROM members WHERE username = "'.$username.'"';
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		$row = mysql_fetch_assoc($query);
		if(($username == $row['username']) && ($password == $row['password'])){
		 	    $_SESSION['loggedin'] = true;
		 	    $_SESSION['username'] = $row['username'];
		 	    $_SESSION['memberID'] = $row['memberID'];
		 	    return true;
		 }
	}

	public function logout(){
		session_destroy();
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}

}


?>
