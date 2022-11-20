<?php 
$con = crear_con();
header('Access-Control-Allow-Origin: *'); # Access to XMLHttpRequest at 'http://127.0.0.1/tweets/src/backend/leer_datos.php?action=fetchall' from origin 'http://localhost:8080' has been blocked by CORS policy: No 'Access-Control-Allow-Origin' header is present on the requested resource.
$action = $_GET['action'];

$SELECT_publicaciones = $con->prepare("SELECT * FROM publicacion");
$SELECT_publi_region  = $con->prepare("SELECT * FROM publi_region WHERE publicacionID = :publicacionID");
$SELECT_publi_tags    = $con->prepare("SELECT * FROM publi_tags WHERE publicacionID = :publicacionID");
$SELECT_etiquetas     = $con->prepare("SELECT * FROM etiquetas WHERE etiquetaID = :etiquetaID");
$SELECT_regiones      = $con->prepare("SELECT * FROM regiones WHERE regionID = :regionID");
$SELECT_publi_id   = $con->prepare("SELECT * FROM publicacion WHERE publicacionID = :publicacionID");

if($action == 'fetchall') { # Si el filtro está vacío
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
            $i++;
        }
    } else {
        # No hay publicaciones en la base de datos.
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
            $i++;
        }
    } else {
        # No hay publicacion que coincidan con el criterio de busqueda. 
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






// $SELECT_tags->bindParam(':action', $action, PDO::PARAM_STR);
    // $SELECT_tags->execute();
    // if($SELECT_tags->rowCount() > 0) {
    //     # Recorro todas las publicaciones con la etiqueta correspondiente.
    //     while($row_tags = $SELECT_tags->fetch(PDO::FETCH_ASSOC)) {
    //         $etiquetaID = $row_tags;
       
    //         $SELECT_publi_tags->execute($etiquetaID);
    //         while($row_publi_tags = $SELECT_publi_tags->fetch(PDO::FETCH_ASSOC)) {
    //             $publicacionID = $row_publi_tags;

    //             $SELECT_publi_id->execute($publicacionID);
    //             while($row_publi_id = $SELECT_publi_id->fetch(PDO::FETCH_ASSOC)) {
    //                 $publicacion[$i]['id'] = $row_publi_id['publicacionID'];
    //                 $publicacion[$i]['contenido'] = $row_publi_id['contenido'];
    //                 $publicacion[$i]['categoria'] = $row_publi_id['categoria'];
    //                 $publicacion[$i]['fecha'] = $row_publi_id['hora']; # Estoy guardando solo la fecha ahora. UPS! @fix

    //                 $i++;
    //             }   
    //         }
    //     }
        
    //     # Me fijo si hay publicaciones sin esa etiqueta que se corresponden con el criterio de busqueda.
    //     $SELECT_publi->bindParam(':action', $action, PDO::PARAM_STR);
    //     $SELECT_publi->execute();
    //     if($SELECT_publi->rowCount() > 0) {
    //         while($row_publicacion = $SELECT_publi->fetch()) {
    //             $publicacion[$i]['id'] = $row_publicacion['publicacionID'];
    //             $publicacion[$i]['contenido'] = $row_publicacion['contenido'];
    //             $publicacion[$i]['categoria'] = $row_publicacion['categoria'];
    //             $publicacion[$i]['fecha'] = $row_publicacion['hora']; # Estoy guardando solo la fecha ahora. UPS! @fix
    //             $publicacionID = ['publicacionID' => $row_publicacion['publicacionID']];
    
    //             $SELECT_publi_region->execute($publicacionID);
    //             if($SELECT_publi_region->rowCount() > 0) {
    //                 while($row_publi_region = $SELECT_publi_region->fetch()) {
    //                     $regionID = ['regionID' => $row_publi_region['regionID']];
                        
    //                     $SELECT_regiones->execute($regionID);
    //                     while($row_regiones = $SELECT_regiones->fetch()) {
    //                         $publicacion[$i]['region'] = $row_regiones['region'];   
    //                     }
    //                 }
    //             } else {
    //                 # No hay regiones
    //                 $publicacion[$i]['region'] = NULL;
    //             }
    //             $i++;
    //         }
    //     } else {
    //         # No hay publicaciones con contenido o categoria que se correspondan con el criterio de busqueda.
    //     }

    // } else {
    //     # Ninguna etiqueta coincide con el criterio de búsqueda
    // }
    // echo json_encode($publicacion);
?>

