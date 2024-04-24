<?php 

if(isset($_SESSION['mail'])) {
    session_destroy();
    header('Location: '.SERVER_URL);
}

?>