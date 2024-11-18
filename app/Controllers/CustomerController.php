<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CustomerModel; 
use App\Models\CustomerPageModel;
use CodeIgniter\Session\Session;
use CodeIgniter\Validation\Validation;

class CustomerController extends BaseController {

	protected $pagination;
    protected $encrypt;
    protected $session;
    protected $validation;

    protected $CustomerModel;
    protected $CustomerPageModel;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    public function __construct() {

		//load relevant CI libraries and helpers and init the configuration options for pagination
		$this->pagination = \Config\Services::pager();
		  
		$this->encrypt = \Config\Services::encrypt();
		$this->session = \Config\Services::session();	
		$this->validation = \Config\Services::user_validation_rules();
		
		helper(['url']);
		  
		$this->CustomerModel = new CustomerModel();            
		$this->CustomerPageModel  = new CustomerPageModel();		
		  
	 }// function __construct()
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    
	 /*
	  *index function for this controller
	  */
	 public function index(){
		
		  $this->getAllCustomers(0); //call internal function to display all customers
	 
	 }//end function index()
	 
	 
	 /*
	  *top level function to allow a customer to register with the site
	  */
	  public function register() {


	  }
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
	 
	/*
	 *function to load all the customers in the db (with pagination)
	 *called from the sidebar
	 */
    public function getAllCustomers() {
	
		// Paginate, 10 per view
		$customers = ['customers' => $this->CustomerPageModel->paginate(10),
						'pager' => $this->CustomerPageModel->pager ];

		echo view('customer/ViewAllCustomers', $customers);        
    }//end  function getCustomers()

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
  
    /*
	 *function to provide drill down information for a particular customer.
	 *the drill down info is based on $customerNumber
	 */
	public function getDrillDownCustomer($customerNumber) {
	   // Get specific customer
	   log_message("debug", "Drilldown reached with: ". print_r($customerNumber));
	   // Call Model method
	   $Customer['Customer'] = $this->CustomerModel->getCustomer($customerNumber);

	   echo view('customer/customerDetails', $Customer);
	   
     
	}//end function getDrillDownCustomer() 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
	
	/*
	 *function to search for customers based on their name
	 *called from the form allowing client to search by name
	 */
	public function getCustomerByName() {
		
 	
	}//end function getProductByName()

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

	/*
	 *function which handles the buttons at the button of the drilldown view
	 */
    public function handleCustomerActivity($customerNumber) {
		
        if (isset($_POST['insert']))
          echo view('customer/insertCustomer'); //call view to handle an insert
        else if (isset($_POST['update']))
            $this->updateCustomer($customerNumber); //call function within this controller to handle an update		
        else if (isset($_POST['delete']))
            $this->deleteCustomer($customerNumber); //call function within this controller to handle a deletion
        
    }//end function handleCustomerActivity()

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

	/*
	 *function to allow the deletion of a customer based on the $customerNumber
	 */
    public function deleteCustomer($customerNumber) {
		       
    }//end function deleteCustomer()
    
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

	/*
	 *function to perform an insertion of customer into into the DB via the model
	 */
    public function insertCustomer() {
       
 

    }//end function insertCustomer()
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
	/*
	 *function to allow a customer to register their details
	 */
	public function registerCustomer() {
		// Check for POST request
		if ($this->request->getPost()) {
			$customer = $this->request->getPost();

			// Validate inputs
			if ($this->validate('user_validation_rules')) {
				// Call insertCustomer if validation passes
				$this->CustomerModel->insertCustomer($customer);
				// create success msg
				$msg = 'You have been successfully registered';
			} else {
				// handle errors and create message
				$data['validation'] = $this->validator;
				$msg = 'Error processing request, please try again';
			}
		} else {
			$data['validation'] = $this->validator; 
			echo view('customer/registerCustomer', $data);
			return; // Exit to avoid displaying success message on initial load
		}
	
		// Display the msgpag
		// Pass the message to the view
		echo view('msgpage',['msg' => $msg]);
	
	}//end function insertCustomer()
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
	/*
	 *function to perform an update of customer into into the DB via the model
	 *the update is based on $customerNumber
	 */
    public function updateCustomer($customerNumber) {
		// Check for POST request
		if ($this->request->getPost()) {
			$customer = $this->request->getPost();

			// Validate inputs
			if ($this->validate('user_validation_rules')) {
				// Call updateCustomer if validation passes
				$this->CustomerModel->updateCustomer($customer);
				$flag = true;
				$this->handleFlag($flag);
			} else {
				// handle errors and create message
				$data['validation'] = $this->validator;
				$flag = false;
				$this->handleFlag($flag);
			}
		} else {
			$data['validation'] = $this->validator; 
			echo view('customer/registerCustomer', $data);
			return; // Exit to avoid displaying success message on initial load
		}
	
			// The handleFlag method will display the message to the user
    }//end function updateCustomer()

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

	/*
	 *internal function to load a success/failure message after an update, deletion or insertion to the DB.
	 */    
    public function handleFlag($flag) {
		
		//if $flag is true display success message else display failure message
		if ($flag)
          	$data['msg'] = "The changes you have made have been saved to the database";
        else
            $data['msg'] = "The changes you have made have NOT been saved to the database. Please try again";
        
		//load the view which will display the appropriate message
		echo view('msgpage', $data);
    }//end function handleFlag()


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

	/*
	 *function to validate a user attempting to login
	 */   
	public function validateUser() {
	// get the submitted email and password
	$email = $this->request->getPost('email');
	$password = $this->request->getPost('password');
	
	// Call method from Customer Model to authenticate
	$result = $this->CustomerModel->authenticate($password, $email);
	
	if($result){
		// returns the customer name from their email address
		$customerName = $this->CustomerModel->getCustomerByEmail($email);

		// set username
		$sessionData = [
			'customerName' => $customerName,
			'isLoggedIn' => true,
		];
		$this->session->set($sessionData);
		
		// set success message
		$msg = "$customerName, you have successfully logged in.";
	}
	else {
		$msg = "You have entered an invalid email/password combination. Please try again.";
	}
		// renders the message view, and pass the message
		echo view('msgpage', ['msg' => $msg]);
	}
	//end class CustomerController 

}