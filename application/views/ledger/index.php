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
									&nbsp;
								</div>
								<div class="col-md-5">
									<?php echo anchor('ledger/add', 'Add Ledger',array('class' => 'btn btn-primary add_item_modal align-right', 'target' => '_blank'));?>
								</div>
							</div>
						</form>
						<div class="portlet-body">
							<table class="table table-bordered table-striped table-hover" id="ledger_detail">
								<thead>
									<tr>
										<th width="10px" class="text-center">S/N</th>
										<th width="50px" class="text-center">Code</th>
										<th width="150px" class="text-center">Header</th>
										<th class="text-center">Ledger</th>
										<th width="80px" class="text-center">Type</th>
										<th width="60px" class="text-center">Report</th>
										<th width="120px" class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if(!empty($ledger))
										{
											$i=0;
											foreach ($ledger as $row){
												$i++;
									?>
												<tr>
													<td class="text-center"><?php echo $i; ?></td>
													<td class="text-center"><?php echo $row->code; ?></td>
													<td><?php echo $row->header; ?></td>
													<td><?php echo $row->name; ?></td>
													<td class="text-center"><?php echo $row->type; ?></td>
													<td class="text-center"><?php echo $row->report; ?></td>
													<td class="text-center actions">
														<a data-toggle="modal" href="#add_item" data-id="<?php echo $row->id;?>" class="btn default btn-xs blue add_item_modal">
															Edit
														</a>
														<?php echo anchor('ledger/delete/'.$row->id.'/index', 'Delete',array('class' => 'btn default btn-xs red','onclick'=>"return confirm('Are you sure to remove this Ledger?')"));?>
													</td>
												</tr>
									<?php 
											}
										}
										else
										{
									?>
											<tr class="gradeX">
												<td colspan="11" class="text-center"> -- No Data Available -- </td>
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
				<h4 class="modal-title">Ledger</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible1="1">
					<div class="col-md-12">
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Code</label>
								<div class="col-md-4">
									<input type="hidden" id="ledger_id" name="ledger_id">
									<input class="form-control form-control-inline input-sm" name="code" id="code"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Header</label>
								<div class="col-md-4">
									<select class="form-control input-sm select2me header_list" name="header" id="header">
										<option value="">- Please Select -</option>
										<option value="Assets">Assets</option>
										<option value="Expenses">Expenses</option>
										<option value="Other Expenses">Other Expenses</option>
										<option value="Income">Income</option>
										<option value="Other Income">Other Income</option>
										<option value="Equity">Equity</option>
										<option value="Liability">Liability</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Parent</label>
								<div class="col-md-5">
									<select class="form-control input-sm select2me parent_list" name="parent" id="parent">
										<option value="">- Please Select -</option>
										<?php

											if(!empty($ledger))
											{
												foreach ($ledger as $row){
										?>
													<option value="<?php echo $row->name;?>"><?php echo $row->name;?></option>
										<?php
												}
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Ledger</label>
								<div class="col-md-9">
									<input class="form-control form-control-inline input-sm" name="ledger" id="ledger"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Type</label>
								<div class="col-md-4">
									<select class="form-control input-sm select2me type_list" name="type" id="type">
										<option value="">- Please Select -</option>
										<option value="CR">CR</option>
										<option value="DR">DR</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Report</label>
								<div class="col-md-4">
									<select class="form-control input-sm select2me report_list" name="report" id="report">
										<option value="">- Please Select -</option>
										<option value="PL">PL</option>
										<option value="BS">BS</option>
									</select>
								</div>
							</div>
						</div>
					</div>		
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" class="btn red" onclick="save_ledger();">Save</button>
			</div>
		</div>
	</div>
</div>

<script>
	function home(){
		window.location.href = '<?PHP echo site_url("announcement/index"); ?>';
	}

	function save_ledger()
	{
		var id=$("#ledger_id").val();
		var code=$("#code").val();
		var header=$("#header").val();
		var parent=$("#parent").val();
		var ledger=$("#ledger").val();
		var type=$("#type").val();
		var report=$("#report").val();

		if(code!="" && ledger!= "" && type!="" && report!="")
		{
			$.ajax({
		        type:"POST",
		        url: "<?php echo site_url('ledger/save_ledger'); ?>",
		        data:{"id":id,"code":code,"header":header,"parent":parent,"ledger":ledger,"type":type,"report":report},
		        success: function(response){
		        	$("#ledger_detail").load(location.href + " #ledger_detail");
		        	$('#add_item').modal('hide');
		        }
		    });
		}
		else
		{
			alert('Mode, Number & Currency cannot be empty!');
		}
	}

	$(document).on("click", ".add_item_modal", function () {
		var id = $(this).data('id');
		var status_text;
		$("#ledger_id").val(id);

		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('ledger/get_ledger_detail'); ?>",
	        data:{"id":id},
	        success: function(response){
	        	response = JSON.parse(response);
	        	console.log(id);

	        	set_select2me_text('#parent',response.parent,response.parent);
	        	set_select2me_text('#header',response.header,response.header);
	        	set_select2me_text('#report',response.report,response.report);
	        	set_select2me_text('#type',response.type,response.type);
	        	$("#ledger").val(response.name);
	        	$("#code").val(response.code);
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