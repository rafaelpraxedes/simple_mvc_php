<?php
// app/controllers/MainController.php
namespace App\Controllers;

use App\Views\MainView;

class MainController {
    
    public function __construct() {
    }

    public function index($msg = null) {
        MainView::renderFull('main', $msg);
    }

    public function notFound() {
        MainView::render('404', '');
    }

}
?>
