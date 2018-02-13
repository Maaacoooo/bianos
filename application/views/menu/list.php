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
                    <div class="row">
                        <div class="col-lg-12">

                        <div class="card">
                            <div class="card-block">

                            
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group pull-right">
                                            <input type="text" name="search" class="form-control" placeholder="Search..." />
                                        </div>
                                    </div>
                                </div>
                                <h5 class="text-bold card-title">List <span class="badge"><?=$total_result?></span></h5>
                                <table class="table table-condensed table-responsive">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="15%">Image</th>
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Menu Category</th>
                                            <th>Action</th>
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
                                            <td>
                                            <?php if ($menu['img']): ?>
                                                <a href="<?=base_url('menu/view/'.$menu['id'])?>"><img src="<?=base_url('/uploads/'. $menu['img'])?>" class="img-thumbnail"/></a>
                                            <?php else: ?>
                                                <a href="<?=base_url('menu/view/'.$menu['id'])?>"><img src="<?=base_url('assets/img/default-img.png')?>" class="img-thumbnail"/></a>
                                            <?php endif; ?>
                                            </td>
                                            <td><?=$menu['title']?></td>
                                            <td><?=$menu['price']?></td>
                                            <td><?=$menu['category']?></td>
                                            <td><a href="<?=base_url('menu/view/'.$menu['id'])?>" title="View" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                            </td>
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