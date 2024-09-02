<?php
include("../../bd.php");

if(isset( $_GET['txtID'] )){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("DELETE FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    $mensaje="Registro eliminado";
    header("Location:index.php?mensaje=".$mensaje); 
}


$sentencia=$conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_tbl_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../templates/header.php"); ?>
<br/>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" 
        href="crear.php" role="button">
        Agregar usuarios
        </a>
    </div>
    <div class="card-body">
       
<div class="table-responsive-sm">
    <table class="table"   id="tabla_id" >
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre del usuario</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($lista_tbl_usuarios as $registro) { ?> 

                <tr class="">
                <td scope="row"><?php echo $registro['id']; ?></td>
                <td><?php echo $registro['usuario']; ?> </td>
                <td>****</td>
                <td><?php echo $registro['correo']; ?></td>
                <td> 
                    <a  class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                        |  
                    <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id']; ?>" role="button">Eliminar</a>
                    
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div> 
    </div>
  
</div>



<?php include("../../templates/footer.php"); ?>