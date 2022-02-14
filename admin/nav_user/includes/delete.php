<?php require_once "class.php";
if(empty($_POST['user_id'])){
	echo "Not found";
	die();
} else {
	$user = new user;
	$user->delete($_POST['user_id']);	
}
?>
<script>
function myFunction() {
  var txt;
  var r = confirm("Press a button!");
  if (r == true) {
    txt = "You pressed OK!";
  } else {
    txt = "You pressed Cancel!";
  }
  document.getElementById("demo").innerHTML = txt;
}
</script>