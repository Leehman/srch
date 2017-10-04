<?php
session_start();
$messages = "";

if(!isset($_SESSION['messages'])){
	$_SESSION['messages'] ="";
}

?>

<!DOCTYPE html>
<html>
<HEAD>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
<script src="partials/assets/js/jquery.js"></script>
<script src="partials/assets/js/jquery-2.1.3.min.js"></script>


<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link href="partials/assets/bootstrap.css" rel="stylesheet">
<link href="partials/assets/ie10-viewport-bug-workaround.css" rel="stylesheet">
<link href="partials/assets/starter-template.css" rel="stylesheet">

<script src="partials/assets/ie-emulation-modes-warning.js"></script>
<link rel="stylesheet" type="text/css" href="partials/assets/js/jquery-ui.css" >
<style>
 fieldset {
	border: 0;
	padding: 0;
	margin: 0;
	min-width: 0;

 }

</style>

</HEAD>
<BODY>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Search Employees</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container">

		<form action="" method="post" id="frmmgr" name="frmmgr">
		<fieldset id="fset" name="fset">

			<div align="center">
				<input style="border:0px;background-color:#F2F2F2;" type='text' size='40' id='fmessage' name='fmessage'/>

				<p>
				<label for="">Name: </label>
				<input type='text' size='30' name='fname' id='fname' value=""  />
				<label for="">Company: </label>
				<input type='text' size='30' name='fcompany' id='fcompany'  value=""  disabled />
				&nbsp;&nbsp;&nbsp;
				<input type="button" value="Switch Input Fields" id="switch" name="switch"/>&nbsp;
				</p>
				<p>
				&nbsp;
				<input type="reset" value="Reset"  id="reset"/>
				<!--<input type="Submit" value="Submit"  id="Submit" style="display: none;";/>-->
				</p>

				<p>
					<div id="xmessages" style="align:center;border-style:none;text-align:center;color:red;" > <?php echo $messages; ?></div>
				</p>
			</div>

		</fieldset>

		<div id="editfrm" name="editfrm" align="center" ></div>

		</form>

</div><!-- /.container -->
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="partials/assets/js/jquery.js"></script>
	<script>window.jQuery || document.write('<script src="partials/assets/jquery-3.2.1.min.js"><\/script>')</script>
	<script src="partials/assets/bootstrap.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="partials/assets/ie10-viewport-bug-workaround.js"></script>


	<script src="partials/assets/js/jquery-ui.js"></script>
	<script src="partials/assets/js/jquery-ui.css"></script>
	<script src="partials/assets/js/jquery-ui.min.js"></script>
	<script src="partials/assets/js/jquery-ui.min.css"></script>
</BODY>


<script type="text/javascript ">
	$(function() {
	   //autocomplete name

	     $("#fname").autocomplete({
	        source: "/srch/autosearch.php?search=f",
	        minLength: 2,
	        autoFocus: true,

			 change: function (event, ui) {
       //your code
		   },
		   close: function (event, ui) {
				 var fnme = $("#fname").val();
				//alert(fnme );
				$("#editfrm" ).load( "/srch/editform.php?term="+encodeURIComponent(fnme));
			}
			});

	    //autocomplete name
	    $("#fcompany").autocomplete({
	        source: "/srch/autosearch.php?search=c",
	        minLength: 2,
	        autoFocus: true,

			change: function (event, ui) {
			//your code
			},
			close: function (event, ui) {
				 var fnme = $("#fcompany").val();
				//alert(fnme );
				$("#editfrm" ).load( "/srch/editform.php?term="+encodeURIComponent(fnme));
			}
			});
	});
</script>

<script type="text/javascript ">
	  $("#switch").on("click", function(){
			var toggle = $("#fname").prop("disabled");

			$("#fname").prop("disabled", !toggle );
			$("#fcompany").prop("disabled", toggle );
		});

		//$(".reset").click(function() {
		//   $(this).closest('form').find("input[type=text], textarea").val("");
		//		$("#fcompany").prop("disabled", !$("#fcompany").prop("disabled"));
		//});


		//});

</script>
</html>


<?php
if(isset($_SESSION['messages'])){
	echo $messages = $_SESSION['messages'];
}
?>
