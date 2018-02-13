<!DOCTYPE HTML>
<html>

<head>
    <title><?=$site_title?> - <?=$title?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                            <h3 class="page-title"><?=$title?></h3>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-block">    
                            <h5 class="text-bold card-title">Stocks</h5> 
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ($results):

                                        if($page == 1) {
                                            $x = 1; 
                                        } else {
                                            $x = (($page-1)*$per_page)+1;
                                        } 

                                         ?>
                                        <?php foreach ($results AS $menu): ?>
                                            <tr>
                                                <th scope="row"><?=$x++;?></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                        </tbody>
                                    </table>
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

</body>
</html>