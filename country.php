<?php
$path="https://restcountries.com/v3.1/region/asia";
$data= json_decode(file_get_contents($path),true);
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
            <h5 class="text-center">Asian Countries</h5>
            <br/>
            <table border="1" class=" table table-striped">
                <tr class="text text-primary">
                    <th>Flag</th>
                    <th>Country Name</th>
                    <th>Capital City</th>
                    <th>Region</th>
                    <th>Subregionth</th>
                    <th>Currencies</th>
                    <th>Country Code</th>
                    <th>&nbsp;</th>
                </tr>
                
                <?php foreach($data as $v){ ?>
                <tr>
                    
                    <td><img src="<?php echo $v['flags']['png'];?>" width="60" height="auto"/></td>
                    <td><?php echo $v['name']['common']; ?></td>
                    <td><?php 
                            if(empty($v['capital'][0])){}
                            else echo $v['capital'][0];
                        ?>
                    </td>
                    <td><?php echo $v['region']; ?></td>
                    <td><?php echo $v['subregion']; ?></td>
                    <td><?php
                            $arrc = $v['currencies'];
                            foreach ($arrc as $c){
                                $c_name=$c['name'];
                                $c_symbol=$c['symbol'];
                                print($c_name . "(" . $c_symbol . ")");
                                echo "</br>";
                            }
                        ?>
                    </td>
                    <td><?php echo $v['cca2']; ?></td>
                    <td><a href="countrydetails.php?q=<?php echo $v['cca2']; ?>"><button class="btn btn-success" type="button">View</button></a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div> 
            <p style="font-size:11px;" class="text-center">All Right Received &copy;2023</p>
        </div>
    </body>
</html>
