<?php
$c = $_GET['q'];
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://city-and-state-search-api.p.rapidapi.com/search?q=$c",
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
	$data = json_decode($response, true);
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container">
            <table class=" table">
                <tr class="text text-primary">
                    <th>ID</th>
                    <th>City Name</th>
                    <th>State Name</th>
                    <th>Country Name</th>
                    <th>&nbsp;</th>
                </tr>
                
                <?php foreach($data as $v){ 
                if(empty($v['state_name'])){
                    continue;
                }
                else {?>
                <tr>
                    <td><?php echo $v['id']; ?></td>
                    <td><?php echo $v['name']; ?></td>
                    <td><?php 
                            if(empty($v['state_name'])){
                                echo 'No data';
                            }
                            else echo $v['state_name'];
                        ?>
                    </td>
                    <td>
                        <?php
                        if(empty($v['country_name'])){
                            echo 'No data';
                        }
                        else{
                            echo $v['country_name'];
                        }
                        ?>
                    </td>
                    <td><a href="citydetails.php?q=<?php echo $v['id']; ?>"><button class="btn btn-success" type="button">City Details</button></a></td>
                </tr>
                <?php }}?>
            </table>
        </div>
    </body>
</html>