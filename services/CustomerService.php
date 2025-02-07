<?php
// app/Service/CustomerService.php
namespace App\Services;

use App\Models\Customer;
use App\Models\Address;
use App\ORM\CustomerRepository;
use App\ORM\AddressRepository;

class CustomerService {
    
    private $customers = [];
    private $customerRepository;
    private $addressRepository;

    public function __construct() {
        $this->customerRepository = new CustomerRepository();
        $this->addressRepository = new AddressRepository();
    }

    public function loadCustomers() {
        $this->customers = $this->customerRepository->all();
    }

    //public function getAllCustomers() {
    //    return $this->customers;
    //}
    
    public function getAllCustomers() {
        $customers = $this->customerRepository->all();
        foreach ($customers as $customer) {
            $addresses = $this->addressRepository->findByCustomerId($customer->getId());
            $customer->setAddresses($addresses);
        }
        return $customers;
    }    

    public function getCustomerById($id) {
        foreach ($this->customers as $customer) {            
            if ($customer->id == $id) {
                $addresses = $this->addressRepository->findByCustomerId($id);
                $customer->setAddresses($addresses);
                return $customer;
            }
        }
        return null;
    }

    public function createCustomer($name, $email, $address, $addressType) {
        $customer = new Customer(null, $name, $email);
        $this->customerRepository->save($customer);
    
        // Create Address for the Customer
        $addressEntity = new Address(null, $customer->getId(), $address, $addressType);
        $this->addressRepository->save($addressEntity);        

        $customer->setAddresses($addressEntity);
        $this->customers[] = $customer;
    }

    public function updateCustomer($id, $name, $email) {
        $customer = $this->getCustomerById($id);
        if ($customer) {
            $customer->name = $name;
            $customer->email = $email;
            $this->customerRepository->save($customer);
        }
    }

    public function deleteCustomer($id) {       
        $customer = $this->getCustomerById($id);
        if ($customer) {
            $this->customerRepository->delete($id);
            $this->customers = array_filter($this->customers, fn($c) => $c->id !== $id);
        }
    }
}
?>
