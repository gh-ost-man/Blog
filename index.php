<?php
    require_once('vendor/autoload.php');

    $requestURI = preg_split('/\/|\?/', $_SERVER['REQUEST_URI']);
 
    // if(!isset($requestURI[1]) || $requestURI[1] == ""){
    //     $controllerName = "user";
    // } else{
    //     $controllerName = $requestURI[1];
    // }
   
    // if(!isset($requestURI[2]) || $requestURI == ""){
    //     $actionName = 'index';
    // } else {
    //     $actionName= $requestURI[2];
    // }
    
    $controllerName = (!isset($requestURI[1]))? 'blog' : (($requestURI[1] == "")? 'blog' : $requestURI[1]);
    $actionName = !isset($requestURI[2]) ? 'index' : ($requestURI[2] == ''? 'index' : $requestURI[2]);
    $conrollerPath = 'controllers/' . ucfirst($controllerName) . 'Controller.php'; 

    try {
        if(file_exists($conrollerPath)){
            $controllerClassName = '\\controllers\\' . ucfirst($controllerName) . 'Controller';
            $controller = new $controllerClassName;
            $methodName = 'action' . $actionName;

            if(method_exists($controller, $methodName)){
                $controller->$methodName();
            } else {
                throw new Exception("Method $methodName in controller class $controllerClassName not found in file $conrollerPath");
            }
        } else {
            throw new Exception("Controller file not found file name: $conrollerPath");
        }
    } catch (Exception $ex){
        echo $ex->getMessage();
    }