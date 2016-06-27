<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php if(isset($title)){ echo $title; }?></title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/jquery-1.11.3.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body style="text-align: center;">
<div id="page-container"  style="width: 1024px; display: inline-block;">
<header style="height: 269px;">

<div class="page-header">
	
</div>
<div class="sub-menu-container">
	 <form  method="post"  action="/">
		<div>
		  
		 	<input type="text" value="<?php if(isset($_POST['s'])){ echo $_POST['s']; }?>" name="s"  style="margin-left: 110px; width: 556px; height: 46px; background-image: url('../image/barra_busqueda_556x48.png'); background-size: 100% 100%; border-width: 0px; background-color: transparent; margin-top: 20px; padding-left: 40px; padding-right: 50px;">
			<img src="/image/lupa_31x31.png" title="search_icon" width="31" height="31"  style="margin-top: 0px; margin-left: -50px;">	
		 
     <a href="/register/"  style="color: black;">
     <input type="button" onClick="document.location = '/register/'" name="loginRegister" value="Login/Register"  style="width: 247px; float: right; margin-top: 15px; height: 60px; padding-left: 67px; padding-right: 0px; border-width: 0px; padding-top: 0px; background-size: 100% 100%; background-color: transparent; margin-right: -19px; background-image: url('../image/Boton_usuario_229x45.png');>

			<input type="submit" value="Login/Register" ">
		 </a>
		</div>
	 </form>
</div>
<div class="logo_container" style="margin-top: 0px; top: -210px; left: -400px; position: relative;display: inline-block;">
		<img src="/image/logo_203x203.png" title="logo" width="203" height="203"  style="margin-top: 0px; margin-left: 0px; width: 203px;">
</div>
	
<?php if( $user->is_logged_in() ){ ?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Objetos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/nuevoItem/">Nuevo Objeto</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><?php echo $_SESSION['username']; ?></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="cambiarContrasenia.php">Cambiar Contraseña</a></li>
            <li><a href="/logout/">Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php

  }

?>
</header>
 <div id="main-area">