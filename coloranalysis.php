<?php
include_once "class/color_of_objects.php";
include_once "class/sub_classes.php";
$colorOfObject = new color_of_objects();

$result = null;
$mainClass = null;
$subClassID = null;
$subClassName = null;

if (isset($_POST["submit"])) {
    if ($_POST["selection"] != "Bir kategori seçiniz." && $_FILES["file"]["tmp_name"][0] != null) {
        if (count($_FILES["file"]["tmp_name"]) <= 3) {
            $classFullInfo = explode(" ", $_POST["selection"]);
            $mainClass = intval($classFullInfo[0]);
            $subClassID = doubleval($classFullInfo[1]);
            $subClassName = $classFullInfo[2];
            $total = count($_FILES['file']['name']);
            $newDir = sha1(mt_rand());
            mkdir("uploads/" . $newDir);
            $target_dir = "uploads/" . $newDir . "/";
            $fileNames = array();
            for ($i = 0; $i < $total; $i++) {
                $_FILES["file"]["name"][$i] = str_replace(" ", "", $_FILES["file"]["name"][$i]);
                $target_file = $target_dir . substr(sha1(mt_rand()), 0, 8) . basename($_FILES["file"]["name"][$i]);
                if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file)) {
                    array_push($fileNames, $target_file);
                }
            }
            if ($fileNames != null) {
                $result = shell_exec("python detect.py " . json_encode($fileNames));
                $result = trim($result);
            }
        } else { ?>
            <div class="alert alert-dark" role="alert">
                Resim sayısı en fazla 3 adet olmalı.
            </div>
        <?php }
    } else { ?>
        <div class="alert alert-dark" role="alert">
            Lütfen bir kategori ve en az bir resim seçiniz.
        </div>
<?php }
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
    <script type="text/javascript" src="js/events.js"></script>
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

    .custom-spinner {
        padding: 49%;
        background-color: rgb(75 75 75 / 90%);
        border-radius: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        visibility: hidden;
    }

    .res-img {
        object-fit: contain;
        max-height: 450px;
        background: rgb(162 164 166 / 22%);
        border-radius: 15px;
    }
</style>

