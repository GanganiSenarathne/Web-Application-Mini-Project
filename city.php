<html>
    <head>
        <meta charset="UTF-8">
        <title>Countries Details</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
        <style>
            #navigation{font-size: 11px;text-align: right}
        </style>
        <script>
            function showCities(str) {
                var xhttp;
                if (str == "") {
                  document.getElementById("show").innerHTML = "";
                  return;
                }
                xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("show").innerHTML = this.responseText;
                  }
                };
                xhttp.open("GET", "getcities.php?q="+str, true);
                xhttp.send();
            }
        </script>
    </head>
    <body>
        <div id="navigation" class="container-fluid"> <a href="index.php">Home</a></div>
        <div class="container">
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <br/><br/>
                    <h5 class="text-center">City Information</h5>
                    <div class="container">
                        <h5 class="text text-primary">
                            <div class="row">
                                <div class="col-md-4">Search Cities</div>
                                <div class="col-md-8"> <input type="text" id="search" class="form-control" onkeyup="showCities(this.value)" /></div>
                            </div>
                        </h5>
                        <hr/>
                        <div id="show">Load Cities</div>
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
