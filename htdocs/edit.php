<?php
require 'header.php';
?>
<br>
<a href="/"><-- Main</a>

<br><br>
<?php
if ($_SESSION['logged_user']->perm == 'admin' ) {

if(isset($_POST['part_save'])) {
    $part_id = strip_tags(trim($_POST['part_id']));
    $part_type = strip_tags(trim($_POST['part_type']));
    $part_mark = strip_tags(trim($_POST['part_mark']));
    $part_case = strip_tags(trim($_POST['part_case']));
    $part_qty = strip_tags(trim($_POST['part_qty']));
    $part_wb = strip_tags(trim($_POST['part_wb']));
    $part_wb_explode = explode('||', $part_wb);
    $part_wb_id = $part_wb_explode[0];
    $part_wb_name = $part_wb_explode[1];
    $part_ds_link= strip_tags(trim($_POST['part_ds_link']));
    $part_desc= strip_tags(trim($_POST['part_desc']));
    if (isset($_POST['on_board'])) {
		$on_board = 1;
		}
     else {
		$on_board = 0;
    }
    $sql = "SELECT id FROM part_types WHERE part_type='$part_type' ";
    $part_type_result = mysqli_query($db,$sql);
    $part_type_int_assoc = mysqli_fetch_assoc($part_type_result);
    $part_type_int=$part_type_int_assoc['id'];
    $sql = "UPDATE parts SET type_id='$part_type_int', part_mark='$part_mark', part_case='$part_case',part_qty='$part_qty',
	     on_board='$on_board', which_board='$part_wb_id', datasheet_link='$part_ds_link', part_desc='$part_desc'
	      WHERE id='$part_id' ";
    if ($part_type_int > 0 ) {
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$result = mysqli_query($db, $sql) or trigger_error(mysqli_error($db)." in ".$sql);
	if (!result) {
         printf("%s\n", mysqli_error($db));
         exit();
       } else {
        print_r($result);
    echo "Updated successfuly. <br>";
    }
}
$part_form_show=1;
} // if isset post part_save


if(isset($_POST['board_save'])) {
    $board_id = strip_tags(trim($_POST['board_id']));
    $board_name = strip_tags(trim($_POST['board_name']));
    $board_marks = strip_tags(trim($_POST['board_marks']));
    $board_desc = strip_tags(trim($_POST['board_desc']));
//    $sql = "INSERT INTO parts (type_id,part_mark,part_case,on_board) VALUES ('$part_type_int','$part_mark','$part_case','$on_board')";
    $sql = "UPDATE boards SET board_name='$board_name', board_marks='$board_marks', board_desc='$board_desc' WHERE id='$board_id' ";
//    echo "update query: ".$sql."<br>";
//    if ($part_type_int > 0 ) {
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$result = mysqli_query($db, $sql) or trigger_error(mysqli_error($db)." in ".$sql);
	//mysqli_close($db);
	if (!$result) {
         printf("%s\n", mysqli_error($db));
         exit();
        }
    echo "Updated successfuly";
//    } else {
//    echo "Board unknown. Nothing saved";
//    }
    $board_form_show=1;
} // if isset post

if(isset($_POST['board_delete'])) {
    $board_id = strip_tags(trim($_POST['board_id']));
    $board_name = strip_tags(trim($_POST['board_name']));
    $board_marks = strip_tags(trim($_POST['board_marks']));
    $board_desc = strip_tags(trim($_POST['board_desc']));
    $sql = "DELETE FROM boards WHERE id='$board_id' ";
    echo "delete query: ".$sql."<br>";
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$result = mysqli_query($db, $sql) or trigger_error(mysqli_error($db)." in ".$sql);
	//mysqli_close($db);
	if (!$result) {
         printf("%s\n", mysqli_error($db));
         exit();
    echo "Deleted successfuly";
    } else {
    echo "Board unknown. Nothing added";
    }
    $board_form_show=1;
} // if isset post

if(isset($_GET['p_id'])) {
$part_id=$_GET['p_id'];
$sql="SELECT t1.*, t2.* FROM parts AS t1 JOIN part_types AS t2 ON t1.type_id = t2.id WHERE t1.id='$part_id' ";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$part_type=$row['part_type'];
$part_mark=$row['part_mark'];
$part_case=$row['part_type'];
$part_qty=$row['part_qty'];
$on_board=$row['on_board'];
$part_wb=$row['which_board'];
$part_ds_link=$row['datasheet_link'];
$part_form_show=1;
} //if isset p_id

if ( isset($_GET['b_id'] )) {
$board_id=$_GET['b_id'];
$sql="SELECT * FROM boards WHERE id='$board_id'";
$result=mysqli_query($db,$sql);
//mysqli_close($db);
$row=mysqli_fetch_assoc($result);
$board_name=$row['board_name'];
$board_marks=$row['board_marks'];
$board_desc=$row['board_desc'];
$board_added=$row['board_added'];
$board_form_show=1;
} // if isset get b_id
?>

<div id="conainer" style="width:100%;" >

<?php
$board_sql = "SELECT id,board_name FROM boards";
$board_result=mysqli_query($db,$board_sql);
?>
<div id="part_form" style="vertical-align:top; border:1px solid black; display:none; padding: 10px;">
<form method="post" action="edit.php">
 Part type: <input style="align:right;" type="text" name="part_type" id="input-part-type" value="<?php echo $part_type ?>" /><br>
  <div id="dispaly"></div>
 Part mark: <input  type="text" name="part_mark" value="<?php echo $part_mark; ?>" /><br>
 Part case: <input type="text" name="part_case" value="<?php echo $part_case; ?>" /><br>
 Qty: <input type="text" name="part_qty" value="<?php echo $part_qty; ?>" /><br><br>
 Is on board: <input type="checkbox" name="on_board" id="on_board_checkbox"
		 <?php if ($on_board) { echo 'checked';} ?> /><br>
 <div id="part_form_board" style="display:none;">
  Board: 
    <select name="part_wb" id="part_wb" />
    <?php
	while ($row = mysqli_fetch_assoc($board_result)) {
	echo '<option>'.$row["id"].' || '.$row["board_name"].'</option><br>';
     }
    ?>
     </select>
  <!--
  <input type="text" name="part_wb" value="<?php echo $part_wb; ?>" />
  -->
 </div>
 <br><br>
 Datasheet link: <input type="text" name="part_ds_link" value="<?php echo $part_ds_link; ?>" /><br><br>
 Part description: <input type="text" name="part_desc" value="<?php echo $part_desc; ?>" /><br><br>
 <input type="hidden" name="datetime" value="<?php echo date('Y-m-d H:i:s');?>" />
 <input type="hidden" name="part_id" value="<?php echo $part_id; ?>">
 <input type="hidden" name="board_id" value="<?php echo $board_id; ?>">
 <input type="submit" name="part_save" value="Save" />
</form>
</div>

<div id="board_form" style="vertical-align:top; border:1px solid black; display:none; padding: 10px;">
<form method="post" action="edit.php">
 Board name: <input  type="text" name="board_name" value="<?php echo $board_name; ?>" /><br>
 Board marks: <input type="text" name="board_marks" value="<?php echo $board_marks; ?>" /><br>
 board desc <input type="text" name="board_desc" value="<?php echo $board_desc; ?>" /><br>
 <input type="hidden" name="board_id" value="<?php echo $board_id; ?>"><br>
 <input type="submit" name="board_save" value="Save" />
 <input type="submit" name="board_delete" value="Delete" />
</form>
</div>

</div>

<?php
if ($board_form_show) {
echo '<script>
	document.getElementById("board_form").style.display="inline-block";
	</script>';
}
if ($part_form_show) {
echo '<script>
	document.getElementById("part_form").style.display="inline-block";
	</script>';
}
?>

<script>
var cb = document.getElementById('on_board_checkbox');
var df = document.getElementById('part_form_board');
if (cb.checked) {df.style.display = 'inline-block';};
cb.onchange = function() {
	df.style.display = this.checked ? 'inline-block' : 'none';
};
</script>


<?php
} else {
    echo "Insufficient permissin to edit. Please login with proper account or contact admin.";
} // end if permission
include_once 'footer.php';
?>
