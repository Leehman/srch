<?php

require_once "getData.php";
//
if (isset($_GET["term"])){
	$term = $_GET["term"];
}else{
	var_dump($_GET['term']);
	exit;
}
//
$dbData = getData::clientByName($term) ;
if (is_null($dbData)) {
	$nuthin2c = <<<EOD
		<p style="align: center"> No data found !!! </p>
EOD;
echo $nuthin2c;
exit;
}

$genders = trim($dbData[1]);
$mgender = " " ;
$fgender = " " ;

if (strcmp($genders,"male") == 0){
	$mgender = "selected='true'" ;
} else {	$fgender = "selected='true'" ; }
//	open p field with no data to display

//
$popform = <<<EOD

	<fieldset>

		<div>

			<p>
			<label for="ffname">Name: </label>
			<input type='text' size='30' name='ffname' id='ffname' value="{$dbData[0]}" /></p>

			<p>
			<label for="ffcompany">Company: </label>
			<input type='text' size='30' name='ffcompany' id='ffcompany' value="{$dbData[2]}" /></p>

			<p>
			<label for="ffgender">Gender: </label>
			<select size='2' name='ffgender'>
				<option value="male" {$mgender} >Male</option>
				<option value="female" {$fgender} >Female</option>
			</select>

			</p>
			<p>
			<label for="">Action: </label>
			<input type="submit" value="Change" id="submit" name="submit"/>&nbsp;
			<input type="submit" value="Delete" id="delete" name="delete"/>&nbsp;
			<input type="button" value="Cancel"  name="cancel" id="cancel"/>
			</p>

			<input type="hidden" name="ffrecordid" id="ffrecordid" value="{$dbData[3]}" />
			<input type="hidden" name="fftype" id="fftype" value="edit" />

			<div id="xmessages" name="xmessages" style="align:center;border-style:none;text-align:center;color:red;" ></div>
		</div>
	</fieldset>


<script>
	//alert(document.forms[0].fftype.value);
	$(document).ready(function() {
		 
		$("#frmmgr").submit(function(e){
		  event.preventDefault();

		  console.log($(document.activeElement).val());
		  which = document.activeElement).val();
		  if (which == 'delete') {
			document.forms[0].fftype.value = 'delete';	}

		  var webreq = $.ajax({
			      url: "editData.php",
			      type: 'POST',
			      dataType: "json",
			      data: $(this).serialize()
				});

		      webreq.done (function (data)
		      {	$("#xmessages").html(data);
		  			alert(data);
					var url = "editform.php";
					$(location).attr('href',url);
		      });

		      webreq.fail (function (xhr, desc, err)
		      {	$("#xmessages").html(err);
		  			alert("Error!.");
		           console.log("error");
				});
			});
			//event.preventDefault();
		});
</script>

EOD;
echo $popform;

?>
