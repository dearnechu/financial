<?php
include("includes/config.inc.php");
 session_start();  
include(DIR_FUNCTIONS . "database.php");
include(DIR_CLASSES . "order.php");
$order = new Order();
//error_reporting(0);
	$query= $_GET['qry'];
	$query = stripslashes($query);
	//echo $query ;
	$query = str_replace('-','/',$query);
	$query  = Query($query);
	 
	$data = "";
 //	
 
/** PHPExcel */
require_once DIR_INCLUDES . 'phpexcel/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator(SITE_OWNER)
							 ->setLastModifiedBy(SITE_OWNER)
							 ->setTitle("Penpol orders")
							 ->setSubject("Penpol orders")
							 ->setDescription("Penpol Orders")
							 ->setKeywords("Penpol")
							 ->setCategory("Penpol");

// Create a first sheet, representing sales data
 
$objPHPExcel->getActiveSheet()->setCellValue('A1', '#12566');

$objPHPExcel->getActiveSheet()->mergeCells('D1:H1');
$objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
$objPHPExcel->getActiveSheet()->mergeCells('B1:B2');
$objPHPExcel->getActiveSheet()->mergeCells('C1:C2');

$objPHPExcel->getActiveSheet()->mergeCells('I1:I2');
$objPHPExcel->getActiveSheet()->mergeCells('J1:J2');
$objPHPExcel->getActiveSheet()->mergeCells('K1:K2');
$objPHPExcel->getActiveSheet()->mergeCells('L1:L2');
$objPHPExcel->getActiveSheet()->setCellValue('D1', '#12566');
$objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$objPHPExcel->getActiveSheet()->setCellValue('D2', 'Name');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPHPExcel->getActiveSheet()->setCellValue('E2', 'Carton');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->setCellValue('F2', 'Quantity');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->setCellValue('G2', 'Rate');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->setCellValue('H2', 'Value');
 
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray(
		array(
			'font'    => array(
				'bold'      => true
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				'bottom'     => array(
 					'style' => PHPExcel_Style_Border::BORDER_THIN
 				)
			),
			'fill' => array(
	 			'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
	  			'rotation'   => 90,
	 			'startcolor' => array(
	 				'argb' => 'FFA0A0A0'
	 			),
	 			'endcolor'   => array(
	 				'argb' => 'FFFFFFFF'
	 			)
	 		)
		)
);

$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(
		array(
			'font'    => array(
				'bold'      => true
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				'bottom'     => array(
 					'style' => PHPExcel_Style_Border::BORDER_THIN
 				)
			),
			'fill' => array(
	 			'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
	  			'rotation'   => 90,
	 			'startcolor' => array(
	 				'argb' => 'FFA0A0A0'
	 			),
	 			'endcolor'   => array(
	 				'argb' => 'FFFFFFFF'
	 			)
	 		)
		)
);
 

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Sl No')
            ->setCellValue('B1', 'Order No')
            ->setCellValue('C1', 'Order Date')
            ->setCellValue('D1', 'Product')
			->setCellValue('I1', 'Total')
			->setCellValue('J1', 'Ordered By')
			->setCellValue('K1', 'Status')
			->setCellValue('L1', 'Credit');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);			
$objPHPExcel->getActiveSheet()->getStyle('D1:H1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFill()->getStartColor()->setARGB('FF146ac1');
$objPHPExcel->getActiveSheet()->getStyle('D2:H2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('D2:H2')->getFill()->getStartColor()->setARGB('FF146ac1');

$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle('D2:H2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

		
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$i=1;
$row =3;
 
 	while($export = FetchAssoc($query)){
		$status=$order->getstatusname($order->getcurrentorderstatus($export['id']));
	 	$products = $order->getproductsreport($export['id']);
		if($export['credit']==0){
			$creditby ="Zone";
		}else{
			$creditby = $order->getuserfirstname($export['credit']);	
		}
	 	$total    = $order->gettotal($export['id']);
	 	$status = $status['status'];
	  	$onum = ' '.$export['order_no']; 
		$objPHPExcel->getActiveSheet()
            ->setCellValue('A'.$row, $i)
            ->setCellValue('B'.$row, $onum)
            ->setCellValue('C'.$row, $export['order_date']);
			
 		$pr=0;		
		foreach($products as $p) {			
 			$objPHPExcel->getActiveSheet()
				->setCellValue('D'.$row, $p['name'])
				->setCellValue('E'.$row, $p['carton_no'])
				->setCellValue('F'.$row, $p['quantity'])
				->setCellValue('G'.$row, number_format($p['rate'],2))
				->setCellValue('H'.$row, '=F'.$row.'*G'.$row);
				
 			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $export['first_name'])
										  ->setCellValue('K'.$row, $status)
										  ->setCellValue('L'.$row, $creditby);
			
			$row = $row+1; 
			$pr=$pr+1;			
		}
		$prevrow=$row-1;
		$rowfirst=$row-$pr;
        $objPHPExcel->getActiveSheet()->mergeCells('I'.$rowfirst.':I'.$prevrow);
		$objPHPExcel->getActiveSheet()->mergeCells('K'.$rowfirst.':K'.$prevrow);	
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$rowfirst, '=SUM(H'.$rowfirst.':H'.$prevrow.')');
		$objPHPExcel->getActiveSheet()->mergeCells('J'.$rowfirst.':J'.$prevrow);
		$objPHPExcel->getActiveSheet()->mergeCells('L'.$rowfirst.':L'.$prevrow);
		
		$i = $i+1;
	 }
 	/*echo $row=$row-1;
  die();*/
	
$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':H'.$row);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Total');
$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);	
$lastrow=$row-1;
$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, '=SUM(I3:I'.$lastrow.')');
$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, ' ');
$objPHPExcel->getActiveSheet()->setCellValue('K'.$row, ' ');
$objPHPExcel->getActiveSheet()->getStyle('A3:A'.$lastrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Orders');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="orders.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit; 
?>