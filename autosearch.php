<?php

 session_start();
 require_once("dbconnect.php") ;

 if (isset($_GET['term'])){
    $return_arr = array();
    $search_session = array();
    $ssearch = $_GET['search'];
    //
    try {

        //
        if(isset($_GET['search']) AND $_GET['search'] == "f"){
        	$stmt = DB::getInstance()->prepare('SELECT client_id, name, company, gender FROM clients WHERE name LIKE :term');
        	$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
        	while($row = $stmt->fetch()) {
            	$return_arr[] =  $row['name'];
              $search_session[] = array("cid"=> $row['client_id'],"name"=>$row['name'],"company"=>$row['company'],"gender"=>$row['gender']);

            }
        }
        elseif (isset($_GET['search']) AND $_GET['search'] == "c"){
        	$stmt = DB::getInstance()->prepare('SELECT client_id, name, company, gender FROM clients WHERE company LIKE :term');
        	$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
        	while($row = $stmt->fetch()) {
            	$return_arr[] =  $row['company'];
              $search_session[] = array("cid"=> $row['client_id'],"name"=>$row['name'],"company"=>$row['company'],"gender"=>$row['gender']);

        	}
          //

        }
        else{
        	echo "Major error has occurred!!!";
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    $_SESSION["ssearch"] = $ssearch  ;
    $_SESSION["searchresults"] = $search_session;
    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
    //var_dump($_SESSION);

}else{echo "something bad!" ;}


?>
