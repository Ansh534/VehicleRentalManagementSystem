<?php
session_start();
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['vrmsuid']==0)) {
  header('location:logout.php');
  } else{

  
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    
    <title>Vehicle Rental Management System || Change Password</title>

    <!--=== Bootstrap CSS ===-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--=== Slicknav CSS ===-->
    <link href="assets/css/plugins/slicknav.min.css" rel="stylesheet">
    <!--=== Magnific Popup CSS ===-->
    <link href="assets/css/plugins/magnific-popup.css" rel="stylesheet">
    <!--=== Owl Carousel CSS ===-->
    <link href="assets/css/plugins/owl.carousel.min.css" rel="stylesheet">
    <!--=== Gijgo CSS ===-->
    <link href="assets/css/plugins/gijgo.css" rel="stylesheet">
    <!--=== FontAwesome CSS ===-->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!--=== Theme Reset CSS ===-->
    <link href="assets/css/reset.css" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="style.css" rel="stylesheet">
    <!--=== Responsive CSS ===-->
    <link href="assets/css/responsive.css" rel="stylesheet">
<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
    
</head>

<body class="loader-active">

    <!--== Preloader Area Start ==-->
    <div class="preloader">
        <div class="preloader-spinner">
            <div class="loader-content">
                <img src="assets/img/preloader.gif" alt="JSOFT">
            </div>
        </div>
    </div>
    <!--== Preloader Area End ==-->

   <?php include_once('includes/header.php');?>

    <!--== Page Title Area Start ==-->
    <section id="page-title-area" class="section-padding overlay">
        <div class="container">
            <div class="row">
                <!-- Page Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>My Booking</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <!--== Contact Page Area Start ==-->
    <div class="contact-page-wrao section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="contact-form">
<b>#<?php echo $bid=$_GET['bookingid'];?> Booking Details</b>



 <div class="row">
 <div class="col-lg-12">
<?php
//Getting Url
$link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 

// Getting order Details
$userid= $_SESSION['vrmsuid'];
$ret=mysqli_query($con,"select CreationDate,Status from tblbookingtwowheeler where UserId='$userid' and BookingNumber='$bid'");
while($result=mysqli_fetch_array($ret)) {
?>

<p style="color:#000"><b>Booking #</b><?php echo $bid?></p>
<p style="color:#000"><b>Booking Date : </b><?php echo $od=$result['CreationDate'];?></p>
<p style="color:#000"><b>Booking Status :</b> <?php if($result['Status']==""){
    echo "Not Response Yet";
} else {
echo $result['Status'];
}?> &nbsp;
</p>

<?php } ?>
<!-- Invoice -->
<p>
 <a href="javascript:void(0);" onClick="popUpWindow('tw-invoice.php?invid=<?php echo $bid;?>');" title="Booking Invoice" style="color:#000">  Invoice</a></p>


 </div>
 </div> 

            <div class="row" style="margin-top:1%">
 <div class="col-lg-12">

        <?php 
 $query=mysqli_query($con,"select DATEDIFF(tblbookingtwowheeler.ReturnDate,tblbookingtwowheeler.BookingDate) as ddf,tblvehicle.Image,tblvehicle.VehicleName,tblvehicle.RentalPrice,tblbookingtwowheeler.FullName,tblbookingtwowheeler.BookingNumber,tblbookingtwowheeler.BookingDate,tblbookingtwowheeler.ReturnDate,tblbookingtwowheeler.TotalCost,tblbookingtwowheeler.Remark,tblbookingtwowheeler.Status,tblbookingtwowheeler.RemarkDate,tblbookingtwowheeler.CreationDate from tblvehicle join tblbookingtwowheeler on tblvehicle.ID=tblbookingtwowheeler.VehicleID where tblbookingtwowheeler.Userid='$userid' and tblbookingtwowheeler.BookingNumber=$bid");
$num=mysqli_num_rows($query);
if($num>0){
    $cnt=1;

?>
<table border="1" class="table">
    <tr>
<th>#</th>
<th>Booking Number</th>
<th>Booking Date</th>
<th>From  Date</th>
<th>To Date</th>
<th>Vehicle Image</th>  
<th>Vehicle Name</th>    
<th>Rental Price</th>   
<th>Total Price</th>  

</tr>
<?php   
while ($row=mysqli_fetch_array($query)) {
    ?>



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
<?php } ?>

</table>

<p>


 
    <p style="color:red">
        <a href="two-wheeler-booking.php" title="Back" style="color:red">Back </a>
    </p>


                </div>
            </div>         </div>
                </div>
            </div>
        </div>
    </div>
    <!--== Contact Page Area End ==-->

   
   <?php include_once('includes/footer.php');?>
    <!--== Scroll Top Area Start ==-->
    <div class="scroll-top">
        <img src="assets/img/scroll-top.png" alt="JSOFT">
    </div>
    <!--== Scroll Top Area End ==-->

    <!--=======================Javascript============================-->
    <!--=== Jquery Min Js ===-->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <!--=== Jquery Migrate Min Js ===-->
    <script src="assets/js/jquery-migrate.min.js"></script>
    <!--=== Popper Min Js ===-->
    <script src="assets/js/popper.min.js"></script>
    <!--=== Bootstrap Min Js ===-->
    <script src="assets/js/bootstrap.min.js"></script>
    <!--=== Gijgo Min Js ===-->
    <script src="assets/js/plugins/gijgo.js"></script>
    <!--=== Vegas Min Js ===-->
    <script src="assets/js/plugins/vegas.min.js"></script>
    <!--=== Isotope Min Js ===-->
    <script src="assets/js/plugins/isotope.min.js"></script>
    <!--=== Owl Caousel Min Js ===-->
    <script src="assets/js/plugins/owl.carousel.min.js"></script>
    <!--=== Waypoint Min Js ===-->
    <script src="assets/js/plugins/waypoints.min.js"></script>
    <!--=== CounTotop Min Js ===-->
    <script src="assets/js/plugins/counterup.min.js"></script>
    <!--=== YtPlayer Min Js ===-->
    <script src="assets/js/plugins/mb.YTPlayer.js"></script>
    <!--=== Magnific Popup Min Js ===-->
    <script src="assets/js/plugins/magnific-popup.min.js"></script>
    <!--=== Slicknav Min Js ===-->
    <script src="assets/js/plugins/slicknav.min.js"></script>

    <!--=== Mian Js ===-->
    <script src="assets/js/main.js"></script>

</body>

</html>
<?php }  ?>