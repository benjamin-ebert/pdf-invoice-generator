<?php

class Invoice
{
	private $customer;
	private $services;
	private $meta;
	
	function __construct()
	{
		$this->customer = [];
		$this->services = [];
		$this->meta = [];
	}


	// CUSTOMER INFO
	function get_customer_name() {
		echo "Customer's name?" . "\n";
		$name = trim(fgets(STDIN));
		array_push($this->customer, $name);
		return $this;
	}

	function get_customer_address() {
		echo "Customer's address? (Street Number, Zipcode City)" . "\n";
		$address = trim(fgets(STDIN));
		preg_match('/^(.*?)\s(\d{0,4}\w?\)?\-?\d{1,4}?\w?\)?),\s(\d{5})\s(.*?)$/', $address, $matches);
		$street = $matches[1];
		$number = $matches[2];
		$zip = $matches[3];
		$city = $matches[4];
		array_push($this->customer, $street, $number, $zip, $city);
		return $this;
	}

	function return_customer() {
		return $this->customer;
	}


	// SERVICE INFO
	function get_number_of_services() {
		echo "How many different services?" . "\n";
		$this->numServices = trim(fgets(STDIN));
		return $this;
	}

	function get_services() {
		for ($i=0; $i < $this->numServices ; $i++) { 
			echo "Service?" . "\n";;
			$name = (trim(fgets(STDIN)));
			echo "Price?" . "\n";
			$price = (trim(fgets(STDIN)));
			echo "Amount?" . "\n";
			$amount = (trim(fgets(STDIN)));
			$service = array(
				'name' => $name, 
				'amount' => $amount, 
				'price' => $price
			);
			array_push($this->services, $service);			
		}
		return $this;
	}

	function return_services() {
		return $this->services;
	}


	// META INFO
	function get_total_price() {
		$totalPrice = 0;
		foreach ($this->services as $service) {
			$servicePrice = $service['price'] * $service['amount'];
			$totalPrice += $servicePrice;
		}
		echo "The total price is " . $totalPrice . "\n";
		array_push($this->meta, $totalPrice);
		return $this;
	}

	function get_invoice_date() {
		echo "Invoice date = today? (y/n)" . "\n";
		if (trim(fgets(STDIN)) != 'y') {
			echo "Enter invoice date: " . "\n";
			$invoiceDate = trim(fgets(STDIN));
			echo "Invoice date set to " . $invoiceDate . "\n";
		} else {
			$invoiceDate = date('d.m.Y');
			echo "Invoice date set to " . $invoiceDate . "\n";
		}
		array_push($this->meta, $invoiceDate);
		return $this;		
	}

	function get_payment_date() {
		$paymentDate = date('d.m.Y', strtotime("+14 days"));
		array_push($this->meta, $paymentDate);
		echo "Payment date set to " . $paymentDate . "\n";
		return $this;
	}

	function get_invoice_number() {
		$allInvoices = glob('/Users/Admin/Documents/Business/2019/Einnahmen/*.pdf');
		$lastInvoice = end($allInvoices);
		preg_match('/(RE)\s(?<num>\d{1,3})/', $lastInvoice, $matches);
		$lastInvoiceNumber = $matches[num];
		$this->invoiceNumber = $lastInvoiceNumber + 1;
		echo "Last invoice number: " . $lastInvoiceNumber . ", new one: " . $this->invoiceNumber . "? (y/n)" . "\n";
		if (trim(fgets(STDIN)) != 'y') {
			echo "Enter invoice number: " . "\n";
			$this->invoiceNumber = trim(fgets(STDIN));
			echo "Invoice number set to " . $this->invoiceNumber . "\n";
		} else {
			echo "Invoice number set to " . $this->invoiceNumber . "\n";
		}
		array_push($this->meta, $this->invoiceNumber);
		return $this; 		
	}

	function get_invoice_filename() {
		$this->invoiceFileName = "RE" . $this->invoiceNumber . "2019";
		echo "Invoice filename: " . $this->invoiceFileName . "\n";
		array_push($this->meta, $this->invoiceFileName);
		return $this;
	}

	function return_meta() {
		return $this->meta;
	}


	// GENERATE FILES
	function generate_json_files() {
		file_put_contents('customer.json', json_encode($this->customer));
		file_put_contents('services.json', json_encode($this->services));
		file_put_contents('meta.json', json_encode($this->meta));
		return $this;
	}

	function generate_php_file() {
		$this->phpFile = $this->invoiceFileName . '.php';
		$handle = fopen($this->phpFile, 'w') or die('Cannot open file: ' . $this->phpFile);
		$data = '<?php' . "\n" . "\n" 
			. '$customer = ' . 'json_decode(file_get_contents(' . '"' . 'customer.json' . '"' . ')' . ',' . 'true' . ')' . ';' . "\n"
			. '$services = ' . 'json_decode(file_get_contents(' . '"' . 'services.json' . '"' . ')' . ',' . 'true' . ')' . ';' . "\n"
			. '$meta = ' . 'json_decode(file_get_contents(' . '"' . 'meta.json' . '"' . ')' . ',' . 'true' . ')' . ';' . "\n"
			. "\n"
			. 'include' . ' ' . '"' . 'template.php' . '"' . ';';
		fwrite($handle, $data);		
		return $this;	
	}

	function generate_html_file() {
		$this->htmlFile = $this->invoiceFileName . '.html';
		$command = 'php ' . $this->phpFile;
		$renderedHTML = shell_exec($command);
		$handle = fopen($this->htmlFile, 'w') or die('Cannot open file: ' . $this->htmlFile);
		fwrite($handle, $renderedHTML);
		return $this;
	}

	function generate_pdf_file() {
		$pdfFile = $this->invoiceFileName . '.pdf';
		$command = 'cat ' . $this->htmlFile . ' | wkhtmltopdf - ' . $pdfFile;
		shell_exec($command);	
		return $this;	
	}


	// DELETE OBSOLETE FILES
	// 
	// 
	// OPEN PDF
	// 
	// 
	// SUGGEST CHANGING JSON FILES
	// 
	// 
	
}

$invoice = new Invoice();
$invoice->get_customer_name()->get_customer_address()->return_customer();
$invoice->get_number_of_services()->get_services()->return_services();
$invoice->get_total_price()->get_invoice_date()->get_payment_date()->get_invoice_number()->get_invoice_filename()->return_meta();
$invoice->generate_json_files()->generate_php_file()->generate_html_file()->generate_pdf_file();


