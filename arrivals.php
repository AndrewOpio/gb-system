<?php
 if(!isset($_SESSION)){session_start();}
 if(empty($_SESSION['username']))
 { echo "<script>window.location.href ='./';</script>";}
 include('includes/conf.php');

 require_once "classes/arrivals.php";
 require_once "classes/countries.php";

 $arrival = new Arrival();
 $country = new Country();
 
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     $pnumber = $_POST["pnumber"];
     $v_id = $_POST["v_id"];
     $from = $_POST["from"];
     $to = $_POST["to"];
     $fnumber = $_POST["fnumber"];
     $reason = $_POST["reason"];
     $adate = $_POST["adate"];

     $insert = $arrival->addArrival($v_id, $pnumber, $from, $to, $fnumber, $reason, $adate);

     if ($insert) {
    ?>
        <script>
            alert('Arrival added successfully!');
        </script>
     <?php
    }
 }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?=$_SESSION['username']?> | <?=$site_company?> Admin</title>
            <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet" >
        <link href="css/all.css" rel="stylesheet" >
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="cs/app.min.css">
        <link rel="stylesheet" href="datatables/datatables.min.css">
        <link rel="stylesheet" href="datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">

        <link href="css/admin.css" rel="stylesheet" >
    </head>
    <body cz-shortcut-listen="true" data-gr-c-s-loaded="true" style="background-color: #e2e2e2;">
        <div class="container-fluid">
            <?php include "navbar.php"?>
            <div class="row">
                <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4" style="margin: auto; margin-top: 60px; margin-bottom: 20px;">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">                   
                                <div class="card-header" style="height: 60px; background-color: blue;">
                                    <h4 style="color: white;"><a href = "home.php"  style="color: white; padding-right: 30px; "><i class="fas fa-arrow-left"></i></a>Adicionar novas chegadas</h4>
                                </div>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <div class="card-body">
                                        <div class = "row">
                                            <div class = "col-md-12">
                                                <label>Número do Passaporte:</label>
                                                <div class="form-group">
                                                    <input autocomplete = "off" type = "text" name = "pnumber" id = "pnumber" class="form-control" value = "<?php if (isset($_GET["number"])) { echo $_GET["number"]; }?>" placeholder = "insira o número do passaporte.." required/>
                                                    <div class="dropdown-menu" style="margin-left: 15px; margin-top: -13px;" id="suggestion-box"></div>
                                                    <input type = "hidden" name = "v_id"  id = "v_id" value = "<?php if (isset($_GET["id"])) { echo $_GET["id"]; }?>" required/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class = "row">
                                            <div class = "col-md-6">
                                                <label>Chegada de:</label>
                                                <div class="form-group">
                                                    <select name = "from" class="custom-select mb-3" style="width:100%;">
                                                        <?php
                                                          $run = $country->getCountries();
                                                          while($data = pg_fetch_object($run)){
                                                        ?>	
                                                        <option value="<?php echo $data->id; ?>"><?php echo $data->countryname; ?></option>
                                                        <?php
                                                          }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class = "col-md-6">
                                                <label>Destino final:</label>
                                                <div class="form-group">
                                                    <select name = "to" class="custom-select mb-3" style="width:100%;">
                                                        <?php
                                                          $run = $country->getCountries();
                                                          while($data = pg_fetch_object($run)){
                                                        ?>	
                                                        <option value="<?php echo $data->id; ?>"><?php echo $data->countryname; ?></option>
                                                        <?php
                                                          }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class = "row">
                                            <div class = "col-md-6">
                                                <label>Número do vôo:</label>
                                                <div class="form-group">
                                                    <input type = "text" name = "fnumber" class="form-control" placeholder = "insira o número do vôo.." required/>
                                                </div>
                                            </div>
                                            <div class = "col-md-6">
                                            <label>Motivo da Viagem:</label>
                                                <div class="form-group">
                                                    <input type = "text" name = "reason" class="form-control" placeholder = "insira o motivo da viagem" required/>
                                                </div>
                                            </div>
                                        </div>

                                        <label>Data de chegada:</label>
                                        <div class="form-group">
                                            <input type = "date" name = "adate" class="form-control" required/>
                                        </div>
                                        <button type = "submit" class = "btn btn-primary" style = "float:right; width: 200px; margin-bottom: 20px;">+ Adicionar chegada</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        

        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap.bundle.min.js" ></script>
        <script src="js/all.min.js" ></script>
        <script src="js/dashboard.js" ></script>
        <script src="ckeditor/ckeditor.js"></script>
        <script src="datatables/datatables.min.js"></script>
        <script src="datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="js/datatables.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
        <script>
           // AJAX call for autocomplete 
            $(document).ready(function(){
                $("#pnumber").keyup(function(){
                    if ($(this).val()) {
                        $.ajax({
                        type: "POST",
                        url: "suggestions.php",
                        data:'keyword='+$(this).val(),
                        beforeSend: function(){
                            $("#pnumber").css("background","#e2e2e2 url(facebook.png) no-repeat 165px");
                        },
                        success: function(data){
                            $("#suggestion-box").show();
                            $("#suggestion-box").html(data);
                            $("#pnumber").css("background","#FFF");
                        }
                        });
                    } else {
                        $("#suggestion-box").hide(); 
                    }
                });
            });
            //To select country name
            function selectNumber(val1, val2) {
                $("#pnumber").val(val2);
                $("#v_id").val(val1);
                $("#suggestion-box").hide();
            }
        </script>

    </body>
</html>













