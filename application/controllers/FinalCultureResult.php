<?php
class FinalCultureResult extends CI_controller
{
	public function __construct()
	{
		// Code Igniter Default Constructor
		parent::__construct();

		// Load DB Library Manually
		$this->load->database();

		// Load Model
		$this->load->model('FinalCultureResult_Model');
	}

	public function index()
	{
		$row = $this->FinalCultureResult_Model->getData();
		$data['specimenCode'] = $row['SpecimenCode'];
		$data['patientID'] = $row['PatientID'];
		$data['ljResult'] = $row['LJFinalResult'];
		$data['mgitResult'] = $row['MGITFinalResult'];
		$data['userID'] = $this->session->userdata('userID');
		$data['priv'] = $this->session->userdata('privilage');
		$this->load->view('pages/final-culture-result',$data);
	}

	public function add(){
		$this->FinalCultureResult_Model->inputData();
		$data['userID'] = $this->session->userdata('userID');
		$data['priv'] = $this->session->userdata('privilage');
		$currDate = $this->input->post('dateReported');
		$this->generate_pdf($currDate);
		$this->load->view('menu',$data);
	}

	public function generate_pdf($currDate)
	{
		// Load PDF Library
		$this->load->library('FinalPdf');

		$pdf = new FinalPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setCellHeightRatio(1.0);

		// Set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('tblab');
		$pdf->SetTitle('FINAL CULTURE REPORT');
		$pdf->SetSubject('FINAL CULTURE REPORT');
		$pdf->SetKeywords('TCPDF, tblab');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set font
		$pdf->SetFont('times', 'BI', 12);
		
		// ---------------------------------------------------------

		//Generate HTML table data from MySQL - start
		$pdf->setFontSubsetting(true);   
  
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('times', '', 12, '', true);   
  
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage(); 
  
    // set text shadow effect
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
	// Set some content to print
	
	$row = $this->FinalCultureResult_Model->getPatient();
	$patientID = $row->PatientID;

	$txt = "<pre>
<h1>TB LABORATORY DEPARTMENT</h1>
<h4>FINAL CULTURE REPORT</h4>
</pre>";

	$pdf->writeHTMLCell(0, 0, '', '', '<pre>'.$txt.'</pre>', 0, 1, 0, true, 'C', true);  




    $html = "<pre>
		<b>
		Name: ".$row->PatientFirstName." ".$row->PatientLastName."
		Sex: ".$row->PatientSex."
		Birthday: ".$row->PatientBirthday."
		Patient ID: ".$row->PatientID."
		Date Reported: ".$currDate."
		</b>
		</pre>";

	// Print text using writeHTMLCell()
	

	$pdf->writeHTMLCell(0, 0, '', '', '<pre>'.$html.'</pre>', 0, 1, 0, true, 'L', true);   
	

	$tbl = <<<EOD
<b><table cellspacing="" cellpadding="" border="1">
    <tr>
		<th>COLLECTION DATE</th>
		<th>SMEAR RESULT</th>
		<th>CULTURE RESULT AFTER 8 WEEKS INCUBATION</th>
		<th>CULTURE DUE</th>
	</tr>
</table>
</b>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
	
	$specimenRow = $this->FinalCultureResult_Model->getResult();
	foreach($specimenRow as $spec){
		$specificRow = $this->FinalCultureResult_Model->getSpecific($spec->SpecimenCode);
		foreach($specificRow as $row1){
			$tb2 = "<b><table cellspacing='' cellpadding='' border='1'><tr><td>".$row1->DateCollected."</td><td>".$row1->MannerOfReporting."</td><td>".$row1->MannerOfReporting1."</td><td>".$row1->SmearResultDate."</td></tr></b>";

			$pdf->writeHTML($tb2, true, false, false, false, '');
		}
	}
	

$row = $this->FinalCultureResult_Model->getEmp();
	$employee = "
	_________________________ \t\t\t\t\t\t\t\t\t\t\t\t_________________________
	<b>".$row->UserFirstName." ".$row->UserLastName." \t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t ".$row->UserFirstName." ".$row->UserLastName." <div> ".$row->UserProfession." \t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t Medical Technologist<div> LN:".$row->UserLicenseNumber." \t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t </b>";
	$pdf->writeHTMLCell(0, 0, '', '', '<pre>'.$employee.'</pre>', 0, 1, 0, true, 'L', true); 


// Print text using writeHTMLCell()


//$pdf->writeHTML($end, true, false, false, false, '');
    // ---------------------------------------------------------    
  
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output("FinalCulture " .$patientID. " Report", 'I');
	exit();  
  


    //============================================================+
    // END OF FILE
    //============================================================+
    }
}
?>