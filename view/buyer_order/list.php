<?php $judul = 'Order List';?>

<?php ob_start() ?>
<br>
<center><h1>Order List</h1></center>
<br>
<div class="row">
    <div class="col-md-12">
        <form name="frmSearch" method="post" action="http://localhost/php_crud/index.php/order/list">
            <div class="search-box"> 
                <div class="col-md-4">
                    <div class="form-group"> 
                        <input type="text" placeholder="From Date" id="post_at" name="search[entry_at]"  value="<?php echo $entry_at; ?>" class="input-control" />
                    </div>
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" placeholder="To Date" id="post_at_to_date" name="search[entry_at_to_date]" style="margin-left:10px"  value="<?php echo $entry_at_to_date; ?>" class="input-control"  />
                    </div>
                </div> 
                <input type="submit" name="go" class="btnSearch" value="Search">
                <input type="reset" class="btnSearch" value="Reset" onclick="window.location='http://localhost/php_crud/index.php/order/list'"> 
            </div>
        </form>
    </div>
   
</div>
<div class="table-responsive">
    <a href="http://localhost/php_crud/index.php/order/create" class="btn btn-primary btn-sm pull-right"><span class="glyphicon glyphicon-plus"></span> Add New</a>

    <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>IP</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>Receipt ID</th>
                <th>Items</th>
                <th>Amount</th>
                <th>Note</th>
                <th>Entry Date</th>
                <th>Entry By</th>
            </tr>
            <?php foreach ($orders as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['buyer'] ?></td>
                    <td><?= $row['buyer_ip'] ?></td>
                    <td><?= $row['buyer_email'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['city'] ?></td>
                    <td><?= $row['receipt_id'] ?></td> 
                    <td><?= $row['items'] ?></td>  
                    <td><?= $row['amount'] ?></td> 
                    <td><?= $row['note'] ?></td> 
                    <td><?= $row['entry_at'] ?></td> 
                    <td><?= $row['entry_by'] ?></td> 
                </tr>
            <?php endforeach ?>
        </table> 
</div>
<br>
<?php $isi = ob_get_clean() ?>

<?php include 'view/layout.php' ?>