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
                            <h3 class="page-title">Users</h3>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-10">

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

                            <div class="card">
                                <div class="card-block">
                             
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group pull-right">
                                                <input type="text" name="search" class="form-control" placeholder="Search..." />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h5 class="text-bold card-title">User List <span class="badge"><?=$total_result?></span></h5>
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Full Name</th>
                                                <th>Username</th>
                                                <th>Usertype</th>
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
                                        <?php foreach ($results AS $user): ?>
                                            <tr>
                                                <th scope="row"><?=$x++;?></th>
                                                <td><?=$user['name']?></td>
                                                <td><?=$user['username']?></td>
                                                <td><?=$user['usertype']?></td>
                                                <td><a href="<?=base_url('users/update/'.$user['username'])?>" title="View" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="form-group">
                            <div class="card">
                                <div class="card-header" role="tab" id="headingThree">
                                    <h5 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Register User
                                    </a>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="card-block">

                                        <div class="row">
                                        <div class="col-md-12">
                                            <?=form_open_multipart('users', array('class' => 'form-horizontal'))?>
                                                <div class="form-group row margin-top-30">
                                                    <div class="col-md-3">
                                                        <label class="control-label col-form-label">Username</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="username" class="form-control" value="<?=set_value('username')?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label class="control-label col-form-label">Full name</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="name" class="form-control" value="<?=set_value('name')?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label class="control-label col-form-label">Email Address</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="email" class="form-control" value="<?=set_value('email')?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label class="control-label col-form-label">Contact Number</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="contact" class="form-control" value="<?=set_value('contact')?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label class="control-label col-form-label">Usertype</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select name="usertype" class="form-control" value="<?=set_value('usertype')?>">
                                                            <option disabled="" selected="">Select Usertype...</option>
                                                             <?php 
                                                                if($usertypes):
                                                                foreach($usertypes as $usr):
                                                              ?>
                                                            <option value="<?=$usr['title']?>"><?=$usr['title']?></option>
                                                            <?php
                                                                endforeach;
                                                                endif;
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label class="control-label col-form-label">Profile Image</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="file" name="img" class="form-control" value="<?=set_value('img')?>">
                                                    </div>
                                                </div>

                                                <div class="pull-right">
                                                    <button type="reset" class="btn btn-secondary">
                                                        Reset
                                                        <i class="fa fa-refresh position-right"></i>
                                                    </button>

                                                    <button type="submit" class="btn btn-primary">
                                                        Submit
                                                        <i class="fa fa-arrow-right position-right"></i>
                                                    </button>
                                                </div>
                                            <?=form_close()?>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                          <div class="col-md-10">
                            <div class="pull-right">
                              <?php foreach ($links as $link) { echo $link; } ?>
                            </div>
                          </div><!-- /.col-md-12 -->

                    </div>

                    

                </div>
            </div>
            <!-- /PAGE CONTENT -->
        </div>
    </div>

    <?php $this->load->view('inc/js')?>

</body>
</html>