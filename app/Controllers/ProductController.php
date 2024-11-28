<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ProductModel; 
use App\Models\ProductPageModel; 
use App\Models\ShoppingCartModel; 

class ProductController extends BaseController {
	
	var $imageName;
	protected $pagination;
    protected $encrypt;
    protected $session;
    protected $validation;
    protected $productModel;
    protected $productPageModel;
	protected $shoppingCartModel;
	
////////////////////////////////////////////////////////////////////////////////////////////////	
	 /*
	  *constructor function for this controller
	  */
	  public function __construct() {   
		  
		$this->session = \Config\Services::session();	
		$this->pagination = \Config\Services::pager();

		$cart = \Config\Services::cart();
		  
		helper(['url', 'form']);
		  
		$this->productModel = new ProductModel();  
		$this->productPageModel = new ProductPageModel();  
		$this->shoppingCartModel = new ShoppingCartModel();
	
     }//end function __construct()
	 
////////////////////////////////////////////////////////////////////////////////////////////////
	 /*
	  *index function for this controller
	  */
	 public function index(){
		 
		  $this->productModel = new ProductModel();
		   	 
	 }//end function index()
	 
 ///////////////////////////////////////////////////////////////////////////////////////////////
	/*
	 *
	 *	Shopping Cart Related functions
	 *
	 */
////////////////////////////////////////////////////////////////////////////////////////////////

	public function handleCartActivity($productCode) {
        
		if (isset($_POST['add'])) { 
				if ($this->isLoggedIn()) {
					$this->addToCart($productCode);	
				} else {
					$data['msg'] = "You MUST be logged in to add products to your shopping cart";
					echo view('msgpage', $data);	
				}
		}	
		else if (isset(($_POST['cancel']))) {
				$this->getProducts(); //call internal function getProducts()
			}
		else if (isset(($_POST['update']))) {
				$this->updateCart(); //call internal function getProducts();
			}
		else if (isset(($_POST['Checkout']))) {
			$this->processOrder(); //call internal function getProducts()
		}	
		else if (isset(($_POST['ContinueShopping']))) {  
			$this->getProducts(); //call internal function getProducts()
		}	
 
    }//end handleCartActivity
////////////////////////////////////////////////////////////////////////////////////////////////


   /*
	*function called when the user wants to update the qty of an item in the cart
	*/
	public function processOrder() {
 

	}//end updateCart
	
////////////////////////////////////////////////////////////////////////////////////////////////	
////////////////////////////////////////////////////////////////////////////////////////////////
/*
	*function called when the user wants to update the qty of an item in the cart
	*/
	public function updateCart() {
	   
 
    
	}//end updateCart
    
////////////////////////////////////////////////////////////////////////////////////////////////
	
   /*
	*function called when the user wants to add an item to their cart
	*/
	public function addToCart($productCode) {
        // get the product details
		$product = $this->productModel->getProduct($productCode);
		$qty = $this->request->getPost('quantitytPurchased');
		// default qty to 1 if left empty on submission
		if(!$qty){
			$qty = 1;
		}

		$data = [
			'productCode' => $product['productCode'],
			'price' => $product['buyPrice'],
			'qty' => $qty,
			'productName' => $product['productName'],
			'sessionId' => $this->session->session_id
		];

		// call stored procedure to add to cart
		$query = $this->shoppingCartModel->addToCart($data);

		if(!$query){
			echo view('msgpage',['msg' => 'Error adding item to cart']);
		} else {
			echo view('msgpage',['msg' => 'Added to cart']);
		}
        
    }//end addToCart
	
////////////////////////////////////////////////////////////////////////////////////////////////	
    /*
	*function called when the user wants to view their cart
	*/
	public function viewCart(){
		// get the sesseion id
		$sessionId = session_id();
		// Call model method to get cart
		$CartDetails = $this->shoppingCartModel->getCartDetails($sessionId);
		// if not null, return the view with the data
		if($CartDetails->getNumRows() > 0){
			$NumberofItems = $this->shoppingCartModel->getNoItemsinCart($sessionId)->getRowArray();
			$CartValue = $this->shoppingCartModel->getCartValue($sessionId)->getRowArray();
			echo view('product/viewCart', ['CartDetails'=>$CartDetails->getResultArray(), 
												'NumberofItems' => $NumberofItems['NumberofItems'],
														'CartValue' => $CartValue['cartValue']			
											]);
		} else {
			echo view('msgpage', ['msg' => 'Your Cart is Empty :(']);
		}
	
	}//end viewCart
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
* Function to check if user is logged in
*/

