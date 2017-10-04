<?php
//session_start();
require_once "getData.php";
//
//var_dump($_REQUEST);
//exit;
$rid = $_REQUEST["ffrecordid"];
//
if(isset($_REQUEST["ffname"])){
	$dbname = trim($_REQUEST["ffname"]);
} else { $dbname = "";	}
if(isset($_REQUEST["ffcompany"])){
	$dbcompany = trim($_REQUEST["ffcompany"]);
} else { $dbcompany = ""; }
if(isset($_REQUEST["ffgender"])){
	$dbgender = trim($_REQUEST["ffgender"]);
} else {$dbgender = "male"; }
//
if (isset($_REQUEST["fftype"])){
	if($_REQUEST["fftype"]=="edit")
		{	// update
			//var_dump($_REQUEST);
			$dbData = getData::updateByid($dbname,$dbcompany,$dbgender,$rid) ;
			//
			//var_dump($_REQUEST);
			//return
			$_SeSsION["messages"]= "good update";
			//header("Location: /src/searchform.html",true);
			echo "Good Update";
			//echo json_encode("Good Update");
			exit(0);

		}

	else if($_REQUEST["fftype"]=="delete"){
			// add
			$dbData = getData::deleteClients($rid) ;
			//
			$_SeSsION["messages"]= "Record deleted";
			//header("Location: /src/searchform.html",true);
			//echo json_encode("Record deleted");
			echo "Record deleted";
			exit(0);
		}
	else {	echo('Wrong database action used to get to this page!');
			}
} else {
	echo('Wrong method used to get to this page!');	}
echo("cya");
exit(0);
?>
