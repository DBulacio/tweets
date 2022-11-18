<?php 
$con = crear_con();
if($con == NULL) {
    echo json_encode(array('success' => 0));
    return;
}
// if(!isset($_POST['contenido']) || !isset($_POST['categoria'])) {
//     echo json_encode(array('success' => 0));
//     return;
// }

$con->beginTransaction();

try {
    $hora = date('Y-m-d H:i:s');
    $contenido = $_POST['contenido'];
    $categoria = $_POST['categoria'];
    # Insert general
    $INSERT_publicacion = $con->prepare("INSERT INTO publicacion (contenido, categoria, hora) VALUES (:contenido, :categoria, :hora)");
    // $INSERT_etiqueta    = $con->prepare("INSERT INTO etiqueta (publicacionID, etiqueta) VALUES (:publicacionID, :etiqueta)");
    // $INSERT_region      = $con->prepare("INSERT INTO region (publicacionID, etiqueta) VALUES (:publicacionID, :etiqueta)");
    // $INSERT_enlace      = $con->prepare("INSERT INTO enlace (publicacionID, etiqueta) VALUES (:publicacionID, :etiqueta)");

    $INSERT_publicacion->execute('contenido' => $contenido, 'categoria' => $categoria, 'hora' => $hora);
    $publicacionID = $con->lastInsertId();

    // if(isset($_POST['etiqueta'])) {
    //     # Procesar las etiquetas separadas por comas.
    //     # ...
    //     $INSERT_etiqueta->execute('publicacionID' => $publicacionID, 'etiqueta' => $etiqueta); # Chequear que se haya hecho...
    // }
    // if(isset($_POST['region'])) {
    //     $INSERT_region->execute('publicacionID' => $publicacionID, 'region' => $region); # Chequear que se haya hecho...
    // }
    // if(isset($_POST['enlace'])) {
    //     $INSERT_enlace->execute('publicacionID' => $publicacionID, 'enlace' => $enlace); # Chequear que se haya hecho...
    // }

    $con->commit();
    echo json_encode(array('success' => $publicacionID));
    header('Location: index.html');
} catch(PDOException $e) {
    $con->rollback();
    // log any errors to file
    echo json_encode(array('success' => 0));
    ExceptionErrorHandler($e);
    exit;
}

// else {
//     echo json_encode(array('success' => 0));
// }
//     echo json_encode(array('success' => 1));
// } else {
//     echo json_encode(array('success' => 0));
// }

function crear_con() {
    $user = "root";
    $pass = "";
    $dbname = "twooter";

    try {
        $con = new PDO('mysql:host=localhost;dbname='.$dbname, $user, $pass);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return NULL;
    }
    
    return $con;
}
?>