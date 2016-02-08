angular
  .module('main')
  .controller('IndexController', function($scope, supersonic) {
    // Controller functionality here
    

       /* supersonic.ui.drawers.disable("left").then( function() {
          supersonic.logger.debug("Left drawer was disabled");
        });
    
         function getSpans() {
        
             var spans = document.getElementsByTagName('a');
             for (i=0;i<spans.length;i++)
	           spans[i].onclick=CardClick;
    } */
    
   $scope.Enter = function ()  {
       
       Authenticate();
       
       };
    
   $scope.CardClick = function () {
        CardClick();
       console.log("CLIKER");
       //document.getElementById("cardInfo").onclick("supersonic.ui.dialog.alert('Interstellar!')");
        // document.getElementsByClassName("card").addEventListener("click",CardClick);
       };

      function Authenticate(){
          strLogonName=document.getElementById("username").value;
          strPassword=document.getElementById("passwd").value;
          var xmlhttp;
          xmlhttp= new XMLHttpRequest();
          if (xmlhttp===null){
            alert ("Your browser does not support XMLHTTP! Currently known acceptable browsers are IE5+, Firefox, Chrome, Opera, Safari.");
            return;
          }
          xmlhttp.open("Get","https://cyberirb.us/QQQTest/AppAPI.php?sstrTrigger=Login&sstrLogonName="+strLogonName+"&sstrPassword="+strPassword,true);
          xmlhttp.onreadystatechange = function response() {

                            //enable side drawer
                            supersonic.ui.drawers.enable("left").then( function() {
                              supersonic.logger.debug("Left drawer was enabled1");
                            });
                            //Hide Login and show table
                          document.getElementById("Login").style.display = "none";
                          document.getElementById("InboxTable").style.display = "block";
                            //Populate Inbox Table
                          PopulateInboxTable();
                          
                };
          xmlhttp.send();
        };
   
    
        function PopulateInboxTable(){

          console.log("table load");
          var xmlhttp;
          xmlhttp= new XMLHttpRequest();
          if (xmlhttp===null){
            alert ("Your browser does not support XMLHTTP! Currently known acceptable browsers are IE5+, Firefox, Chrome, Opera, Safari.");
            return;
          }
          xmlhttp.open("Get","https://cyberirb.us/QQQTest/AppAPI.php?sstrTrigger=PopulateInboxTable&sstrLogonName="+strLogonName,true);
          xmlhttp.onreadystatechange = function response() {
                  if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                      TableArray=xmlhttp.responseText;
                      //console.log(TableArray);
                      document.getElementById("table-body").innerHTML=TableArray;

                    }
                  }
                };
          xmlhttp.send();
        }
    


    function CardClick() {
        console.log("Card Click");
     alert("supersonic.ui.dialog.alert('Interstellar!')");
     }
        //document.getElementById("Enter").addEventListener("click",Authenticate);
        //document.getElementById("InboxTable").addEventListener("load",getSpans);
       // document.getElementById("cardInfo").addEventListener("click",CardClick);
     //document.getElementById("clickfunc").addEventListener("click",CardClick);
// };
      
    
  
   // };
   }); 
