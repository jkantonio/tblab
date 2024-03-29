<?php
class SputumCollection extends CI_controller
{
	public function __construct()
	{
		// Code Igniter Default Constructor
		parent::__construct();

		// Load DB Library Manually
		$this->load->database();

		// Load Model
		$this->load->model('SputumCollection_Model');
	}

	public function index()
	{
		$row = $this->SputumCollection_Model->getPosts();
		$data['patientID'] = $row['PatientID'];
		$data['patientFN'] = $row['PatientFirstName'];
		$data['patientMN'] = $row['PatientMiddleName'];
		$data['patientLN'] = $row['PatientLastName'];
		$data['bday'] = $row['PatientBirthday'];
		$data['sex'] = $row['PatientSex'];
		$data['colType'] = $row['CollectionType'];
		$data['numDoC'] = $row['NumberOfDaysCollection'];
		$data['reqBy'] = $row['RequestedBy'];
		$data['$embassy'] = $row['Embassy'];
		$data['dateSR'] = $row['DateOfSputumRequest'];
		$data['priv'] = $this->session->userdata('privilage');
		$data['userID'] = $this->session->userdata('userID');
		$data['pdfLink'] = 'storage/tcpdf_example.pdf';
		//call a model function with input
		$dates = $this->findSched();
		$data['dates'] = $dates;
		$data['scheds'] = $this->SputumCollection_Model->getScheds($dates);
		$this->load->view('pages/sputum-collection', $data);
	}

	public function findSched(){
		date_default_timezone_set("Asia/Manila");
		$currDate = date('Y-m-d');
		for ($x = 0; $x <= 7; $x++) {
			$newDate = date('Y-m-d', strtotime($currDate. ' + '.$x.' days'));
			$dates[$x] = $newDate;
		}
		return $dates;
	}

	public function add()
	{
		$row = $this->SputumCollection_Model->getPosts();
		$data['userID'] = $this->session->userdata('userID');
		$PatientID = $row['PatientID'];
		$PatientFN = $row['PatientFirstName'];
		$PatientMN = $row['PatientMiddleName'];
		$PatientLN = $row['PatientLastName'];
		$sex = $row['PatientSex'];
		$embassy = $row['Embassy'];
		$dateSR = $row['DateOfSputumRequest'];
		$sputumDate = $this->input->post('sputumDate');
		$patientID = $this->input->post('patientID');
		$this->SputumCollection_Model->addSputumCollection($sputumDate,$patientID);
		$this->generate_pdf($PatientFN, $PatientMN, $PatientLN, $sex, $patientID, $embassy, $sputumDate);
		$this->load->view('spmc', $data);
	}

	public function generate_pdf($PatientFN, $PatientMN, $PatientLN, $sex, $patientID, $embassy, $sputumDate)
	{
		// Load PDF Library
		$this->load->library('SputumPdf');

		$pdf = new SputumPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// Set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('tblab');
		$pdf->SetTitle('Sputum Examination Request Form');
		$pdf->SetSubject('PDF of Sputum Examination Request Form');
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

    $pdf->setCellHeightRatio(1.0);
        $txt = "<pre>
<h1>TB LABORATORY DEPARTMENT</h1>
<h4>Sputum Examination Request Form</h4>
</pre>";

    $pdf->writeHTMLCell(0, 0, '', '', '<pre>'.$txt.'</pre>', 0, 1, 0, true, 'C', true);
  
    // set text shadow effect
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
    // Set some content to print

    $sputumDate1 = date('M-d', strtotime($sputumDate));
    $sputumDate2 = date('M-d', strtotime($sputumDate . " + 1 day"));
    $sputumDate3 = date('M-d', strtotime($sputumDate . " + 2 day"));

	$html = "
		<b>\t\t\t\tName: ".$PatientFN . " ".$PatientMN. " ".$PatientLN."
		\t\t\t\tGender: ".$sex."
		\t\t\t\tEmbassy: ".$embassy."
		\t\t\t\tDate Scheduled: ".$sputumDate."
		\t\t\t\tPatient ID: ".$patientID."
	    
	    <div>
		    	\t\t\t\tPlease come personally for sputum examination for three
		    successive mornings on the dates indicated below. Report
		    promptly from 6:00 AM to 8:00 AM only. Please do not take
		    your breakfast. Only water is allowed.
	    </div>
	    <div>
	    		\t\t\t\tTardiness or failure to complete the three days
	    	collection would mean repetition of the series with
	    	additional fees to be charged. Please bring your passport.
	    </div>
	    <div>
	    		\t\t\t\tCOLLECTION DATES ON: ".$sputumDate1.", ".$sputumDate2.", and ".$sputumDate3.".
	    </div>

		\t\t\t\t______________________             ______________________
							Applicant Signature                 Lab Representative</b>";



    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', '<pre>'.$html.'</pre>', 0, 1, 0, true, 'L', true);   
  
    // ---------------------------------------------------------    
  
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    ob_end_clean();
    $pdf->Output("Sputum Examination Request Patient " .$patientID. " Form", 'I');
	exit();  
  


    //============================================================+
    // END OF FILE
    //============================================================+
    }
}
?>