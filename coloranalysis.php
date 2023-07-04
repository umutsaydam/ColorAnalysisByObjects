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
                $result = shell_exec("python detect.py " . json_encode($fileNames) . "*" . $subClassID);
                if (trim($result) == "not found") {
                    $result = null;
                    
                }
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
        background-color: rgb(157 157 157 / 80%);
        border-radius: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        visibility: hidden;
    }
</style>

<body>
    <div class="custom-spinner" id="spinner">
        <div class="text-center">
            <div class="spinner-border" style="width: 100px; height: 100px;" role="status">
                
            </div>
            <span>Analiz ediliyor...</span>
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

                        <?php if ($result != null) {
                            $result = trim($result);
                            echo $result;
                            $result = explode("/", $result)[0];
                            $symbols = ["[", "]", "array", "(", ",", ")", "'"];
                            $result = trim(str_replace("      ", " ", str_replace($symbols, "", trim($result))));
                            // 0-> colors, 1-> classes
                            $colorsAndClasses = explode("*", $result);
                            $classes = explode(" ", trim($colorsAndClasses[1]));
                            $analyzes = explode("%", $colorsAndClasses[0]);
                            array_pop($analyzes);
                            $analyzes = array_reverse($analyzes);

                        ?> <div class="row">
                                <h4 class="text-center mb-4 text-light"><?php echo $subClassName; ?> kategorisine göre renk analizi sonuçları.</h4>
                            </div>
                            <div class="row mt-5 result">
                                <?php
                                $sum = 0;
                                $className = null;
                                for ($i = 0; $i < count($analyzes); $i++) {
                                    $items = explode(" ", str_replace("  ", " ", trim($analyzes[$i])));
                                    if ($i % 3 == 0) {
                                        $colorOfObject->setColorRgb(($items[0] . "," . $items[1] . "," . $items[2]));
                                        $colorOfObject->setSubClass($subClassID);
                                        $subClass->setsubClassID($subClassID);
                                        $classInfo = $subClass->getsubClassID();
                                        $colorOfObject->createColorValue();

                                        $sum = 0;
                                        for ($j = $i; $j <= $i + 2; $j++) {
                                            $rate = doubleval(explode(" ", str_replace("  ", " ", trim($analyzes[$j])))[3]);
                                            $sum += $rate;
                                        }
                                ?>
                                        <div class="col d-flex justify-content-center align-items-center result-bg">
                                        <?php }
                                    $rateOfAnalysis = $items[3] * 100 / $sum;
                                        ?>
                                        <div class="skill-main col-md-2" style="margin:45px;">
                                            <div class="skill-item">
                                                <h4><?php echo $i + 1; ?>. Renk</h4>
                                                <div class="progress">
                                                    <style>
                                                        .progress<?php echo $i + 1; ?>::-webkit-progress-value {
                                                            background: rgb(<?php echo $items[0] . ", " . $items[1] . ", " . $items[2]; ?>);
                                                        }
                                                    </style>
                                                    <progress class="progress-bar col-5 <?php echo "progress" . $i + 1; ?>" style="height:100%; width:100%;" id="myProgress" value="<?php echo intval($rateOfAnalysis); ?>" max="100"> <?php echo $items[3]; ?> </progress>
                                                </div>
                                                <h6 class="text-center mt-1"><?php echo "rgb(" . $items[0] . "," . $items[1] . ", " . $items[2] . ")"; ?></h6>
                                                <h6 class="text-center mt-1"><?php echo (strlen(strval($rateOfAnalysis)) > 5 ? substr($rateOfAnalysis, 0, 5) : $rateOfAnalysis) . "%";
                                                                                ?></h6>
                                            </div>
                                        </div>
                                        <?php
                                        if ($i != 0 && ($i + 1) % 3 == 0) {
                                        ?>
                                        </div>
                                <?php }
                                    }
                                ?>
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