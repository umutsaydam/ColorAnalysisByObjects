<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Renk Analizi | Ana sayfa</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<style>
    html {
        height: 100%;
    }

    body {
        height: 100%;
        margin: 0;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-image: linear-gradient(305deg,
                hsl(263deg 33% 69%) 0%,
                hsl(259deg 24% 69%) 10%,
                hsl(251deg 15% 70%) 18%,
                hsl(224deg 7% 69%) 25%,
                hsl(146deg 6% 69%) 34%,
                hsl(110deg 13% 70%) 43%,
                hsl(101deg 22% 70%) 54%,
                hsl(96deg 32% 70%) 67%,
                hsl(93deg 41% 69%) 82%,
                hsl(92deg 49% 69%) 100%);
    }

    .btn-radius {
        border-radius: 50px !important;
    }

    .vertical-center {
        min-height: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
</style>

<body>
    <div class="jumbotron vertical-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-center mt-2 mb-4 text-light">Seçtiğiniz verileri yükleyerek renk analizine başlayın.</h2>
                    <div class="row d-flex justify-content-center align-items-center">
                        <a href="coloranalysis.php" class="btn btn-light col-md-3 btn-radius p-3"><b>Renk analizine başla</b></a>
                    </div>
                    <div class="row justify-content-center align-items-center mt-3">
                        <a href="colorstatistics.php" class="btn btn-light col-md-3 btn-radius p-3"><b>Renk istatistiklerini gör</b></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js" async defer></script>
</body>

</html>