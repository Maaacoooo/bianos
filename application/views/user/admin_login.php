<!DOCTYPE HTML>
<html>

<head>
    <title>Modish - Open Source Admin Dashboard Template</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/core.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/components.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/icons/fontawesome/styles.min.css')?>">

    <script type="text/javascript" src="<?=base_url('lib/js/jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('lib/js/tether.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('lib/js/bootstrap.min.js')?>"></script>

    <script type="text/javascript" src="<?=base_url('assets/js/app.min.js')?>"></script>
</head>

<body>

    <?=form_open('dashboard/login')?>
        <div class="page-container">
            <!-- PAGE CONTENT -->
            <div class="content h-100">
                <div class="row h-100">
                    <div class="col-lg-12">
                        <div class="login card auth-box mx-auto my-auto">
                            <div class="card-block text-center">
                                <div class="user-icon">
                                    <i class="fa fa-user-circle"></i>
                                </div>

                                <h4 class="text-light">Login</h4>

                                <?php
                                    //ALERT / NOTIFICATION
                                    //ERROR ACTION                          
                                    if($this->session->flashdata('error')): ?>

                                    <div class="alert alert-danger" role="alert">
                                      <span class="icon"><i class="fa fa-times position-left"></i>
                                      </span>
                                      <strong>Oops!</strong>
                                      <?=$this->session->flashdata('error')?>
                                    </div>
                                               
                                <?php 
                                    endif; //error end
                                    //SUCCESS ACTION                          
                                    if($this->session->flashdata('success')): ?>
                                    <div class="alert alert-success" role="alert">
                                      <span class="icon"><i class="fa fa-check position-left"></i>
                                      </span>
                                      <strong>Success!</strong>
                                      <?=$this->session->flashdata('success')?>
                                    </div>
                                <?php 
                                    endif; //success end
                                    //FORM VALIDATION ERROR
                                    $this->form_validation->set_error_delimiters('<li>', '</li>');
                                    if(validation_errors()): ?>
                                    <div class="alert alert-warning" role="alert">
                                      <span class="icon"><i class="fa fa-exclamation-triangle position-left"></i>
                                      </span>
                                      <strong>Warning!</strong>         
                                      <?=validation_errors()?>         
                                    </div>
                                <?php endif; //formval end ?> 

                                <div class="user-details">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-user-o"></i>
                                                </span>
                                            <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-key"></i>
                                                </span>
                                            <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>

                                <div class="user-links">
                                    <a href="#" class="pull-left">Forgot Password?</a>
                                    <a href="#" class="pull-right">Register</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /PAGE CONTENT -->
        </div>
    <?=form_close()?>



</body>

</html>