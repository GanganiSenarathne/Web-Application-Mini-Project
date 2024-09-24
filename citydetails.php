<?php
$c = $_GET['q'];
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://city-and-state-search-api.p.rapidapi.com/cities/$c",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: city-and-state-search-api.p.rapidapi.com",
		"X-RapidAPI-Key: 0a8da135e1msh1f43166c9d1bc1bp1700bejsn28d51a854b5f"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$data2 = json_decode($response, true);
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>City Details</title>
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
                <br/>
                <h3><center>City Information</center></h3>
                <div class="container">
                    <hr/>
                    <table class=" table table-striped">
                        <tr>
                            <th>City ID</th>
                            <th><?php echo $data2['id']; ?></th>
                        </tr>
                        <tr>
                            <th>City Name</th>
                            <th><?php echo $data2['name']; ?></th>
                        </tr>
                        <tr>
                            <th>State Name</th>
                            <th><?php 
                                if(empty($data2['state_name'])){
                                    echo 'No data';
                                }
                                else echo $data2['state_name'];
                            ?></th>
                        </tr>
                        <tr>
                            <th>Country Name</th>
                            <th><?php echo $data2['country_name']; ?></th>
                        </tr>
                        <tr>
                            <th>Country Flag</th>
                            <td><?php
                                    echo "<img src='https://flagcdn.com/w320/" . strtolower($data2['country_code']) . ".png' alt='" . $data2['country_name'] . " Flag' width='100' height='50'>";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align: center">
                                <iframe 
                                    width="100%"
                                    height="300" 
                                    frameborder="1" style="border:1"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBkYIJfA2XuA60zji9dbt231q_HQ7z_tDc&q=<?php echo urlencode($data2['name'].','.$data2['country_name']); ?>&zoom=12"
                                    allowfullscreen>
                                </iframe>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-1">&nbsp;</div>
        </div>
        <div> 
            <p style="font-size:11px;" class="text-center">All Right Received &copy;2023</p>
        </div>
    </body>
</html>
