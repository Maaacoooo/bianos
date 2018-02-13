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
                        <div class="col-lg-8">    

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
                                    <h5 class="text-bold card-title">Update: <?=$info['title']?></h5>

                                    <?=form_open_multipart('menu/view/'.$info['id'])?>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="img" class="form-control" id="image">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" class="form-control" id="title" value="<?=$info['title']?>" placeholder="Title" />
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input type="number" name="price" min="0" class="form-control" id="price" value="<?=$info['price']?>" placeholder="Price" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="category">Menu Category</label>
                                                    <select name="category" class="form-control" id="category">
                                                        <option disabled="" selected="">Select Menu...</option>
                                                    <?php if ($categories): ?>
                                                    <?php foreach ($categories AS $cat): ?>
                                                        <option value="<?=$cat['title']?>" <?php if ($info['category'] == $cat['title']) { echo 'selected'; } ?>><?=$cat['title']?></option>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" class="form-control" id="description" placeholder="Place Some text here..." rows="5"><?=$info['description']?></textarea>
                                        </div>

                                        <div class="form-group pull-right">
                                            <input type="hidden" name="id" value="<?=$this->encryption->encrypt($info['id'])?>"/>
                                            <input type="hidden" name="img" value="<?=$info['img']?>"/>
                                            <button type="reset" class="btn btn-primary">Reset Field</button>
                                            <button type="submit" class="btn btn-info">Update</button>
                                            <a href="#exampleModal" data-toggle="modal" class="btn btn-danger">Delete</a>
                                        </div>
                                    <?=form_close()?> 
                                </div>
                            </div>
                        </div>                         
                    </div>


                    <?=form_open('menu/delete')?>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete: <?=$info['title']?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete <b><?=$info['title']?></b>. You cannot undo this action.
                          </div>
                          <input type="hidden" name="id" value="<?=$this->encryption->encrypt($info['id'])?>"/>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.modal -->
                    <?=form_close()?>


                </div>
            </div>
            <!-- /PAGE CONTENT -->
        </div>
    </div>

    <?php $this->load->view('inc/js')?>

</body>
</html>