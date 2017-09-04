<?php
include_once 'header.php';
?>
<div class="container">
 <div class="row">
  <div class="col-md-9">
   <div class="page-header">
    <a href="add.php">Add component or board</a>
<!--
    <a href="add.php?w=p">Add part</a>
    <a href="add.php?w=b">Add board</a>
-->
   </div>
  </div>
  <div class="col-md-3">
   <?php
	$sql = "SELECT t1.*, t2.part_type, t3.board_name FROM parts as t1 JOIN part_types AS t2  ON t1.type_id = t2.id LEFT JOIN boards AS t3 ON t1.which_board = t3.id ";
	$result = mysqli_query($db,$sql);
	?>
	<pre><?php 
	//var_dump($_SESSION); 
	?>
	</pre>
	<div style="vertical-align:top; border: 1px solid black; display: inline-block; padding: 10px; margin:10px;">
	<div style-"display:table;">
	    <div style="display:table-row;">
		<div class="tc"> mark </div>
		<div class="tc"> type </div>
		<div class="tc"> case </div>
		<div class="tc"> qty </div>
		<div class="tc"> onb </div>
		<div class="tc"> wb </div>
		<div class="tc"> ds link </div>
	    </div>
	<?php
	while($row = mysqli_fetch_assoc($result)) {
	    if ($row["board_name"]) { 
		$board_name = ' || '.$row["board_name"]; }
	    else {
		$board_name = ''; }
	    $ds_link = '';
	    if ($row["datasheet_link"]) {
		$ds_link = '<a href='.$row["datasheet_link"].' alt="'.$row["datasheet_link"].'">Datasheet</a>';}
	    echo '<div class="tr"><div class="tc"> '
	    .$row["part_mark"].' </div> <div class="tc"> '
	    .$row["part_type"].' </div> <div class="tc"> '
	    .$row["part_case"].' </div> <div class="tc"> '
	    .$row["part_qty"].' </div> <div class="tc"> '
	    .$row["on_board"].' </div> <div class="tc"> '
	    .$row["which_board"].$board_name.' </div> <div class="tc"> '
	    .$ds_link.' </div><div class="tc">
	    <a href="/edit.php?p_id='.$row["id"].'">Edit</a></div></div>';
	}
    ?>
    </div>
    </div>

	<?php
	$sql = "SELECT * FROM boards";
	$result = mysqli_query($db,$sql);
	?>

	<div style="vertical-align:top; border: 1px solid black; display: inline-block; padding: 10px; margin:10px;">
	<div style-"display:table;">
	    <div style="display:table-row;">
		<div class="tc"> name </div>
		<div class="tc"> marks </div>
		<div class="tc"> desc </div>
		<div class="tc"> added </div>
	    </div>
	<?php
	while($row = mysqli_fetch_assoc($result)) {
	    $board_id=$row['id'];
	    echo '<div class="tr"><div class="tc"> '
	    .$row["board_name"].' ('.$board_id.') </div> <div class="tc"> '
	    .$row["board_marks"].' </div> <div class="tc"> '
	    .$row["board_desc"].' </div> <div class="tc"> '
	    .$row["board_added"].' </div> <div class="tc"> 
	    <a href="/edit.php?b_id='.$board_id.'">Edit</a></div></div>';
	}
    mysqli_close($db);
    ?>
    </div>
    </div>

   </div> <!-- col-md-3 -->
  </div> <!-- col-md-9 -->
 </div> <!-- row -->
</div> <!-- container -->
<?php
include_once 'footer.php';
?>