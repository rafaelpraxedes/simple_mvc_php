<!-- views/customers_list.php -->
<?php 

    // HTML Table & Styles
    $table_body_tr = "<tr>";
    $table_body_td = "<td>";

    $res_table  = "<table class='customer-table'>";
    $res_table .= "<thead>";
    $res_table .= "<th>" . "ID"         . "</th>"; 
    $res_table .= "<th>" . "Name"       . "</th>"; 
    $res_table .= "<th>" . "Email"      . "</th>"; 
    $res_table .= "<th>" . "Addresses"  . "</th>";
    $res_table .= "<th>" . "Action"     . "</th>"; 
    $res_table .= "</thead>";

    $res_table .= "<tbody>";    
    foreach ($customers as $customer) {
        $res_table .= $table_body_tr;
        
        $id = $customer->getId();
        
        $url = "./customer_update.php?id=" . $id;
        $url2 = "<a href='" . $url . "'>" . $id . "</a>";
       
        $res_table .= $table_body_td . $url2 . "</td>";
        $res_table .= $table_body_td . $customer->getName() . "</td>";
        $res_table .= $table_body_td . $customer->getEmail() . "</td>";
        $customerAddress = '';
        foreach ($customer->getAddresses() as $address) {
            $customerAddress = $address->getAddress();
            break; // gest first address
        }
        $res_table .= $table_body_td . $customerAddress . "</td>";
        $res_table .= $table_body_td . ' <button onclick="deleteCustomer(' . $customer->getId() . ')">Delete</button>' . " </td>";
        $res_table .= "</tr>";
    }
    $res_table .= "</tbody>";
    
    $res_table .= "</table>";
    
?>
 
 <div class="table-container">

    <!-- <h2>Customers List</h2> -->
    <table class="customer-table">
        <?php
            echo $res_table; 
        ?>
    </div>
    <div>
        <div class="button-container">
            <button onclick="window.location.href='<?= BASE_URL ?>'" class="btn">Back</button>
            <button onclick="window.location.href='<?= BASE_URL ?>customers/new'" class="btn btn-primary">New Customer</button>
        </div>        
    </div>
    <!-- Display the message if it's set -->
    <?php if (!empty($message)): ?>
        <div>
            <p style="color: green; margin-top: 20px;"><?= $message ?></p>
        </div>
    <?php endif; ?>
    
    <script>
        function deleteCustomer(id) {      

            if (confirm("Confirm deletion of customer id " + id + "?") == false) {
                return;
            }
        
            fetch('index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ action: 'delete', id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Customer deleted');
                    location.reload();
                } else {
                    console.log(data);
                    alert('Error deleting customer');
                }
            });
        }
    </script>

</div>