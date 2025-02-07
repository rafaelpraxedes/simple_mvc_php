<?php
// app/models/Address.php
namespace App\Models;

class Address {
    
    private $id;
    private $customerId;
    private $address;
    private $type;

    public function __construct($id, $customerId, $address, $type) {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->address = $address;
        $this->type = $type;
    }

    public function getId() { return $this->id; }
    public function getCustomerId() { return $this->customerId; }
    public function getAddress() { return $this->address; }
    public function getAddressType() { return $this->type; }
}
