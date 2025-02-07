<?php
// app/controllers/CustomersController.php
namespace App\Controllers;

use App\Models\CustomerModel;
use App\Views\CustomerView;

class CustomersController {
    
    private $model;

    public function __construct() {
        $this->model = new CustomerModel();
        $this->model->loadCustomers(); // Load initial data from the database
    }

    public function index($msg = null) {
        $customers = $this->model->getAllCustomers();        
        //require BASE_PATH . '/Views/customers_list.php';
        CustomerView::render('customers_list', $customers, $msg);
    }

    public function show($id) {
        $customer = $this->model->getCustomerById($id);
        CustomerView::render('customers_list', $customer, '');
    }

    public function new() {
        // Display the create customer form
        //CustomerView::render('customers_create', null, '');
        CustomerView::renderFull('customers_create', null, '');
    }
    
    public function create() {

        $name = isset($_POST['name']) ? $_POST['name'] : NULL;
        $email = isset($_POST['email']) ? $_POST['email'] : NULL;
        $address = isset($_POST['address']) ? $_POST['address'] : NULL;
        $addressType = isset($_POST['addressType']) ? $_POST['addressType'] : NULL;
        
        // Validate input
        if (empty($name)    || 
            empty($email)   ||
            empty($address ) ||
            empty($addressType) 
           ) {
            $message = "Mandatory fields can not be empty.";
            CustomerView::renderFull('customers_create', null , $message);
            exit;
        }        
        
        // Sanitize the input        
        $name = $this->sanitizeInput($name);
        $email = $this->sanitizeInput($email);
        $address = $this->sanitizeInput($address);
        $addressType = $this->sanitizeInput($addressType);

        // Validate the email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email format.";
            CustomerView::renderFull('customers_create', null, $message);
            exit;
        }

        $this->model->createCustomer($name, $email, $address, $addressType);

        //Redirect to prevent form resubmission
        //header("Location: " . $_SERVER['PHP_SELF']);
        header("Location: " . BASE_URL . "customers");
    }

    public function update($id, $name, $email) {
        $this->model->updateCustomer($id, $name, $email);
        header("Location: /customer");
    }
    
    public function delete() {
        header('Content-Type: application/json');

        // Validate input
        if (!isset($_POST['id'])) {
            echo json_encode(['error' => "Invalid customer ID."]);
            exit;
        }
       
        $delResult = $this->model->deleteCustomer($_POST['id']);
        
        echo json_encode(['success' => $_POST['id']]);
    }
    
    private function sanitizeInput($data) {
        // Trim whitespace, remove slashes, and convert special characters to HTML entities
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }    
}
?>
