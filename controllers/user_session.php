<?php include "db.php" ;
    session_start();
    if(isset($_SESSION['user_id'])){
        $records = $conn ->prepare('SELECT id_usuario, nombre_completo, email,nom_usuario, password FROM usuarios WHERE id_usuario=:id_usuario');
        $records->bindParam(':id_usuario', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;
        if(is_countable($results) && count($results) >0){
            $user = $results;
        }
    }

?>