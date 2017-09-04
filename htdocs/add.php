<?php
include_once 'header.php';
?>
<a href="/"> <-- Main</a><br><br>
<div id="add_part" class="ib l">Add part</div>
<div id="add_board" class="ib l">Add Board</div>
<div id="add_part_type" class="ib l">Add/delete part type</div><br><br>

<?php

if ($_SESSION['logged_user']->perm == 'admin' ) {

?>
<div id="container" >

<div id="part_form" class="form" style="display:none; border: 1px solid black; padding: 10px; margin: 0 10px;">
<form method="post" action="add.php">
 Add part: <br>
 Part type: 
   <select name="part_type" id="input-part-type" />
 <?php
	$sql = "SELECT * FROM part_types";
	$result = mysqli_query($db,$sql);
	//$row = mysqli_fetch_assoc($result);
    while ($row = mysqli_fetch_assoc($result)) {
	echo '<option>'.$row["part_type"].'</option><br>';
    }
?>
    </select><br>
 Part mark: <input type="text" name="part_mark" /><br>
 Part case: <input type="text" name="part_case" /><br>
 Part qty: <input type="text" name="part_qty" /><br>
 Part description: <input type="text" name="part_desc" /><br>
 Is on board: <input type="checkbox" name="on_board" id="on_board_checkbox" /><br>
 <div id="part_form_board" style="display:none;">
    Board:
    <select name="part_wb" id="part_wb" />
	<?php
	    $board_sql = "SELECT id,board_name FROM boards";
	    $board_result=mysqli_query($db,$board_sql);
	    while ($row = mysqli_fetch_assoc($board_result)) {
	    echo '<option>'.$row["id"].' || '.$row["board_name"].'</option><br>';
    	    }
        ?>
    </select><br>
    <!--
    <input type="text" name="part_wb" value="<?php echo $part_wb; ?>" />
     -->
 </div><br>
 Datasheet link: <input type="text" name="part_ds_link" /><br>
 <input type="hidden" name="datetime" value="<?php echo date('Y-m-d H:i:s');?>" />
 <input type="submit" name="part_add" value="add" />
</form>
</div>

<div id="board_form" class="form" style="display:none; vertical-align:top; border: 1px solid black; padding: 10px; margin: 0 10px;">
<form method="post" action="add.php">
 Add board: <br>
 Board name: <input type="text" name="board_name" id="board_name" /><br>
 Board marks: <input type="text" name="board_marks" /><br>
 Board description:<br> <textarea name="board_desc" style="width:100%;"></textarea><br>
 <p>
 <label for="board_file">Board image:</label>
 <input type="file" name="board_file" id="board_file">
 <progress id="progressbar" value="0" max="100"></progress>
 </p>
 <input type="hidden" name="board_added" value="<?php echo date('Y-m-d H:i:s');?>" />
 <input type="submit" name="board_add" value="add" />
</form>
</div>

<div id="part_type_form" class="form" style="display:none; vertical-align:top; border: 1px solid black; padding: 10px; margin: 0 10px;">
<form method="post" action="add.php">
 Add part type: <input type="text" name="part_type" id="part_type" placeholder="enter part type name" /><br>
 <input type="hidden" name="part_type_added" value="<?php echo date('Y-m-d H:i:s');?>" />
 <input type="submit" name="part_type_add" value="add" /><br>
 Delete part type: <input type="text" name="part_type_id" id="part_type_id" placeholder="enter part type id" /><br>
 <input type="submit" name="part_type_delete" value="delete" />
</form> <br>
<?php
$sql = "SELECT * FROM part_types";
$result = mysqli_query($db,$sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "id: ".$row['id'].", name: ".$row['part_type']." <br>";
}
?>
</div>


</div>

<?php
if (isset($_POST['part_add'])) {
 $part_type = strip_tags(trim($_POST['part_type']));
 $part_mark = strip_tags(trim($_POST['part_mark']));
 $part_case = strip_tags(trim($_POST['part_case']));
 $part_qty = strip_tags(trim($_POST['part_qty']));
 $part_desc = strip_tags(trim($_POST['part_desc']));
 $part_ds_link = strip_tags(trim($_POST['part_ds_link']));
 $part_wb = strip_tags(trim($_POST['part_wb']));
 $part_wb_explode = explode('||', $part_wb);
 $part_wb_id = $part_wb_explode[0];
 $part_wb_name = $part_wb_explode[1];
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
 $sql = "INSERT INTO parts (type_id,part_mark,part_case,part_qty,on_board,which_board,datasheet_link,part_desc)
	 VALUES ('$part_type_int','$part_mark','$part_case','$part_qty','$on_board','$part_wb_id', '$part_ds_link','$part_desc')";
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
 echo "Part added successfuly";
} else {
 echo "Part type unknown. Nothing added";
}
}
?>

