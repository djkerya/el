//<?php
//include_once 'header.php';

//$sql = "SELECT * FROM part_types";
//$result = mysqli_query($db,$sql);
//$row = mysqli_fetch_assoc($result);
//?>
/*
<div id="container">
<div style="display:inline-block; border: 1px solid black; padding: 10px; margin: 0 10px;">
<form method="post" action="add.php">
 Part type: 
// <select name="part_type" id="input-part-type">
// <?php while ($row) {
//  echo '<option value="'.$row["part_type"].'"></option>';
// ?>
// </select><br>
// <!--
   <input type="text" name="part_type" id="input-part-type" /><br>
// -->
  <div id="dispaly"></div>
 Part mark: <input type="text" name="part_mark" /><br>
// Part case: <input type="text" name="part_case" /><br>
 Is on board: <input type="checkbox" name="on_board" /><br>
 <input type="hidden" name="datetime" value="<?php echo date('Y-m-d H:i:s');?>" />
 <input type="submit" name="add" value="add" />
</form>
</div>
</div>
*/

/*
<?php
if (isset($_POST['add'])) {
 $part_type = strip_tags(trim($_POST['part_type']));
 $part_mark = strip_tags(trim($_POST['part_mark']));
 $part_case = strip_tags(trim($_POST['part_case']));
 if (isset($_POST['on_board'])) {
    $on_board = 1;
 }
 else {
    $on_board = 0;
 }
 $sql = "SELECT id FROM part_types WHERE part_type='".$part_type."'";
 //echo "SQL : ".$sql."<br>";
 $part_type_result = mysqli_query($db,$sql);
 $part_type_int_assoc = mysqli_fetch_assoc($part_type_result);
 $part_type_int=$part_type_int_assoc['id'];
// print("Part type int: ".$part_type_int."<br>");
 $sql = "INSERT INTO parts (type_id,part_mark,part_case,on_board) VALUES ('$part_type_int','$part_mark','$part_case','$on_board')";
// echo "insert query: ".$sql."<br>";
if ($part_type_int > 0 ) {
 $result = mysqli_query($db, $sql) or die(mysqli_error($db));
 if (!result) {
    printf("%s\n", mysqli_error());
    exit();
 } else {
 print_r($result);
 }
 mysqli_close($db);
 echo "Added successfuly";
} else {
 echo "Part type unknown. Nothing added";
}
}
?>
 <!--
<script type-"tet/javascript">
function init() {
 $.getScript("/TextChange.js");
 var init_page=1;
}
</script>
-->
*/
//<?php
//include_once 'footer.php';
//?>
