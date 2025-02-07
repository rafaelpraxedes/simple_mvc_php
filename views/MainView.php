<?php
// app/View.php
namespace App\Views;

class MainView {
    
    public static function render($view, $message) {

        // Include the view file, assuming the view path is relative to a "views" folder
        //require BASE_PATH . '/views/' . $view . '.php';

        $viewContent = null;

        // Start output buffering
        ob_start();
        
        // Load the specific view content
        require BASE_PATH . "/views/{$view}.php";
        
        // Store the output of the view content
        $viewContent = ob_get_clean();
        
        // Now load the main layout (home.php) with the view content embedded
        require BASE_PATH . "/views/main.php";

    }

    public static function renderFull($view, $message) {

        // Include the view file, assuming the view path is relative to a "views" folder
        require BASE_PATH . '/views/' . $view . '.php';

    }    
}
