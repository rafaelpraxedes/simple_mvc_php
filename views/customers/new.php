<!-- views/customer/new.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Customer</title>
    <base href="<?= BASE_URL ?>">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="top-bar">
        <h1> Create a New Customer </h1>
    </div>
    <div class="menu-bar">
        <p> </p>
    </div>
    <div class="form-container">
        <form action="index.php" method="POST">
            
            <input type="hidden" name="action" value="create">
        
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            </br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            </br>
            
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br>
            </br>
            
            <label for="addressType">Address Type:</label>
            <select id="addressType" name="addressType">
                <option value="mailing">Mailing</option>
                <option value="shipping" disabled>Shipping</option>
            </select>

            </br></br>
            
            <div class="button-container">
                <button onclick="window.location.href='<?= BASE_URL ?>customers'" class="btn">Back</button>
                <button type="submit" class="btn btn-primary">Add Customer</button>
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
