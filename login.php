<?php
  include("includes/header.php");
  include("db.php");
  $visible = "none";
  if ($_POST) {
    echo 'si hay post en login';
    $usuario = $email = $password = "";

    // Validando datos del formulario
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $usuario = test_input($_POST["usuario"]);
      $password = test_input($_POST["clave_usuario"]);
    }
  	if (!$usuario && !$password) {
  		die("Faltan datos para el login!");
  	}else{

      $sql = "select * from usuarios where usuario= :login and password= :password";

      $resultado = $conn->prepare($sql);

      $resultado->bindValue(":login", $usuario);
      $resultado->bindValue(":password", $password);
      $resultado->execute();
      $numero_registros=$resultado->rowCount();
      if ($numero_registros!=0) {
        session_start();
        $registro=$resultado->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id_user'] = $id_user = $registro['id_user'];
        $_SESSION['autoridad'] = $registro['autoridad'];
    		$_SESSION['message'] = "Sesion iniciada, Bienvenido/a ".strtoupper($usuario)."(".$id_user.")!";
    		$_SESSION['message_type'] = 'success';
        $_SESSION['usuario'] = $usuario;
        echo "<script>window.location.replace('http://localhost/AplicacionLakePlaza/index.php')</script>";
      } else {
        $visible = "block";
      }
    }
  }else{
    echo 'No ha iniciado sesion';
  }
?>
<!-- Section: Design Block -->
<section class=" text-center text-lg-start">
  <style>
    .rounded-t-5 {
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }
    @media (min-width: 992px) {
      .rounded-tr-lg-0 {
        border-top-right-radius: 0;
      }
      .rounded-bl-lg-5 {
        border-bottom-left-radius: 0.5rem;
      }
    }
  </style>
  <div class="card mb-3">
    <div class="row g-0 d-flex align-items-center">
      <div class="col-lg-4 d-none d-lg-flex">
        <!-- <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes" -->
        <!-- <img src="images/PROMOCIONAL-LPM.jpg" alt="Imagen Login" -->
        <img src="images/fondo_LPMargarita.jpg" alt="Imagen Login"
          class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5">
          <form action='<?php 
            echo htmlspecialchars($_SERVER["PHP_SELF"]);
            ?>' method='POST'>
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <div class="alert alert-success alert-dismissible fade show d-<?php echo $visible ?> "  role='alert'  >
                    Datos incorrectos, vuelva a intentarlo!
                  </div>
                  <label class="form-label" for="usuario">Usuario</label>
                  <input type="text" id="usuario" name="usuario" class="form-control"  placeholder="Indique su usuario" required />
                </div>
              </div>
            </div>
            <!-- Email input 
            <div class="form-outline mb-4">
              <input type="email" id="email" name="email" class="form-control" />
              <label class="form-label" for="email">Cuenta de Email</label>
            </div>
            -->
            <!-- Password input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="clave_usuario">Password</label>
              <input type="password" id="clave_usuario" name="clave_usuario" placeholder="Debe tener max. 10 caracteres." class="form-control" />
            </div>
            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              <!-- Checkbox 
              <div class="col d-flex justify-content-center">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                  <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div
              </div>-->
              <div class="col">
                <!-- Simple link -->
                <a href="#">Olvidó el password?</a>
              </div>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4" name="entrar">Entrar</button> 
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->