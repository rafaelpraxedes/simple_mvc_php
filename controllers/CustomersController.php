<?php
// app/controllers/CustomersController.php
namespace App\Controllers;

use App\Models\Customer;
use App\Services\CustomerService;
use App\Views\CustomerView;

class CustomersController {
    
    private $service;

    public function __construct() {
        $this->service = new CustomerService();
        $this->service->loadCustomers(); // Load initial data from the database
    }

    public function index($msg = null) {
        $customers = $this->service->getAllCustomers();        
        CustomerView::render('list', $customers, $msg);
    }

    public function new() {
        // Display the create customer form
        CustomerView::renderFull('new', null, '');
    }
    
    public function create() {

        $name = isset($_POST['name']) ? $_POST['name'] : NULL;
        $email = isset($_POST['email']) ? $_POST['email'] : NULL;
        $address = isset($_POST['address']) ? $_POST['address'] : NULL;
        $addressType = isset($_POST['addressType']) ? $_POST['addressType'] : NULL;
        
        // Validate input
        if (empty($name)     || 
            empty($email)    ||
            empty($address ) ||
            empty($addressType) 
           ) {
            $message = "Mandatory fields can not be empty.";
            CustomerView::renderFull('new', null , $message);
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
            CustomerView::renderFull('new', null, $message);
            exit;
        }

        $this->service->createCustomer($name, $email, $address, $addressType);

        //Redirect to prevent form resubmission
        //header("Location: " . $_SERVER['PHP_SELF']);
        header("Location: " . BASE_URL . "customers");
    }

    public function edit($id) {
        $customer = $this->service->getCustomerById($id);
        CustomerView::renderFull('edit', $customer, '');
    }

    public function update() {

        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : NULL;
        $email = isset($_POST['email']) ? $_POST['email'] : NULL;
        $address = isset($_POST['address']) ? $_POST['address'] : NULL;
        //$addressType = isset($_POST['addressType']) ? $_POST['addressType'] : NULL;

        //$customer = $this->service->getCustomerById($id);
        $customer = new Customer ($id, $name, $email);

        // Validate input
        if (empty($name)     || 
            empty($email)    ||
            empty($address )
           ) {
            $message = "Mandatory fields can not be empty.";
            CustomerView::renderFull('edit', $customer , $message);
            exit;
        }        
        
        // Sanitize the input        
        $name = $this->sanitizeInput($name);
        $email = $this->sanitizeInput($email);
        $address = $this->sanitizeInput($address);
        //$addressType = $this->sanitizeInput($addressType);

        // Validate the email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email format.";
            CustomerView::renderFull('edit', $customer, $message);
            exit;
        }

        //$this->service->updateCustomer($id, $name, $email);
        $this->service->updateCustomer($id, $name, $email);

        //header("Location: /customer");
        header("Location: " . BASE_URL . "customers");
    }
    
    public function delete() {
        header('Content-Type: application/json');

        // Validate input
        if (!isset($_POST['id'])) {
            echo json_encode(['error' => "Invalid customer ID."]);
            exit;
        }
       
        $delResult = $this->service->deleteCustomer($_POST['id']);
        
        echo json_encode(['success' => $_POST['id']]);
    }
    
    private function sanitizeInput($data) {
        // Trim whitespace, remove slashes, and convert special characters to HTML entities
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }    
}
?>
