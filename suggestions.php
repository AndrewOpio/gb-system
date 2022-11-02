<?php
 require_once "classes/visitors.php";
 $visitor = new Visitor();

if(!empty($_POST["keyword"])) {
    $check = $visitor->getSuggestions($_POST["keyword"]);
    $result = pg_fetch_object($check);

    if(!empty($result)) {
?>

       <div style="padding: 10px;  width: 100%;">
<?php while($result = pg_fetch_object($check)){ ?> 
       <p style="margin-bottom: 2px;" onClick="selectNumber(<?php echo $result->id; ?>, '<?php echo $result->passportnumber; ?>');"><?php echo $result->passportnumber; ?></p>
       <hr style="margin-top: 5px; margin-bottom: 5px;"/>

 <?php } ?>
       </div>
<?php 
  } else {
?>
       <div style="padding: 10px; width: 100%;">No results</div>
       <script>
          $("#v_id").val("");
       </script>
<?php
  } 
}
?>
