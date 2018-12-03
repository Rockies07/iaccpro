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
								<div class="col-md-12">
									<a data-toggle="modal" href="#add_item" data-id="0" class="btn btn-primary add_item_modal align-right">
										Add Currency
									</a>
								</div>
							</div>
						</form>
						<div class="portlet-body">
							<table class="table table-bordered table-hover" id="currency_detail">
								<thead>
									<tr>
										<th width="10px" class="text-center">S/N</th>
										<th width="50px" class="text-center">Code</th>
										<th>Currency Name</th>
										<th width="150px" class="text-center">Rate</th>
										<th width="120px" class="text-center">Action</th>
										<th width="180px" class="text-center">Update Date</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if(!empty($currency))
										{
											$i=0;
											foreach ($currency as $row){
												$i++;
									?>
												<tr>
													<td class="text-center"><?php echo $i; ?></td>
													<td class="text-center"><?php echo $row['code']; ?></td>
													<td><?php echo $row['name']; ?></td>
													<td class="text-center"><?php echo number_format($row['rate'],4); ?></td>
													<td class="text-center actions">
														<a data-toggle="modal" href="#add_item" data-id="<?php echo $row['id'];?>" class="btn default btn-xs blue add_item_modal">
															Edit
														</a>
														<?php echo anchor('currency/delete/'.$row['id'].'/index', 'Delete',array('class' => 'btn default btn-xs red','onclick'=>"return confirm('Are you sure to remove this Currency?')"));?>
													</td>
													<td class="text-center"><?php echo date('H:i d M Y',strtotime($row['updatedate'])); ?></td>
												</tr>
									<?php 
											}
										}
										else
										{
									?>
											<tr class="gradeX">
												<td colspan="6" class="text-center"> -- No Data Available -- </td>
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
				<h4 class="modal-title">Currency</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:120px" data-always-visible="1" data-rail-visible1="1">
					<div class="col-md-12">
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Code</label>
								<div class="col-md-5">
									<input type="hidden" id="currency_id" name="currency_id">
									<input class="form-control form-control-inline input-sm" size="5" maxlength="3" type="text" name="code" id="code"/>
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
								<label class="control-label col-md-3 font-sm">Rate</label>
								<div class="col-md-9">
									<input class="form-control form-control-inline input-sm" maxlength="20" type="text" name="rate" id="rate"/>
								</div>
							</div>
						</div>
					</div>		
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" class="btn red" onclick="save_currency();">Save</button>
			</div>
		</div>
	</div>
</div>

<script>
	function home(){
		window.location.href = '<?PHP echo site_url("announcement/index"); ?>';
	}

	function save_currency()
	{
		var id=$("#currency_id").val();
		var code=$("#code").val();
		var rate=$("#rate").val();
		var name=$("#name").val();
		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('currency/save_currency'); ?>",
	        data:{"id":id,"code":code,"rate":rate,"name":name},
	        success: function(response){
	        	console.log(response);
	        	$("#currency_detail").load(location.href + " #currency_detail");
	        	$('#add_item').modal('hide');
	        }
	    });
	}

	$(document).on("click", ".add_item_modal", function () {
		var id = $(this).data('id');
		var status_text;
		$("#currency_id").val(id);

		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('currency/get_currency_detail'); ?>",
	        data:{"id":id},
	        success: function(response){
	        	response = JSON.parse(response);
	        	console.log(response.type);

	        	$("#code").val(response.code);
	        	$("#name").val(response.name);
	        	$("#rate").val(response.rate);
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