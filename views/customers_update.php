<!-- customer_update.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Customer</title>
    <link href='css/style.css' rel='stylesheet' type='text/css'>
</head>
<body>
    <h1>Update a Customer</h1>
    <form action="index.php" method="POST">
        
        <input type="hidden" name="action" value="update">
      
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" disabled><br>
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
            <button type="submit">Update Customer</button>
            <button type="button" onclick="window.location.href='index.php';">Cancel</button>
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
    
</body>
</html>
