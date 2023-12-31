<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>Currency Converter</title>
</head>

<body>

    <div class="wrapper">
        <header> Currency Converter</header>
        <form method="GET" action="<?php echo $_SERVER["PHP_SELF"] ?>">
            <div class="amount">
                   <p> Please enter the amount:</p>
                    <input type="text" name="amount" value="1">

            </div>
            <div class="drop-list">  
                <div class="from"> 
                    <p>From</p>     
                    <select name="firstcurrency" id="firstcurrency">
                        <option value="Select">Select</option>
                        <option value="EUR">EUR</option>
                        <option value="KWD">KWD</option>
                        <option value="US">US</option>
                    </select>
                </div>    
                    <div class="to">
                        <p> To:</p>
                        
                        <select name="secondcurrency" id="secondcurrency">
                            <option value="Select">Select</option>
                            <option value="EUR">EUR</option>
                            <option value="KWD">KWD</option>
                            <option value="US">US</option>
                        </select>
                    </div>
                    <div class="exchange-rate"> getting exchange rate...</div>
                    <button type="submit" formmethod="get"> Get Exchange Rate</button>
            </div>        
           
        </form>
    </div>
    <?php
    if (isset($_GET['amount']) && isset($_GET['firstcurrency']) && isset($_GET['secondcurrency'])) {
        $amount = $_GET['amount'];
        $firstCurrency = $_GET['firstcurrency'];
        $secondCurrency = $_GET['secondcurrency'];

        if (!empty($amount) && $firstCurrency !== 'Select' && $secondCurrency !== 'Select') {
            $endpoint = "https://currency-converter18.p.rapidapi.com/api/v1/convert?";
            $fromCurrency = $firstCurrency;
            $toCurrency = $secondCurrency;

            // Building the final API endpoint
            $finalEndpoint = "{$endpoint}from={$fromCurrency}&to={$toCurrency}&amount={$amount}";

            // cURL request to the API
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => $finalEndpoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: currency-converter18.p.rapidapi.com",
                    "X-RapidAPI-Key: 5d222445a9msh2e4bf8e8bf88484p15d3c6jsn95fd8d349b11"  // Remplacez VOTRE_CLE_API par votre clé API
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                // Décoder la réponse JSON
                $data = json_decode($response, true);

                // Vérifier si la conversion a réussi
                if ($data['success']) {
                    // Afficher le résultat de la conversion avec 2 chiffres après la virgule
                    echo "Converted Amount: " . number_format($data['result']['convertedAmount'], 2);
                } else {
                    // Afficher un message en cas d'échec de la conversion
                    echo "Conversion failed. Validation Message: " . implode(", ", $data['validationMessage']);
                }
            }
        } else {
            echo "Missing required data";
        }
    }
    ?>
</body>

</html>
