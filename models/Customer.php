<?php
// app/models/Customer.php
namespace App\Models;

class Customer {
    
    public $id;
    public $name;
    public $email;
    public $created_at;
    private $addresses = [];

    public function __construct($id = null, $name = null, $email = null, $created_at = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->created_at = $created_at;
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }

    public function getAddresses() { return $this->addresses; }
    public function setAddresses($addresses) { $this->addresses = $addresses; }
}

?>
