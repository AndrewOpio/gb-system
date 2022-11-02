<?php
    if(!isset($_SESSION)){session_start();}
    if(empty($_SESSION['username']))
    { echo "<script>window.location.href ='./';</script>";}

    include('includes/conf.php');
    require_once "classes/visas.php";
    require_once "classes/borderpoints.php";
    require_once "classes/visitors.php";

    $visitor = new Visitor();

    $visa = new Visa();
    $point = new Point();

    $query = $visa->getVisas();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST["id"];
        $by = $_SESSION["username"];

        $run = $visa->approveVisa($id, $by);
        $query = $visa->getVisas();

        if ($run) {
        ?>
            <script>
                alert('Visa approved');
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
        <link rel="stylesheet" href="datatables/datatables.min.css">
        <link href="css/admin.css" rel="stylesheet" >

    </head>
    <body cz-shortcut-listen="true" data-gr-c-s-loaded="true" style="background-color: #e2e2e2;">
        <div class="container-fluid">
             <?php include "navbar.php"?>
            <div class="row">
                <!--<nav class="col-md-2 d-none d-md-block bg-light sidebar navbar-collapse collapse" id="navbarscontent">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column" id="nav1">
                            <li class="nav-item">
                                <a class="nav-link" href="home">
                                Home
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>-->
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="margin:auto; margin-top: 60px; margin-bottom: 20px;">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">                   
                                <div class="card-header" style="height: 60px; background-color: blue;">
                                <h4 style="color: white;"><a href = "home.php" style="color: white; padding-right: 30px; "><i class="fas fa-arrow-left"></i></a>Gerenciar vistos</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" style="padding-top: 10px;">
                                        <table class="table table-striped" id="table-4">
                                            <thead>
                                                <tr>
                                                   <th class="text-center">#</th>
                                                    <th>Número do Passaporte</th>
                                                    <th>Numero do visto</th>
                                                    <th>Data de chegada</th>
                                                    <th>Duração do visto</th>
                                                    <th>Data de validade</th>
                                                    <th>Publicado por</th>
                                                    <th>Aprovado por</th>
                                                    <th>Local de emissão</th>
                                                    <th>Taxas pagas</th>
                                                    <th>Açao</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $i = 1;
                                                while($data = pg_fetch_object($query)){
                                                    $run = $point->getPoint($data->placeofissue);
                                                    $p = pg_fetch_object($run);

                                                    $run_vistr = $visitor->getVisitor($data->passportnumber);
                                                    $get_vistr = pg_fetch_object($run_vistr);

                                            ?>  
                                                <div id="english<?php echo $i;?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Electronic Visa</h4>
                                                            </div>
                                                            <div class="modal-body">
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
                                                                            <img src="https://chart.googleapis.com/chart?cht=qr&chl=https://gb.ultimate-ability.com/visa.php?id=<?php echo $data->visanumber; ?>&chs=200x200&chld=L|0" alt="" width = 120 height = 120 style = "float: left;"/>
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
                                                                                   <span style = "float: right;">eVisa Number</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $data->visanumber; ?></b></span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">eVisa Issue Date</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $data->arrivaldate; ?></b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">eVisa Expiry Date</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $data->expirydate; ?></b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Place of issue</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $p->pointname; ?></b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Visa Fee</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $data->feespaid; ?></b></span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Full Name</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $get_vistr->surname ."   ". $get_vistr->othernames; ?></b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Date  Of Birth</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $get_vistr->dob; ?></b></span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Nationality</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $get_vistr->nationality; ?></b></span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Travel Document</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b>Passport</b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Travel Doc. No.</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $data->passportnumber; ?></b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Travel Doc. Issue</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $get_vistr->passportissuedate; ?></b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Travel Doc. Expiry</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $get_vistr->passportexpiry; ?></b></span>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="col-md-3" style = "">
                                                                           <img src="<?php echo $get_vistr->photo; ?>" alt="" width = 50 height = 50 style = "float: left;"/>
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

                                                                <button type = "submit" onclick = "Print(<?php echo $i;?>)" class = "btn btn-primary" style = "margin-top: 10px;">Print Visa</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="portuguese<?php echo $i;?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Visto Eletrônico</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card" style = "padding: 15px;" id = "visa<?php echo $i;?>">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                           <div style = "display: flex;">
                                                                              <div>
                                                                                <img src="images/guinea-bissau.png" alt="" width = 50 height = 50 style = "margin-bottom: 10px; margin-right: 10px;"/>
                                                                              </div>
                                                                              <div style = "margin-top: 4px;">
                                                                                <span><b>Visto Eletrônico</b></span><br>
                                                                                <span style = "font-size: 13px;">eVisa Governo da Guiné-Bissau.</span>
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
                                                                            <img src="https://chart.googleapis.com/chart?cht=qr&chl=https://gb.ultimate-ability.com/visa.php?id=<?php echo $data->visanumber; ?>&chs=200x200&chld=L|0" alt="" width = 120 height = 120 style = "float: left;"/>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div style = "display: flex;">
                                                                                <div>
                                                                                    <img src="images/guinea-bissau.png" alt="" width = 50 height = 50 style = "margin-right: 15px;"/>
                                                                                </div>

                                                                               <div>
                                                                                    <p style = "text-align: center; margin-bottom: -3px;"><b>IMIGRAÇÃO DA GUINÉ</b></p>
                                                                                    <p style = "text-align: center; font-size: 11px;">[Seção 2 [1], Passport Act 1966]</p>
                                                                                    <p style = "text-align: center; margin-top: -15px;"><b>VISTO DE ENTRADA ÚNICA</b></p>
                                                                                </div>
                                                                            </div>

                                                                            <div>
                                                                                <p style = "text-align: center; font-size: 11px; margin-top: -14px;">Bom para uma única viagem à Guiné-Bissau com <b>3 meses</b> a partir desta data, desde que este passaporte permaneça válido.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <span style = "margin-top: 10px;"><b>Informação do titular eVisa</b></span>
                                                                    <hr style = "width: 100%; background-color: #000; margin-top: 0px;">

                                                                    <div class="row" style = "width: 100%; margin: auto;">
                                                                        <div class="col-md-9">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">eVisa Número</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $data->visanumber; ?></b></span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Data de Emissão da eVisa</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $data->arrivaldate; ?></b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Data de Vencimento eVisa</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $data->expirydate; ?></b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Local de emissão</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $p->pointname; ?></b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Taxa de visto</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $data->feespaid; ?></b></span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Nome completo</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $get_vistr->surname ."   ". $get_vistr->othernames; ?></b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Data de nascimento</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $get_vistr->dob; ?></b></span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Nacionalidade</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $get_vistr->nationality; ?></b></span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Documento de viagem</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b>Passaporte</b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Viajar por Doc. No.</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $data->passportnumber; ?></b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Viajar por Doc. Edição</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $get_vistr->passportissuedate; ?></b></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                   <span style = "float: right;">Viajar por Doc. Termo</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <span><b><?php echo $get_vistr->passportexpiry; ?></b></span>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="col-md-3" style = "">
                                                                           <img src="<?php echo $get_vistr->photo; ?>" alt="" width = 50 height = 50 style = "float: left;"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="jumbotron" style = "margin-top: 10px; width: 100%; padding: 10px;">
                                                                        <span><b>AVISO LEGAL:</b></span><br>
                                                                        <span>
                                                                        Este eVISA apenas estabeleceu que você está qualificado para viajar, mas não garante que você tem direito de entrar na GUINÉ.
                                                                            Ao chegar à Guiné, você será inspecionado por um oficial de entrada / saída da imigração guineense.                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <button type = "submit" onclick = "Print(<?php echo $i;?>)" class = "btn btn-primary" style = "margin-top: 10px;">Imprimir Visa</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $data->passportnumber; ?></td>
                                                    <td><?php echo $data->visanumber; ?></td>
                                                    <td><?php echo $data->arrivaldate; ?></td>
                                                    <td><?php echo $data->visaduration. "  days"; ?></td>
                                                    <td><?php echo $data->expirydate; ?></td>
                                                    <td><?php echo $data->issuedby; ?></td>
                                                    <td><?php echo $data->approvedby; ?></td>
                                                    <td><?php echo $p->pointname; ?></td>
                                                    <td><?php echo $data->feespaid; ?></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Opções</a>
                                                            <div class="dropdown-menu">
                                                                <button  type = "button" class="dropdown-item has-icon" data-toggle="modal" data-target="#english<?php echo $i;?>" data-backdrop = "true"><i class="fas fa-eye"></i> Visto inglês</button>
                                                                <button  type = "button" class="dropdown-item has-icon" data-toggle="modal" data-target="#portuguese<?php echo $i;?>" data-backdrop = "true"><i class="fas fa-eye"></i> Visto português</button>
                                                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                                    <button  type = "submit" class="dropdown-item has-icon"><i class="fa fa-check"></i> Aprovar</button>
                                                                    <input type = "hidden" name = "id" value = "<?php echo $data->id; ?>"/>
                                                                </form>

                                                                <!--<div class="dropdown-divider"></div>
                                                                <a href="#" class="dropdown-item has-icon text-danger"><i class="fas fa-exclamation-triangle"></i>Block</a>
                                                                <a href="#" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>Delete</a>-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                 $i++;
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
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


























































