<?php
    include('includes/conf.php');
    require_once "classes/visas.php";
    require_once "classes/visitors.php";
    require_once "classes/borderpoints.php";

    $visitor = new Visitor();
    $visa = new Visa();
    $point = new Point();

    $query = $visa->getVisa($_GET['id']);
    $data = pg_fetch_object($query);

    if ($data) {
        $run_vistr = $visitor->getVisitor($data->passportnumber);
        $get_vistr = pg_fetch_object($run_vistr);
    
        $run = $point->getPoint($data->placeofissue);
        $p = pg_fetch_object($run);    
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
        <link rel="stylesheet" href="datatables/datatables.min.css">
        <link href="css/admin.css" rel="stylesheet">
        <style>
           @media (max-width: 767px){
                .qrcode{
                    margin-bottom: 15px;
                }

                .pic{
                    margin-top: 15px;
                    margin-bottom: 15px;
                }

                .fname{
                    float: left; 
                    margin-top: 5px; 
                }
            }

            @media (min-width: 768px){
                .fname{
                    float: right;
                }
            }

            .padding-0{
                padding-right:0;
                padding-left:0;
            }
        </style>
    </head>

    <body cz-shortcut-listen="true" data-gr-c-s-loaded="true" style="background-color: #e2e2e2;">
        <div class="container-fluid">
        <?php
           if ($data) {
        ?>
            <main role="main" class="col-md-6 ml-sm-auto col-lg-6 px-4" style="margin:auto; margin-top: 30px; margin-bottom: 20px;">
                <div class="card">                   
                    <div class="card-header" style="height: 60px; background-color: blue;">
                        <h4 style="color: white;">Visa</h4>
                    </div>
                    <div class="card-body">
                        <div>
                            <div>
                                <h4>Electronic Visa</h4>
                            </div>
                            <div>
                                <div class="card" style = "padding: 15px;" id = "visa<?php echo $i;?>">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div style = "display: flex;">
                                                <div>
                                                <img src="images/guinea-bissau.png" alt="" width = 50 height = 50 style = "margin-bottom: 10px; margin-right: 10px;"/>
                                                </div>
                                                <div style = "margin-top: 4px;">
                                                <span><b>Electronic Visa</b></span><br>
                                                <span style = "font-size: 13px;">eVisa Government of Guinea Bissau.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div  style = "float: right;">
                                                <h2 style = "margin-bottom: -5px;  margin-top: -4px; text-align: center;"><b>eVISA</b></h2>
                                                <p style = "text-align: center; font-size: 10px;">GUINEA BISSAU</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style = "width: 100%; background-color: #000; margin-top: 3px;">

                                    <div class="row" style = "padding-left: 20px; padding-right: 20px;">
                                        <div class="col-md-4" style = "">
                                            <img class="qrcode" src="https://chart.googleapis.com/chart?cht=qr&chl=https://gb.ultimate-ability.com/visa.php?id=<?php echo $data->visanumber; ?>&chs=200x200&chld=L|0" alt="" width = 120 height = 120 style = "float: left;"/>
                                        </div>
                                        <div class="col-md-8">
                                            <div style = "display: flex;">
                                                <div>
                                                    <img src="images/guinea-bissau.png" alt="" width = 50 height = 50 style = "margin-right: 15px;"/>
                                                </div>

                                                <div>
                                                    <p style = "text-align: center; margin-bottom: -3px;"><b>GUINEA IMMIGRATION</b></p>
                                                    <p style = "text-align: center; font-size: 11px;">[Section 2[1], Passport Act 1966]</p>
                                                    <p style = "text-align: center; margin-top: -15px;"><b>SINGLE ENTRY VISA</b></p>
                                                </div>
                                            </div>

                                            <div>
                                                <p style = "text-align: center; font-size: 11px; margin-top: -14px;">Good for a single jounrney to Guinea Bissau with <b>3 months</b> from  date hereof, provided that this passport remain valid.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <span style = "margin-top: 10px;"><b>eVisa holder information</b></span>
                                    <hr style = "width: 100%; background-color: #000; margin-top: 0px;">

                                    <div class="row" style = "width: 100%; margin: auto;">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="fname">eVisa Number</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><b><?php echo $data->visanumber; ?></b></span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="fname">eVisa Issue Date</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><b><?php echo $data->arrivaldate; ?></b></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="fname">eVisa Expiry Date</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><b><?php echo $data->expirydate; ?></b></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="fname">Place of issue</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><b><?php echo $p->pointname; ?></b></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="fname">Visa Fee</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><b><?php echo $data->feespaid; ?></b></span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="fname">Full Name</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><b><?php echo $get_vistr->surname ."   ". $get_vistr->othernames; ?></b></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="fname">Date  Of Birth</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><b><?php echo $get_vistr->dob; ?></b></span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="fname">Nationality</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><b><?php echo $get_vistr->nationality; ?></b></span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="fname">Travel Document</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><b>Passport</b></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="fname">Travel Doc. No.</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><b><?php echo $data->passportnumber; ?></b></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="fname">Travel Doc. Issue</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><b><?php echo $get_vistr->passportissuedate; ?></b></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="fname">Travel Doc. Expiry</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <span><b><?php echo $get_vistr->passportexpiry; ?></b></span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-3" style = "">
                                            <img src="<?php echo $get_vistr->photo; ?>" alt="" class="pic" width = 50 height = 50 style = "float: left;"/>
                                        </div>
                                    </div>
                                    <div class="jumbotron" style = "margin-top: 10px; width: 100%; padding: 10px;">
                                        <span><b>DISCLAIMER:</b></span><br>
                                        <span>
                                            This eVISA merely established that you are eligible to travel but does not guarantee that you are entitled to enter GUINEA.
                                            Upon arrival to Guinea, you will be inspected by a Guinea immigration Entry/Exit officer.
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        <?php
           } else {
        ?>
            <div class="alert alert-danger" style="margin:auto; margin-top: 30px;" role="alert">Visa not found!.</div>
        <?php
           }
        ?>
        </div>

        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js" integrity="sha512-mPA/BA22QPGx1iuaMpZdSsXVsHUTr9OisxHDtdsYj73eDGWG2bTSTLTUOb4TG40JvUyjoTcLF+2srfRchwbodg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="js/bootstrap.bundle.min.js" ></script>
        <script src="js/all.min.js" ></script>
        <script src="js/dashboard.js" ></script>
        <script src="ckeditor/ckeditor.js"></script>
        <script src="datatables/datatables.min.js"></script>
        <script src="datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="js/datatables.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    
        <script>
           function Print(x){
                var mode = "iframe";
                var close = mode == "popup";
                var options = {mode: mode, popClose: close};
                $("#visa"+x).printArea(options);
           }
        </script>
    </body>
</html>


























































