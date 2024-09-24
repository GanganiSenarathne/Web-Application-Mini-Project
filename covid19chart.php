<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://covid-193.p.rapidapi.com/statistics",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: covid-193.p.rapidapi.com",
		"X-RapidAPI-Key: 0a8da135e1msh1f43166c9d1bc1bp1700bejsn28d51a854b5f"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);
    $stacs = $data['response'];
}
?>
<html>
    <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'countryes');
            data.addColumn('number', 'cases');

            <?php
                foreach ($stacs as $country) {
                    if ($country['continent'] == 'Europe') {
                        if($country['country'] == 'Europe'){
                            continue;
                        }
                        else{
                            $countryName = $country['country'];
                            $cases = $country['cases']['total'];
                            echo "data.addRow(['$countryName', $cases]);";
                        }
                    }
                }
            ?>

            var options = {
                title: 'Cases vs Countries in Europe',
                curveType: 'function',
                height: 500,
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.BarChart(document.getElementById('myChart'));
            chart.draw(data, options);
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <style>
        #navigation{font-size: 11px;text-align: right}
    </style>
    </head>

    <body>
        <div id="navigation" class="container-fluid"> <a href="index.php">Home</a></div>
        <div class="container">
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10" > 
                    <br/><br/>
                    <h4 class="text-center">COVID19 Information in Europe - Bar Chart </h4>
                    <div style="min-height: 500px;">
                        <div id="myChart" ></div>
                    </div>
                    <div class="col-md-1">&nbsp;</div>
                </div>
            </div>                  
        </div>
        <div> 
            <p style="font-size:11px;" class="text-center">All Right Received &copy;2023</p>
        </div>
    </body>
</html>