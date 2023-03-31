<?php  
  require("class.categorycollection.php");          
  require("class.pdofactory.php");        
//Esta API no necesita utilizar la key -> Ebj59S6hlH37Sa4PuLd5SHabC5vadQe2wYL5ZsZe

//CREATE TABLE categorycollection (id SERIAL PRIMARY KEY,categoryid INTEGER NOT NULL,title VARCHAR(255) NOT NULL,description TEXT, link VARCHAR(255),  categorytitle VARCHAR(255) NOT NULL,  categorylink VARCHAR(255),  categorydescription TEXT,  layers TEXT);

function obtenerDatos() {

  $url = "https://eonet.gsfc.nasa.gov/api/v2.1/categories"; //url de la api de la nasa
  $ch = curl_init(); //iniciar la peticion GET y inicia una nueva sesión cURL
  curl_setopt($ch, CURLOPT_URL, $url); //Establece la URL a la que se realizará la solicitud con curl_setopt()
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Establece la opción CURLOPT_RETURNTRANSFER en true, para que la respuesta de la solicitud sea devuelta como una cadena de texto.
  $json = curl_exec($ch);//Ejecuta la solicitud con curl_exec(), que devuelve los datos de respuesta de la API en formato JSON.
  curl_close($ch); //Cierra la sesión cURL con curl_close().
  return json_decode($json);//Decodifica los datos de respuesta JSON en un objeto de PHP con json_decode() y devuelve un objeto
  //json_decode en java seria Deserialize() una clase
}
  
$datos = obtenerDatos();
$strDSN = "pgsql:dbname=nasadbedgar;host=localhost;port=5432";           
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root", array());                
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);          
$categoryList = array();
    
foreach ($datos->categories as $categoryArray) {    
  $category = new categorycollection($objPDO);    
  $category->settitle($datos->title);        
  $category->setdescription($datos->description);  
  $category->setlink($datos->link);                
  $category->setcategoryid($categoryArray->id);
  $category->setcategorytitle($categoryArray->title);
  $category->setcategorylink($categoryArray->link);
  $category->setcategorydescription($categoryArray->description);
  $category->setlayers($categoryArray->layers); 

  array_push($categoryList, $category);  
}

?>
<head>
    <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
          border: 2px solid blue;
        }

        td, th {
          border: 1px solid green;
          text-align: left;
          padding: 8px;
          background-color: #F3FFE3;
        }

        tr:nth-child(even) {
          background-color: #dddddd;
        }
    </style>
</head>

<table>
    <tr>
        <th>Titulo</th>
        <th>Descripcion</th>
        <th>Link</th>  

        <th>ID de Categoria</th>
        <th>Titulo de Categoria</th>        
        <th>Link de Categoria</th>        
        <th>Descripcion de Categoria</th>
        <th>Capa</th>
    </tr>    
        <?php foreach ($categoryList as $category) { ?>
            <tr>
                <td><?php echo $category->gettitle(); ?></td>
                <td><?php echo $category->getdescription(); ?></td>
                <td><?php echo $category->getlink(); ?></td>
                <td>                         
                    <h3><?php echo $category->getcategoryid(); ?></h3>
                </td>                         
                <td>                         
                    <p><?php echo $category->getcategorytitle(); ?></p>     
                </td>          
                <td>                         
                    <p><?php echo $category->getcategorylink(); ?></p>     
                </td>          
                <td>
                    <?php echo $category->getcategorydescription(); ?>                                
                </td>
                <td>                 
                    <?php echo $category->getlayers(); ?>                                                                                                           
                </td>
            </tr>
        <?php } ?>
    
</table>
