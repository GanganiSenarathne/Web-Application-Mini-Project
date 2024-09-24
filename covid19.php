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
        <meta charset="UTF-8">
        <title>COVID19 Information</title>
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
                    <h4 class="text-center">COVID19 Information in Europe </h4>
                    <div class="container">
                        <hr />
                        <table class="table">
                            <tr>
                                <th>Country</th>
                                <th>Population</th>
                                <th>Total Covid Cases</th> 
                                <th>Total Deaths</th> 
                                <th>Tests</th>
                                <th>Continent</th>
                            </tr>
                            <?php foreach($stacs as $v){
                                if($v['continent'] == "Europe"){?>
                                    <tr>
                                        <td><?php echo $v['country']; ?></td>
                                        <td><?php echo $v['population'] ? $v['population'] : '0'; ?></td>
                                        <td><?php echo $v['cases']['total'] ? $v['cases']['total'] : '0'; ?></td>
                                        <td><?php echo $v['deaths']['total'] ? $v['deaths']['total'] : '0'; ?></td>
                                        <td><?php echo $v['tests']['total'] ? $v['tests']['total'] : '0'; ?></td>
                                        <td><?php echo $v['continent']; ?></td>
                                    </tr> 
                            <?php }} ?>
                        </table>
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