<?php
if (isset($_POST['board_add'])) {
//    echo "<pre>".
//	var_dump($_POST)
//    ."</pre>";
 $board_name = strip_tags(trim($_POST['board_name']));
 $board_marks = strip_tags(trim($_POST['board_marks']));
 $board_added = strip_tags(trim($_POST['board_added']));
 $board_desc = strip_tags(trim($_POST['board_desc']));
 //check if board name already exists
  $sql = "SELECT * FROM boards WHERE board_name='$board_name'";
//  echo "SQL : ".$sql."<br>";
  $board_name_result = mysqli_query($db,$sql);
  $board_name_assoc = mysqli_fetch_assoc($board_name_result);
  $board_name_exists = $board_name_assoc['board_name'];
  if  ($board_name_exists ) { 
     echo "Board already exists: ".$board_name_exists."<br>
           Nothing added.";
     exit();
    }
 $sql = "INSERT INTO boards (board_name,board_marks,board_desc,board_added)
	VALUES ('$board_name','$board_marks','$board_desc','$board_added')";
// echo "insert query: ".$sql."<br>";
//if ($part_type_int > 0 ) {
 $result = mysqli_query($db, $sql) or die(mysqli_error($db));
 if (!result) {
    printf("%s\n", mysqli_error());
    exit();
 } else {
 print_r($result);
 }
 mysqli_close($db);
 echo "Board added successfuly";
//} else {
// echo "Nothing added";
//}
} // endif post
?>

<?php
if (isset($_POST['part_type_add'])) {
    echo "<pre>".
	var_dump($_POST)
    ."</pre>";
 $part_type = strip_tags(trim($_POST['part_type']));
  $sql = "SELECT * FROM part_types WHERE part_type='$part_type'";
//  echo "SQL : ".$sql."<br>";
  $part_type_result = mysqli_query($db,$sql);
  $part_type_assoc = mysqli_fetch_assoc($part_type_result);
  $part_type_exists = $board_name_assoc['part_type'];
  if  ($part_type_exists ) { 
     echo "Part type already exists: ".$part_type_exists."<br>
           Nothing added.";
     exit();
    }
 $sql = "INSERT INTO part_types (part_type) VALUES ('$part_type')";
 $result = mysqli_query($db, $sql) or die(mysqli_error($db));
 if (!result) {
    printf("%s\n", mysqli_error());
    exit();
 } else {
 print_r($result);
 }
 mysqli_close($db);
 echo "Part type added successfuly";
} // endif post
?>

<?php
if (isset($_POST['part_type_delete'])) {
    echo "<pre>".
	var_dump($_POST)
    ."</pre>";
 $part_type_id = strip_tags(trim($_POST['part_type_id']));
//  $sql = "SELECT * FROM part_types WHERE part_type='$part_type'";
//  echo "SQL : ".$sql."<br>";
//  $part_type_result = mysqli_query($db,$sql);
//  $part_type_assoc = mysqli_fetch_assoc($part_type_result);
//  $part_type_exists = $board_name_assoc['part_type'];
//  if  ($part_type_exists ) { 
//     echo "Part type already exists: ".$part_type_exists."<br>
//           Nothing added.";
//     exit();
//    }
 $sql = "DELETE FROM part_types WHERE id='$part_type_id'";
 $result = mysqli_query($db, $sql) or die(mysqli_error($db));
 if (!result) {
    printf("%s\n", mysqli_error());
    exit();
 } else {
 print_r($result);
 }
 mysqli_close($db);
 echo "Part type added successfuly";
} // endif post

