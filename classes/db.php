<?php


class DB{

//$2y$10$uka1A.bW8FZEEYltklZCBeOgHF4CF1h55p0/LIqiFV88hmcOYbQlm

	public function login($username, $password){
		$sql = 'SELECT username, password, id FROM user WHERE username = "'.$username.'"';
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		$row = mysql_fetch_assoc($query);
		echo $row['password'];
		echo "user pass:".$password;
		if(($username == $row['username']) && ($password == $row['password'])){
		 	    $_SESSION['loggedin'] = true;
		 	    $_SESSION['username'] = $row['username'];
		 	    $_SESSION['id'] = $row['id'];
		 	    return true;
		 }
	}

	public function loginBackOffice($username, $password){
		$sql = 'SELECT username, password, id, rol_id FROM user WHERE username = "'.$username.'"';
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		$row = mysql_fetch_assoc($query);
		echo $row['password'];
		echo "user pass:".$password;
		if(($username == $row['username']) && ($password == $row['password']) && ($row['rol_id'] == 1 || $row['rol_id'] == 2)){
		 	    $_SESSION['loggedin'] = true;
		 	    $_SESSION['username'] = $row['username'];
		 	    $_SESSION['id'] = $row['id'];
		 	    $_SESSION['rol_id'] = $row['rol_id'];
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
