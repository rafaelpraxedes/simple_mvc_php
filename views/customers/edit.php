<!-- views/customer/edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer details</title>
    <base href="<?= BASE_URL ?>">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="top-bar">
        <h1> Edit a Customer </h1>
    </div>
    <div class="menu-bar">
        <p> </p>
    </div>
    <div class="form-container">
        <form action="index.php" method="POST">
            
            <input type="hidden" name="action" value="update">

            <input type="hidden" name="id" value="<?= $customers->getId() ?>">
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= $customers->getName() ?>" readonly><br>
            </br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $customers->getEmail() ?>" required><br>
            </br>
            
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?= $customers->getAddress() ?>" required><br>
            </br>
            
            <label for="addressType">Address Type:</label>
            <select id="addressType" name="addressType">
                <option value="mailing">Mailing</option>
                <option value="shipping" disabled>Shipping</option>
            </select>

            </br></br>
            
            <div class="button-container">
                <button type="button" class="btn" onclick="window.location.href='<?= BASE_URL ?>customers'; return false;">Back</button>
                <button type="submit" class="btn btn-primary">Update Customer</button>           
            </div>
        
        </form>    
        <div>
            <p style="color: red;">
                <?php
                    if (isset($message) and !empty($message)) {
                        echo $message;
                    }
                ?>
            </p>
        </div>
    </div>
</body>
</html>
