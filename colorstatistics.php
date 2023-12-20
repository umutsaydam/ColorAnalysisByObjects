<?php
include_once "class/classes.php";
include_once "class/sub_classes.php";
include_once "class/color_of_objects.php";

function calculateAverageColor($colors)
{
    $cnt = count($colors);
    $red = 0.0;
    $green = 0.0;
    $blue = 0.0;
    foreach ($colors as $item) {
        $rgb = explode(",", $item);
        $red += floatval($rgb[0]);
        $green += floatval($rgb[1]);
        $blue += floatval($rgb[2]);
    }
    return number_format($red / $cnt, 2) . ", " . number_format($green / $cnt, 2) . ", " . number_format($blue / $cnt, 2);
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

    .statistics {
        width: 100%;
        max-width: 900px;
        background-color: rgba(222, 226, 230, 0.22);
        border-radius: 5px;
        padding: 18px;
        border-radius: 15px;
    }

    .area {
        width: 100%;
        height: 90%;
        margin-top: -50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #container {
        width: 90%;
        height: 90%;
        background-color: rgba(222, 226, 230, 0.22);
        border-radius: 5px;
        padding: 8px;
        border-radius: 15px;
        -webkit-box-shadow: 0px 0px 59px -20px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 0px 0px 59px -20px rgba(0, 0, 0, 0.75);
        box-shadow: 0px 0px 59px -20px rgba(0, 0, 0, 0.75);
    }

    #container {
        margin-top: 50px;
    }

    .time-line-btn {
        display: flex;
        width: 50%;
        align-items: center;
        justify-content: center;
    }

    .color-box {
        min-height: 3em;
        vertical-align: middle;
        color: #3e3e3e;
        float: right;
        border-radius: 20px;
        text-align: center;
    }

    .statistic-title {
        font-size: 1.5rem;
        border-bottom: 2px solid #eaeaea;
        padding: 2px;
    }

    .statistic-sub-class {
        color: #3e3e3e;
        padding-top: 10px;
    }

    .count-of-data {
        font-size: 0.9rem;
        opacity: 0.7;
    }

    span.rgb-color-code {
        border-color: rgba(222, 226, 230, 0.22);
        padding: 5px;
        border-radius: 15px;
        float: right;
        color: #fffc;
    }

    path.highcharts-point.highcharts-color-0.highcharts-node {
        stroke: white;
        stroke-width: 0.3px;
    }

    path.highcharts-point.highcharts-color-0.highcharts-node:hover {
        stroke: white;
        stroke-width: 1px;
    }
</style>

