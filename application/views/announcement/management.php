</div>

<div class="page-container">
	<div class="page-content">
		<div class="container-fluid">
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="#" onclick="home()">Home</a><i class="fa fa-circle"></i>
				</li>
				<li class="active">
					 Announcement
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->	
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue ">
						<div class="portlet-title">
							<div class="caption">
								<?php
									if($edit_announcement->id!=0)
									{
								?>	
										<i class="fa fa-gift"></i>Edit Announcement
								<?php 
									}
									else
									{
								?>
										<i class="fa fa-gift"></i>Add Announcement
								<?php 
									}
								?>
							</div><!-- 
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div> -->
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<?php echo form_open($action, $attribute)?>
								<div class="form-body">
									<div class="form-group">
										<label class="control-label col-md-2">Title</label>
										<div class="col-md-10">
											<input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo (isset($edit_announcement->title))?$edit_announcement->title:set_value('title');?>"/>
											<input type="hidden" name="edit_id" value="<?php echo (isset($edit_announcement->id))?$edit_announcement->id:'0';?>"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2">Description</label>
										<div class="col-md-10">
											<textarea name="description" placeholder="Description" class="form-control" rows="5"><?php echo (isset($edit_announcement->description))?$edit_announcement->description:set_value('description');?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2">Category</label>
										<div class="col-md-10">
											<select class="form-control" name="category">
												<?php 
													if(isset($edit_announcement->category))
													{
														switch($edit_announcement->category)
														{
															case 0: $str_category="Public";break;
															case 1: $str_category="Sub Admin";break;
															case 2: $str_category="Administrator"; break;
															default: $str_category="Public";break;
														}
												?>
														<option value="<?php echo $edit_announcement->category;?>"><?php echo $str_category;?></option>
												<?php 
													}
													else
													{
												?>	
														<option value="">-Select-</option>
												<?php
													}
												?>
												<option value="0" <?php echo set_select('category', '0'); ?> selected>Public</option>
												<option value="1" <?php echo set_select('category', '1'); ?>>Sub Admin</option>
												<option value="2" <?php echo set_select('category', '2'); ?>>Administrator</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
													<button type="reset" class="btn default" >Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function home(){
		window.location.href = '<?PHP echo site_url("announcement/index"); ?>';
	}
</script>

<script src="<?php echo base_url();?>public/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>public/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>