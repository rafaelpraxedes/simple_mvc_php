<?php
// app/ORM/AddressRepository.php
namespace App\ORM;

use App\Models\Address;
use App\ORM\Database;
use PDO;

define('DEFAULT_ADDR_TYPE', 'mailing');

class AddressRepository {
    
    private $dbConn;

    public function __construct() {
        $this->dbConn = Database::getConnection();
    }

    public function findByCustomerId($customerId) {
        
        $stmt = $this->dbConn->prepare("SELECT * FROM customer_addresses WHERE customer_id = ? AND type = ?");
        $stmt->execute([$customerId, DEFAULT_ADDR_TYPE]);
        $addresses = [];

        while ($row = $stmt->fetch()) {
            $addresses[] = new Address(
                $row['id'],
                $row['customer_id'],
                $row['address'],
                $row['type'],
            );
        }

        return $addresses;
    }

    public function save(Address $address) {       
        // Get values as variables for bindParam
        $customerIdValue = $address->getCustomerId();
        $addressValue = $address->getAddress();
        $addressTypeValue = $address->getAddressType();

        $stmt = $this->dbConn->prepare("INSERT INTO customer_addresses (customer_id, address, type) VALUES (:customerId, :address, :addressType)");

        // Bind parameters
        $stmt->bindParam(':customerId', $customerIdValue);
        $stmt->bindParam(':address', $addressValue);
        $stmt->bindParam(':addressType', $addressTypeValue);

        // Execute the statement
        if ($stmt->execute()) {
            // Optionally, set the ID on the address object if you have an auto-increment ID
            //$address->setId($this->dbConn->lastInsertId());
            return true;
        }

        return false;
    }
    
}
