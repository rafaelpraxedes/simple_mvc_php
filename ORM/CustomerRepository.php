<?php
// app/ORM/CustomerRepository.php
namespace App\ORM;

use App\Models\Customer;
use App\ORM\Database;
use PDO;

class CustomerRepository {
    
    private $dbConn;

    public function __construct() {
        $this->dbConn = Database::getConnection();
    }

    public function all() {
        $stmt = $this->dbConn->query("SELECT * FROM customers");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $customers = [];
        foreach ($stmt->fetchAll() as $data) {
            $customers[] = new Customer($data['id'], $data['name'], $data['email'], $data['created_at']);
        }
        return $customers;
    }

    public function find($id) {
        $stmt = $this->dbConn->prepare("SELECT * FROM customers WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Customer($data['id'], $data['name'], $data['email'], $data['created_at']);
        }
        return null;
    }

    public function save(Customer $customer) {
        if (isset($customer->id)) {
            $stmt = $this->dbConn->prepare("UPDATE customers SET name = :name, email = :email WHERE id = :id");
            $stmt->bindParam(':id', $customer->id);
        } else {
            $stmt = $this->dbConn->prepare("INSERT INTO customers (name, email) VALUES (:name, :email)");
        }
        $stmt->bindParam(':name', $customer->name);
        $stmt->bindParam(':email', $customer->email);
        $res = $stmt->execute();

        if (!isset($customer->id)) {
            $customer->id = $this->dbConn->lastInsertId();
        }
    }

    public function delete($id) {       
        $stmt = $this->dbConn->prepare("DELETE FROM customers WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