<body>
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
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/networkgraph.js"></script>
    <?php
    $colorOfObjects = new color_of_objects();
    $subClassesWithParentClasses = null;
    $analyzesTimeFilter = "alltimes";
    if (isset($_GET["filterradio"])) {
        $analyzesTimeFilter = $_GET["filterradio"];
        $subClassesWithParentClasses = $colorOfObjects->getColorsWithParents($analyzesTimeFilter);
    } else {
        $subClassesWithParentClasses = $colorOfObjects->getColorsWithParents();
    }
    $nodes = "";
    $datas = "";
    $colorsByObjects = array();
    $statisticOfColor = array();
    if ($subClassesWithParentClasses != null) {
        foreach ($subClassesWithParentClasses as $item) {
            $className = $item['class_name'];
            $subClassName = $item['sub_class_name'];
            $colorRgb = $item['color_rgb'];
            if (!isset($colorsByObjects[$className])) {
                $colorsByObjects[$className] = [];
            }
            if (!isset($colorsByObjects[$className][$subClassName])) {
                $colorsByObjects[$className][$subClassName] = [];
            }
            $colorsByObjects[$className][$subClassName][] = $colorRgb;
        }


        $statisticOfColorByMainClass = array();
        $statisticOfColorByCount = array();
        foreach ($colorsByObjects as $key => $value) {
            foreach ($value as $subKey => $subValue) {
                if (!isset($statisticOfColor[$key])) {
                    $statisticOfColor[$key] = [];
                    $statisticOfColorByCount[$key] = [];
                }
                if (!isset($statisticOfColor[$key][$subKey])) {
                    $statisticOfColor[$key][$subKey] = [];
                    $statisticOfColorByCount[$key][$subKey] = [];
                }
                //echo $key." ".$subKey." ".json_encode(count($subValue))."-";
                $statisticOfColorByCount[$key][$subKey] = count($subValue);
                $resultOfCalculate = calculateAverageColor($subValue);
                $statisticOfColor[$key][$subKey] = $resultOfCalculate;
            }
        }
        foreach ($statisticOfColor as $key => $value) {
            if (!isset($statisticOfColorByMainClass[$key])) {
                $statisticOfColorByMainClass[$key] = [];
            }
            $statisticOfColorByMainClass[$key] = calculateAverageColor($value);
        }

        foreach ($statisticOfColor as $classItemKey => $classItemValue) {
            $nodes .= "{
                id: '" . $classItemKey . "',
                marker: {
                  radius: 60,
                },
                
                color: 'rgb(" . $statisticOfColorByMainClass[$classItemKey] . ")',                
              },";
            foreach ($classItemValue as $key => $value) {
                $nodes .=  "{
                    id: '" . $key . "',
                    marker: {
                      radius: 40,
                    },
                    color: 'rgb(" . $value . ")'
                  },";

                $datas .= "['" . $key . "', '" . $classItemKey . "'],";
            }
        }
        $datas = substr($datas, 0, strlen($datas) - 1);
    }
    ?>

    <div class="area">
        <div id="container"></div>
    </div>
    <script>
        Highcharts.setOptions({
            title: {
                style: {
                    color: '#ffffff',
                    fontWeight: 'bold',
                    fontSize: '18px',
                    fontFamily: 'Trebuchet MS, Verdana, sans-serif'
                }
            }
        });
        Highcharts.chart('container', {

            chart: {
                type: 'networkgraph',
                backgroundColor: '#3e3e3e',
                borderRadius: '8px',
                marginTop: 80
            },
            title: {
                text: 'Renk İstatistikleri'
            },
            plotOptions: {
                networkgraph: {
                    keys: ['from', 'to'],
                    layoutAlgorithm: {
                        enableSimulation: true,
                        integration: 'verlet',
                        linkLength: 100
                    },
                    dataLabels: {
                        style: {
                            color: '#fffc',
                            fontWeight: 'bold',
                            fontSize: '15px',
                            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
                        },
                    }
                },
            },
            series: [{
                marker: {
                    radius: 13,
                },
                dataLabels: {
                    enabled: true,
                    linkFormat: '',
                    borderRadius: 10,
                    borderWidth: 1,
                    backgroundColor: 'rgba(222, 226, 230, 0.22)',
                    allowOverlap: true,
                    style: {
                        textOutline: false
                    }
                },
                data: [
                    <?php echo $datas; ?>
                    /*['Pantolon', 'Giyim'],
                    ['Canta', 'Giyim'],
                    ['Gomlek', 'Giyim'],
                    ['Ayakkabi', 'Giyim']*/

                ],
                nodes: [<?php echo $nodes; ?>]
            }]
        });
    </script>

    <div class="area" style="height:auto !important; margin-top:15px;">
        <div id="container">
            <div class="card">
                <div class="card-header">
                    <h4>Kategorilerine Göre Renk En Çok Tercih Edilen Renkler</h4>
                    <p>
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa-solid fa-filter"></i> Filtrele
                        </a>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form action="colorstatistics.php" method="GET">
                                <ul>
                                    <li class="list-group-item">
                                        <div class="col-md-12 d-flex align-items-center justify-content-center">
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="filterradio" value="alltimes" id="btnradio1" autocomplete="off" <?php echo $analyzesTimeFilter == "alltimes" ? "checked" : ""; ?>>
                                                <label class="btn btn-outline-primary" for="btnradio1">Tüm zamanlar</label>

                                                <input type="radio" class="btn-check" name="filterradio" value="lastyear" id="btnradio2" autocomplete="off" <?php echo $analyzesTimeFilter == "lastyear" ? "checked" : ""; ?>>
                                                <label class="btn btn-outline-primary" for="btnradio2">Geçen yıl</label>

                                                <input type="radio" class="btn-check" name="filterradio" value="thisyear" id="btnradio3" autocomplete="off" <?php echo $analyzesTimeFilter == "thisyear" ? "checked" : ""; ?>>
                                                <label class="btn btn-outline-primary" for="btnradio3">Bu yıl</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-md-12 d-flex align-items-center justify-content-center mt-3">
                                        <input type="submit" class="btn btn-primary" value="Filtrele">
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>

                    <div class="card-body" style="padding: 0 !important">
                        <blockquote class="blockquote mb-0">
                            <?php // $statisticOfColorByCount[$key][$k]
                            if (count($statisticOfColor) > 0) {
                                foreach ($statisticOfColor as $key => $value) { ?>
                                    <p class="statistic-title"><?php echo $key; ?></p>
                                    <?php
                                    foreach ($value as $k => $val) { ?>
                                        <footer class="blockquote-footer mt-2 statistic-sub-class"><b><?php echo $k; ?></b>
                                            <cite title="Source Title"></cite>
                                            <span class="color-box col-10" style="background-color: rgb(<?php echo $val; ?>)">
                                                <span class="rgb-color-code">rgb(<?php echo $val; ?>)</span>
                                            </span>
                                            <p class="count-of-data"><?php echo "(" . $statisticOfColorByCount[$key][$k] . " adet veri ile hesaplanmıştır.)"; ?></p>
                                        </footer>
                                <?php }
                                }
                            } else { ?>
                                <div class="alert alert-dark" role="alert">
                                    Veri bulunamadı.
                                </div>
                            <?php }
                            ?>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>