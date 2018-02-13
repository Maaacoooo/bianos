<!DOCTYPE html>
<html>
	<head>
		<title><?=$title?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">

		<?php $this->load->view('frontend/inc/css') ?>

	</head>
	<body>

	<!-- OVERLAY -->
	<div class="vegas-overlay" style="margin: 0px; padding: 0px; position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; background-image: url(<?=base_url('assets/frontend/images/overley.png')?>);"></div>
	<!-- OVERLAY -->

		<!-- NAVBAR -->
		<?php $this->load->view('frontend/inc/navbar') ?>
		<!-- NAVBAR -->

		<!-- CONTENT HEADER -->
		<div class="content-header">
			<div class="logotext"><h1 class="customh1">Biaño's Pizza</h1>
			<p class="customp">Lorem ipsum dolor molar mecar melee lorem ipsum dolor.</p></div>
		</div>
		<!-- /.CONTENT HEADER -->

			<!-- SECTION -->
			<section id="bottom">
				<div class="container">
			    	<p class="text-muted lead">
						Lorem ipsum dolor molar mecar melee lorem ipsum dolor imsur morse maroo malco dolora mente mos mando
						ipsum dolor molar mecar melee lorem ipsum dolor imsur morse maroo malco dolora mente mos mando madlara.
			    	</p>
				</div>
			</section>
			 <!-- /#SECTION -->


			 <!-- ITEM BACKGROUND -->
			<div id="item_background">
				<div class="container">
					<div class="row">
						<!-- col-sm-12 -->
						<div class="col-sm-12">


					    	<div class="col-sm-8">
					    	<?php if ($menus): ?>
					    	<?php foreach ($menus as $menu): ?>
					    		<div class="col-md-4 col-sm-5">
						    		<div class="item">
						    			<div class="item-image" style="height: 170px">
							    			<a href="#" data-toggle="modal" data-target="#exampleModal<?=$menu['id']?>"><img src="<?=base_url('/uploads/'. $menu['img'])?>" class="img-responsive"></a>
					    				</div>
					    				<div class="text">
						    				<h3><a href="#"><?=$menu['title']?></a></h3>
					    					<p class="price"><?=$menu['price']?></p>
					    				</div>
				    				</div>
				    				<!-- /.item -->
					    		</div>
					    	<?php endforeach; ?>
					    	<?php endif; ?>
					    	</div>

					    	<div class="col-sm-4">
								<?php $this->load->view('inc/left_nav')?>
					    	</div>
						
						</div>
						<!-- /.col-sm-12 -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container -->
			</div>
			<!-- /.ITEM BACKGROUND -->

			<!-- CONTACT -->
			<div id="contact">
				<div class="container">
					<h1 class="text-muted new">Contact Us</h1>
				</div>
			</div>
			<div id="contact_background">
				<div class="custom">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<p class="large">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel nam magnam natus tempora cumque, aliquam deleniti voluptatibus voluptas. 
										Repellat vel, et itaque commodi iste ab, laudantium voluptas deserunt nobis.</p>
									
									<ul class="list-icons">
										<li><i class="fa fa-map-marker pr-10"></i> Near Boulevard, QWEQWE</li>
										<li><i class="fa fa-phone pr-10"></i> +00 1234567890</li>
										<li><i class="fa fa-fax pr-10"></i> +00 1234567891 </li>
										<li><i class="fa fa-envelope-o pr-10"></i> your@email.com</li>
									</ul>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<input type="text" class="form-control custom-form" placeholder="Name"/>
									</div>
									<div class="form-group">
										<input type="text" class="form-control custom-form" placeholder="Phone"/>
									</div>
									<div class="form-group">
										<input type="text" class="form-control custom-form" placeholder="Email"/>
									</div>
									<div class="form-group">
										<textarea class="form-control custom-form" rows="5" placeholder="Your Content"></textarea>
									</div>
									
									<button type="button" class="btn btn-default form-control btn-custom">SUBMIT</button>
									
								</div>
								<!-- /.col-sm-6 -->
							</div>
							<!-- /.col-sm-12 -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.container -->
				</div>
				<!-- /.custom -->
			</div>
			<!-- /.CONTACT -->

			<?php $this->load->view('frontend/inc/copyright') ?>



			<?php if ($menus): ?>
			<?php foreach ($menus as $menu): ?>
			<!-- Modal -->  
		    <div class="modal fade" id="exampleModal<?=$menu['id']?>">
		      <div class="modal-dialog">
		        <div class="modal-content">
		          <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		              <span aria-hidden="true">×</span></button>
		            <h4 class="modal-title"><u><?=$menu['title']?></u></h4>
		          </div>
		          <div class="modal-body">
		          	<div class="row">
			           <div class="col-sm-12">
				          	<div class="col-sm-6">
				          		<div class="form-group">
				          			<img src="<?=base_url('/uploads/'. $menu['img'])?>" class="img-thumbnail img-responsive">
				          		</div>
					        </div>

					        <div class="col-sm-4">
					        	<div class="form-group">
					        		<label for="price">Price</label>
					        		<h4><?=$menu['price']?></h4>
					        	</div>
					            <div class="form-group">
					              <label for="brand">Select Table</label>
					              <select name="brand" id="brand" class="form-control" required="">
					                <option selected="" disabled="">Select Table...</option>
					                <option value="">1</option>
					                <option value="">2</option>
					                <option value="">3</option>
					                <option value="">4</option>
					              </select>
					            </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="number" name="qty" min="0" class="form-control" placeholder="Quantity" />
                                </div>

					        </div>
					        <div class="col-sm-12">
						        <div class="form-group">
						        	<label>Description</label>
						        	<blockquote>
						        		<?=$menu['description']?>
						        	</blockquote>
						        </div>
					        </div>
				        </div>
				        <!-- /.col-sm-12 -->
			        </div>
			        <!-- /.row -->
		          </div>
		          <!-- /.modal-body -->
		          <div class="modal-footer">
		            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		            <button type="submit" class="btn btn-success">Add</button>
		          </div>
		        </div>
		        <!-- /.modal-content -->
		      </div>
		      <!-- /.modal-dialog -->
		    </div>
		   	<!-- /.Modal -->
		    <?php endforeach; ?>
		    <?php endif; ?>


	</body>

		<?php $this->load->view('frontend/inc/js') ?>

		<script>
			jQuery(window).scroll(function(){
				var vscroll = jQuery(this).scrollTop();
				//console.log(vscroll);
				jQuery('.logotext').css({
					"transform" : "translate(0px, "+vscroll/2+"px)"
				});
			});
		</script>
</html>