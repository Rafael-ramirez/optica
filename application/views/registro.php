<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Registro</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"> -->

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/vendor/simple-line-icons/css/simple-line-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
     <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <!-- Custom styles for this template -->
    <link href="/assets/css/estilos.css" rel="stylesheet">
    <link href="/assets/css/new-age.css" rel="stylesheet">
    <link href="/assets/bootstrap-4.0.0-beta/dist/css/bootstrap.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav" style="background: rgba(233, 236, 239, 0.99) !important;">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
          <img src="/assets/img/favic.png" class="" height="52px" alt="">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto" style="color: #222222 !important;">
            <li class="nav-item" style="color: #222222 !important;">
              <a class="nav-link js-scroll-trigger menu-a" href="/" style="color: #222222 !important;">Inicio</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link js-scroll-trigger menu-a" href="#features">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger menu-a" href="#contact">Contact</a>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link js-scroll-trigger menu-a" href="/registro">Registro</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger menu-a" href="/login" style="color: #222222 !important;">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="contenido-registro">
        <div class="row">
          <div class="col-md-12">
            <h2>Registro</h2>
            <hr>
          </div>
        </div>
        <p class="titulo"><b>Datos Del Cliente</b></p>
        <form action="./Registro/agregar" method="post" enctype="multipart/form-data" id="needs-validation" novalidate>
        <input type="hidden" class="token" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>">
            <div class="form-row">
                <div class="form-group col-md-4">
            <label for="inputExpediente" class="col-form-label">No. De Expediente</label>
            <input type="text" name="Expediente" class="form-control" id="inputExpediente" placeholder="Expediente Del Cliente" required>
            <div class="invalid-feedback">
              Por favor Ingresa El No. De Expediente
            </div>
                </div>
            <div class="form-group col-md-4">
                <label for="inputNombre" class="col-form-label">Nombre Del Cliente</label>
                <input type="text" name="nombre" class="form-control" id="inputNombre" required>
                <div class="invalid-feedback">
                    Favor De Ingresar El Nombre Del Cliente.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputApellido" class="col-form-label">Apellidos</label>
                <input type="text" name="apellidos" id="inputApellido" class="form-control" required>
                <div class="invalid-feedback">
                    Favor De Ingresar Apellidos Del cliente.
                </div>
            </div>
            </div>
            <div class="form-group">
                <label for="inputCorreo" class="col-form-label">Correo electronico</label>
                <input type="email" name="correo" class="form-control" id="inputCorreo" placeholder="" required>
                <div class="invalid-feedback">
                    Favor de ingresar un correo valido.
                </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputTelefono" class="col-form-label">Telefono</label>
                    <input type="number" name="telefono" class="form-control" id="inputTelefono" required>
                    <div class="invalid-feedback">
                        Favor De Ingresar Número Valido.
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCalle" class="col-form-label">Calle y Número</label>
                    <input type="text" name="calle" class="form-control" id="inputCalle"  required>
                    <div class="invalid-feedback">
                        Favor De Ingresar Domicilio Vslido.
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputColonia" class="col-form-label">Colonia</label>
                    <input type="text" name="Colonia" class="form-control" id="inputColonia" required>
                    <div class="invalid-feedback">
                        Por favor Ingresa Colonia Valida
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCiudad" class="col-form-label">Ciudad</label>
                    <input type="text" name="ciudad" class="form-control" id="inputCiudad" required>
                    <div class="invalid-feedback">
                        Favor De Ingresa Ciudad Valida
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputArmazon" class="col-form-label">Armazón</label>
                <input type="text" name="armazon" class="form-control" id="inputArmazon" required>
            </div>
            <div class="form-group">
                <label for="inputObservaciones" class="col-form-label">Observaciones</label>
                <input type="text" name="observaciones" class="form-control" id="inputObservaciones" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                <label for="inputMaterial" class="col-form-label">Material</label>
                <!-- <input type="text" name="Material" id="inputMaterial" class="form-control" required> -->
                <select  name="Material" id="inputMaterial" class="form-control" required>
                    <option value="Plastico CR 39">Plastico CR 39</option>
                    <option value="Plastico Alto Indice">Plastico Alto Indice</option>
                    <option value="Photocromatico">Photocromatico</option>
                    <option value="Antireflejante AR">Antireflejante AR</option>
                    <option value="Antireflejante BF">Antireflejante BF</option>
                </select>
                <div class="invalid-feedback">
                    Favor De Ingresar Material Valido.
                </div>
            </div>
                <div class="form-group col-md-4">
                    <label for="inputTipo" class="col-form-label">Tipo De Lentes</label>
                    <!-- <input type="text" name="tipo" id="inputTipo" class="form-control" required> -->
                    <select  name="tipo" id="inputTipo" class="form-control" required>
                        <option value="Invisible">Invisible</option>
                        <option value="Flat Top">Flat Top</option>
                        <option value="Progresivo">Progresivo</option>
                        <option value="Photocromático">Photocromático</option>
                        <option value="Photocromático y Progresivo">Photocromático y Progresivo</option>
                    </select>
                    <div class="invalid-feedback">
                        Favor De Ingresar Tipo De Lentes valido.
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputTinte" class="col-form-label">Tinte</label>
                    <!-- <input type="text" name="tinte" id="inputTinte" class="form-control" required> -->
                    <select  name="tinte" id="inputTinte" class="form-control" required>
                        <option value="1">1</option>
                        <option value="1 1/2">1 1/2</option>
                        <option value="2">2</option>
                        <option value="2 1/2">2 1/2</option>
                        <option value="3">3</option>
                        <option value="Desvanecido">Desvanecido</option>
                    </select>
                    <div class="invalid-feedback">
                        Favor De Ingresar Tinte Valido.
                    </div>
                </div>
        </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEsferaOd" class="col-form-label">Esfera O.D</label>
                        <input type="text" name="EsferaOd" class="form-control" id="inputEsferaOd" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCilindroOd" class="col-form-label">Cilindro O.D</label>
                        <input type="text" name="CilindroOd" class="form-control" id="inputEsferaOd" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEjeOd" class="col-form-label">Eje O.D</label>
                        <input type="text" name="EjeOd" id="inputEjeOd" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputAdicionOd" class="col-form-label">Adicion O.D</label>
                        <input type="text" name="AdicionOd" class="form-control" id="inputAdicionOd" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputDipOd" class="col-form-label">DIP O.D</label>
                        <input type="text" name="DipOd" class="form-control" id="inputDipOd" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputAlturaOd" class="col-form-label">Altura O.D</label>
                        <input type="text" name="AlturaOd" id="inputAlturaOd" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEsferaOi" class="col-form-label">Esfera O.I</label>
                        <input type="text" name="EsferaOi" class="form-control" id="inputEsferaOi" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCilindroOi" class="col-form-label">Cilindro O.I</label>
                        <input type="text" name="CilindroOi" class="form-control" id="inputEsferaOi" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEjeOi" class="col-form-label">Eje O.I</label>
                        <input type="text" name="EjeOi" id="inputEjeOi" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputAdicionOi" class="col-form-label">Adicion O.I</label>
                        <input type="text" name="AdicionOi" class="form-control" id="inputAdicionOi" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputDipOi" class="col-form-label">DIP O.I</label>
                        <input type="text" name="DipOi" class="form-control" id="inputDipOi" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputAlturaOi" class="col-form-label">Altura O.I</label>
                        <input type="text" name="AlturaOi" id="inputAlturaOi" class="form-control" required>
                    </div>
                </div>
        <div class="form-group">
          <label for="file" class="col-form-label">Imagen Lente</label><br>
          <input type="file" name="logo" id="file" class="" required>
          <div class="invalid-feedback">
            Favor de ingresar un lmagen valido.
          </div>
        </label>
        </div>
        </div>
        <button type="submit" class="btn btn-primary btn-registro">Registrar</button>
      </form>
      </div>
    </div>
    <footer>
      <div class="container">
        <p>&copy; 2017 Optica Econolentes Express. All Rights Reserved.</p>
        <ul class="list-inline">
          <li class="list-inline-item">
            <a href="#">Privacy</a>
          </li>
          <li class="list-inline-item">
            <a href="#">Terms</a>
          </li>
          <li class="list-inline-item">
            <a href="#">FAQ</a>
          </li>
        </ul>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link href="/assets/bootstrap-4.0.0-beta/dist/js/bootstrap.js" rel="stylesheet">
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      "use strict";
      window.addEventListener("load", function() {
        var form = document.getElementById("needs-validation");
        form.addEventListener("submit", function(event) {
          if (form.checkValidity() == false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add("was-validated");
        }, false);
      }, false);
    }());
    </script>
  </body>
</html>
