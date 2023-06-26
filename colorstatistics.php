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
        display: flex;
        align-items: center;
        justify-content: center;
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

    #container {
        width: 100%;
        max-width: 900px;
        background-color: rgba(222, 226, 230, 0.22);
        border-radius: 5px;
        padding: 18px;
        border-radius: 15px;
    }

    #container {
        margin-top: 50px;
    }
</style>

<body>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/networkgraph.js"></script>

    <div id="container"></div>
    <script>
        Highcharts.chart('container', {

            chart: {
                type: 'networkgraph',
                marginTop: 80
            },

            title: {
                text: 'Renk Analizi'
            },


            plotOptions: {
                networkgraph: {
                    keys: ['from', 'to'],
                    layoutAlgorithm: {
                        enableSimulation: true,
                        integration: 'verlet',
                        linkLength: 100
                    }
                }
            },

            series: [{
                marker: {
                    radius: 13,
                },
                dataLabels: {
                    enabled: true,
                    linkFormat: '',
                    allowOverlap: true,
                    style: {
                        textOutline: false
                    }
                },
                data: [
                    <?php
                    echo "['Pantolon', 'Giyim']";
                    ?>
                    /*
                    ['Pantolon', 'Giyim'],
                    ['Canta', 'Giyim'],
                    ['Gomlek', 'Giyim'],
                    ['Ayakkabi', 'Giyim']
                    */
                ],
                nodes: [{
                    id: 'Giyim',
                    marker: {
                        radius: 30,
                        width: '250',
                        height: '250'
                    },
                    color: 'rgb(50,120,222)',
                    marker: {
                        width: '150',
                        height: '150'
                    }
                }, ]
            }]
        });
    </script>

</body>

</html>