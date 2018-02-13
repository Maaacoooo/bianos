<!DOCTYPE HTML>
<html>

<head>
    <title><?=$site_title?> - <?=$title?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?=base_url('assets/custom/css/jquery-ui.min.css')?>">

    <?php $this->load->view('inc/css')?>

</head>

<body>

    <?php $this->load->view('inc/header')?>

    <div class="page-container">
        <div class="page-content">

        <?php $this->load->view('inc/left_nav')?>

            <!-- PAGE CONTENT -->
            <div class="content-wrapper">
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="page-title">Sales Register</h3>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-block">

                                    <h5 class="text-bold card-title">Items</h5>

                                    <?=form_open('sales/create')?>
                                    <div class="input-group">
                                        
                                        <input type="text" name="item" class="form-control" id="item" placeholder="Search item..." />
                                        
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add Item</button>
                                        </div>
                                    </div>
                                    <?=form_close()?>

                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Item ID</th>
                                                <th>Item Name</th>
                                                <th>SRP</th>
                                                <th>QTY</th>
                                                <th>DISC</th>
                                                <th>Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>ASD</td>
                                                <td>asd</td>
                                                <td>asd</td>
                                                <td>asd</td>
                                                <td>asd</td>
                                                <td>asd</td>
                                            </tr>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="text-bold card-title">Sale Options</h5>
                                        <div class="form-group">
                                            <label for="sample">Sample</label>
                                            <input type="text" name="" class="form-control" id="sample" placeholder="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="sample">Sample</label>
                                            <input type="text" name="" class="form-control" id="sample" placeholder="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="sample">Sample</label>
                                            <input type="text" name="" class="form-control" id="sample" placeholder="" />
                                        </div>
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <textarea name="remarks" class="form-control" cols="3" id="remarks"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="total_amount">Total Amount</label>
                                        
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Amount Tendered</label>
                                            <input type="text" name="remarks" class="form-control" id="amount">
                                        </div>      
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /PAGE CONTENT -->
        </div>
    </div>

    <?php $this->load->view('inc/js')?>

    <script type="text/javascript" src="<?=base_url('assets/custom/js/jquery-ui.js')?>"></script>

<script type="text/javascript">
  $(function(){
  $("#item").autocomplete({    
    source: "<?php echo base_url('index.php/sales/autocomplete');?>" // path to the get_birds method
  });
});
</script>

</body>
</html>