<body>
    <div class="custom-spinner" id="spinner">
        <div class="text-center">
            <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
            <dotlottie-player src="https://lottie.host/697296c5-375d-4e78-b052-39125773ee60/sKruhEtHVd.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
            <h5 class="text-center text-light">Analiz ediliyor...</h5>
        </div>
    </div>
    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="fa-solid fa-bars" style="color: #ffffff; font-size:27px; margin:15px"></i></button>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Menü</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="coloranalysis.php" class="link-underline link-underline-opacity-0" style="color:#3e3e3e; font-size: 18px;"><i class="fa-solid fa-magnifying-glass-chart" style="font-size:12px; font-size: 18px;"></i> Renk analizi yap</a></li>
                <li class="list-group-item"><a href="colorstatistics.php" class="link-underline link-underline-opacity-0" style="color:#3e3e3e; font-size: 18px;"><i class="fa-solid fa-chart-line" style="font-size:12px; font-size: 18px;"></i> Kategorilere göre renk istatistikleri</a></li>
            </ul>
        </div>
    </div>

    <div class="jumbotron vertical-center">
        <div class="container">
            <div class="row">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="col">
                        <div class="row justify-content-center align-items-center mt-2 mb-5">
                            <div class="col-md-8">
                                <?php
                                $subClass = new SubClasses();
                                $allSubClasses = $subClass->getSubAllClasses();
                                ?>
                                <h2 class="text-center mb-4 text-light">Tespit edilecek nesneyi seçiniz.</h2>
                                <select class="form-select" name="selection" aria-label="Default select example">
                                    <option selected>Bir kategori seçiniz.</option>
                                    <?php
                                    foreach ($allSubClasses as $class) { ?>
                                        <option value="<?php echo $class["main_class_id"] . " " . $class["sub_class_id"] . " " . $class["sub_class_name"]; ?>"><?php echo $class["sub_class_name"]; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <h2 class="text-center mb-4 text-light">Verilerinizi yüklemeye başlayın.</h2>
                        <div class="row d-flex justify-content-center align-items-center upload-file">
                            <i class="fa-solid fa-plus plus-icon"></i>
                            <input class="form-control" type="file" accept="image/*" name="file[]" multiple="multiple" style="height:100%; background-color: transparent !important; padding-bottom: 15%;" multiple />
                        </div>
                        <div class="row justify-content-center align-items-center mt-5">
                            <input class="btn btn-light col-md-3 btn-radius p-3 mb-4" onclick="toggleLoadingSpinner()" id="uploadBtn" type="submit" name="submit" value="Yükle" />
                        </div>

                        <?php
                        if ($result != null && $result != "not found") {
                            $result = trim($result);
                            $result = explode("/", $result)[0];
                            $symbols = ["[", "]", "array", "(", ",", ")", "'"];
                            $result = trim(str_replace("      ", " ", str_replace($symbols, "", trim($result))));
                            // 0-> colors, 1-> classes
                            $colorsAndClasses = explode("*", $result);
                            $classes = explode(" ", trim($colorsAndClasses[1]));
                            $analyzes = explode("%", $colorsAndClasses[0]);
                            array_pop($analyzes);
                            $file_dir = trim($colorsAndClasses[2]);

                            $main_result = array();
                            $secondary_result = array();

                            function replace($param)
                            {
                                $regex = '/\s\s+/';
                                return str_replace(" ", ", ", trim(preg_replace($regex, ' ', str_replace("\n", " ", $param))));
                            }

                            if (count($analyzes) > 0) {
                                for ($i = 0; $i < count($classes); $i++) {
                                    if ($classes[$i] == $subClassID) {
                                        $main_result[] = array($classes[$i], array($analyzes[$i * 3], $analyzes[$i * 3 + 1], $analyzes[$i * 3 + 2]));
                                    } else {
                                        $secondary_result[] = array($classes[$i], array($analyzes[$i * 3], $analyzes[$i * 3 + 1], $analyzes[$i * 3 + 2]));
                                    }
                                }

                                if (count($main_result) > 0) { ?>
                                    <div class="row">
                                        <h4 class="text-center mb-2 text-light"><?php echo $subClassName; ?> kategorisine göre renk analizi sonuçları.</h4>
                                    </div>
                                    <div class="mt-5 result">
                                        <?php
                                        $indxOfImg = 0;

                                        for ($i = 0; $i < count($main_result); $i++) {
                                            $items = $main_result[$i];
                                            $items[1] = array_map("replace", $items[1]);
                                            $items[1] = array_reverse($items[1]);

                                            $rate = 0.0;
                                            $red = 0.0;
                                            $green = 0.0;
                                            $blue = 0.0;
                                            for ($j = 0; $j < count($items[1]); $j++) {
                                                $colorsAndRate = explode(", ", $items[1][$j]);
                                                $red += doubleval($colorsAndRate[0]);
                                                $green += doubleval($colorsAndRate[1]);
                                                $blue += doubleval($colorsAndRate[2]);
                                                $rate += doubleval($colorsAndRate[3]);
                                            }

                                            $colorOfObject->setColorRgb(round($red / 3, 2) . ", " . round($green / 3, 2) . ", " . round($blue / 3, 2));
                                            $colorOfObject->setSubClass($subClassID);
                                            $subClass->setsubClassID($subClassID);
                                            $classInfo = $subClass->getsubClassID();
                                            $colorOfObject->createColorValue();
                                        ?>
                                            <div class="col d-flex justify-content-center align-items-center result-bg">
                                                <img src="uploads/<?php echo $file_dir; ?>/<?php echo $items[0] . "_" . $indxOfImg; ?>_gfg_white.png" class="mt-1 res-img col-md-2">
                                                <?php
                                                for ($l = 0; $l < count($items[1]); $l++) {
                                                    $rnd = rand(50, 999);
                                                    $rgbColors = explode(", ", $items[1][$l]);
                                                    $rateOfAnalysis = round((100 * floatval($rgbColors[3])) / $rate, 2);
                                                ?>
                                                    <div class="skill-main col-md-2" style="margin:45px;">
                                                        <div class="skill-item">
                                                            <h4><?php echo $l + 1; ?>. Renk</h4>
                                                            <div class="progress">
                                                                <style>
                                                                    .progress<?php echo $i + $rnd; ?>::-webkit-progress-value {
                                                                        background: rgb(<?php echo $rgbColors[0] . ", " . $rgbColors[1], ", " . $rgbColors[2] ?>);
                                                                    }
                                                                </style>
                                                                <progress class="progress-bar col-5 <?php echo "progress" . $i + $rnd; ?>" style="height:100%; width:100%;" id="myProgress" value="<?php echo intval($rateOfAnalysis); ?>" max="100"> <?php echo explode(", ", $items[1][$l])[3]; ?> </progress>
                                                            </div>
                                                            <h6 class="text-center mt-1"><?php echo "rgb(" . $rgbColors[0] . ", " . $rgbColors[1], ", " . $rgbColors[2] . ")"; ?></h6>
                                                            <h6 class="text-center mt-1"><?php echo $rateOfAnalysis . "%";
                                                                                            ?></h6>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        <?php
                                            $indxOfImg++;
                                        }
                                        ?>
                                    </div>
                                <?php    } else { ?>
                                    <div class="row">
                                        <h4 class="text-center mb-2 mt-5 text-light"> Seçtiğiniz kategoride herhangi bir nesne tespit edilemedi.</h4>
                                    </div>
                                <?php }

                                if (count($secondary_result) > 0) { ?>
                                    <div class="row">
                                        <h4 class="text-center mb-2 mt-5 text-light"> Seçtiğiniz kategoriden farklı olarak bunlar tespit edildi.</h4>
                                    </div>
                                    <div class="mt-5 result">
                                        <?php
                                        $indxOfImg = 0;

                                        for ($i = 0; $i < count($secondary_result); $i++) {
                                            $items = $secondary_result[$i];
                                            $items[0] = intval($items[0]);
                                            $items[1] = array_map("replace", $items[1]);
                                            $items[1] = array_reverse($items[1]);
                                            $rate = 0.0;
                                            $red = 0.0;
                                            $green = 0.0;
                                            $blue = 0.0;
                                            for ($j = 0; $j < count($items[1]); $j++) {
                                                $colorsAndRate = explode(", ", $items[1][$j]);
                                                $red += doubleval($colorsAndRate[0]);
                                                $green += doubleval($colorsAndRate[1]);
                                                $blue += doubleval($colorsAndRate[2]);
                                                $rate += doubleval($colorsAndRate[3]);
                                            }

                                            $colorOfObject->setColorRgb(round($red / 3, 2) . ", " . round($green / 3, 2) . ", " . round($blue / 3, 2));
                                            $colorOfObject->setSubClass($items[0]);
                                            $subClass->setsubClassID($items[0]);
                                            $classInfo = $subClass->getsubClassID();
                                            $colorOfObject->createColorValue();
                                        ?>
                                            <div class="col d-flex justify-content-center align-items-center result-bg">
                                                <img src="uploads/<?php echo $file_dir; ?>/<?php echo $items[0] . "_0"; ?>_gfg_white.png" class="mt-1 res-img col-md-2">
                                                <?php
                                                for ($l = 0; $l < count($items[1]); $l++) {
                                                    $rnd = rand(50, 999);
                                                    $rgbColors = explode(", ", $items[1][$l]);
                                                    $rateOfAnalysis = round((100 * floatval($rgbColors[3])) / $rate, 2);
                                                ?>
                                                    <div class="skill-main col-md-2" style="margin:45px;">
                                                        <div class="skill-item">
                                                            <h4><?php echo $l + 1; ?>. Renk</h4>
                                                            <div class="progress">
                                                                <style>
                                                                    .progress<?php echo $i + $rnd; ?>::-webkit-progress-value {
                                                                        background: rgb(<?php echo $rgbColors[0] . ", " . $rgbColors[1], ", " . $rgbColors[2] ?>);
                                                                    }
                                                                </style>
                                                                <progress class="progress-bar col-5 <?php echo "progress" . $i + $rnd; ?>" style="height:100%; width:100%;" id="myProgress" value="<?php echo intval($rateOfAnalysis); ?>" max="100"> <?php echo explode(", ", $items[1][$l])[3]; ?> </progress>
                                                            </div>
                                                            <h6 class="text-center mt-1"><?php echo "rgb(" . $rgbColors[0] . ", " . $rgbColors[1], ", " . $rgbColors[2] . ")"; ?></h6>
                                                            <h6 class="text-center mt-1"><?php echo $rateOfAnalysis . "%";
                                                                                            ?></h6>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        <?php
                                            $indxOfImg++;
                                        }
                                        ?>
                                    </div>
                                <?php }
                            } else { ?>
                                <div class="row justify-content-center align-items-center mt-2 mb-5">
                                    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                                    <dotlottie-player src="https://lottie.host/bed5c7fe-60b6-47f1-840a-3a73a7cf3708/BnHMGGWshW.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
                                    <div class="row">
                                        <h4 class="text-center mb-4 text-light">Maalesef veriler üzerinde istenen kategorideki nesneyi tespit edemedik. </h4>
                                    </div>
                                </div>
                            <?php }
                        } else if ($result == "not found") { ?>
                            <div class="row justify-content-center align-items-center mt-2 mb-5">
                                <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                                <dotlottie-player src="https://lottie.host/bed5c7fe-60b6-47f1-840a-3a73a7cf3708/BnHMGGWshW.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
                                <div class="row">
                                    <h4 class="text-center mb-4 text-light">Maalesef veriler üzerinde istenen kategorideki nesneyi tespit edemedik. </h4>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>

</html>