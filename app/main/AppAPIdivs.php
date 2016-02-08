<?php
header('Content-type: text/html');
header('Access-Control-Allow-Origin: *');
$strLogonName=$_GET["sstrLogonName"];
$strPassword=$_GET["sstrPassword"];
$strTrigger=$_GET["sstrTrigger"];
$serverName = "184.106.118.20"; //serverName\instanceName
$DBconnectionInfo = array('Database'=>'QQQ','UID'=>'ProIRB','PWD'=>'500Years');
$conn = sqlsrv_connect( $serverName, $DBconnectionInfo);

if($strTrigger=="Login"){
  if( $conn ) {
       $check = "SELECT * FROM users WHERE LogonName = '$strLogonName'";
       $result=sqlsrv_query($conn, $check);
       if(!($info = sqlsrv_fetch_array($result))){
        echo 'That user does not exist in our database.';
       }
      
      else{
  
        $tmppw = $info['Password'];
  
        //gives error if the password is wrong
        if($strPassword != $tmppw){
          echo ('Incorrect password, please try again.');
        }
        else{
          echo "go";
        }
      }
  }else{
       echo "Connection could not be established.<br />";
       die( print_r( sqlsrv_errors(), true));
  }
}
	
if($strTrigger=="PopulateInboxTable"){
  if( $conn ) {
       $check = "DECLARE @return_value int EXEC @return_value = [proirb]. [CIRB_spQQQProtocol] @CustNum='101', @TaskList_AssignToLogonName='$strLogonName', @TaskList_Complete='0', @SpecialSProc=Protocols4TaskList";
       $result=sqlsrv_query($conn, $check);
       if(!($info = sqlsrv_fetch_array($result))){
        echo 'sql statement bad';
       }
      
      else{
        //build table
        $fcount = sqlsrv_num_fields($result );
        $tag = sqlsrv_field_metadata($result );
        $Num= 0;
        while( $row = sqlsrv_fetch_array( $result) ) {
          //echo json_encode ($row);
              $Num++;
              print("<div id='".$Num."' class='card' ng-click=CardClick()>");
              print("<p id='inboxTitle'>".$row['Title']."</td>");
              print("<p id='inboxTask'>".$row['TaskVerbage']."</td>");
              print("<p id='inboxProtNum'>".$row['ProtocolNum']."</td>");
              print("<p id='inboxType'>".$row['Type']."</td>");
              //print("<td data-title='ID'>".$row['PI4Protocol']."</td>");
              //print("<td data-title='ID' id='".$Num."TaskID' style='display:none;'>".$row['TaskID']."</td>");
             // print("<td data-title='ID' id='".$Num."RefNum' style='display:none;'>".$row['RefNum']."</td>");
              print("</div>");
        }
      }
  }else{
       echo "Connection could not be established.<br />";
       die( print_r( sqlsrv_errors(), true));
  }
}


if($strTrigger=="CardClicked"){
  if( $conn ) {
      echo 'card clicked';
       //$check = "SELECT * FROM users WHERE LogonName = '$strLogonName'";
     //  $result=sqlsrv_query($conn, $check);
      // if(!($info = sqlsrv_fetch_array($result))){
      //  echo 'That user does not exist in our database.';
     //  }
     // else {
     //  echo "Connection could not be established.<br />";
     //  die( print_r( sqlsrv_errors(), true));
  }
}

if($strTrigger=="Task"){
  $strTask=$_POST["sstrTask"];
  $strRefNum=$_POST["sstrRefNum"];
  $strLogonName=$_POST["sstrLogonName"];
  $bolAuthAdminCoor=$_POST["sbolAuthAdminCoor"];
  $strMainPageMode=$_POST["sstrMainPageMode"];
  include clsQQQFullApp.php;
  TriggerCall($strTask,'' ,'' ,'101',$strLogonName,$bolAuthAdminCoor,$strMainPageMode,$strRefNum);
  echo "good";
}
	//output data in XML format
	//sqlsrv_close($sdbhTaskList);
?>

