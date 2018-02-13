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
                            <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success pull-right">Create Menu</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

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
                              <h5 class="text-bold card-title">List <span class="badge"><?=$total_result?></span></h5>
                              <table class="table table-condensed">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Title</th>
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
                                  <?php foreach ($results AS $category): ?> 
                                      <tr>
                                          <th scope="row"><?=$x++;?></th>
                                          <td><?=$category['title']?></td>
                                          <td><a href="#updateMenu<?=$category['title']?>" data-toggle="modal" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                          <a href="#deleteMenu<?=$category['title']?>" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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

                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                      <?=form_open('menu/create_menu')?>
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Menu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="menu">Title</label>
                                        <input type="text" name="title" class="form-control" id="menu" placeholder="Title"/>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                          </div>
                        </div>
                        <?=form_close()?>
                      </div>
                    </div>
                    <!-- /.modal -->

                    <?php if ($results): ?>
                    <?php foreach ($results AS $category): ?>
                    <!-- Modal -->
                    <div class="modal fade" id="updateMenu<?=$category['title']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                      <?=form_open('menu/update_menu')?>
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Menu: <?=$category['title']?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="menu">Title</label>
                                        <input type="text" name="title" value="<?=$category['title']?>" class="form-control" id="menu" placeholder="Title"/>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <input type="hidden" name="id" value="<?=$this->encryption->encrypt($category['title'])?>"/>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                          </div>
                        </div>
                        <?=form_close()?>
                      </div>
                    </div>
                    <!-- /.modal -->
                    <?php endforeach ?>
                    <?php endif ?>


                    <?php if ($results): ?>
                    <?php foreach ($results AS $category): ?>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteMenu<?=$category['title']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                      <?=form_open('menu/delete_menu')?>
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Menu: <?=$category['title']?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                <p>Are you sure you want to delete <b><?=$category['title']?>.</b>
                                You cannot undo this action.
                                </p>
                                </div>
                            </div>
                          </div>
                          <input type="hidden" name="id" value="<?=$this->encryption->encrypt($category['title'])?>"/>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </div>
                        </div>
                        <?=form_close()?>
                      </div>
                    </div>
                    <!-- /.modal -->
                    <?php endforeach ?>
                    <?php endif ?>

                </div>
            </div>
            <!-- /PAGE CONTENT -->
        </div>
    </div>

    <?php $this->load->view('inc/js')?>

</body>
</html>