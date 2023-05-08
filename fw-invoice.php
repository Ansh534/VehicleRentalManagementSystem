<?php
session_start();
error_reporting(0);
include_once('includes/dbconnection.php');
if (strlen($_SESSION['vrmsuid']==0)) {
  header('location:logout.php');
  } else{ 

 

    ?>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}
function f3()
{
window.print(); 
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>VRMS-Invoice</title>
</head>
<body>

<div style="margin-left:50px;">

<?php  
$invid=$_GET['invid'];
$query=mysqli_query($con,"select DATEDIFF(tblbookingcar.ReturnDate,tblbookingcar.BookingDate) as ddf,tblvehiclecar.Image,tblvehiclecar.VehicleName,tblvehiclecar.RentalPrice,tblbookingcar.FullName,tblbookingcar.BookingNumber,tblbookingcar.BookingDate,tblbookingcar.ReturnDate,tblbookingcar.TotalCost,tblbookingcar.Remark,tblbookingcar.Status,tblbookingcar.RemarkDate,tblbookingcar.CreationDate from tblvehiclecar join tblbookingcar on tblvehiclecar.ID=tblbookingcar.VehicleID where tblbookingcar.BookingNumber=$invid");
$num=mysqli_num_rows($query);
$cnt=1;
?>

<table border="1"  cellpadding="10" style="border-collapse: collapse; border-spacing:0; width: 100%; text-align: center;">
  <tr align="center">
   <th colspan="8" >Invoice of #<?php echo  $invid;?></th> 
  </tr>
  <?php  
while ($row=mysqli_fetch_array($query)) {
  ?>
  <tr>
    <th colspan="3">Booking Date :</th>
<td colspan="5">  </b> <?php echo $row['CreationDate'];?></td>
  </tr>
  
<th>#</th>
<th>Booking Number</th>
<th>Booking Date</th>
<th>From Date</th>
<th>To Date</th>
<th>Vehicle Image</th>  
<th>Vehicle Name</th>    
<th>Rental Price</th>   
<th>Total Price</th>  

</tr>



<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row['BookingNumber'];?></td>
<td><?php echo $row['CreationDate'];?></td>
<td><?php echo $row['BookingDate'];?></td>
<td><?php echo $row['ReturnDate'];?></td>
<td>
<img class="b-goods-f__img img-scale" src="admin/images/<?php echo $row['Image'];?>" alt="<?php echo $row['Image'];?>" width='300' height='250'></td>
<td><?php echo $row['VehicleName'];?></td>  
<td><?php echo $rpice=$row['RentalPrice'];?>  </td> 
<td>Rs. <?php
$d1=$row['ddf'];;

 echo $total=$d1*$rpice;?></td>
 <?php 

$cnt=$cnt+1; 
                    }        
 ?> 
</td>
    
</tr>

</table>
     
     <p >
      <input name="Submit2" type="submit" class="txtbox4" value="Close" onClick="return f2();" style="cursor: pointer;"  />   <input name="Submit2" type="submit" class="txtbox4" value="Print" onClick="return f3();" style="cursor: pointer;"  /></p>
</div>

</body>
</html>

  <?php } ?>   