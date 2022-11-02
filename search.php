<?php
    if(!isset($_SESSION)){session_start();}
    if(empty($_SESSION['username']))
    { echo "<script>window.location.href ='./';</script>";}

    include('includes/conf.php');
    require_once "classes/visitors.php";
    $visitor = new Visitor();
    
    $query = $visitor->getVisitors();
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
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><?=$siteTitle;?></a>
            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarscontent" aria-controls="navbarscontent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button> -->
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout">Sign out</a>
                </li>
            </ul>
        </nav>
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
                                <h4 style="color: white;"><a href = "home.php"  style="color: white; padding-right: 30px; "><i class="fas fa-arrow-left"></i></a>Pesquisa de visitantes</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" style="padding-top: 10px;">
                                        <table class="table table-striped" id="table-4">
                                            <thead>
                                                <tr>
                                                   <th class="text-center">#</th>
                                                    <th>Tipo de passaporte</th>
                                                    <th>Número do Passaporte</th>
                                                    <th>Sobrenome</th>
                                                    <th>Outros nomes</th>
                                                    <th>Data de nascimento</th>
                                                    <th>Nacionalidade</th>
                                                    <th>Açao</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $i = 1;
                                                while($data = pg_fetch_object($query)){
                                            ?>  
                                                <div id="details<?php echo $i;?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h4 class="modal-title">Mais detalhes</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class = "row">
                                                                    <div class = "col-md-6">
                                                                        <label>Data de Captura:</label>
                                                                        <p><?php echo $data->capturedate; ?></p>
                                                                    </div>

                                                                    <div class = "col-md-6">
                                                                        <label>Local de nascimento:</label>
                                                                        <p><?php echo $data->birthlocation; ?></p>
                                                                    </div>
                                                                </div>

                                                                <div class = "row">
                                                                    <div class = "col-md-6">
                                                                        <label>Nome do pai:</label>
                                                                        <p><?php echo $data->fathersname; ?></p>
                                                                    </div>

                                                                    <div class = "col-md-6">
                                                                        <label>Nome da mãe:</label>
                                                                        <p><?php echo $data->mothersname; ?></p>
                                                                    </div>
                                                                </div>

                                                                <div class = "row">
                                                                    <div class = "col-md-6">
                                                                        <label> Estado civil:</label>
                                                                        <p><?php echo $data->maritalstatus; ?></p>
                                                                    </div>

                                                                    <div class = "col-md-6">
                                                                        <label>Profissão:</label>
                                                                        <p><?php echo $data->profession; ?></p>
                                                                    </div>
                                                                </div>

                                                                <div class = "row">
                                                                    <div class = "col-md-6">
                                                                        <label>Ocupação atual:</label>
                                                                        <p><?php echo $data->currentoccupation; ?></p>
                                                                    </div>

                                                                    <div class = "col-md-6">
                                                                        <label>Cidadão/Cidadã:</label>
                                                                        <p><?php echo $data->citizen; ?></p>
                                                                    </div>
                                                                </div>

                                                                <div class = "row">
                                                                    <div class = "col-md-6">
                                                                        <label> Endereço de Emissão:</label>
                                                                        <p><?php echo $data->issueaddress; ?></p>
                                                                    </div>

                                                                    <div class = "col-md-6">
                                                                        <label>Data de emissão do passaporte:</label>
                                                                        <p><?php echo $data->passportissuedate; ?></p>
                                                                    </div>
                                                                </div>

                                                                <div class = "row">
                                                                    <div class = "col-md-12">
                                                                        <label>Data de Expiração do Passaporte:</label>
                                                                        <p><?php echo $data->passportexpiry; ?></p>
                                                                    </div>
                                                                </div>

                                                                <div class = "row">
                                                                    <div class = "col-md-6">
                                                                        <label>Impressão digital:</label><br>
                                                                        <p><img src = "<?php echo $data->thumbprint; ?>" width = 80 height = 80/></p>
                                                                    </div>

                                                                    <div class = "col-md-6">
                                                                        <label>foto:</label>
                                                                        <p><img src = "<?php echo $data->photo; ?>" width = 80 height = 80/></p>
                                                                    </div>
                                                                </div>

                                                                <div class = "row">
                                                                    <div class = "col-md-12">
                                                                        <label>Assinatura:</label>
                                                                        <p><img src = "<?php echo $data->signature; ?>" width = 80 height = 80/></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $data->passporttype; ?></td>
                                                    <td><?php echo $data->passportnumber; ?></td>
                                                    <td><?php echo $data->surname; ?></td>
                                                    <td><?php echo $data->othernames; ?></td>
                                                    <td><?php echo $data->dob; ?></td>
                                                    <td><?php echo $data->nationality; ?></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Opções</a>
                                                            <div class="dropdown-menu">
                                                                <button  type = "button" class="dropdown-item has-icon" data-toggle="modal" data-target="#details<?php echo $i;?>" data-backdrop = "true"><i class="fas fa-eye"></i> Veja mais</button>
                                                                <a href="arrivals.php?id=<?php echo $data->id; ?>&number=<?php echo $data->passportnumber; ?>" class="dropdown-item has-icon"><i class="fa fa-plane fa-flip-horizontal"></i> Chegada</a>
                                                                <a href="departures.php?id=<?php echo $data->id; ?>&number=<?php echo $data->passportnumber; ?>" class="dropdown-item has-icon"><i class="fa fa-plane"></i> Partida</a>
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
        <script src="js/bootstrap.bundle.min.js" ></script>
        <script src="js/all.min.js" ></script>
        <script src="js/dashboard.js" ></script>
        <script src="ckeditor/ckeditor.js"></script>
        <script src="datatables/datatables.min.js"></script>
        <script src="datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="js/datatables.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    </body>
</html>













