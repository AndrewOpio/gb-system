<?php
    if(!isset($_SESSION)){session_start();}
    if(empty($_SESSION['username']))
    { echo "<script>window.location.href ='./';</script>";}

    include('includes/conf.php');
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
        <link rel="stylesheet" href="css/jquery.dataTables.min.css">
        <link href="css/admin.css" rel="stylesheet">
        
        <style>
            img:hover{
                transform: scale(1.01);
            }
        </style>
    </head>

    <body cz-shortcut-listen="true" data-gr-c-s-loaded="true" style="background-color: #e2e2e2;">
        <div class="container-fluid">
            <?php include "navbar.php"?>
            <div class="row">
                <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4" style="margin: auto;">
                            <h3 style = "margin-top: 60px;"><b>Bissau Painel Administrativo</b></h3>
                            <hr style="background-color: green;">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="card" style = "padding: 10px;">
                                        <img src="images/new-entry.png" alt="" class="card-img" width="100" height="200" >
                                        <a href="visitors.php" class="btn btn-primary text-center">Nova entrada</a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card" style = "padding: 10px;">
                                        <img src="images/arrivals.jpeg" alt="" class="card-img" width="100" height="200">
                                        <a href="arrivals.php" class="btn btn-primary text-center">Chegadas</a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card" style = "padding: 10px;">
                                        <img src="images/departures.png" alt="" class="card-img" width="100" height="200">
                                        <a href="departures.php" class="btn btn-primary text-center">Partidas</a>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="card" style = "padding: 10px;">
                                        <img src="images/visa-apply.jpeg" alt="" class="card-img" width="100" height="200">
                                        <a href="addvisa.php" class="btn btn-primary text-center">Pedido de visto</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-sm-4">
                                    <div class="card"  style = "padding: 10px;">
                                        <img src="images/search.png" alt="" class="card-img" width="100" height="200">
                                        <a href="search.php" class="btn btn-primary text-center">Procurar</a>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card"  style = "padding: 10px;">
                                        <img src="images/Reports.png" alt="" class="card-img" width="100" height="200">
                                        <a href="reports.php" class="btn btn-primary text-center">Relatórios</a>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card" style = "padding: 10px;">
                                        <img src="images/visa-apply.jpeg" alt="" class="card-img" width="100" height="200">
                                        <a href="viewvisas.php" class="btn btn-primary text-center">Ver vistos</a>
                                    </div>
                                </div>
                            </div>

                            <h3 style = "margin-top: 60px;"><b>Administração do Sistema</b></h3>
                            <hr style="background-color: green;">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card" style = "padding: 10px;">
                                        <img src="images/man.png" alt="" class="card-img" width="80" height="200">
                                        <a href="users.php" class="btn btn-primary text-center">Gerenciar usuários</a>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card" style = "padding: 10px;">
                                        <img src="images/border.png" alt="" class="card-img" width="100" height="200">
                                        <a href="borderpoints.php" class="btn btn-primary text-center">Gerenciar pontos de fronteira</a>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card" style = "padding: 10px;">
                                        <img src="images/country.png" alt="" class="card-img" width="100" height="200">
                                        <a href="countries.php" class="btn btn-primary text-center">Gerenciar países</a>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                </main>
            </div>
        </div>


        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap.bundle.min.js" ></script>
        <script src="js/all.min.js" ></script>
        <script src="js/dashboard.js" ></script>
        <script src="ckeditor/ckeditor.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <!-- <script src="js/autonumeric.min.js"></script> -->
        <script type='text/javascript'>
            $(document).ready(function() {
                $('input[name="dates"]').daterangepicker({
                    timePicker: true,
                    timePicker24Hour: true,
                    timePickerSeconds: true,
                    locale: {
                        format: 'YYYY-MM-DD HH:mm:ss'
                    }
                });
                $('input[name="dob"]').daterangepicker({
                    singleDatePicker: true,
                    timePicker: false,
                    showDropdowns: true,
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
                $('input[name="passportissuedate"]').daterangepicker({
                    singleDatePicker: true,
                    timePicker: false,
                    showDropdowns: true,
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
                $('input[name="passportexpiry"]').daterangepicker({
                    singleDatePicker: true,
                    timePicker: false,
                    showDropdowns: true,
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
                $('input[name="displaydate"]').daterangepicker({
                    singleDatePicker: true,
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
                $('.example').DataTable( {
                    "pagingType": "full_numbers"
                } );
                $('#pricetable').DataTable( {
                    "pagingType": "full_numbers",
                    "order": [[ 0, "desc" ]]
                } );

            });

            CKEDITOR.replaceClass = 'content';

            //moneyFormat = new AutoNumeric('.money', { decimalPlaces: 0});
        //  delete user model
        $('#deleteUserModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var user_id = button.data('user_id') // Extract info from data-* attributes
            var users_name = button.data('users_name') // Extract info from data-* attributes
            var user_image = '' + button.data('user_image') // Extract info from data-* attributes
            var oldphoto = button.data('user_image') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#user_id').val(user_id);
            modal.find('#users_name').text(users_name);
            modal.find('img#user_image').attr('src',user_image);
            modal.find('#oldphoto').val(oldphoto);
        });
        //edit user modal
        $('#editUserModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var user_id = button.data('user_id') // Extract info from data-* attributes
            var users_name = button.data('users_name') // Extract info from data-* attributes
            var user_name = button.data('user_name') // Extract info from data-* attributes
            var user_type = button.data('user_type') // Extract info from data-* attributes
            var user_bio = button.data('user_bio') // Extract info from data-* attributes
            var user_image = '' + button.data('user_image') // Extract info from data-* attributes
            var oldphoto = button.data('user_image') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#user_id_edit').val(user_id);
            modal.find('#users_name_edit').val(users_name);
            modal.find('#user_name_edit').val(user_name);
            modal.find('#usertypeoption').val(user_type);
            modal.find('#usertypeoption').text(user_type);
            modal.find('img#user_image_edit').attr('src',user_image);
            modal.find('#profile_edit').text(user_bio);
            modal.find('#oldphoto').val(oldphoto);

        });
        // edit Market model
        $('#editMarketModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var marketname = button.data('marketname') // Extract info from data-* attributes
            var marketdistrict = button.data('marketdistrict') // Extract info from data-* attributes
            var marketid = button.data('marketid') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('#name_edit').val(marketname);
            modal.find('#district_edit').val(marketdistrict);
            modal.find('#id_edit').val(marketid);
        });
        // delete Market model
        $('#deleteMarketModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var marketname = button.data('marketname') // Extract info from data-* attributes
            var marketid = button.data('marketid') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('#name_delete_market').text(marketname);
            modal.find('#id_delete_market').val(marketid);
        });
        // edit Unit model
        $('#editUnitModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var unitname = button.data('unitname') // Extract info from data-* attributes
            var unitunit = button.data('unitunit') // Extract info from data-* attributes
            var unitid = button.data('unitid') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('#name_edit').val(unitname);
            modal.find('#unit_edit').val(unitunit);
            modal.find('#id_edit').val(unitid);
        });
        // delete Unit model
        $('#deleteUnitModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var unitname = button.data('unitname') // Extract info from data-* attributes
            var unitid = button.data('unitid') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('#name_delete_unit').text(unitname);
            modal.find('#id_delete_unit').val(unitid);
        });
        // edit Commodity model
        $('#editCommodityModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var commodityname = button.data('commodityname') // Extract info from data-* attributes
            var commodityunit = button.data('commodityunit') // Extract info from data-* attributes
            var commodityunitname = button.data('commodityunitname') // Extract info from data-* attributes
            var commodityid = button.data('commodityid') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('#name_edit').val(commodityname);
            modal.find('#commodity_unit_name').val(commodityunit);
            modal.find('#commodity_unit_name').text(commodityunitname);
            modal.find('#id_edit').val(commodityid);
        });
        // delete Commodity model
        $('#deleteCommodityModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var commodityname = button.data('commodityname') // Extract info from data-* attributes
            var commodityid = button.data('commodityid') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('#name_delete_commodity').text(commodityname);
            modal.find('#id_delete_commodity').val(commodityid);
        });
        // edit Commodity Price model
        $('#editCommodityPriceModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var commodity = button.data('commodity') // Extract info from data-* attributes
            var commodityid = button.data('commodityid') // Extract info from data-* attributes
            var market = button.data('market') // Extract info from data-* attributes
            var marketid = button.data('marketid') // Extract info from data-* attributes
            var commoditypriceid = button.data('commoditypriceid') // Extract info from data-* attributes
            var amount = button.data('amount') // Extract info from data-* attributes
            var pricedatetime = button.data('pricedatetime') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('#commodity_edit').val(commodityid);
            modal.find('#commodity_edit').text(commodity);
            modal.find('#market_edit').val(marketid);
            modal.find('#market_edit').text(market);
            modal.find('#amount_edit').val(amount);
            modal.find('#id_commodity_edit').val(commoditypriceid);
            modal.find('#pricedatetime').val(pricedatetime);
        });
        // delete Commodity Price model
        $('#deleteCommodityPriceModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var commodityname = button.data('commodityname') // Extract info from data-* attributes
            var commoditypriceid = button.data('commoditypriceid') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('#name_delete_commodity').text(commodityname);
            modal.find('#id_delete_commodity').val(commoditypriceid);
        });
        </script>
    </body>
</html>