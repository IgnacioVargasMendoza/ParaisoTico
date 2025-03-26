<?php

class ControllerNavigation
{
    public function login()
    {
        include 'View/Login/login.php';
    }

    public function home(){
        include 'View/Login/home.php';
    }
    
    public function cuenta(){
        include 'View/Usuario/index.php';
    }
    
    public function blog(){
        
        $blogController = new BlogController();
        $blogController->blog();
    }

    public function blogDetail($id)
    {
        // Instanciar BlogController y llamar a su método blogDetail()
        $blogController = new BlogController();
        $blogController->blogDetail($id);
    }
}