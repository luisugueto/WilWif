<?php 
$x = $_POST["x"];
$y = $_POST["y"];
$w = $_POST["w"];
$h = $_POST["h"];
$img_path = $_POST["src"];
$relative_path = "../public_html";
$isImg = getimagesize($relative_path.$img_path);
if($isImg !== false) {
$ext = explode('.', $img_path);
$type = $ext[count($ext) - 1];
if ($type=="jpeg"){$type="jpg";}
$width  = $isImg[0]; $height = $isImg[1]; 
switch ($type) {
			case "jpg": $img = imagecreatefromjpeg($relative_path.$img_path); break;
			case "png": $img = imagecreatefrompng($relative_path.$img_path); break;
			case "gif": $img = imagecreatefromgif($relative_path.$img_path); break;
		}
imagealphablending($img, true);		
$img_cropped = imagecreatetruecolor($w, $h);
imagesavealpha($img_cropped, true);
imagealphablending($img_cropped, false);
$transparent = imagecolorallocatealpha($img_cropped, 0, 0, 0, 127);
imagefill($img_cropped, 0, 0, $transparent);
imagecopyresampled($img_cropped, $img, 0, 0, $x, $y, $w, $h, $w, $h); 
switch ($type) {
			case "jpg": $img = imagejpeg($img_cropped, $relative_path.$img_path); break;
			case "png": $img = imagepng($img_cropped, $relative_path.$img_path); break;
			case "gif": $img = imagegif($img_cropped, $relative_path.$img_path); break;
		}
if(!is_dir("../public_html/images/".date("Y")))
{
	mkdir("../public_html/images/".date("Y"));
}
if(!is_dir("../public_html/images/".date("Y")."/".date('m')))
{
	mkdir("../public_html/images/".date("Y")."/".date('m'));
}
		$filename = basename($relative_path.$img_path, PATHINFO_FILENAME);
		$finalpath = '/images/'.date("Y").'/'.date('m').'/'.$filename;
		rename($relative_path.'/tmp/'.$filename,$relative_path.$finalpath);
		/*	copy('image1.jpg', 'del/image1.jpg');
		*/
die($finalpath); 
} else {
echo ("error");
die();
}
?>