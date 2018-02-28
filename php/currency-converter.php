<?php
function currencyConverter($currency_from,$currency_to,$currency_input){ //uses yahoo query language to convert currencies
    $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
    $yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$currency_from.$currency_to.'")'; //select the currencies using currency codes
    $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
    $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
    $yql_session = file_get_contents($yql_query_url);
    $yql_json =  json_decode($yql_session,true);
    $currency_output = (float) $currency_input*$yql_json['query']['results']['rate']['Rate']; //output the result as a float

    return $currency_output;
}

//initialiaze variables with placeholder values
$currency_from = "selected currency";
$currency_to = "selected currency";
$currency_input = "input";
$currency = "output";

//on complete form submit
if (isset($_POST['currency_from']) && isset($_POST['currency_to']) && isset($_POST['currency_input']))
{
    //get user input as variables
    $currency_from = $_POST['currency_from'];
    $currency_to = $_POST['currency_to'];
    $currency_input = $_POST['currency_input'];

    //output result of converter function
    $currency = currencyConverter($currency_from,$currency_to,$currency_input);
}

echo <<<_END
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
            
        <title>Currency Converter</title>
        
        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

        <!-- Theme CSS -->
        <link href="css/grayscale.min.css" rel="stylesheet">
    </head>
	<body>
        <header class="intro">
            <div class="intro-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="brand-heading">Currency Converter</h1>
                            <p>
                                <div class="form-group">
                                    <form method="post" action="index.php">
                                        <label>Amount:</label>
                                        <input type="text" name="currency_input" class="form-control" />
                                        <br>
                                        <label>Input Currency:</label>
                                        <select class="form-control" name="currency_from">
                                            <option value="USD">U.S. Dollars</option>
                                            <option value="EUR">Euros</option>
                                            <option value="INR">Indian Rupees</option>
                                            <option value="JPY">Japanese Yen</option>
                                            <option value="GBP">British Pounds</option>
                                            <option value="AUD">Australian Dollars</option>
                                            <option value="CNY">Chinese Yuan</option>
                                            <option value="CAD">Canadian Dollars</option>
                                        </select>
                                        <br>
                                        <label>Output Currency:</label>
                                        <select class="form-control" name="currency_to">
                                            <option value="USD">U.S. Dollars</option>
                                            <option value="EUR">Euros</option>
                                            <option value="INR">Indian Rupees</option>
                                            <option value="JPY">Japanese Yen</option>
                                            <option value="GBP">British Pounds</option>
                                            <option value="AUD">Australian Dollars</option>
                                            <option value="CNY">Chinese Yuan</option>
                                            <option value="CAD">Canadian Dollars</option>
                                        </select>
                                        <br>
                                        <input class="btn btn-primary" type="submit" value="Convert!" />
                                    </form>
                                </div>
                            </p>
                            <p>Result: $currency_input $currency_from is equal to $currency $currency_to</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
	
    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    
    </body>
</html>
_END;
?>

