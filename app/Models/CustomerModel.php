<?php
namespace App\Models;
use CodeIgniter\Model;
use ErrorException;

class CustomerModel extends Model { 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    public function __construct() {
     
        $this->db = \Config\Database::connect();  //Connect to the database on class creation
		
    }// end function __construct()
    
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
	 
	/*
	 *function to retrieve all the customers based on $offset
	 */   
    public function getCustomers($offset) {
		
 
    }//end function getCustomers()
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
	 
	/*
	 *function to retrieve all the customers based on $id
	 *this function is called as part of the drill down
	 */
    public function getCustomer($customerNumber) {
		log_message("debug", "Fetching details for Customer Number: " . $customerNumber);

		$query = $this->db->query("Call getCustomer($customerNumber)");

		echo print_r($query->getRowArray(), true);

	    if ($query->getNumRows() > 0) {
			// Fetch the first row as an associative array
			$result = $query->getRowArray();
			
			// Log the result for debugging
			log_message("debug", "GET CUSTOMER Query Result: " . print_r($result, true));
			
			// Return the result
			return $result;
		} else {
			// If no result found, return null or handle accordingly
			log_message("debug", "No customer found with number: " . $customerNumber);
			return null;
		}

    }//end function getCustomer()

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
	 
	/*
	 *function to retrieve a customers info based on $customerName
	 *this function is called when the user searches for a customer name
	 */
	public function getCustomerByName($customerName) {
      	
 

    }//end function getCustomerByName(


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
	 
	/*
	 *function to delete a customer record info based on $id
	 */
    public function deleteCustomer($id) {

 
		
    }//end function deleteCustomer()


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
	 
	/*
	 *function to update a complete customer record
	 *all updated info contained in $customer 
	 */
      public function updateCustomer($customer) {

		echo print_r($customer, true);
	
		$customerNumber = $customer['customerNumber'];
		$customerName = $customer['customerName'];
		$c_lname = $customer['contactLastName'];
		$c_fname = $customer['contactFirstName'];
		$phone = $customer['phone'];
		$add1 = $customer['addressLine1'];
		$add2 = $customer['addressLine2'];
		$email = $customer['email'];
		$city = $customer['city'];
		$state = $customer['state'];
		$p_code = $customer['postalCode'];
		$country = $customer['country'];
		$creditLimit = $customer['creditLimit'];


		$this->db->query("CALL updateCustomer(
			'$customerNumber',
			'$customerName',
			'$c_lname',
			'$c_fname',
			'$add1',
			'$add2',
			'$city',
			'$state',
			'$p_code',
			'$country',
			'$creditLimit',
			'$email',
			'$phone'
		)");

		$flag = true;
		return $flag;
        
	  } //end function updateCustomer()
     
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
	 
    /*
	 *function to insert a complete customer record
	 *all info is contained in $customer 
	 */ 
    public function insertCustomer($customer) {
		// extract fields from form
		$customerName = $customer['companyName'];
		$c_lname = $customer['contactLastName'];
		$c_fname = $customer['contactFirstName'];
		$phone = $customer['phone'];
		$add1 = $customer['addressLine1'];
		$add2 = $customer['addressLine2'];
		$email = $customer['email'];
		$city = $customer['city'];
		$state = $customer['state'];
		$p_code = $customer['postalCode'];
		$country = $customer['country'];
		$password = $customer['password'];
		$creditLimit = 0.00; // initalize to zero

		// call stored procedure and pass parameters
		$this->db->query("Call customer_add(
			'$customerName',
			'$c_lname',
			'$c_fname',
			'$add1',
			'$add2',
			'$city',
			'$state',
			'$p_code',
			'$country',
			'$creditLimit',
			'$email',
			'$phone',
			'$password'
		)"); 

    }//end function insertCustomer()

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

    /*
	 *function to authenticate a customer login
	 */ 
	 public function authenticate($password, $email) {
		// Call the stored procedure, email and password In params, @customerName Out param
		$query = $this->db->query("CALL authenticateCustomer('$password', '$email')");

		// Get details
		$result = $query->getRowArray();

		return $result;
	 }
	 /*
	 *function to return the total number of records in the customers table
	 */ 
	public function getTotalRows() {
		
 
	}

	public function getCustomerByEmail($email){
		// calls stored procedure to get the customers name (concatenation of first and last)
		$this->db->query('Call getCustomerByEmail(?, @customerName)', [$email]);
		// retrieve the parameter
		$result = $this->db->query('SELECT @customerName as customerName')->getRow();
		// returns the result if true, else returns null
		return $result ? $result->customerName : null;
	}

}//end class CustomerModel




