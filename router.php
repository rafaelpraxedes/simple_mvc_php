<?php 
    
    use App\Controllers\MainController;
    use App\Controllers\CustomersController;

    $mainController = new MainController();
    $customersController = new CustomersController();

    // Parse URL to get the path
    $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $requestMethod = $_SERVER['REQUEST_METHOD'];

//var_dump($uri);
//var_dump('<br>');
//var_dump($requestMethod);

    if ($requestMethod === 'POST') {
            
        $action = isset($_POST['action']) ? $_POST['action'] : 'no action';
        
        switch ($action) {
            case 'new':
                $customersController->new();
                break;
            case 'create':
                $customersController->create();
                break;
            case 'update':
                $customersController->update();
                break;
            case 'delete':
                $customersController->delete();
                break;
            default:
                $customersController->index();
                break;
        }
    } else {
        
        switch ($uri) {
            case 'crm_app':
                $mainController->index();
                break;
            case 'crm_app/customers':
                $customersController->index();
                break;
            case 'crm_app/customers/new':
                $customersController->new();
                break;
            default:
                $mainController->notFound();
                break;
        }

    }
    
?>