<?php
$c = $_GET['q'];

$pathc="https://restcountries.com/v3.1/alpha/$c";
$datac=json_decode(file_get_contents($pathc),true);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Countries Details</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
        <style>
            #navigation{font-size: 11px;text-align: right}
        </style>
    </head>
    <body>
        <div id="navigation" class="container-fluid"> <a href="index.php">Home</a></div>
        <div class="container">
            <br/>
            <h3><center><?php echo $datac[0]['name']['common']; ?></center></h3>
                <div class="clearfix">&nbsp;</div>
                <table class=" table table-striped">
                    <tr>
                        <td colspan="2" style="text-align:center">
                            <img src="<?php echo $datac[0]['flags']['png']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Official Name</th>
                        <th><?php echo $datac[0]['name']['official']; ?></th>
                    </tr>
                    <tr>
                        <th>Capital</th>
                        <th><?php echo $datac[0]['capital'][0]; ?></th>
                    </tr>
                    <tr>
                        <th>Code</th>
                        <th><?php echo $datac[0]['cca2']; ?></th>
                    </tr>
                    <tr>
                        <th>Currency</th>
                        <th><?php 
                               $arrc=$datac[0]['currencies'];
                               foreach($arrc as $v){
                                print($v['name']);
                               }
                            ?> 
                        </th>
                    </tr>
                    <tr>
                        <th>Subregion</th>
                        <th><?php echo $datac[0]['subregion']; ?></th>
                    </tr>
                    <tr>
                        <th>Continent</th>
                        <th><?php echo $datac[0]['region']; ?></th>
                    </tr>
                    <tr>
                        <th>Languages</th>
                        <th><?php $arrl=$datac[0]['languages'];
                                echo join(", ",$arrl);
                            ?>
                        </th>
                    </tr>
                    <tr>
                        <th>Borders </th>
                        <th><?php if(isset($datac[0]['borders'])){
                                    foreach($datac[0]['borders'] as $b){
                                        $path = "https://restcountries.com/v3.1/alpha/$b";
                                        $data = json_decode(file_get_contents($path),true);
                                        echo $data[0]['name']['common'].", ";
                                    }
                                  } 
                            ?> 
                        </th>
                    </tr>
                    <tr>
                        <th>Population </th>
                        <th><?php  echo number_format($datac[0]['population']); ?> </th>
                    </tr>
                    <tr>
                        <th>Area</th>
                        <th><?php echo number_format($datac[0]['area']); ?> </th>
                    </tr>
                </table>
        </div>
        <div> 
            <p style="font-size:11px;" class="text-center">All Right Received &copy;2023</p>
        </div>
    </body>
</html>
