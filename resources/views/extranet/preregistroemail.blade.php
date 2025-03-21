<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>LegalProceedings</title>
</head>

<body>
    <div class="row">
        <div class="col-12">
            <h1>Bienvenido al sistema de Quiku</h1>
            <img class="img-fluid" src="{{ asset('imagenes/sistema/icono_sistema.png') }}" alt=""
                style="max-width: 35px">
            <br>
            <p>Estimado Usuario. Ha solicitado registrarse a nuestro aplicativo para presentar Peticiones, Quejas o
                Reclamos, para continuar con su registro por favor dar clic sobre el enlace o cópielo y péguelo en su
                explorador web para continuar con el registro.</p>
            <br>
            <a href="{{ route('extranet.registro_ext', ['id' => $id, 'cc' => $cedula, 'tipo' => $tipopersona]) }}" target="_blank"
                rel="noopener noreferrer">{{ route('extranet.registro_ext', ['id' => $id, 'cc' => $cedula, 'tipo' => $tipopersona]) }}</a>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>
