<?php
require './backend/koneksi.php';
require './backend/formbackend.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="">
    <title></title>
    <link rel="stylesheet" href="./css/style.min.css">
    <!-- Font Awesome kit -->
</head>

<body>
    <div class="navbar">
        <div class="kiri">
            <img src="./img/Group 22.png" alt="" class="logo">
            <div class="field-teks">
                <div class="judul">
                    <p class="teks1">Swift</p>
                    <p class="teks2">Shop</p>
                </div>
                <p class="teks">Cara Jitu Top Up Cerdas !</p>
            </div>
        </div>
        <div class="kanan"><img src="./img/Icon ionic-ios-search.png" alt=""></div>
    </div>
    <div class="section-form">
        <div class="field-form">
            <div class="kiri">
                <form action="#" method="GET">
                    <input type="hidden" name="game" value="3">
                    <label for="nominal">Jumlah UC yang diinginkan</label>
                    <input type="text" name="nominal" id="nominal" placeholder="Masukkan nominal UC">
                    <label for="pembayaran">Metode Pembayaran</label>
                    <div class="custom-select">
                        <select name="metode" id="metode">
                            <option value="0">Metode Pembayaran:</option>
                            <?php selectComboBox($conn) ?>
                        </select>
                    </div>
                    <input type="submit" value="Hitung Sekarang!">
                </form>
            </div>
            <div class="kanan php-muncul">
                <div class="atas">
                    <?php hasilForm($conn, "item"); ?>
                    <canvas id="myChart" style="width:100%;"></canvas>
                    <!-- <img src="./img/Group 14.png" alt="" class="gambar"> -->
                    <p class="teks">Hasil Perhitungan akan muncul di sini</p>
                </div>
                <div class="bawah">
                    <a href="./reportExcel.php" class="button-red">Download Excel</a>
                    <a href="./reportPDF.php" class="button-green">Download PDF</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
    <script src="./script/script.js"></script>
    <script>
        try {
            // var xValues = ["Pilihan 1", "Pilihan 2"];
            // var yValues = [55, 49];
            var barColors = ["#b46bff", "#00b0ab"];

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    indexAxis: 'y',
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Hasil Perhitungan"
                    }
                }
            });
        } catch (error) {

        }
    </script>
</body>

</html>