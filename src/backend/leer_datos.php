<?php 
$con = crear_con();
# Access to XMLHttpRequest at 'http://127.0.0.1/tweets/src/backend/leer_datos.php?action=fetchall' from origin 'http://localhost:8080' has been blocked by CORS policy: No 'Access-Control-Allow-Origin' header is present on the requested resource.
header('Access-Control-Allow-Origin: *'); 
// $received_data = json_decode(file_get_contents("php://input"));
$action = $_GET['action'];

// if($received_data->action == 'fetchall') {
if($action == 'fetchall') {
    $SELECT_publicaciones = $con->prepare("SELECT * FROM publicacion");
    $SELECT_publi_region  = $con->prepare("SELECT * FROM publi_region WHERE publicacionID = :publicacionID");
    $SELECT_publi_tags    = $con->prepare("SELECT * FROM publi_tags WHERE publicacionID = :publicacionID");
    $SELECT_etiquetas     = $con->prepare("SELECT * FROM etiquetas WHERE etiquetaID = :etiquetaID");
    $SELECT_regiones      = $con->prepare("SELECT * FROM regiones WHERE regionID = :regionID");
    # Ver que hago con los enlaces

    $SELECT_publicaciones->execute();
    if($SELECT_publicaciones->rowCount() > 0) {
        $publicacion = array();
        $i = 0;
        while($row_publicacion = $SELECT_publicaciones->fetch()) {
            $publicacion[$i]['id'] = $row_publicacion['publicacionID'];
            $publicacion[$i]['contenido'] = $row_publicacion['contenido'];
            $publicacion[$i]['categoria'] = $row_publicacion['categoria'];
            $publicacion[$i]['fecha'] = $row_publicacion['hora']; # Estoy guardando solo la fecha ahora. UPS! @fix
/*            $publicacionID = ['publicacionID' => $row_publicacion['publicacionID']];

            $SELECT_publi_region->execute($publicacionID);
            if($SELECT_publi_region->rowCount() > 0) {
                while($row_publi_region = $SELECT_publi_region->fetch()) {
                    $regionID = ['regionID' => $row_publi_region['regionID']];
                    
                    $SELECT_regiones->execute($regionID);
                    while($row_regiones = $SELECT_regiones->fetch()) {
                        $publicacion['region'] = $row_regiones['region'];   
                    }
                }
            } else {
                # No hay regiones
            }

            $SELECT_publi_tags->execute($publicacionID);
            if($SELECT_publi_tags->rowCount() > 0) {
                while($row_publi_tags = $SELECT_publi_tags->fetch()) {
                    $etiquetaID = ['etiquetaID' => $row_publi_tags['etiquetaID']];
                    
                    $SELECT_etiquetas->execute($etiquetaID);
                    while($row_etiquetas = $SELECT_etiquetas->fetch()) {
                        $publicacion['etiqueta'] = $row_etiquetas['etiqueta'];   
                    }
                }
            } else {
                # No hay etiquetas
            }    */
            $i++;
        }
    } else {
        # No hay tweets que mostrar.
    }
    
    echo json_encode($publicacion);
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