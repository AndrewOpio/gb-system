<h3>Story Categories</h3>
<hr>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategoryModal">Create Catgeory</button>
<br>
<br>
<?php
    if(isset($_POST['saveCategory']))
    {
        $title=mysqli_real_escape_string($conn, $_POST['title']);
        $description=mysqli_real_escape_string($conn, $_POST['description']);
        $created = date("Y-m-d H:i:s");
        $modified = date("Y-m-d H:i:s");
        $created_by = $_SESSION['user_id'];
        if($title!="")
        {
            $categoryInsertQuery=mysqli_query($conn, "insert into categories(title, description, created, modified, created_by) values('$title', '$description', '$created', '$modified', '$created_by')") or die(mysqli_error($conn));
            if($categoryInsertQuery)
            {
                echo"<div class='alert alert-success' role='alert'>Data saved successfully</div>";
                unset($title, $description);
            }
        }
        else{
            echo"<div class='alert alert-danger' role='alert'>Please fill in all fields of the form marked as required</div>";
        }
    }
    if(isset($_POST['saveEditCategory']))
    {
        $categoryid = $_POST['categoryid'];
        $title=mysqli_real_escape_string($conn, $_POST['title']);
        $description=mysqli_real_escape_string($conn, $_POST['description']);
        $modified = date("Y-m-d H:i:s");
        $edit_by = $_SESSION['user_id'];
        if($title!="")
        {
            $categoryUpdateQuery=mysqli_query($conn, "update categories set title='$title', description='$description', modified = '$modified', edited_by = '$edit_by' where id = '$categoryid'") or die(mysqli_error($conn));
            if($categoryUpdateQuery)
            {
                echo"<div class='alert alert-success' role='alert'>Data saved successfully</div>";
                unset($title, $description);
            }
        }
        else{
            echo"<div class='alert alert-danger' role='alert'>Please fill in all fields of the form marked as required</div>";
        }
    }
    if(isset($_POST['deleteCategory']))
    {
        $categoryid=$_POST['id'];
        $check_category_query=mysqli_query($conn, "select * from categories where id = '$categoryid'") or die(mysqli_error($conn));
        if(mysqli_num_rows($check_category_query)>=1)
        {
            $row=mysqli_fetch_array($check_category_query);
            $deleteQuery=mysqli_query($conn, "delete from categories where id = '$categoryid'") or die(mysqli_error($conn));
            if($deleteQuery)
            {
                echo"<div class='alert alert-success' role='alert'>Category deleted successfully</div>";
            }
        }
        else{
            echo "<script>window.location.href ='home?pg=categories';</script>";
        }
    }
?>
<br>
<!--categories tables-->
<?php
$categoriesSelectQuery=mysqli_query($conn, "select * from categories");
?>
<table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Category Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
if($categoriesSelectQuery)
{
while($row = mysqli_fetch_array($categoriesSelectQuery))
{?>
                <tr>
                    <td><?=$row['title']?></td>
                    <td><?=$row['description']?></td>
                    <td><button type="button"  class="btn btn-primary" data-toggle="modal" data-categoryid="<?=$row['id']?>" data-categorytitle="<?=$row['title']?>" data-categorydescription="<?=$row['description']?>" data-target="#editCategoryModal" ><i class="fa fa-edit"></i></button>  <!--<button type="button"  class="btn btn-danger" data-toggle="modal" data-categoryid="<?=$row['id']?>" data-categorytitle="<?=$row['title']?>"  data-target="#deleteCategoryModal" ><i class="fa fa-trash-alt"></i></button>--></td>
                </tr>
<?php
}
}
?>
            </tbody>
        </table>
        <!-- Create Model -->
        <div class="modal fade" id="createCategoryModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype='multipart/form-data'>
                    <div class="modal-body">   
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title (Required):</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?=(isset($title))?$title:''?>">
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-form-label">Description:</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="3"><?=(isset($description))?$description:''?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="saveCategory">Save</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Edit Category Model -->
        <div class="modal fade" id="editCategoryModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype='multipart/form-data'>
                    <input type="hidden" name="categoryid" id="id_edit">
                    <div class="modal-body">   
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title (Required):</label>
                            <input type="text" class="form-control" id="title_edit" name="title" value="">
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-form-label">Description:</label>
                            <textarea name="description" id="description_edit" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="saveEditCategory">Save</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Delete Model -->
        <div class="modal fade" tabindex="-1" id="deleteCategoryModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the category <span id="categorytitle" style="color: red"></span></p>
                    <form method="POST" action="" id="deleteCategoryForm">
                        <input type="hidden" name="categoryid" value="" id="categoryid"/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="deleteCategory" class="btn btn-danger">Yes delete</button>
                        </div>
                    </form>
                </div>
                
                </div>
            </div>
        </div>