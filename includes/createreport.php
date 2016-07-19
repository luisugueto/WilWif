<?php
	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

	/** Include PHPExcel */
	require_once ('../lib/excel/PHPExcel.php');

	
	
	
	// Create new PHPExcel object


	$objPHPExcel = new PHPExcel();
	
	// Set document properties


	$creatorFile = 'Zuaru Automatic Software 1.0';
	$titleFile = 'Report History';
	$subjectFile = 'Report';
	$descriptionFile = 'report user history';
	$keywordFile = 'report user wilwif history';
	$categoryFile = 'report';	

	$objPHPExcel->getProperties()->setCreator($creatorFile)
							 ->setLastModifiedBy($creatorFile)
							 ->setTitle($titleFile)
							 ->setSubject($subjectFile)
							 ->setDescription($descriptionFile)
							 ->setKeywords($keywordFile)
							 ->setCategory($categoryFile);

	// border and style of the  cells
	
	$sharedStyle1 = new PHPExcel_Style();
$sharedStyle2 = new PHPExcel_Style();

$sharedStyle1->applyFromArray(
	array('borders' => array(
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
								'top'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
								'left'		=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
							)
		 ));

$sharedStyle2->applyFromArray(
	array('borders' => array(
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'top'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'left'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN)
							)
		 ));
		 
		 
	$gdImage = imagecreatefrompng('../admin/image/logo.png');
// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setName('Logo Wilwif');$objDrawing->setDescription('wilwif logo');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(75);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objDrawing->setCoordinates('A1');
	
			/*
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', 'Atencion:');
			*/
			$objPHPExcel->getActiveSheet()->mergeCells('D7:E7');
			$objPHPExcel->getActiveSheet()->mergeCells('F7:G7');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', 'User');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D7', 'Action');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F7', 'Data');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H7', 'Date');
			
			$searchValue = (isset($_GET['s']))?  $_GET['s'] : '';
			if($searchValue =='')
			$searchValue = (isset($_POST['s']))?  $_POST['s'] : '';

			$searchValue = ($searchValue == '' )? '':"WHERE action like '%".$searchValue."%' or data like '%".$searchValue."%' or date like '%".$searchValue."%'";
			$query = "SELECT h.*, u.username as username FROM history h LEFT JOIN user u ON h.id_user = u.id ".$searchValue;

			$sql = mysql_query($query) or die('error at try to access data' . mysql_error());
			$i = 9;
			while($row = mysql_fetch_assoc($sql))
			{
				$objPHPExcel->getActiveSheet()->mergeCells('D'.$i.':E'.$i.'');
				$objPHPExcel->getActiveSheet()->mergeCells('F'.$i.':G'.$i.'');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i,$row['username']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i,$row['action']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i,$row['data']);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i,$row['date']);
				$i++;
			}
				
				//$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth('24');
				
				
				$objPHPExcel->getActiveSheet()->mergeCells('A5:B5');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', 'User :'.$_SESSION['username']);
				$objPHPExcel->getActiveSheet()->mergeCells('A6:B6');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', 'Date:'.date('Y-m-d H:i:s'));
			
		
			//$objPHPExcel->getActiveSheet()->getStyle('A8')->getFont()->setSize(9);
			
			
			$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "B10:E10");
			// Aqui se debe crear  la nueva cotizacion en base de datos y obtener el id para asi poder agregarle los productos
			
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Report');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

//$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->setShowGridlines(false);
$objPHPExcel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_LAYOUT);
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
//$objWriter->save(str_replace('.php', $nombreExcel.'.pdf', __FILE__));


// Redirect output to a client’s web browser (Excel2007)

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');

if($_POST['type'] == "excel")
{	
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="records.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
}
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

$objWriter->save('php://output');



exit;
?>