<?php session_start();
include('../dist/includes/dbcon.php');
if(!isset($_GET['order_id']) || $_GET['order_id']==NULL){
    echo "<script>location.href = 'home.php';</script>";
}else{
    $order_id=$_GET['order_id'];
    $m_id=$_GET['m_id'];
} 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View ordered current status</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <style type="text/css">
        body { font-size: 120%; }
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper" style="min-height: 560px;">
        <div class="container">
          <!-- Content Header (Page header) -->
          <form method="POST" action="">
          <section class="content-header" style="text-transform: uppercase;font-weight: bold;line-height: 20px;">
        <?php 
            $query=mysqli_query($con,"SELECT buy_sell_status FROM create_order WHERE order_id='$order_id'");
            $row=mysqli_fetch_array($query);
            $status = $row['buy_sell_status'];
            if ($status == 'buy') { ?>
              <h1>
                <a class="btn btn-lg btn-warning" href="addOrder_seller.php?m_id=<?php echo $m_id;?>" name="submit404">Back</a>
            </h1>
            <center><b><h3 style="margin-top: -40px;">Ordered Product To Buy</h3></center></b>  
        <?php }elseif ($status == 'sell') { ?>
            <h1>
                <a class="btn btn-lg btn-warning" href="addOrder_buyer.php?m_id=<?php echo $m_id;?>" name="submit404">Back</a>
            </h1> 
            <center><b><h3 style="margin-top: -40px;">Ordered Product To Sell</h3></center></b>
        <?php } ?>
            
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Order no - <?php echo $order_id;?></li>
            </ol>
          </section>
          </form>
          <!-- Main content -->
          <section class="content">
            <div class="row" style="margin-top: 10px;">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header">
                  <h4 class="box-title">Product List of Order No - <?php echo $order_id;?> & Member No - <?php echo $m_id;?>
                </h4>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead style="font-size:12px;">
                      <tr>
                        <th>SL</th>
                        <th style="width: 350px">Product Name</th>
                        <th>Ordered Quantity</th>
                        <th>Delivered Quantity</th>
                        <th>Due Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php
        $query=mysqli_query($con,"select * from order_deli_status_view where order_id='$order_id'");
            $i=0;
            while($row=mysqli_fetch_array($query)){
            $i++;
    ?>
          <tr>
            <td><?php echo $i;?></td>
            <td style="width: 350px"><?php echo $row['prod_name'];?></td>
            <td><?php echo $row['od_qty'];?></td>
            <td><?php echo $row['dd_qty'];?></td>
            <td><?php echo $row['DUE'];?></td>
          </tr> 
<?php } ?>        
                    </tbody>
                  </table>

                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="col-md-2"></div>
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
