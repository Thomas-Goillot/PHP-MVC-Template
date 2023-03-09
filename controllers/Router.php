<?php  

require_once('views/View.php');

class Router{
    private $_controller;

    private $_view;


    public function __construct(){
        try{
            // Autoload any classes that are required
            spl_autoload_register(function($class){
                require_once 'models/'.$class.'.php';
            });

            $url = '';

            // Check if there is a URL
            if(isset($_GET['url'])){
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
                
                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller".$controller;
                $controllerFile = "controllers/".$controllerClass.".php";

                if(file_exists($controllerFile)){
                    require_once($controllerFile);
                    $this->_controller = new $controllerClass($url);
                }
                else{
                    throw new Exception('Page introuvable');
                }
            }
            else{
                require_once('controllers/ControllerAccueil.php');
                $this->_controller = new ControllerAccueil($url);
            }
        }
        catch(Exception $e){
            $errorMsg = $e->getMessage();
            $this->_view = new View('Error');
            $this->_view->generate(array('errorMsg' => $errorMsg));
        }
    }

}

?>