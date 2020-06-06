<!-- view/music/form.php -->
<?php
$request = preg_replace("|/*(.+?)/*$|", "\\1", $_SERVER['PATH_INFO']);
$uri = explode('/', $request);

// Set form action 
    $judul = 'New Order';
    $form_action = "http://localhost/php_crud/index.php/order/create"; 

$valNama = isset($music['nama']) ? $music['nama'] : '';
$valJudul = isset($music['judul']) ? $music['judul'] : '';
$valAlbum = isset($music['album']) ? $music['album'] : '';
$valTahun = isset($music['tahun']) ? $music['tahun'] : '';
$valId = isset($music['id']) ? $music['id'] : '';
?>

<?php ob_start() ?>
    <h1><?= $judul ?></h1>
<div id="answers" style="color: #3e8f3e">
    
</div>
    <form action="<?php $form_action ?>" method="post" id="buyer-form">
        <?php if ($valId): ?>
            <input type="hidden" name="id" value="<?= $valId ?>">
        <?php endif ?>

        <div class="form-group">
            <label for="nama">Name</label>
            <input name="name" type="text" value="<?= $valNama ?>" class="form-control" id="name" placeholder="Type Full Name">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="text" value="<?= $valJudul ?>" class="form-control" id="email" placeholder="Type E-mail Address">
        </div>

        <div class="form-group">
            <label for="album">Phone</label>
            <input name="phone" type="text" value="<?= $valAlbum ?>" class="form-control" id="phone" placeholder="Type Mobile Number">
        </div>    
		
		<div class="form-group">
            <label for="album">City</label>
            <input name="city" type="text" value="<?= $valTahun ?>" class="form-control" id="city" placeholder="Type City Name">
        </div>
        <div class="form-group">
            <label for="album">Receipt Id</label>
            <input name="receipt_id" type="text" value="<?= $valTahun ?>" class="form-control " id="receipt_id" placeholder="Enter Receipt ID">
        </div>
        <div class="form-group">
            <label for="album">Item</label>
            <input name="items" type="text" value="<?= $valTahun ?>" class="form-control" id="items" placeholder="Type Item Name">
        </div>
        <div class="form-group">
            <label for="album">Amount</label>
            <input name="amount" min="0" step="1" type="number" value="<?= $valTahun ?>" class="form-control" id="amount" placeholder="Enter Amount">
        </div>
        <div class="form-group">
            <label for="album">Note</label>
            <input name="note"  type="text" value="<?= $valTahun ?>" class="form-control" id="note" placeholder="Type your note">
        </div>
        <div class="form-group">
            <label for="album">Entry By</label>
            <input name="entry_by" min="0" step="1" type="number" value="<?= $valTahun ?>" class="form-control" id="entry_by" placeholder="Enter Entry By ID">
        </div> 
        <div class="form-group">
            <label for="album">IP Address</label>
            <input name="buyer_id" type="text" value="<?= $valTahun ?>" class="form-control" id="buyer_id" placeholder="IP Address">
        </div>
        <button class="btn btn-primary pull-right" type="submit" id="submit">Save</button>
    </form>
<a href="http://localhost/php_crud/index.php/order/list" class="btn btn-primary btn-sm pull-left"><span class="glyphicon glyphicon-list"></span> List</a>

<?php $isi = ob_get_clean() ?>



<?php include 'view/layout.php' ?>

