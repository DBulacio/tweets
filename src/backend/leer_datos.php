<?php 
$con = crear_con();
header('Access-Control-Allow-Origin: *'); # Access to XMLHttpRequest at 'http://127.0.0.1/tweets/src/backend/leer_datos.php?action=fetchall' from origin 'http://localhost:8080' has been blocked by CORS policy: No 'Access-Control-Allow-Origin' header is present on the requested resource.
$action = $_GET['action'];

$SELECT_publicaciones = $con->prepare("SELECT * FROM publicacion");
$SELECT_publi_region  = $con->prepare("SELECT * FROM publi_region WHERE publicacionID = :publicacionID");
$SELECT_publi_tags    = $con->prepare("SELECT * FROM publi_tags WHERE publicacionID = :publicacionID");
$SELECT_etiquetas     = $con->prepare("SELECT * FROM etiquetas WHERE etiquetaID = :etiquetaID");
$SELECT_regiones      = $con->prepare("SELECT * FROM regiones WHERE regionID = :regionID");
$SELECT_publi_id = $con->prepare("SELECT * FROM publicacion WHERE publicacionID = :publicacionID");
$SELECT_enlaces  = $con->prepare("SELECT * FROM enlace WHERE publicacionID = :publicacionID");

if($action == '') { # Si el filtro está vacío
    $SELECT_publicaciones->execute();
    if($SELECT_publicaciones->rowCount() > 0) {
        $publicacion = array();
        $i = 0;
        while($row_publicacion = $SELECT_publicaciones->fetch()) {
            $publicacion[$i]['id'] = $row_publicacion['publicacionID'];
            $publicacion[$i]['contenido'] = $row_publicacion['contenido'];
            $publicacion[$i]['categoria'] = $row_publicacion['categoria'];
            $publicacion[$i]['fecha'] = $row_publicacion['hora']; # Estoy guardando solo la fecha ahora. UPS! @fix
            $publicacionID = ['publicacionID' => $row_publicacion['publicacionID']];

            $SELECT_publi_region->execute($publicacionID);
            if($SELECT_publi_region->rowCount() > 0) {
                while($row_publi_region = $SELECT_publi_region->fetch()) {
                    $regionID = ['regionID' => $row_publi_region['regionID']];
                    
                    $SELECT_regiones->execute($regionID);
                    while($row_regiones = $SELECT_regiones->fetch()) {
                        $publicacion[$i]['region'] = $row_regiones['region'];   
                    }
                }
            } else {
                # No hay regiones
                $publicacion[$i]['region'] = NULL;
            }

            $publicacion[$i]['enlace'] = array();
            $SELECT_enlaces->execute($publicacionID);
            while($row_enlaces = $SELECT_enlaces->fetch()) {
                # Guardo todos los enlace en una posición nueva del array para poder mostrarlos 
                # en caso de que haya más de uno.
                array_push($publicacion[$i]['enlace'], $row_enlaces['enlace']);
            }

            $i++;
        }
    } else {
        $publicacion = NULL;
    }
    
    echo json_encode($publicacion);
} else {
    // encontrar publicaciones que contengan la palabra en 
    // la etiqueta, el contenido o la categoria
    $action = '%' . $action . '%';

    $SELECT = $con->prepare("SELECT DISTINCT pt.publicacionID 
    FROM etiquetas tags
    INNER JOIN publi_tags pt
    WHERE tags.etiqueta LIKE :action AND tags.etiquetaID = pt.etiquetaID
    UNION
    SELECT DISTINCT publicacionID 
    FROM publicacion WHERE contenido LIKE :action OR categoria LIKE :action
    ");

    $SELECT->bindParam(':action', $action, PDO::PARAM_STR);
    $SELECT->execute();
    if($SELECT->rowCount() > 0) {
        $i = 0;
        while($row = $SELECT->fetch(PDO::FETCH_ASSOC)) {
            $publicacionID = $row;

            $SELECT_publi_id->execute($publicacionID);
            while($row_publicacion = $SELECT_publi_id->fetch()) {
                $publicacion[$i]['id'] = $row_publicacion['publicacionID'];
                $publicacion[$i]['contenido'] = $row_publicacion['contenido'];
                $publicacion[$i]['categoria'] = $row_publicacion['categoria'];
                $publicacion[$i]['fecha'] = $row_publicacion['hora']; # Estoy guardando solo la fecha ahora. UPS! @fix
            }

            $SELECT_publi_region->execute($publicacionID);
            if($SELECT_publi_region->rowCount() > 0) {
                while($row_publi_region = $SELECT_publi_region->fetch()) {
                    $regionID = ['regionID' => $row_publi_region['regionID']];
                    
                    $SELECT_regiones->execute($regionID);
                    while($row_regiones = $SELECT_regiones->fetch()) {
                        $publicacion[$i]['region'] = $row_regiones['region'];   
                    }
                }
            } else {
                # No hay regiones
                $publicacion[$i]['region'] = NULL;
            }

            $publicacion[$i]['enlace'] = array();
            $SELECT_enlaces->execute($publicacionID);
            while($row_enlaces = $SELECT_enlaces->fetch()) {
                # Guardo todos los enlace en una posición nueva del array para poder mostrarlos 
                # en caso de que haya más de uno.
                array_push($publicacion[$i]['enlace'], $row_enlaces['enlace']);
            }
            $i++;
        }
    } else {
        $publicacion = NULL;
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

