<?php

$con=new mysqli("localhost","root","","covid2023");

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


foreach($stacs as $v){
    $a=$v['country'];
    $b=$v['population'];
    $c=$v['cases']['total'];
    $d=$v['deaths']['total'];
    $e=$v['tests']['total'];
    $f=$v['continent'];
    $g=$v['day'];
    $s="select * from covidcases WHERE countryName='$a'";
    $r=$con->query($s);
    $n=$r->num_rows;
    if($n<1){
        $sql="INSERT into covidcases(countryName, population, totalcases, deaths, tests, continent, date) VALUES('$a','$b','$c','$d','$e','$f','$g')";
        $con->query($sql);
    }
}
?>          