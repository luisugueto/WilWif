<?php  
$target = '../public_html/images/'.$_FILES['file']['name'];
$ext = explode('.', $target);
$type = $ext[count($ext) - 1];
if ($type=="jpeg"){$type="jpg";}
$isImg = getimagesize($_FILES["file"]["tmp_name"]);
$width  = $isImg[0]; $height = $isImg[1]; 
	if($isImg !== false) {
		if(($type == "png") or ($type == "gif") or ($type == "jpg") ) {
		if($_FILES['file']['size'] < 2*1048576) {
		move_uploaded_file( $_FILES['file']['tmp_name'],$target);
		if (($width > 200) or ($height > 200)){
		if ($width == $height) {
		$nWidth = $nHeight = 200;
		}
		else if ($width > $height) {
		$nWidth = 200;
		$nHeight = $nWidth * $height / $width;
		} else {
		$nHeight = 200;
		$nWidth = $nHeight * $width / $height;
		}
		switch ($type) {
			case "jpg": $img = imagecreatefromjpeg($target); break;
			case "png": $img = imagecreatefrompng($target); break;
			case "gif": $img = imagecreatefromgif($target); break;
		}
		imagealphablending($img, true);		
		$img_cropped = imagecreatetruecolor($nWidth, $nHeight);
		imagesavealpha($img_cropped, true);
		imagealphablending($img_cropped, false);
		$transparent = imagecolorallocatealpha($img_cropped, 0, 0, 0, 127);
		imagefill($img_cropped, 0, 0, $transparent);
		imagecopyresampled($img_cropped, $img, 0, 0, 0, 0, $nWidth, $nHeight, $width, $height);
		switch ($type) {
			case "jpg": $img = imagejpeg($img_cropped, $target); break;
			case "png": $img = imagepng($img_cropped, $target); break;
			case "gif": $img = imagegif($img_cropped, $target); break;
		}
		}
		$target = 'images/'.$_FILES['file']['name'];
		die($target); 
		} else {
		echo 'Error, la imagen pesa mas de 2 mb';
		die();
		}} else {
		echo 'Error, el archivo seleccionado no es una imagen valida';
		die();
		}
	} else {
	echo 'Error, el archivo seleccionado no es una imagen valida';
	die();
	}
?>