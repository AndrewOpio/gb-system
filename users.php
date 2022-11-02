<?php
 if(!isset($_SESSION)){session_start();}
 if(empty($_SESSION['username']))
 { echo "<script>window.location.href ='./';</script>";}
 include('includes/conf.php');

 require_once "classes/users.php";
 $user = new User();

 if($_SERVER["REQUEST_METHOD"] == "POST"){
     if (isset($_POST["add"])) {
        $email = $_POST["email"];
        $name = $_POST["name"];
        $username = $_POST["username"];
        $bio = $_POST["bio"];
        $password = $_POST["password"];

        $check = $user->checkDetails($email, $username);
        $get = pg_fetch_object($check);
        
        if (!$get) {
            $image = @$_FILES['pic'];
            $image_name = $image['name'];          
            $image_tmp = $image['tmp_name'];
            $dir = "users/";

            move_uploaded_file($image_tmp, $dir.$image_name);  
            $pic = $dir.$image_name;
       
            $insert = $user->addUser($email, $name, $username, $bio, $password, $pic);
       
            if ($insert) {
           ?>
               <script>
                   alert('User added successfully!');
               </script>
            <?php
            }
    
        } else {
        ?>
            <script>
                alert('Username already exists!');
            </script>
         <?php
        }
        
   
     } elseif (isset($_POST["edit"])) {

        $id = $_POST["edit"];
        $email = $_POST["email"];
        $email_orig = $_POST["email_orig"];
        $name = $_POST["name"];
        $username = $_POST["username"];
        $username_orig = $_POST["username_orig"];
        $bio = $_POST["bio"];
        $password = $_POST["password"];

        $image = @$_FILES['pic'];
        $image_name = $image['name'];          
        $image_tmp = $image['tmp_name'];
        $dir = "users/";

        if ($image_name) {
            move_uploaded_file($image_tmp, $dir.$image_name);  
            $pic = $dir.$image_name;

        } else {
            $pic = "";
        }
        

        if ($email_orig != $email || $username_orig != $username) {

            if ($email_orig != $email && $username_orig != $username) {
                $check = $user->checkDetails($email, $username);

            } elseif ($email_orig != $email) {
                $check = $user->checkEditDetails($email, "");

            } else {
                $check = $user->checkEditDetails("", $username);
            }           
            $get = pg_fetch_object($check);
        
        } else {
            $get = "";
        }
        
        if (!$get) {
            $edit = $user->editUser($id, $email, $name, $username, $bio, $password, $pic);
    
            if ($edit) {
        ?>
            <script>
                alert('User edited successfully!');
            </script>
        <?php
            }

        } else {
            ?>
                <script>
                    alert('Username  or email already exists!');
                </script>
             <?php
        }

     } elseif (isset($_POST["delete"])) {
        $id = $_POST["delete"];
        $delete = $user->deleteUser($id);
   
        if ($delete) {
       ?>
           <script>
               alert('User deleted successfully!');
           </script>
        <?php
        }

     } elseif (isset($_POST["switch"])) {
        $id = $_POST["id"];
        $status = $_POST["status"];

        $switch = $user->userStatus($id, $status);
   
        if ($switch) {
       ?>
           <script>
               alert('User status changed');
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
        <link href="../css/bootstrap.min.css" rel="stylesheet" >
        <link href="../css/all.css" rel="stylesheet" >
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link href="../css/admin.css" rel="stylesheet">
        <link rel="stylesheet" href="../datatables/datatables.min.css">
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
                                    <h4 style="color: white;"><a href = "home.php"  style="color: white; padding-right: 30px;"><i class="fas fa-arrow-left"></i></a>New User</h4>
                                    <button type = "submit" class="btn btn-success" data-toggle="modal" data-target="#add" data-backdrop = "true" style="margin-top: -38px; float: right;"><i class="fas fa-plus"></i>  Add user</button>
                                </div>

                                <div id="add" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add User</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                                                    <div class="card-body">
                                                        <label>Email:</label>
                                                        <div class="form-group">
                                                            <input type = "text" name = "email" class="form-control" placeholder = "enter email.." required/>
                                                        </div>
                                                        
                                                        <label>Name:</label>
                                                        <div class="form-group">
                                                            <input type = "text" name = "name" class="form-control" placeholder = "enter name.." required/>
                                                        </div>

                                                        <label>User Name:</label>
                                                        <div class="form-group">
                                                            <input type = "text" name = "username" class="form-control" placeholder = "enter username.." required/>
                                                        </div>

                                                        <label>Bio:</label>
                                                        <div class="form-group">
                                                            <input type = "text" name = "bio" class="form-control" placeholder = "enter bio.." required/>
                                                        </div>

                                                        <label>Password:</label>
                                                        <div class="form-group">
                                                            <input type = "text" name = "password" class="form-control" placeholder = "enter password.." required/>
                                                        </div>

                                                        <label>Picture:</label>
                                                        <div class="form-group">
                                                            <input type = "file" name = "pic" class="form-control" required/>
                                                        </div>

                                                        <input type = "hidden" name = "add"  value = "add">
                                                        <button type = "submit" class = "btn btn-primary" style = "float:right; width: 150px; margin-bottom: 20px;">Save</button>
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
                                                    <th>Email</th>
                                                    <th>Name</th>
                                                    <th>User Name</th>
                                                    <th>Bio</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $i = 1;
                                                $query = $user->getUsers();
                                                while($data = pg_fetch_object($query)){                                                    
                                            ?>  
                                                <div id="user<?php echo $i;?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit User</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                                                                    <div class="card-body">
                                                                        <div>
                                                                           <img src = "<?php echo $data->image; ?>" width = 140 height = 140 style = "margin-bottom: 10px;"/>
                                                                        </div>                                      
                                                                        <label>Email:</label>
                                                                        <div class="form-group">
                                                                            <input type = "text" name = "email" class="form-control" value="<?php echo $data->email; ?>"  placeholder = "enter email.." required/>
                                                                            <input type = "hidden" name = "email_orig" value="<?php echo $data->email; ?>"/>
                                                                        </div>
                                                                        
                                                                        <label>User Name:</label> 
                                                                        <div class="form-group">
                                                                           <input type = "text" name = "username" class="form-control" value="<?php echo $data->username; ?>" placeholder = "enter username.." required/>
                                                                           <input type = "hidden" name = "username_orig" value="<?php echo $data->username; ?>"/>
                                                                        </div>

                                                                        <label>Name:</label>
                                                                        <div class="form-group">
                                                                            <input type = "text" name = "name" class="form-control" value="<?php echo $data->name; ?>" placeholder = "enter name.." required/>
                                                                        </div>

                                                                        <label>Bio:</label>
                                                                        <div class="form-group">
                                                                            <textarea name = "bio" class="form-control" placeholder = "enter bio.." required><?php echo $data->bio; ?></textarea>
                                                                        </div>

                                                                        <label>Change Password:</label>
                                                                        <div class="form-group">
                                                                            <input type = "text" name = "password" class="form-control" placeholder = "enter password.."/>
                                                                        </div>

                                                                        <label>Picture:</label>
                                                                        <div class="form-group">
                                                                            <input type = "file" name = "pic" class="form-control"/>
                                                                        </div>

                                                                        <input type = "hidden" name = "edit"  value = "<?php echo $data->id; ?>">
                                                                        <button type = "submit" class = "btn btn-primary" style = "float:right; width: 150px; margin-bottom: 20px;">Save</button>
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
                                                                <h4 class="modal-title">Delete this user</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this user?</p>

                                                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                                    <input type = "hidden" name = "delete" value = "<?php echo $data->id; ?>">
                                                                    <button class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>                      
                                                        </div>
                                                    </div>
                                                </div>


                                                <div id="activate<?php echo $i;?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Activate this user</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to activate this user?</p>

                                                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                                    <input type = "hidden" name = "switch" value = "switch">
                                                                    <input type = "hidden" name = "id" value = "<?php echo $data->id; ?>">
                                                                    <input type = "hidden" name = "status" value = "active">
                                                                    <button class="btn btn-danger">Activate</button>
                                                                </form>
                                                            </div>                      
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="block<?php echo $i;?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Block this user</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to block this user?</p>

                                                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                                    <input type = "hidden" name = "switch" value = "switch">
                                                                    <input type = "hidden" name = "status" value = "blocked">
                                                                    <input type = "hidden" name = "id" value = "<?php echo $data->id; ?>">
                                                                    <button class="btn btn-danger">Block</button>
                                                                </form>
                                                            </div>                      
                                                        </div>
                                                    </div>
                                                </div>


                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $data->email; ?></td>
                                                    <td><?php echo $data->name; ?></td>
                                                    <td><?php echo $data->username; ?></td>
                                                    <td><?php echo $data->bio; ?></td>
                                                    <td><img src = "<?php echo $data->image; ?>" width = 40 height = 40/></td>
                                                    <td><?php echo $data->status; ?></td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                                                            <div class="dropdown-menu">
                                                                <button  type = "button" class="dropdown-item has-icon" data-toggle="modal" data-target="#user<?php echo $i;?>" data-backdrop = "true"><i class="fas fa-edit"></i>  Edit</button>
                                                                <div class="dropdown-divider"></div>
                                                                <button  type = "button" class="dropdown-item has-icon" data-toggle="modal" data-target="#delete<?php echo $i;?>" data-backdrop = "true"><i class="fas fa-trash-alt"></i>  Delete</button>

                                                                <?php
                                                                    if ($data->status == "active") {
                                                                ?>
                                                                        <button  type = "button" class="dropdown-item has-icon" data-toggle="modal" data-target="#block<?php echo $i;?>" data-backdrop = "true"><i class="fas fa-ban"></i>  Block</button>    
                                                                <?php
                                                                    } elseif ($data->status == "blocked") {
                                                                ?>
                                                                        <button  type = "button" class="dropdown-item has-icon" data-toggle="modal" data-target="#activate<?php echo $i;?>" data-backdrop = "true"><i class="fas fa-unlock"></i>  Unblock</button>    
                                                                <?php
                                                                    }
                                                                ?>
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

        <script src="../js/jquery/jquery-2.2.4.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js" ></script>
        <script src="../js/all.min.js" ></script>
        <script src="../js/dashboard.js" ></script>
        <script src="../datatables/datatables.min.js"></script>
        <script src="../datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="../js/datatables.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    </body>
</html>













