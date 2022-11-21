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
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    $hora = time();
    $hora = date("Y-m-d H:i:s", $hora);
    $contenido = $_POST['contenido'];
    $categoria = $_POST['categoria'];
    
    # Select
    $SELECT_regiones  = $con->prepare("SELECT * FROM regiones WHERE regionID = :regionID");
    $SELECT_etiquetas = $con->prepare("SELECT * FROM etiquetas WHERE etiqueta = :etiqueta");
    # Insert
    $INSERT_publicacion = $con->prepare("INSERT INTO publicacion (contenido, categoria, hora) VALUES (:contenido, :categoria, :hora)");
    $INSERT_enlace      = $con->prepare("INSERT INTO enlace (publicacionID, enlace) VALUES (:publicacionID, :enlace)");
    $INSERT_etiqueta    = $con->prepare("INSERT INTO etiquetas (etiqueta) VALUES (:etiqueta)");
    $INSERT_publi_etiqueta = $con->prepare("INSERT INTO publi_tags (publicacionID, etiquetaID) VALUES (:publicacionID, :etiquetaID)");
    $INSERT_publi_regiones = $con->prepare("INSERT INTO publi_region (publicacionID, regionID) VALUES (:publicacionID, :regionID)");
    
    $INSERT_publicacion->execute(['contenido' => $contenido, 'categoria' => $categoria, 'hora' => $hora]);
    $publicacionID = $con->lastInsertId();

    if(isset($_POST['region'])) {
        $SELECT_regiones->execute(['regionID' => $_POST['region']]);
        while($row_regiones = $SELECT_regiones->fetch()) { 
            # Traer regionID
            $regionID = $row_regiones['regionID'];
        }
        # Insertar en publi_region
        $INSERT_publi_regiones->execute(['publicacionID' => $publicacionID, 'regionID' => $regionID]);
    }
    
    if(isset($_POST['etiqueta'])) {
        # Las etiquetas vienen separadas por comas. 
        # Proceso de separación:
        $spaceless_tag = str_replace(" ", "", $_POST['etiqueta']);
        $etiquetas = explode(",", $spaceless_tag);

        foreach($etiquetas as $etiqueta) {
            # Chequear si la etiqueta existe en etiquetas
            $SELECT_etiquetas->execute(['etiqueta' => $etiqueta]);
            if($SELECT_etiquetas->rowCount() > 0) { 
                # Si existe traer el id
                while($row_etiquetas = $SELECT_etiquetas->fetch()) {
                    $etiquetaID = $row_etiquetas['etiquetaID'];
                }
            } else {
                # Si no existe crearla y traer el id
                if($INSERT_etiqueta->execute(['etiqueta' => $etiqueta]))
                    $etiquetaID = $con->lastInsertId();
            }
            # Insertar en publi_tags
            $INSERT_publi_etiqueta->execute(['publicacionID' => $publicacionID, 'etiquetaID' => $etiquetaID]);
        }

        if(isset($_POST['enlace'])) {
            # Los enlaces vienen separados por comas. 
            # Proceso de separación:
            $spaceless_enlace = str_replace(" ", "", $_POST['enlace']);
            $enlaces = explode(",", $spaceless_enlace);
            
            foreach($enlaces as $enlace) {
                if(substr($enlace, 0, 7) !== "https://" && substr($enlace, 0, 6) !== "http://")
                    $enlace = "https://".$enlace;

                $INSERT_enlace->execute(['publicacionID' => $publicacionID, 'enlace' => $enlace]);
            }
        }
    }

    $con->commit();
    # Mensaje de ok! 
    echo json_encode(array('success' => $publicacionID));
    header('Location: http://localhost:8080/index.html');
} catch(PDOException $e) {
    $con->rollback();
    // log any errors to file
    echo json_encode(array('success' => $e));
    // ExceptionErrorHandler($e);
    exit;
}

function crear_con() {
    $user = "root";
    $pass = "";
    $dbname = "noticias";

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