<?php 
$con = crear_con();
if($con == NULL) {
    echo json_encode(array('success' => 0));
    return;
}
if(!isset($_POST['contenido']) || !isset($_POST['categoria'])) {
    echo json_encode(array('success' => 0));
    return;
}

$con->beginTransaction();

try {
    $hora = date('Y-m-d H:i:s');
    $contenido = $_POST['contenido'];
    $categoria = $_POST['categoria'];
    
    # Select
    $SELECT_region = $con->prepare("SELECT * FROM regiones WHERE regionID = :regionID");
    # Insert
    $INSERT_publicacion = $con->prepare("INSERT INTO publicacion (contenido, categoria, hora) VALUES (:contenido, :categoria, :hora)");
    $INSERT_enlace      = $con->prepare("INSERT INTO enlace (publicacionID, enlace) VALUES (:publicacionID, :enlace)");
    $INSERT_etiqueta    = $con->prepare("INSERT INTO etiquetas (etiqueta) VALUES (:etiqueta)");
    $INSERT_etiqueta_publi = $con->prepare("INSERT INTO publi_tags (publicacionID, regionID) VALUES (:publicacionID, :etiquetaID)");
    $INSERT_region_publi   = $con->prepare("INSERT INTO publi_region (publicacionID, regionID) VALUES (:publicacionID, :regionID)");
    
    $INSERT_publicacion->execute(['contenido' => $contenido, 'categoria' => $categoria, 'hora' => $hora]);
    $publicacionID = $con->lastInsertId();

    if(isset($_POST['region'])) {
        $SELECT_region->execute(['regionID' => $_POST['region']]);
        while($row = $SELECT_region->fetch()) { 
            $regionID = $row['regionID'];
        }

        $INSERT_region_publi->execute(['publicacionID' => $publicacionID, 'regionID' => $regionID]);
    }
    
    # Pensar cómo hacerlo
    // if(isset($_POST['enlace'])) {
    //     $INSERT_enlace->execute('publicacionID' => $publicacionID, 'enlace' => $enlace); # Chequear que se haya hecho...
    // }

    // if(isset($_POST['etiqueta'])) {
    //     # Procesar las etiquetas separadas por comas.
    //     # ...
    //     $INSERT_etiqueta->execute('publicacionID' => $publicacionID, 'etiqueta' => $etiqueta); # Chequear que se haya hecho...
    // }

    $con->commit();
    # Mensaje de ok! 
    echo json_encode(array('success' => $publicacionID));
    header('Location: http://localhost:8080/index.html');
} catch(PDOException $e) {
    $con->rollback();
    // log any errors to file
    echo json_encode(array('success' => 0));
    ExceptionErrorHandler($e);
    exit;
}

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