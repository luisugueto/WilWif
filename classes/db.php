<?php


class DB{

//$2y$10$uka1A.bW8FZEEYltklZCBeOgHF4CF1h55p0/LIqiFV88hmcOYbQlm

	public function login($username, $password){

		$sql = mysql_query('SELECT username, password, memberID FROM members');
		$row = mysql_fetch_array($sql);
		do
		{	
			if(($username == $row['username']) && ($password == $row['password'])){
			    $_SESSION['loggedin'] = true;
			    $_SESSION['username'] = $row['username'];
			    $_SESSION['memberID'] = $row['memberID'];
			    return true;
			}
		}while(mysql_fetch_array($sql));
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
