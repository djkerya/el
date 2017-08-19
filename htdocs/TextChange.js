<script type="text/javascript">

function fill(Vlue) {
    $('#input-part-type').val(Value);
    $('#display').hide();
}

$(document).ready(function() {

$('#input-part-type').keyup(function() {
    if (input-part-type == "") {
	$('#dispaly').html("");
    }
    else {
	$.ajax({
	    type: "POST",
	    url: "ajax.php",
	    data: { search: input-part-type},
	    success: function(html) {
		$('#dispaly').html(html).show();
	    }
	});
});
</script>