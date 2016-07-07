<?php


class DB{

//$2y$10$uka1A.bW8FZEEYltklZCBeOgHF4CF1h55p0/LIqiFV88hmcOYbQlm

	public function login($username, $password){
		$sql = 'SELECT username, password, id FROM user WHERE username = "'.$username.'"';
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		$row = mysql_fetch_assoc($query);
		if(($username == $row['username']) && ($password == $row['password'])){
		 	    $_SESSION['loggedin'] = true;
		 	    $_SESSION['username'] = $row['username'];
		 	    $_SESSION['id'] = $row['id'];
		 	    $history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'You are logged', NOW())";
				$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
		 	    return true;
		 }
	}

	public function loginBackOffice($username, $password){
		echo $password;
		$sql = 'SELECT username, password, id, rol_id FROM user WHERE username = "'.$username.'"';
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		$row = mysql_fetch_assoc($query);
		if(($username == $row['username']) && ($password == $row['password'])){
		 	    $_SESSION['loggedin'] = true;
		 	    $_SESSION['username'] = $row['username'];
		 	    $_SESSION['id'] = $row['id'];
		 	    $_SESSION['rol_id'] = $row['rol_id'];
		 	    $history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'You are logged', NOW())";
				$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
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
