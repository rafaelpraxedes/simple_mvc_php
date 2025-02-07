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
//var_dump('<br>');

    if ($requestMethod === 'POST') {
            
        $action = isset($_POST['action']) ? $_POST['action'] : 'no action';

//var_dump($action);
//var_dump('<br>');

        switch ($action) {
            case 'new':
                $customersController->new();
                break;
            case 'create':
                $customersController->create();
                break;
            case 'update':

                var_dump($_POST);

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
            case APP_ROOT:
                $mainController->index();
                exit;
            case APP_ROOT . '/customers':
                $customersController->index();
                exit;
            case APP_ROOT . '/customers/new':
                $customersController->new();
                exit;
        }

        // Handle dynamic route: /customers/detail/{id}
        if (preg_match('#^' . APP_ROOT . '/customers/edit/([0-9]+)$#', $uri, $matches)) {
            $customerId = (int) $matches[1]; // Extract ID from URL
            $customersController->edit($customerId);
            exit;
        }

        // Default case: 404 Not Found
        $mainController->notFound();        
    }
    
?>