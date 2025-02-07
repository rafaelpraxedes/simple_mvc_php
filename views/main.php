<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple CRM</title>
    <base href="<?= BASE_URL ?>">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="top-bar">
        <h1>Simple CRM</h1>
    </div>
    <div class="menu-bar">
        <a href="<?= BASE_URL ?>" class="menu-link">Home</a>
        <a href="customers" class="menu-link">Customers</a>
        <a href="services" class="menu-link">Services</a>
    </div>
    <div class="content">
        <?= $viewContent ?? '' ?>
    </div>
</body>
</html>