?>



<?php
if(isset($_GET[''])) {

}
?>

<?php /*
if (isset($_POST['board_add'])) {
//    echo "<pre>".
//	var_dump($_POST)
//    ."</pre>";
 $board_name = strip_tags(trim($_POST['board_name']));
 $board_marks = strip_tags(trim($_POST['board_marks']));
 $board_added = strip_tags(trim($_POST['board_added']));
 $board_desc = strip_tags(trim($_POST['board_desc']));
 //check if board name already exists
  $sql = "SELECT * FROM boards WHERE board_name='$board_name'";
//  echo "SQL : ".$sql."<br>";
  $board_name_result = mysqli_query($db,$sql);
  $board_name_assoc = mysqli_fetch_assoc($board_name_result);
  $board_name_exists = $board_name_assoc['board_name'];
  if  ($board_name_exists ) { 
     echo "Board already exists: ".$board_name_exists."<br>
           Nothing added.";
     exit();
    }
 $sql = "INSERT INTO boards (board_name,board_marks,board_desc,board_added)
	VALUES ('$board_name','$board_marks','$board_desc','$board_added')";
// echo "insert query: ".$sql."<br>";
//if ($part_type_int > 0 ) {
 $result = mysqli_query($db, $sql) or die(mysqli_error($db));
 if (!result) {
    printf("%s\n", mysqli_error());
    exit();
 } else {
 print_r($result);
 }
 mysqli_close($db);
 echo "Board added successfuly";
//} else {
// echo "Nothing added";
//}
} // endif post

 */ ?>



<script type-"tet/javascript">
function init() {
 $.getScript("/TextChange.js");
 var init_page=1;
}

var ap = document.getElementById('add_part');
var ab = document.getElementById('add_board');
var apt = document.getElementById('add_part_type');

var cb = document.getElementById('on_board_checkbox');
var df = document.getElementById('part_form_board');
if (cb.checked) {df.style.display = 'inline-block';};
cb.onchange = function() {
    df.style.display = this.checked ? 'inline-block' : 'none';
};
document.getElementsByClassName('l')[0]
        .addEventListener('click', function (event) {
    //do something
});
$("#add_part").click(function(){
    $(".form").hide();
    $("#part_form").css('display','inline-block');
});
$("#add_board").click(function(){
    $(".form").hide();
    $("#board_form").css('display','inline-block');
});
$("#add_part_type").click(function(){
    $(".form").hide();
    $("#part_type_form").css('display','inline-block');
});

    $(function(){
      var progressBar = $('#progressbar');
      $('#my_form').on('submit', function(e){
        e.preventDefault();
        var $that = $(this),
            formData = new FormData($that.get(0));
        $.ajax({
          url: $that.attr('action'),
          type: $that.attr('method'),
          contentType: false,
          processData: false,
          data: formData,
          dataType: 'json',
          xhr: function(){
            var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
            xhr.upload.addEventListener('progress', function(evt){ // добавляем обработчик события progress (onprogress)
              if(evt.lengthComputable) { // если известно количество байт
                // высчитываем процент загруженного
                var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
                // устанавливаем значение в атрибут value тега <progress>
                // и это же значение альтернативным текстом для браузеров, не поддерживающих <progress>
                progressBar.val(percentComplete).text('Загружено ' + percentComplete + '%');
              }
            }, false);
            return xhr;
          },
          success: function(json){
            if(json){
              $that.after(json);
            }
          }
        });
      });
    });


</script>

<?php
} else {
    echo "Insufficient permissin to edit. Please login with proper account or contact admin.";
} //if permission check
include_once 'footer.php';
?>
