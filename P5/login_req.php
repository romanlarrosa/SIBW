<?php
    require_once "vendor/autoload.php"; 
    include include("bd.php"); 
    
    $loader = new \Twig\Loader\FilesystemLoader('plantillas');
    $twig = new \Twig\Environment($loader);

    if (isset($_GET['act'])){
        $action = $_GET['act'];
        
        if ($action == "login"){ //Login
            $nick = $_POST['nick'];
            $pass = $_POST['pass'];

            if(checkLogin($nick, $pass)){
                session_start();
                $_SESSION['user'] = $nick;
                header("Location: index.php"); 
            }
            else{
                $msg = "Error de login, intentalo otra vez!";
                echo $twig->render('login.html', ['act' => $action, 'msg' => $msg]);
            }

            
        }
        elseif ($action == "signIn") { //Registro
            
            $nick = $_POST['nick'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];

            addUsuario($nick, $pass, $email);

            # ir a la pantalla de login
            $action ="login";
            $msg = "Ahora haz login para usar el servicio!";
            echo $twig->render('login.html', ['act' => $action, 'msg' => $msg]);
        }
    }
    else { //ERROR, vuelve a la pagina principal
        $action = "login";
        echo $twig->render('login.html', ['act' => $action]);
    }



    
    
    
    
    
?>
