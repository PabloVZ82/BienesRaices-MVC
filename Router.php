<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {

        // Proteger Rutas...
        session_start();

        //Arreglo de rutas protegidas...
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $auth = $_SESSION['login'] ?? null;

        //$currentUrl/urlActual = $_SERVER['PATH_INFO'] ?? '/'; //version desarrollo
        //FUNCION MAS APROX 
         if (isset($_SERVER['PATH_INFO'])) {
                 $urlActual = $_SERVER['PATH_INFO']; 
             }
          else {
             $urlActual = $_SERVER['REQUEST_URI'];
                    
         }
         //Prueba 8
         if($urlActual === null || $urlActual === ""){
               $urlActual = $_SERVER['REQUERI_URI'] ?? '/';
               debuguear($urlActual);
               
             }

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
           // debuguear($fn);
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        //Proteger las rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
             header('Location: /');
         }
        if ($fn) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
            
        } else {
            echo "Página No Encontrada o Ruta no válida";
            
           // debuguear($fn);
        }
    }

    //Muestra una vista
    public function render($view, $datos = [])
    {

        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); //Limpia el bufer

        include __DIR__ . "/views/layout.php";
    }
}
