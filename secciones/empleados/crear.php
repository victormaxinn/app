<?php
include("../../bd.php");

if($_POST){


  $primernombre=(isset($_POST["primernombre"])?$_POST["primernombre"]:"");
  $segundonombre=(isset($_POST["segundonombre"])?$_POST["segundonombre"]:"");
  $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
  $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");
  $fechanacimiento=(isset($_POST["fechanacimiento"])?$_POST["fechanacimiento"]:"");
  $edad=(isset($_POST["edad"])?$_POST["edad"]:"");
  $curp=(isset($_POST["curp"])?$_POST["curp"]:"");
  $gradoestudios=(isset($_POST["gradoestudios"])?$_POST["gradoestudios"]:"");
  $nombramiento=(isset($_POST["nombramiento"])?$_POST["nombramiento"]:"");
  $cicloadministracion=(isset($_POST["cicloadministracion"])?$_POST["cicloadministracion"]:"");
  $celular=(isset($_POST["celular"])?$_POST["celular"]:"");
  $domicilio=(isset($_POST["domicilio"])?$_POST["domicilio"]:"");
  $entidadfederativaclave=(isset($_POST["entidadfederativaclave"])?$_POST["entidadfederativaclave"]:"");
  $municipioclave=(isset($_POST["municipioclave"])?$_POST["municipioclave"]:"");
  $oficialiaclave=(isset($_POST["oficialiaclave"])?$_POST["oficialiaclave"]:"");
  $telefonolada=(isset($_POST["telefonolada"])?$_POST["telefonolada"]:"");
  $correogubernamental=(isset($_POST["correogubernamental"])?$_POST["correogubernamental"]:"");

  $foto=(isset($_FILES["foto"]['name'])?$_FILES["foto"]['name']:"");
  $cv=(isset($_FILES["cv"]['name'])?$_FILES["cv"]['name']:"");

  $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");
  $fechaingreso=(isset($_POST["fechaingreso"])?$_POST["fechaingreso"]:"");

  $sentencia=$conexion->prepare("INSERT INTO
  `tbl_empleados` (`id`, `primernombre`, `segundonombre`, `primerapellido`, `segundoapellido`, `fechanacimiento`, `edad`, `curp`, `gradoestudios`, `nombramiento`, `cicloadministracion`, `celular`, `domicilio`, `entidadfederativaclave`, `municipioclave`, `oficialiaclave`, `telefonolada`, `correogubernamental`, `foto`, `cv`, `idpuesto`, `fechaingreso`)
  VALUES (NULL,:primernombre,:segundonombre,:primerapellido,:segundoapellido,:fechanacimiento,:edad,:curp,:gradoestudios,:nombramiento,:cicloadministracion,:celular,:domicilio,:entidadfederativaclave,:municipioclave,:oficialiaclave,:telefonolada,:correogubernamental,:foto,:cv,:idpuesto,:fechaingreso);");

   $sentencia->bindParam(":primernombre",$primernombre);
   $sentencia->bindParam(":segundonombre",$segundonombre);
   $sentencia->bindParam(":primerapellido",$primerapellido);
   $sentencia->bindParam(":segundoapellido",$segundoapellido);
   $sentencia->bindParam(":fechanacimiento",$fechanacimiento);
   $sentencia->bindParam(":edad",$edad);
   $sentencia->bindParam(":curp",$curp);
   $sentencia->bindParam(":gradoestudios",$gradoestudios);
   $sentencia->bindParam(":nombramiento",$nombramiento);
   $sentencia->bindParam(":cicloadministracion",$cicloadministracion);
   $sentencia->bindParam(":celular",$celular);
   $sentencia->bindParam(":domicilio",$domicilio);
   $sentencia->bindParam(":entidadfederativaclave",$entidadfederativaclave);
   $sentencia->bindParam(":municipioclave",$municipioclave);
   $sentencia->bindParam(":oficialiaclave",$oficialiaclave);
   $sentencia->bindParam(":telefonolada",$telefonolada);
   $sentencia->bindParam(":correogubernamental",$correogubernamental);

   $fecha_=new DateTime();
   $nombreArchivo_foto=($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]['name']:"";
   $tmp_foto=$_FILES["foto"]['tmp_name'];
   if($tmp_foto!=''){
   move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto);
   }
   $sentencia->bindParam(":foto",$nombreArchivo_foto);

   $nombreArchivo_cv=($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]['name']:"";
   $tmp_cv=$_FILES["cv"]['tmp_name'];
   if($tmp_cv!=''){
     move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);
   }

   $sentencia->bindParam(":cv",$nombreArchivo_cv);
   
   $sentencia->bindParam(":idpuesto",$idpuesto);
   $sentencia->bindParam(":fechaingreso",$fechaingreso);
   
   $sentencia->execute();
   
   $mensaje="Registro agregado";
   header("Location:index.php?mensaje=".$mensaje); 

}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_puestos`");
$sentencia->execute();
$lista_tbl_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>
<?php include("../../templates/header.php"); ?>
<br/>
<div class="card">
    <div class="card-header">
        Datos del empleado
    </div>
    <div class="card-body">
    
    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="primernombre" class="form-label">Primer nombre</label>
      <input type="text"
        class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer nombre">
      </div>

    <div class="mb-3">
      <label for="segundonombre" class="form-label">Segundo nombre</label>
      <input type="text"
        class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo nombre">
      
    </div>

    <div class="mb-3">
      <label for="primerapellido" class="form-label">Primer apellido</label>
      <input type="text"
        class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
      
    </div>

    <div class="mb-3">
      <label for="segundoapellido" class="form-label">Segundo apellido</label>
      <input type="text"
        class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
      
    </div>
  
    <div class="mb-3">
      <label for="fechanacimiento" class="form-label">Fecha nacimiento</label>
      <input type="date" class="form-control" name="fechanacimiento" id="fechanacimiento" aria-describedby="emailHelpId" placeholder="Fecha nacimiento">
      
    </div>

    <div class="mb-3">
      <label for="Edad" class="form-label">Edad</label>
      <input type="text"
        class="form-control" name="edad" id="edad" aria-describedby="helpId" placeholder="Edad">
      
    </div>

    <div class="mb-3">
      <label for="curp" class="form-label">Curp</label>
      <input type="text"
        class="form-control" name="curp" id="curp" aria-describedby="helpId" placeholder="Curp">

    </div>  
    
    <div class="mb-3">
      <label for="gradoestudios" class="form-label">Grado estudios</label>
      <input type="text"
        class="form-control" name="gradoestudios" id="gradoestudios" aria-describedby="helpId" placeholder="Grado estudios">
      
    </div>
    
    <div class="mb-3">
      <label for="nombramiento" class="form-label">Nombramiento</label>
      <input type="text"
        class="form-control" name="nombramiento" id="nombramiento" aria-describedby="helpId" placeholder="Nombramiento">
      
    </div>

    <div class="mb-3">
      <label for="cicloadministracion" class="form-label">Ciclo administracion</label>
      <input type="text"
        class="form-control" name="cicloadministracion" id="cicloadministracion" aria-describedby="helpId" placeholder="Ciclo administracion">
      
    </div>

    <div class="mb-3">
      <label for="celular" class="form-label">Celular</label>
      <input type="text"
        class="form-control" name="celular" id="celular" aria-describedby="helpId" placeholder="Celular">
      
    </div>

    <div class="mb-3">
      <label for="domicilio" class="form-label">Domicilio</label>
      <input type="text"
        class="form-control" name="domicilio" id="domicilio" aria-describedby="helpId" placeholder="Domicilio">
      
    </div>
    
    <div class="mb-3">
      <label for="entidadfederativaclave" class="form-label">Entidad federativa clave</label>
      <input type="text"
        class="form-control" name="entidadfederativaclave" id="entidadfederativaclave" aria-describedby="helpId" placeholder="Entidad federativa clave">
      
    </div>

    <div class="mb-3">
      <label for="municipioclave" class="form-label">Municipio clave</label>
      <input type="text"
        class="form-control" name="municipioclave" id="municipioclave" aria-describedby="helpId" placeholder="Municipio clave">
      
    </div>    

    <div class="mb-3">
      <label for="oficialiaclave" class="form-label">Oficialia clave</label>
      <input type="text"
        class="form-control" name="oficialiaclave" id="oficialiaclave" aria-describedby="helpId" placeholder="Oficialia clave">
      
    </div>

    <div class="mb-3">
      <label for="telefonolada" class="form-label">Telefono lada</label>
      <input type="text"
        class="form-control" name="telefonolada" id="telefonolada" aria-describedby="helpId" placeholder="Telefono lada">
      
    </div>

    <div class="mb-3">
      <label for="correogubernamental" class="form-label">Correo gubernamentaL</label>
      <input type="text"
        class="form-control" name="correogubernamental" id="correogubernamental" aria-describedby="helpId" placeholder="Correo gubernamental">
      
    </div>

    <div class="mb-3">
      <label for="" class="form-label">Foto:</label>
      <input type="file"
        class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
      
    </div>

    <div class="mb-3">
      <label for="cv" class="form-label">CV(PDF):</label>
      <input type="file" class="form-control" name="cv" id="cv" placeholder="CV" aria-describedby="fileHelpId">
      
    </div>

    <div class="mb-3">
      <label for="idpuesto" class="form-label">Puesto:</label>

      <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
       <?php foreach ($lista_tbl_puestos as $registro) { ?>
          <option value="<?php echo $registro['id']?>">
          <?php echo $registro['nombredelpuesto']?>
        </option>
        <?php } ?> 
    </select>

    </div>

    <div class="mb-3">
      <label for="fechaingreso" class="form-label">Fecha ingreso</label>
      <input type="date" class="form-control" name="fechaingreso" id="fechaingreso" aria-describedby="emailHelpId" placeholder="Fecha ingreso">
      
    </div>

    <button type="submit" class="btn btn-success">Agregar registro</button>
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

    </form>
    
    </div>
    <div class="card-footer text-muted"></div>
    </div>

<?php include("../../templates/footer.php"); ?>