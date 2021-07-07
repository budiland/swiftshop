<?php
function selectComboBox($conn)
{
    $sql = "SELECT * FROM metode_pembayaran";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["ID_METODE"] . ">" . $row["NAMA_METODE"] . "</option>";
            $i = $i + 1;
        }
    } else {
        echo "0 results";
    }
}

function hasilForm($conn, $type)
{
    if ($_GET) {
        if ($type == "item") {
            // Select item berdasarkan metode
            $sql = "SELECT * FROM item where VALUE_ITEM =" . $_GET['nominal'] . " and ID_GAME=" . $_GET['game'];
            $result = $conn->query($sql);

            // Cek apakah butuh menghitung
            if ($result->num_rows > 0) {
                echo "nominal sama tidak butuh menghitung";
                return;
            } else {
                // Select item berdasarkan metode
                $sql = "SELECT * FROM item where ID_METODE =" . $_GET['metode'];
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        $nama[$i] = $row['NAMA_ITEM'];
                        $value[$i] = $row['VALUE_ITEM'];
                        $harga[$i] = $row['HARGA_ITEM'];
                        $i = $i + 1;
                    }
                    try {
                        hitungdiamond($nama, $value, $harga);
                    } catch (\Throwable $th) {
                    }
                } else {
                    echo "0 results";
                    return;
                }
            }
        } elseif ($type == "uang") {
            // Select item berdasarkan metode
            $sql = "SELECT * FROM item where HARGA_ITEM =" . $_GET['nominal'] . " and ID_GAME=" . $_GET['game'];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "nominal sama tidak butuh menghitung";
                return;
            } else {
                // Select item berdasarkan metode
                $sql = "SELECT * FROM item where ID_METODE =" . $_GET['metode'] . " and ID_GAME=" . $_GET['game'];
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        $nama[$i] = $row['NAMA_ITEM'];
                        $value[$i] = $row['VALUE_ITEM'];
                        $harga[$i] = $row['HARGA_ITEM'];
                        $i = $i + 1;
                    }
                    try {
                        hitunguang($nama, $value, $harga);
                    } catch (\Throwable $th) {
                    }
                } else {
                    echo "0 results";
                    return;
                }
            }
        }
    }
}

function hitungdiamond($nama, $value, $harga)
{
    // mencari item lebih besar dari nominal diamond yang diinginkan
    for ($i = 0; $value[$i] < $_GET['nominal'] || $i >= count($value) - 1; $i++) {
    }
    $hasil1 = $value[$i];
    // echo $value[$i] . " " . $harga[$i];
    // echo "<br>";
    // echo "atau";
    // echo "<br>";
    if ($i == 0) {
    } else {
        // echo $value[$i - 1] . " " . $harga[$i - 1];
    }
    $sisa    = $_GET['nominal'] -  $value[$i - 1];
    // echo "<br>";
    // mencari item lebih besar dari nominal diamond sisa yang diinginkan
    for ($j = 0; $value[$j] < $sisa || $i >= count($value) - 1; $j++) {
    }
    if ($j == 1) {
    } else {
        // echo $value[$j - 0] . " " . $harga[$j - 0];
    }

    $hasil2 = $value[$i - 1] + $value[$j];
    $harga2 = $harga[$i - 1] + $harga[$j];

    echo "<style>
      .section-form .field-form .kanan.php-muncul {
            visibility: visible;
        }
    </style>";

    echo "<script>
        var xValues = ['" . $nama[$i] . " = " . $harga[$i] . "'
        , '" .  $nama[$i - 1] . " + " . $nama[$j] . " = " .
        $harga2 . ".'];
        var yValues = [" . $hasil1 . " , " . $hasil2 . "];
    </script>";
}

function hitunguang($nama, $value, $harga)
{
    // mencari item lebih besar dari nominal uang yang diinginkan
    for ($i = count($harga) - 1; $harga[$i] > $_GET['nominal'] || $i <= 0; $i--) {
    }
    $hasil1 = $value[$i + 1];
    // echo $harga[$i + 1] . " " . $value[$i + 1];
    // echo "<br>";
    // echo "atau";
    // echo "<br>";
    // echo $harga[$i] . " " . $value[$i];
    $sisa = $_GET['nominal'] -  $harga[$i];
    // echo "<br>";
    // echo "Sisa " . $sisa;
    // echo "<br>";
    // mencari item lebih besar dari nominal uang sisa yang diinginkan
    for ($j = count($harga) - 1; $harga[$j] > $sisa || $j <= 0; $j--) {
    }
    // echo $harga[$j] . " " . $value[$j];
    $hasil2 = $value[$i] + $value[$j];
    $harga2 = $harga[$i] + $harga[$j];

    echo "<style>
      .section-form .field-form .kanan.php-muncul {
            visibility: visible;
        }
    </style>";

    echo "<script>
        var xValues = ['" . $nama[$i + 1] . " = " . $harga[$i + 1] . "'
        , '" .  $nama[$i] . " + " . $nama[$j] . " = " .
        $harga2 . ".'];
        var yValues = [" . $hasil1 . " , " . $hasil2 . "];
    </script>";
}
