<?php
 if(!isset($_SESSION)){session_start();}
 if(empty($_SESSION['username']))
 { echo "<script>window.location.href ='';</script>";}
 include('includes/conf.php');

 require_once "classes/borderpoints.php";
 $point = new Point();

 if($_SERVER["REQUEST_METHOD"] == "POST"){
     if (isset($_POST["add"])) {
        $name = $_POST["name"];
        $code = $_POST["code"];
        $lat = $_POST["lat"];
        $lng = $_POST["lng"];

        $check = $point->checkDetails($name, $code);
        $get = pg_fetch_object($check);
        
        if (!$get) {
            $insert = $point->addPoint($name, $code, $lat, $lng);
       
            if ($insert) {
           ?>
               <script>
                   alert('Point added successfully!');
               </script>
            <?php
            }
    
        } else {
        ?>
            <script>
                alert('Name or Code already exists!');
            </script>
         <?php

        }
        
   
     } elseif (isset($_POST["edit"])){
         
        $name = $_POST["name"];
        $name_orig = $_POST["name_orig"];
        $code = $_POST["code"];
        $code_orig = $_POST["code_orig"];
        $lat = $_POST["lat"];
        $lng = $_POST["lng"];
        $id = $_POST["edit"];

        if ($name_orig != $name || $code_orig != $code) {
            if ($name_orig != $name) {
                $check = $point->checkEditDetails($name, "");

            } else {
                $check = $point->checkEditDetails("", $code);
            }           
            $get = pg_fetch_object($check);
        
        } else {
            $get = "";
        }
        
        if (!$get) {
            $edit = $point->editPoint($name, $code, $lat, $lng, $id);
    
            if ($edit) {
        ?>
            <script>
                alert('Point edited successfully!');
            </script>
        <?php
            }

        } else {
            ?>
                <script>
                    alert('Name or Code already exists!');
                </script>
             <?php
        }

     } elseif (isset($_POST["delete"])){
        $id = $_POST["delete"];
        $delete = $point->deletePoint($id);
   
        if ($delete) {
       ?>
           <script>
               alert('Point deleted successfully!');
           </script>
        <?php
        }
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
        <link href="css/admin.css" rel="stylesheet">
        <link rel="stylesheet" href="datatables/datatables.min.css">
    </head>

    <body cz-shortcut-listen="true" data-gr-c-s-loaded="true" style="background-color: #e2e2e2;">
        <div class="container-fluid">
            <?php include "navbar.php"?>
            <div class="row">
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="margin: auto; margin-top: 60px; margin-bottom: 20px;">
                    <div class="row">
                        <div class="col-12" style="margin: auto;">
                            <div class="card">                   
                                <div class="card-header" style="height: 60px; background-color: blue;">
                                    <h4 style="color: white;"><a href = "home.php"  style="color: white; padding-right: 30px;"><i class="fas fa-arrow-left"></i></a>Novo Ponto</h4>
                                    <button type = "submit" class="btn btn-success" data-toggle="modal" data-target="#add" data-backdrop = "true" style="margin-top: -38px; float: right;"><i class="fas fa-plus"></i>  Adicionar ponto</button>
                                </div>

                                <div id="add" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Adicionar Ponto Fronteiriço</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                                                    <div class="card-body">
                                                        <label>Nome do Ponto:</label>
                                                        <div class="form-group">
                                                            <input type = "text" name = "name" class="form-control" placeholder = "insira o nome.." required/>
                                                        </div>
                                                        
                                                        <label>Código de Ponto:</label>
                                                        <div class="form-group">
                                                            <input type = "text" name = "code" class="form-control" placeholder = "Coloque o código.." required/>
                                                        </div>

                                                        <label>latitude:</label>
                                                        <div class="form-group">
                                                            <input type = "text" name = "lat" class="form-control" placeholder = "entrar na latitude.." required/>
                                                        </div>

                                                        <label>longitude:</label>
                                                        <div class="form-group">
                                                            <input type = "text" name = "lng" class="form-control" placeholder = "insira a longitude.." required/>
                                                        </div>
                                                        <input type = "hidden" name = "add"  value = "add">
                                                        <button type = "submit" class = "btn btn-primary" style = "float:right; width: 150px; margin-bottom: 20px;">Salve</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive" style="padding-top: 10px;">
                                        <table class="table table-striped" id="table-5">
                                            <thead>
                                                <tr>
                                                   <th class="text-center">#</th>
                                                    <th>Nome do Ponto</th>
                                                    <th>Código de Ponto</th>
                                                    <th>lattiude</th>
                                                    <th>longitude</th>
                                                    <th>Açao</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $i = 1;
                                                $query = $point->getPoints();
                                                while($data = pg_fetch_object($query)){                                                    
                                            ?>  
                                                <div id="point<?php echo $i;?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Pontos Fronteiriços</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                                                                    <div class="card-body">
                                                                        <label>Nome do Ponto:</label>
                                                                        <div class="form-group">
                                                                            <input type = "text" name = "name" class="form-control" value="<?php echo $data->pointname; ?>"  placeholder = "insira o nome...." required/>
                                                                            <input type = "hidden" name = "name_orig" value="<?php echo $data->pointname; ?>"/>
                                                                        </div>
                                                                        
                                                                        <label>Código de Ponto:</label> 
                                                                        <div class="form-group">
                                                                           <input type = "text" name = "code" class="form-control" value="<?php echo $data->pointcode; ?>" placeholder = "Coloque o código.." required/>
                                                                           <input type = "hidden" name = "code_orig" value="<?php echo $data->pointcode; ?>"/>
                                                                        </div>

                                                                        <label>latitude:</label>
                                                                        <div class="form-group">
                                                                            <input type = "text" name = "lat" class="form-control" value="<?php echo $data->lat; ?>" placeholder = "entrar na latitude.." required/>
                                                                        </div>

                                                                        <label>longitude:</label>
                                                                        <div class="form-group">
                                                                            <input type = "text" name = "lng" class="form-control" value="<?php echo $data->lng; ?>" placeholder = "insira a longitude.." required/>
                                                                        </div>
                                                                        <input type = "hidden" name = "edit"  value = "<?php echo $data->id; ?>">
                                                                        <button type = "submit" class = "btn btn-primary" style = "float:right; width: 150px; margin-bottom: 20px;">Salve</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="delete<?php echo $i;?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Exclua este ponto de fronteira</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Tem certeza de que deseja excluir este ponto de fronteira?</p>

                                                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                                    <input type = "hidden" name = "delete" value = "<?php echo $data->id; ?>">
                                                                    <button class="btn btn-danger">Excluir</button>
                                                                </form>
                                                            </div>                      
                                                        </div>
                                                    </div>
                                                </div>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $data->pointname; ?></td>
                                                    <td><?php echo $data->pointcode; ?></td>
                                                    <td><?php echo $data->lat; ?></td>
                                                    <td><?php echo $data->lng; ?></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Opções</a>
                                                            <div class="dropdown-menu">
                                                                <button  type = "button" class="dropdown-item has-icon" data-toggle="modal" data-target="#point<?php echo $i;?>" data-backdrop = "true"><i class="fas fa-edit"></i>  Editar</button>
                                                                <div class="dropdown-divider"></div>
                                                                <button  type = "button" class="dropdown-item has-icon" data-toggle="modal" data-target="#delete<?php echo $i;?>" data-backdrop = "true"><i class="fas fa-trash-alt"></i>  Excluir</button>
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
        <script src="datatables/datatables.min.js"></script>
        <script src="datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="js/datatables.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    </body>
</html>













