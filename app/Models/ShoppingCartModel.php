<?php
namespace App\Models;
use CodeIgniter\Model;

class ShoppingCartModel extends Model { 

////////////////////////////////////////////////////////////////////////////////////////////////
	
	 /*
	  *constructor function for this controller
	  */
    public function __construct() {
  
		$this->db = \Config\Database::connect();  //Connect to the database on class creation
		
    }//end constructor
	
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	/*
	 *function to allow the retrival of all products
	 */		
	public function addtoCart($data) {
		// extract fields
		$sessionId = $data['sessionId'];
		$name = $data['productName'];
		$qty = $data['qty'];
		$price = $data['price'];
		$productCode = $data['productCode'];

		// call procedure
		$this->db->query("Call add_to_shopping_cart(
			$sessionId,
			'$productCode',
			$qty,
			$price,
			'$name'
		)");
 
	}
	
	/*
	 *function to get the products in the cart for the current session
	 */	
	public function getCartDetails($session_id) {
		
 
			
	}
	
	
	/*
	 *Function to get the number of products in cart for the this session 
	 */	
	public function getNoItemsinCart($session_id) {
		
			
	}


	/*
	 *Function to calculate the total cost of the cart for the this session 
	 */	
	public function getCartValue($session_id) {
	 
			
	}	


	public function emptyCart($session_id) {
		
 
		
	}
}//end class ShoppingCartModel
?>
