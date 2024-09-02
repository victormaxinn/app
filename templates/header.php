<?php
session_start();
$url_base="http://localhost/app/";

if (!isset($_SESSION['usuario'])){
  header("Location:".$url_base."/login.php");
}
?>
<!doctype html>
<html lang="en">
<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" /><font></font><font></font>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script><font></font>

  <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
  <header>
    <!-- place navbar here -->
  </header>
  <nav class="navbar navbar-expand navbar-light bg-light">
      <ul class="nav navbar-nav">
          <li class="nav-item">
              <a class="nav-link active" href="#" aria-current="page"><span class="visually-hidden">(current)</span></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base?>secciones/empleados/">Empleados</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base?>secciones/puestos/">Puestos</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base?>secciones/usuarios/">Usuarios</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar sesión</a>
          </li>
      </ul>
  </nav>
  <main class="container">
  <?php if(isset($_GET['mensaje'])) { ?>
<script>
     Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']; ?>"}); 
</script>
<?php } ?>
