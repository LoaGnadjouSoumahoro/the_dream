<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>Currency Converter</title>
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

    <div class="wrapper">
        <header> Currency Converter</header>
        <form method="GET" action="./conversion.php" id="conversionForm">
            <div class="amount">
                <p> Please enter the amount:</p>
                <input type="text" name="amount" value="0">
            </div>
            <div class="drop-list">
                <div class="from">
                    <p>From</p>
                    <div class="select-box">
                        <select name="firstcurrency" id="firstcurrency">
                            <option value="Select">Select</option>
                            <option value="EUR">EUR</option>
                            <option value="KWD">KWD</option>
                            <option value="USD">USD</option>
                            <option value="CAD">CAD</option>
                            <option value="ARS">ARS</option>
                            <option value="XAF">XAF</option>
                            <option value="BRL">BRL</option>
                            <option value="BRL">BRL</option>
                            <option value="TWD">TWD</option>

                        </select>
                    </div>
                </div>
                <input type="hidden" name="invert" value="1">
                <div class="icon"><i class="fa-solid fa-arrow-right-arrow-left"></i></div>
                <div class="to">
                    <p> To:</p>
                    <div class="select-box">
                        <select name="secondcurrency" id="secondcurrency">
                            <option value="Select">Select</option>
                            <option value="EUR">EUR</option>
                            <option value="KWD">KWD</option>
                            <option value="USD">USD</option>
                            <option value="CAD">CAD</option>
                            <option value="ARS">ARS</option>
                            <option value="XAF">XAF</option>
                            <option value="BRL">BRL</option>
                            <option value="BRL">BRL</option>
                            <option value="TWD">TWD</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="exchange-rate"> 
                <?php

                    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['amount']) && isset($_GET['firstcurrency']) && isset($_GET['secondcurrency'])) {
                        include('./conversion.php');
                    } else {
                        echo 'Getting exchange rate...';
                    }
                ?> 
            </div>
            <button type="button" onclick="getExchangeRate()"> Get Exchange Rate</button>
                
            </div>
        </form>
    </div>

    <!-- <?php

include('./conversion.php');
    ?> -->

     <script>
        // Fonction pour effectuer la requête AJAX
        function getExchangeRate() {
            var form = document.getElementById('conversionForm');
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('GET', './conversion.php?' + new URLSearchParams(formData).toString(), true);

            xhr.onload = function () {
                if (xhr.status == 200) {
                    // Mettez à jour la div avec le résultat de la conversion
                    document.querySelector('.exchange-rate').innerHTML = xhr.responseText;
                }
            };

            xhr.send();
        }
    </script> 

</body>

</html>
