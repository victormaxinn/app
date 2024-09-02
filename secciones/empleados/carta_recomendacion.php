<?php
include("../../bd.php");

if(isset( $_GET['txtID'] )){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
  
    $sentencia=$conexion->prepare("SELECT *,(SELECT nombredelpuesto 
    FROM tbl_puestos 
    WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
  
    

    $primernombre=$registro["primernombre"];
    $segundonombre=$registro["segundonombre"];
    $primerapellido=$registro["primerapellido"];
    $segundoapellido=$registro["segundoapellido"];

    $nombreCompleto=$primernombre."".$segundonombre."".$primerapellido."".$segundoapellido;

    $foto=$registro["foto"];
    $cv=$registro["cv"];
    $idpuesto=$registro["puesto"];
    $puesto =$registro["puesto"];

    $fechadeingreso=$registro["fechadeingreso"];

    $fechaInicio= new DateTime($fechadeingreso);
    $fechaFin=new DateTime(date('Y-m-d'));
    $diferencia=date_diff($fechaInicio,$fechaFin);

} 
 ob_start();
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de recomendacion </title>
  </head>
  <body>
    
<h5>Carta de responsiva de usuario y contraseña para el SID<h5>
<br/><br/>
El que suscribe Director del Archivo del Registro Civil en el Estado de Jalisco Licenciado(a) Jorge Arévalo Gutiérrez,
con domicilio en la finca marcada con el numero 1855 de la avenida Alcalde, colonia Miraflores, en la Cuidad de Gudalajara, Jalisco. Autoriza 
la elaboracion del siguiente RESGUARDO de conformidad a las siguientes clausulas:
  <br/><br/>
Primero.- Que de conformidad con los Artuculos 15, 21, 26, 136, 137 y 138 de la Ley del Registro Civil en el Estado de Jalisco, relativas a las
Facultades y Obligaciones para los Oficiales del Registro Civil en el  Estado se hace de su conocimiento que dentro de las cuales en el presente
escrito se le otorga la clave y contraseña para el uso del Sistema Nacional de Registro de Identidad Basado en Individuos (SID).   
<br/><br/>
Segundo.- Que el uso de la clave antes descrita es de caracter Personal e Intransferible y es asignada para cumplir con las funciones descritas
dentro del marco de Ley del Registro Civil del Estado de Jalisco, particularmente Capítulos III IV; dando buen desempeño de la misma como 
responsabilidad del usuario.
<br/><br/>
Tercero.- Se indica que las consecuencias legales a que haya lugar por el mal uso de la Clave SID serán tipificadas segun lo descrito por los
Numerales 140, 141, 142, 145 y 146 de la ley del Registro Civil en el Estado, así como de los Arábigos 30, 42, 46, 47, 48, 54, 55, 56, y demas
relativos aplicables de la Ley de Responsabilidades Politicas y Administrativas del Estado de Jalisco,
asi como las consecuencias civiles, administrativas y /o Penales a que haya lugar.
<br/><br/>
Cuarto.- la generacion de usuario y contraseña para el personal adscrito o comisinado a las oficialías municipales es realizada por el Oficial
en Jefe en base a la presentación de documentación y solicitud elaborada. Es realizada exclusivamente en la Coordinación de Informatica por
mediacion del C. Ing. Héctor David Martínez Hernández; y entrega via mensaje de whatsapp o fisicamente al Usuario Responsable,
que tendra la responsabilidad de actualizar al momento y de manera periodica la contraseña del acceso.
Y responder desde el mismo mensaje de whatsapp la confirmación de su acceso al sistema SID.
<br/><br/>
Señalado lo anterior:
<br/><br/>
El C. Héctor David Martínez Hernández, adscrito a la coordinación de informatica genera y entrega el usuario y contraseña provisional a la
siguiente persona:
<br/><br/>
Nombre: ____________________________________
<br/><br/>
CURP: _____________________________________
<br/><br/>
Usuario: ____________________________________
<br/><br/>
Municipio: __________________________________
<br/><br/>
Oficialia: ____________________________________
<br/><br/>
Correo electronico: ___________________________
<br/><br/>
Telefono: ____________________________________
<br/><br/>

Se le otorga el Usuario y Contraseña para el acceso al sistema SID, la cual le sera enviada via correo electrónico a: __________________________
la contraseña debera ser modificada de manera inmediata por parte del usuario al ingresar al sistema
y de manera subsecuente para seguridad del Usuario.
<br/><br/><br/><br/>
Atentamente:<br/>        
<br/><br/>

<br/><br/>
Guadalajara, Jalisco. A ______________, _____ de _________ de________ a las ____:____ horas. 
<br/><br/>

Tramita:                                                                                                  
<br/><br/>
Hector David Martinez Hernandez   
<br/><br/>


______________________________<br/>
<br/><br/><br/>
Recibe: _______________________                                                                                                 
<br/><br/><br/>
---------------------------------------------

  

</body>
</html>
<?php
$HTML=ob_get_clean();

require_once("../../libs/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf= new Dompdf();

$opciones=$dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));

$dompdf->setOptions($opciones);

$dompdf->loadHTML($HTML);

$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment"=>false));

?>