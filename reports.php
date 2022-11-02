<?php
    if(!isset($_SESSION)){session_start();}
    if(empty($_SESSION['username']))
    { echo "<script>window.location.href ='./';</script>";}

    include('includes/conf.php');
    require_once "classes/arrivals.php";
    require_once "classes/reports.php";
    require_once "classes/countries.php";

    $arrival = new Arrival();
    $report = new Report();
    $country = new Country();

    $arr = $arrival->getArrivals();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $category = $_POST["category"];
        $start = $_POST["start"];
        $end = $_POST["end"];
        
        if ($category == "arrivals") {
            $arr = $report->getArrivals($start, $end);

        } elseif ($category == "departures") {
            $dep = $report->getDepartures($start, $end);

        } elseif ($category == "visas") {
            $visa = $report->getVisas($start, $end);
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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet" >
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
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
                                <div class="card-header" style="background-color: blue;">
                                     <h4 style="color: white;"><a href = "home.php"  style="color: white; padding-right: 30px; "><i class="fas fa-arrow-left"></i></a>Gerar Relatórios</h4>

                                     <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                        <div class="row">
                                            <div class = "col-md-3">
                                                <h6 style="color: white;">Dados do relatório:</h6>
                                                <select name="category" class="custom-select mb-3" style="width:100%;">	
                                                    <option value="arrivals">Chegadas</option>
                                                    <option value="departures">Partidas</option>
                                                    <!--<option value="visas">Visas Issued</option>-->
                                                </select>
                                            </div>

                                            <div class = "col-md-3">
                                                <h6 style="color: white;">Começar:</h6>
                                                <input name = "start" type = "date" style="width:100%;" class="form-control" required/>
                                            </div>

                                            <div class = "col-md-3">
                                                <h6 style="color: white;">Fim:</h6>
                                                <input name = "end" type = "date" style="width:100%;" class="form-control" required/>
                                            </div>

                                            <div class = "col-md-3">
                                                <button type = "submit" class="btn btn-primary" style="margin-top: 26px;"><i class="fas fa-search"></i>  Procurar</button>
                                            </div>

                                        </div>
                                     </form>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" style="padding-top: 10px;">

                                        <?php
                                           if (isset($arr) && !isset($dep) && !isset($visa)) {
                                        ?>
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                   <th class="text-center">#</th>
                                                    <th>Número do Passaporte</th>
                                                    <th>Destino final</th>
                                                    <th>Número do vôo</th>
                                                    <th>Chegando de</th>
                                                    <th>Razão</th>
                                                    <th>Data de chegada</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $i = 1;
                                                while($data = pg_fetch_object($arr)){
                                                    $state1 = $country->getCountry($data->finaldestination);
                                                    $info1 = pg_fetch_object($state1);

                                                    $state2 = $country->getCountry($data->arrivingfrom);
                                                    $info2 = pg_fetch_object($state2);
                                            ?>  
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $data->passportnumber; ?></td>
                                                    <td><?php echo $info1->countryname; ?></td>
                                                    <td><?php echo $data->flightno; ?></td>
                                                    <td><?php echo $info2->countryname ; ?></td>
                                                    <td><?php echo $data->travelreason; ?></td>
                                                    <td><?php echo $data->arrivaldate; ?></td>
                                                </tr>
                                            <?php
                                                 $i++;
                                                }
                                            ?>
                                            </tbody>
                                        </table>

                                        <?php
                                           } elseif (isset($dep)) {
                                        ?>
                                        <table class="table table-striped" id="table-2">
                                            <thead>
                                                <tr>
                                                   <th class="text-center">#</th>
                                                    <th>Número do Passaporte</th>
                                                    <th>Destino final</th>
                                                    <th>Número do vôo</th>
                                                    <th>Razão</th>
                                                    <th>Data de partida</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $i = 1;
                                                while($data = pg_fetch_object($dep)){
                                                    $state1 = $country->getCountry($data->finaldestination);
                                                    $info1 = pg_fetch_object($state1);
                                            ?>  
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $data->passportnumber; ?></td>
                                                    <td><?php echo $info1->countryname; ?></td>
                                                    <td><?php echo $data->flightno; ?></td>
                                                    <td><?php echo $data->departurereason; ?></td>
                                                    <td><?php echo $data->departuredate; ?></td>
                                                </tr>
                                            <?php
                                                 $i++;
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                        
                                        <?php
                                           } elseif (isset($visa)) {
                                        ?>
                                        <table class="table table-striped" id="table-3">
                                            <thead>
                                                <tr>
                                                   <th class="text-center">#</th>
                                                    <th>Passport Number</th>
                                                    <th>Final Destination</th>
                                                    <th>Flight Number</th>
                                                    <th>Reason</th>
                                                    <th>Departure Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $i = 1;
                                                while($data = pg_fetch_object($dep)){
                                                    $state1 = $country->getCountry($data->finaldestination);
                                                    $info1 = pg_fetch_object($state1);

                                            ?>  
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $data->passportnumber; ?></td>
                                                    <td><?php echo $info1->countryname; ?></td>
                                                    <td><?php echo $data->flightno; ?></td>
                                                    <td><?php echo $data->departurereason; ?></td>
                                                    <td><?php echo $data->departuredate; ?></td>
                                                </tr>
                                            <?php
                                                 $i++;
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                        <?php
                                           }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> 
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script> 
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script> 
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script> 
        <script src="js/bootstrap.bundle.min.js" ></script>
        <script src="js/all.min.js" ></script>
        <script src="js/dashboard.js" ></script>
        <script src="ckeditor/ckeditor.js"></script>
        <script src="js/datatables.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    </body>
</html>













