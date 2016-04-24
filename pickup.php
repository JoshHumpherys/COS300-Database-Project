<!DOCTYPE html>
<html>
<?php require "header.php"; 
   // set server access variables
   $host = "localhost";
   $user = "AEBurdette";
   $pass = "unlock";
   $db = "marciadb";

   $mysqli = new mysqli($host, $user, $pass, $db);
?>

<body>
<div class="container">

<h1>
Search
</h1>

 <form action="pickup.php" method="post">
Order Id: <input type="text" , name="OrderID" , size="10">
Customer Phone: <input type="text" , name="CustomerPhone" , size="10">
Customer Name: <input type="text" , name="CustomerName" , size="35">
<input type="submit" name="Send" value="Send">
</form>

<h2>
Results
</h2>


<?php
   if(isset($_POST["Send"])) {
      if(!empty($_POST["OrderID"])) {
        echo "This is Order Id";   //Notification provided for testing only
        echo "<br>";

        $OrderID = $_POST["OrderID"];
        $query = "SELECT *
                  FROM MARCIADB.ORDER";
        //execute the query          
        $result = $mysqli->query($query);
        if(!empty($result)) {

           echo "<table cellpadding=10>";
           echo "<th>OrderID</th>";
           echo "<th>Drop Date</th>";
           echo "<th>Promise Date</th>";
           echo "<th>Pickup Date</th>";
           echo "<th>Method Of Payment</th>";
           echo "<th>CustomerID</th>";
           echo "</table>";
  
           while($rowIdentification = $result->fetch_array()) {    
              echo "<tr>";
              echo "<td>".$rowIdentification[0]."</td>";
              echo "<td>".$rowIdentification[1]."</td>";
              echo "<td>".$rowIdentification[2]."</td>";
              echo "<td>".$rowIdentification[3]."</td>";
              echo "<td>".$rowIdentification[4]."</td>";
              echo "<td>".$rowIdentification[5]."</td>";
              echo "</tr>";
              }
           }
           else {
              echo "No results were found for OrderID search "; 
              echo $OrderID;
              }
    
        }


      if(!empty($_POST["CustomerPhone"])) {
         echo "This is Customer Phone";   //Notification provided for testing only
         echo "<br>";

         
         $CustomerPhone = $_POST["CustomerPhone"];
         $query = "SELECT *
                   FROM MARCIADB.ORDER";
         if(!empty($query)) {
            echo "Test2";   //Notification Two provided for testing 
            }
           else {
              echo "No results were found for Customer Phone search "; 
              echo $CustomerPhone;
              }

         }


      if(!empty($_POST["CustomerName"])) {
         echo "This is Customer Name";    //Notification provided for testing only
         echo "<br>";

         $CustomerName = $_POST["CustomerName"];
         $query = "SELECT *
                   FROM MARCIADB.ORDER";
         if(!empty($query)) {
            echo "Test3";   //Notification Two provided for testing 
            }
           else {
              echo "No results were found for Customer Name search "; 
              echo $CustomerName;
              }
         }

      }  //This brace for if statement testing send button isset
?>

<h2>
Modify
</h2>

<form action="pickup.php" method="post">
    <input type="submit" name="Update" value="Update">
    <input type="submit" name="Delete" value="Delete">
</form>

<?php
    //Update an existing Order
    if(isset($_POST["Update"])) {
        echo "<br>";
        echo "Customer Id: <input type='number' , name='CustId' , min='0' , max='999' , step='1'>";
        echo " Order Id: <input type='number' , name='OrderId' , min='0' , max='999' , step='1'>";
        echo " Pickup Date: <input type='text' , name='PickupDate' size='35'>";

        echo " Method Of Payment: ";
        echo "<select name='action_type'>
                 <option value='Debit'>Debit</option>
                 <option value='Credit'>Credit</option>
                 <option value='GiftCard'>Gift Card</option>
              </select>";
        }

    //Delete an existing Order
    if(isset($_POST["Delete"])) {
       echo "<br>"; 
       echo "Order Id: <input type='number' , name='OrderId' , min='0' , max='999' , step='1'>";
       }

    // close connection 
    $mysqli->close();
?>

</div>
</body>
</html>
