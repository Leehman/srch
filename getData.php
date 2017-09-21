<?php
//include "mysession.php";
session_start();
include "dbconnect.php";

class getData {
  private static $editData = null;
  private static $dbreturn = null;
  //
  public function __construct() {
             //$srctype = $_SESSION['searchtype'];
             //$srcresults = $_SESSION['searchresults'];
           }

  public static function searchForId($id, $array, $ikeyd) {
    foreach ($array as $key => $val) {
        if ($val[$ikeyd] === $id) {
            return $key;
        }
    }
    return null;
  }

  public static function clientByName($term)
   { header('Access-Control-Allow-Origin: *');
     $srctype = $_SESSION['ssearch'];
     $srcresults = $_SESSION['searchresults'];
      //
      try {
        if($srctype == 'f'){
          $id = self::searchForId($term, $srcresults, 'name');
          #$key = array_search('100', array_column($userdb, 'uid'));
        }elseif ($srctype == 'c'){
          $id = self::searchForId($term, $srcresults, 'company');

        }else{  echo 'error from session'; exit;}

        if(!is_null($id)){
          self::$editData = array($srcresults[$id]['name'], $srcresults[$id]['gender'], $srcresults[$id]['company'], $srcresults[$id]['cid']);
         }

        return self::$editData;

      }
      catch(PDOException $e)
      { echo $e->getMessage();  }
  }


  public static function updateByid($fname,$fcompany,$fgender,$frecid)
   {  header('Access-Control-Allow-Origin: *');
     try {

        //$rec_id = $frecid;
        $sql = "UPDATE clients SET name= ?, gender= ?, company= ? WHERE client_id = ?";
        $stmt = DB::getInstance()->prepare($sql);
        $isOk = $stmt->execute(array($fname,$fgender,$fcompany,$frecid));
        //
        $dbreturn = $stmt->rowCount();

        /*** close the database connection ***/
        return self::$dbreturn;
        //exit;
      }
      catch(PDOException $e)
        { echo $e->getMessage();  }
  }

  public static function deleteClients($frecid)
   {  header('Access-Control-Allow-Origin: *');
     
    try {

        $sql = "DELETE FROM clients WHERE client_id = ?";
        $stmt = DB::getInstance()->prepare($sql);
        $isOk = $stmt->execute(array($frecid));
        //
        //if ($isOk === TRUE) {
        $dbreturn = $stmt->rowCount();
          //return self::$dbreturn;
       // }
       // else {
            //trigger_error('Error executing statement.', E_USER_ERROR);
       //     $dbreturn = -1;
            //return -1;
       // }
        /*** close the database connection ***/
        return self::$dbreturn;
      }
      catch(PDOException $e)
      { echo $e->getMessage();  }
  }

} // end of class

?>
