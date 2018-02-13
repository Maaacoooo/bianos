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
                                    <h5 class="text-bold card-title">New Menu</h5>
                                    <?=form_open_multipart('menu/create')?>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" name="img" class="form-control" id="image" value="<?=set_value('img')?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" class="form-control" id="title" <?=set_value('title')?> placeholder="Title" />
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input type="number" name="price" min="0" class="form-control" id="price" <?=set_value('price')?> placeholder="Price" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="category">Menu Category</label>
                                                    <select name="category" class="form-control" id="category" <?=set_value('category')?>>
                                                        <option disabled="" selected="">Select Menu...</option>
                                                    <?php if ($categories): ?>
                                                    <?php foreach ($categories AS $cat): ?>
                                                        <option value="<?=$cat['title']?>"><?=$cat['title']?></option>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" class="form-control" id="description" <?=set_value('description')?> placeholder="Place Some text here..." rows="5"></textarea>
                                        </div>
                                        <div class="form-group pull-right">
                                            <button type="reset" class="btn btn-primary">Reset Field</button>
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </div>
                                    <?=form_close()?> 
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