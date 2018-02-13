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
                            <h3 class="page-title">Dashboard</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <div class="widget-overview bg-primary-1">
                                <div class="inner">
                                    <h2>$15K</h2>
                                    <p>Sales Today</p>
                                </div>

                                <div class="icon">
                                    <i class="fa fa-dollar"></i>
                                </div>

                                <div class="details bg-primary-3">
                                    <span>View Details <i class="fa fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">
                            <div class="widget-overview bg-info-1">
                                <div class="inner">
                                    <h2>35%</h2>
                                    <p>Growth in Traffic</p>
                                </div>

                                <div class="icon">
                                    <i class="fa fa-signal"></i>
                                </div>

                                <div class="details bg-info-3">
                                    <span>View Details <i class="fa fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">
                            <div class="widget-overview bg-success-1">
                                <div class="inner">
                                    <h2>$8.5K</h2>
                                    <p>Profit Today</p>
                                </div>

                                <div class="icon">
                                    <i class="fa fa-money"></i>
                                </div>

                                <div class="details bg-success-3">
                                    <span>View Details <i class="fa fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">
                            <div class="widget-overview bg-danger-1">
                                <div class="inner">
                                    <h2>8,952</h2>
                                    <p>Unique Visitors</p>
                                </div>

                                <div class="icon">
                                    <i class="fa fa-pie-chart"></i>
                                </div>

                                <div class="details bg-danger-3">
                                    <span>View Details <i class="fa fa-arrow-right"></i></span>
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