<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="wrapper">
        <header> Currency Converter</header>
        <form method="GET" action="" id="conversionForm">
            <div class="amount">
                <p> Please enter the amount:</p>
                <input type="text" name="amount" value="<?php echo isset($_GET['amount']) ? htmlspecialchars($_GET['amount']) : ''; ?>">
            </div>
            <div class="drop-list">
                <div class="from">
                    <p>From:</p>
                    <div class="select-box">
                        <select name="firstcurrency" id="firstcurrency">
                            <?php
                            $currencies = ['Select', 'KWD', 'USD', 'CAD', 'ARS', 'XAF', 'BRL', 'TWD', 'EUR'];
                            foreach ($currencies as $currency) {
                                $selected = (isset($_GET['firstcurrency']) && $_GET['firstcurrency'] == $currency) ? 'selected' : '';
                                echo "<option value=\"$currency\" $selected>$currency</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="invert" value="1">
                <div class="icon">
                <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div class="to">
                    <p> To:</p>
                    <div class="select-box">
                        <select name="secondcurrency" id="secondcurrency">
                            <?php
                            foreach ($currencies as $currency) {
                                $selected = (isset($_GET['secondcurrency']) && $_GET['secondcurrency'] == $currency) ? 'selected' : '';
                                echo "<option value=\"$currency\" $selected>$currency</option>";
                            }
                            ?>
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
            <button type="submit"> Get Exchange Rate</button>
        </form>
    </div>
</body>

</html>
