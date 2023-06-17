<?php


$result = null;
if (isset($_POST["submit"])) {
    if (isset($_POST["selection"]) && isset($_FILES["file"])) {
        $total = count($_FILES['file']['name']);
        $newDir = sha1(mt_rand());
        mkdir("uploads/" . $newDir);
        $target_dir = "uploads/" . $newDir . "/";
        $fileNames = array();
        for ($i = 0; $i < $total; $i++) {
            $target_file = $target_dir . substr(sha1(mt_rand()), 0, 8) . basename($_FILES["file"]["name"][$i]);
            if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file)) {
                array_push($fileNames, $target_file);
            }
        }
        if ($fileNames != null) {
            $result = shell_exec("python detect.py " . json_encode($fileNames));
            if ($result == "failed") {
                echo "HATA";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Renk Analizi | Ana sayfa</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    html {
        height: 100%;
        overflow-x: hidden;
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

    .upload-file {
        height: 100%;
        margin-left: 15%;
        margin-right: 15%;
        position: relative;
        z-index: 1;
    }

    .plus-icon {
        position: absolute;
        color: antiquewhite;
        width: 100%;
        text-align: center;
        font-size: 100px;
        z-index: -1;
    }

    .result {
        min-height: 250px;
        min-width: 250px;
    }

    .result-bg {
        background-color: rgba(222, 226, 230, 0.22);
        border-radius: 5px;
    }
</style>

<body>
    <div class="jumbotron vertical-center">
        <div class="container">
            <div class="row">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="col">
                        <div class="row justify-content-center align-items-center mt-2 mb-5">
                            <div class="col-md-8">
                                <h2 class="text-center mb-4 text-light">Tespit edilecek nesneyi seçiniz.</h2>
                                <select class="form-select" name="selection" aria-label="Default select example">
                                    <option selected>Bir kategori seçiniz.</option>
                                    <option value="Araba">Araba</option>
                                    <option value="Kazak">Kazak</option>
                                    <option value="Ayakkabı">Ayakkabı</option>
                                </select>
                            </div>
                        </div>
                        <h2 class="text-center mb-4 text-light">Verilerinizi yüklemeye başlayın.</h2>
                        <div class="row d-flex justify-content-center align-items-center upload-file">
                            <i class="fa-solid fa-plus plus-icon"></i>
                            <input class="form-control" type="file" accept="image/*" name="file[]" multiple="multiple" style="height:100%; background-color: transparent !important; padding-bottom: 15%;" multiple />
                        </div>
                        <div class="row justify-content-center align-items-center mt-5">
                            <input class="btn btn-light col-md-3 btn-radius p-3 mb-4" type="submit" name="submit" value="Yükle" />
                        </div>

                        <?php if ($result != null) {
                            $result = trim($result);
                            echo $result;
                            $symbols = ["[", "]", "array", "(", ",", ")", "'"];
                            $result = trim(str_replace("      ", " ", str_replace($symbols, "", trim($result))));
                            $analyzes = explode("%", $result);
                            array_pop($analyzes);
                            $analyzes = array_reverse($analyzes);

                            $firstAnalysis = doubleval(explode(" ", trim($analyzes[0]))[3]);
                            $secondAnalysis = doubleval(explode(" ", trim($analyzes[1]))[3]);
                            $thirdAnalysis = doubleval(explode(" ", trim($analyzes[2]))[3]);
                            $sum = 0;
                            for ($i = 0; $i < count($analyzes); $i++) {
                                $rate = doubleval(explode(" ", trim($analyzes[$i]))[3]);
                                $sum += $rate;
                            }
                        ?>
                            <div class="row mt-5 result">
                                <div class="row">
                                    <h2 class="text-center mb-4 text-light">Kazak kategorisine göre renk analizi sonuçları.</h2>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center result-bg">
                                    <?php
                                    $i = 1;
                                    foreach ($analyzes as $analysis) {
                                        $items = explode(" ", trim($analysis));
                                        $rateOfAnalysis = doubleval($items[3] * 100 / $sum); ?>
                                        <div class="skill-main col-md-2" style="margin:45px;">
                                            <div class="skill-item">
                                                <h4><?php echo $i; ?>. Renk</h4>
                                                <div class="progress">
                                                    <style>
                                                        .progress<?php echo $i; ?>::-webkit-progress-value {
                                                            background: rgb(<?php echo $items[0] . "," . $items[1] . ", " . $items[2]; ?>);
                                                        }
                                                    </style>
                                                    <progress class="progress-bar col-5 <?php echo "progress" . $i; ?>" style="height:100%; width:100%;" id="myProgress" value="<?php echo $rateOfAnalysis; ?>" max="100"> <?php echo $items[3]; ?> </progress>
                                                </div>
                                                <h6 class="text-center mt-1"><?php echo "rgb(" . $items[0] . "," . $items[1] . ", " . $items[2] . ")"; ?></h6>
                                                <h6 class="text-center mt-1"><?php echo substr(strval($rateOfAnalysis), 0, 5) . "%"; ?></h6>
                                            </div>
                                        </div>
                                    <?php $i++;
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>