		public function isLoggedIn() {
			if ($this->session->get('isLoggedIn')) {
				return true;  // User is logged in
			} else {
				return false; // User is not logged in
			}
		}

////////////////////////////////////////////////////////////////////////////////////////////////	
	
	/*
	 *
	 *	CRUD functions for a product
	 *
	 */
	
////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	/*
	 *retrieves products for ADMIN STAFF based on an offset
	 */
	public function getProductsForAdmin() { //called from sidebar of admin menu

	
	}////end  function getProductsForAdmin()


////////////////////////////////////////////////////////////////////////////////////////////////
	//When the cart image is selected get product details and add it to the cart - display the cart after adding
	 public function SelectandAddToCart($productCode) {
		// Call method to add to cart, pass the product code
		$this->addToCart($productCode);

     }//end SelectandAddToCart
	 	
////////////////////////////////////////////////////////////////////////////////////////////////


	
	/*
	 *function to provide drill down information for a particular product.
	 *only available to ADMIN STAFF.
	 *the drill down info is based on $productCode
	 */
	public function getDrillDownProductForAdmin($productCode) { //called from product/Admin/ViewAllProducts
       
	    
		
     }//end getDrillDownProductForAdmin
	
////////////////////////////////////////////////////////////////////////////////////////////////

	 public function getDrillDownProduct($productCode) {
        // Call Model method
	   $product = $this->productModel->getProduct($productCode);
	   
	   if(!$product){
		$msg = 'Error retrieving details';
		echo view('msgPage', ['msg' => $msg]);
	   } else {
	   echo view('product/productdetails', ['product' => $product]);
	   }
 
		 
     }//end getDrillDownProduct
	 

////////////////////////////////////////////////////////////////////////////////////////////////

	/*
	 *function to handle the user clicking on the insert/update/delete button for a given product
	 *only available to ADMIN STAFF.
	 */
	 public function handleProductActivity($productNumber) {
        
		
		//if the user clicks "insert" load the insert form
		if (isset($_POST['insert'])){
           echo view('product/admin/insertproduct');	  
        
		}//end if
        
		//if the user clicks "update" call the local function updateProduct
		else if (isset($_POST['update'])){
            $this->updateProduct($productNumber);  	
        
		}//end else if
        
		//if the user clicks "delete" call the local function deleteProduct
		else if (isset($_POST['delete'])){
            $this->deleteProduct($productNumber);
        }//end else if
   
    }//end function handleProductActivity()


////////////////////////////////////////////////////////////////////////////////////////////////        
    

	/*
	 *function to allow the retrival of a product based on its name
	 */		
	public function getProductByName() {
		 
 
	
	}//end getProductByName

			
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	/*
	 *function to allow the retrival of all products
	 */		
	public function getProducts() {
				// display all products using pagination
				$products = ['AllProducts' => $this->productPageModel->paginate(10),
				'pager' => $this->productPageModel->pager ];


				echo view('product/ViewAllProducts', $products);   
	  }//end function getProducts()

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	 

	/*
	 *local function to set pagination options for the retrival of products
	 */	
	public function doPagination($base)  {
				
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	    

	/*
	 *function to allow the insertion of a product
	 *only available to ADMIN STAFF.
	 */	
	public function insertProduct() {
			
 

    }//end function insertProduct()

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	/*
	 *function to allow the update of a products details based on the $productNumber
	 *only available to ADMIN STAFF.
	 */		
	public function updateProduct($productNumber) {
 

    }//end function updateProduct()
	
 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

	/*
	 *function to allow the deletion of a product based on the $productNumber
	 *only available to ADMIN STAFF.
	 */	
	public function deleteProduct($productNumber) {
       
 
                 
    
    }//end function deleteProduct()
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

   /*
	*internal function to allow the upload of an image as part of a product insertion/update
	*only available to ADMIN STAFF.
	*/	
	public function doUpload() {
 
	 
    
	}//end function doUpload()
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 

}//end class ProductController

?>