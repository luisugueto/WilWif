<?php  
 $img_code = date("Y").'-'.date('m').date('d').'-';
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		for ($i = 0; $i < 8; $i++) 
		{
			$img_code = $img_code.$characters[rand(0, strlen($characters))];
			if($i == 3)
			{
				$img_code = $img_code.'-';
			}
		}
		$img_code = $img_code.'-';
		
$target = '../public_html/tmp/'.$img_code.$_FILES['file']['name'];
$ext = explode('.', $target);
$type = $ext[count($ext) - 1];
if ($type=="jpeg"){$type="jpg";}
if ($type=="JPEG"){$type="JPG";}
$isImg = getimagesize($_FILES["file"]["tmp_name"]);
$width  = $isImg[0]; $height = $isImg[1]; 
	if($isImg !== false) {
		if(($type == "png") or ($type == "gif") or ($type == "jpg") or ($type == "JPG")) {
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
			case "JPG": $img = imagecreatefromjpeg($target); break;
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
			case "JPG": $img = imagecreatefromjpeg($target); break;
			case "png": $img = imagepng($img_cropped, $target); break;
			case "gif": $img = imagegif($img_cropped, $target); break;
		}
		}
		$target = '/tmp/'.$img_code.$_FILES['file']['name'];
		die($target); 
		} else {
		echo 'Error, la imagen pesa mas de 2 mb';
		die();
		}} else {
		echo 'Error, el archivo seleccionado no es una imagen valida .File type:'.$type;
		die();
		}
	} else {
	echo 'Error, el archivo seleccionado no es una imagen valida .File type:'.$type;
	die();
	}
?>