<?php
 if(!isset($_SESSION)){session_start();}
 if(empty($_SESSION['username']))
 { echo "<script>window.location.href ='./';</script>";}
 include('includes/conf.php');

 require_once "classes/visitors.php";
 $visitor = new Visitor();

 if($_SERVER["REQUEST_METHOD"] == "POST"){
     $type = $_POST["type"];
     $cdate = $_POST["cdate"];
     $sname = $_POST["sname"];
     $oname = $_POST["oname"];
     $bdate = $_POST["bdate"];
     $blocation = $_POST["blocation"];
     $nationality = $_POST["nationality"];
     $citizen = $_POST["citizen"];
     $iaddress = $_POST["iaddress"];

     $image1 = @$_FILES['tprint'];
     $image1_name = $image1['name'];          
     $image1_tmp = $image1['tmp_name'];
     $dir1= "thumbprints/";
     move_uploaded_file($image1_tmp, $dir1.$image1_name);  
     $tprint = $dir1.$image1_name;

     $image2 = @$_FILES['pic'];
     $image2_name = $image2['name'];          
     $image2_tmp = $image2['tmp_name'];
     $dir2= "photos/";
     move_uploaded_file($image2_tmp, $dir2.$image2_name);  
     $pic = $dir2.$image2_name;

     $image3 = @$_FILES['sign'];
     $image3_name = $image3['name'];          
     $image3_tmp = $image3['tmp_name'];
     $dir3= "signatures/";
     move_uploaded_file($image3_tmp, $dir3.$image3_name);  
     $sign = $dir3.$image3_name;

     $pnumber = $_POST["pnumber"];
     $idate = $_POST["idate"];
     $edate = $_POST["edate"];
     
     $insert = $visitor->addVisitor($type, $cdate, $sname, $oname, $bdate, $blocation, $nationality, $citizen, $iaddress, $tprint, $pic, $sign, $pnumber, $idate, $edate);

     if ($insert) {
    ?>
        <script>
            alert('Visitor added successfully!');
        </script>
     <?php
     }
 }
?>

<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$_SESSION['username']?> | <?=$site_company?> Admin</title>
    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet" >
<link href="css/all.css" rel="stylesheet" >
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<link href="css/admin.css" rel="stylesheet" >
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
                                <h4 style="color: white;"><a href = "home.php"  style="color: white; padding-right: 30px; "><i class="fas fa-arrow-left"></i></a>Adicionar novos visitantes</h4>
                            </div>
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <label>Tipo de passaporte:</label>
                                            <div class="form-group">
                                                <input type = "text" name = "type" class="form-control" placeholder = "digite o tipo de passaporte.." required/>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                        <label>Data de Captura:</label>
                                            <div class="form-group">
                                                <input type = "date" name = "cdate" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <label>Sobrenome:</label>
                                    <div class="form-group">
                                        <input type = "text" name = "sname" class="form-control" placeholder = "digite o sobrenome.." required/>
                                    </div>

                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <label> Outros nomes:</label>
                                            <div class="form-group">
                                                <input type = "text" name = "oname" class="form-control" placeholder = "insira outros nomes.." required/>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                        <label> Data de nascimento:</label>
                                            <div class="form-group">
                                                <input name = "bdate" type = "date" class="form-control" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <label> Local de nascimento:</label>
                                    <div class="form-group">
                                        <input type = "text" name = "blocation" class="form-control" placeholder = "insira o local de nascimento.." required/>
                                    </div>

                                    <label> Nacionalidade:</label>
                                    <div class="form-group">
                                        <input type = "text" name = "nationality" class="form-control" placeholder = "entrar na nacionalidade.." required/>
                                    </div>

                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <label>Cidadão/Cidadã:</label>  
                                            <div class="form-group">
                                                <select name="citizen" class="custom-select mb-3" style="width:100%;">	
                                                    <option value="sim">sim</option>
                                                    <option value="não">Não</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <label>Endereço de Emissão:</label>  
                                            <div class="form-group">
                                                <input type = "text" name ="iaddress" class="form-control" placeholder = "insira o endereço de emissão.." required/>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <label>Impressão digital:</label>  
                                    <div class="form-group">
                                        <input type = "file" name = "tprint" required/>
                                    </div>

                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <label>foto:</label>
                                            <div class="form-group">
                                                <input type = "file" name = "pic" required/>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <label>Assinatura:</label>
                                            <div class="form-group">
                                                <input type = "file" name = "sign" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <label>Número do Passaporte:</label>
                                    <div class="form-group">
                                        <input type = "text" name = "pnumber" class="form-control" placeholder = "insira o número do passaporte.." required/>
                                    </div>

                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <label>Data de emissão do passaporte:</label>
                                            <div class="form-group">
                                                <input type = "date" name = "idate" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <label>Data de Expiração do Passaporte:</label>
                                            <div class="form-group">
                                                <input type = "date" name = "edate" class="form-control"  required/>
                                            </div>
                                        </div>
                                    </div>

                                    <button type = "submit" class = "btn btn-primary" style = "float:right; width: 200px; margin-bottom: 20px;">+ Adicionar visitante</button>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</body></html>













