<?php 

if(!isset($_SESSION)) {

    session_start();

}
if(!isset($_SESSION['username']) && !isset($_GET['rt'])) {

    $controller = 'users';
    $action = 'login';

} else if( !isset($_GET['rt']))
{
    
    $controller = 'channel';
    $action = 'mine';
}
else
{

    $parts = explode( '/', $_GET['rt'] );

    if( isset( $parts[0] ) && preg_match( '/^[A-Za-z0-9]+$/', $parts[0] ) )
        $controller = $parts[0];
    else 
        $controller = 'channel';

    if( isset( $parts[1] ) && preg_match( '/^[A-Za-z0-9]+$/', $parts[1] ) )
        $action = $parts[1];
    else 
        $action = 'mine';
}

$controllerName = $controller . 'Controller';

if( !file_exists( __DIR__ . '/controller/' . $controllerName . '.php' ) )
    error_404();

require_once __DIR__ . '/controller/' . $controllerName . '.php';

if( !class_exists( $controllerName ) )
    error_404();

$con = new $controllerName();

if( !method_exists( $con, $action ) )
    error_404();

$con->$action();
exit(0);


// ------------------------------------
function error_404()
{
    require_once __DIR__ . '/controller/_404Controller.php';
    $con = new _404Controller();
    $con->index();
    exit(0);
}

?>

