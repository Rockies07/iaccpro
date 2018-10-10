</div>
<link rel="stylesheet" href="<?php echo base_url();?>public/assets/global/plugins/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END HEADER -->
<style>	
	.row{
		margin-bottom: 10px;
	}

	.align-right{
		float: right;
	}
</style>
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container-fluid">
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<?php echo form_open($action, $attribute)?>
							<div class="row">
								<div class="col-md-7">
									<div class="form-group">
										<label class="control-label col-md-offset-5 col-md-1" style="width: 100px !important; padding-left: 0">Status</label>
										<div class="col-md-3">
											<select class="form-control input-sm select2me align-right" name="filter_status" id="filter_status">
												<?php 
													if($filter_status!="")
													{
														switch($filter_status)
														{
															case '1': $filter_status_text="Active"; break;
															case '0': $filter_status_text="Suspend"; break;
															default: $filter_status_text="Suspend"; break;
														}
												?>
														<option value="<?php echo $filter_status;?>" selected><?php echo $filter_status_text;?></option>
												<?php
													}
												?>
												<option value="">- Please Select -</option>
												<option value="1">Active</option>	
												<option value="0">Suspend</option>	
											</select>
										</div>
										<div class="col-md-2" style="width: 100px !important;">
											<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<a data-toggle="modal" href="#add_item" data-id="0" class="btn btn-primary add_item_modal align-right">
										Add Project
									</a>
								</div>
							</div>
						</form>
						<div class="portlet-body">
							<table class="table table-bordered table-hover" id="project_detail">
								<thead>
									<tr>
										<th width="10px" class="text-center">S/N</th>
										<th width="50px" class="text-center">Mode</th>
										<th width="50px" class="text-center">Type</th>
										<th width="250px" class="text-center">Name</th>
										<th width="250px" class="text-center">Address</th>
										<th class="text-center">Remark</th>
										<th width="60px" class="text-center">Status</th>
										<th width="120px" class="text-center">Action</th>
										<th width="120px" class="text-center">Create Date</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if(!empty($project))
										{
											$i=0;
											foreach ($project as $row){
												$i++;
												switch($row['status'])
												{
													case '1': $status_str="Active"; break;
													case '0': $status_str="Suspend"; break;
													default: $status_str="Suspend"; break;
												}
									?>
												<tr>
													<td class="text-center"><?php echo $i; ?></td>
													<td class="text-center"><?php echo $row['mode']; ?></td>
													<td class="text-center"><?php echo $row['type']; ?></td>
													<td><?php echo $row['name']; ?></td>
													<td><?php echo $row['address']; ?></td>
													<td><?php echo nl2br($row['remark']); ?></td>
													<td class="text-center"><?php echo $status_str; ?></td>
													<td class="text-center actions">
														<a data-toggle="modal" href="#add_item" data-id="<?php echo $row['id'];?>" class="btn default btn-xs blue add_item_modal">
															Edit
														</a>
														<?php echo anchor('project/delete/'.$row['id'].'/index', 'Delete',array('class' => 'btn default btn-xs red','onclick'=>"return confirm('Are you sure to remove this Project?')"));?>
													</td>
													<td class="text-center"><?php echo date('H:i d M Y',strtotime($row['createdate'])); ?></td>
												</tr>
									<?php 
											}
										}
										else
										{
									?>
											<tr class="gradeX">
												<td colspan="9"> -- No Data Available -- </td>
											</tr>
									<?php
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<div id="add_item" class="modal fade" tabindex="-2" aria-hidden="true" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Project</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:280px" data-always-visible="1" data-rail-visible1="1">
					<div class="col-md-12">
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Mode</label>
								<div class="col-md-4">
									<input type="hidden" id="project_id" name="project_id">
									<select class="form-control input-sm select2me" name="mode" id="mode">
										<option value="">- Please Select</option>
										<option value="SB">SB</option>	
										<option value="Biz">Biz</option>	
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Type</label>
								<div class="col-md-5">
									<input class="form-control form-control-inline input-sm" size="20" maxlength="20" type="text" name="type" id="type"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Name</label>
								<div class="col-md-9">
									<input class="form-control form-control-inline input-sm" size="20" maxlength="50" type="text" name="name" id="name"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Address</label>
								<div class="col-md-9">
									<textarea name="address" id="address" class="col-md-12 form-control form-control-inline input-sm"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Remark</label>
								<div class="col-md-9">
									<textarea name="remark" id="remark" class="col-md-12 form-control form-control-inline input-sm"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Status</label>
								<div class="col-md-4">
									<select class="form-control input-sm select2me" name="status" id="status">
										<option value="1">Active</option>	
										<option value="0">Suspend</option>	
									</select>
								</div>
							</div>
						</div>
					</div>		
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" class="btn red" onclick="save_project();">Save</button>
			</div>
		</div>
	</div>
</div>

<script>
	function home(){
		window.location.href = '<?PHP echo site_url("announcement/index"); ?>';
	}

	function save_project()
	{
		var id=$("#project_id").val();
		var mode=$("#mode").val();
		var type=$("#type").val();
		var address=$("#address").val();
		var name=$("#name").val();
		var remark=$("#remark").val();
		var status=$("#status").val();

		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('project/save_project'); ?>",
	        data:{"id":id,"mode":mode,"type":type,"address":address,"name":name,"remark":remark,"status":status},
	        success: function(response){
	        	console.log(response);
	        	$("#project_detail").load(location.href + " #project_detail");
	        	$('#add_item').modal('hide');
	        }
	    });
	}

	$(document).on("click", ".add_item_modal", function () {
		var id = $(this).data('id');
		var status_text;
		$("#project_id").val(id);

		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('project/get_project_detail'); ?>",
	        data:{"id":id},
	        success: function(response){
	        	response = JSON.parse(response);
	        	console.log(response.type);

	        	set_select2me_text('#mode',response.mode,response.mode);
	        	$("#type").val(response.type);
	        	$("#name").val(response.name);
	        	$("#remark").val(response.remark);
	        	$("#address").val(response.address);

	        	switch(response.status)
	        	{
	        		case "0": status_text="Suspend";break;
	        		case "1": status_text="Active"; break;
	        		default: status_text="Suspend";break;
	        	}
	        	set_select2me_text('#status',response.status,status_text);
	        }
	    });
	});
</script>

<script src="<?php echo base_url();?>public/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>public/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>	