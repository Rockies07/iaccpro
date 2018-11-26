</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE CONTENT -->
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
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
				<div class="col-md-12" style="text-align:right; padding-bottom: 10px">
					<?php echo anchor('announcement/management', 'Add Announcement',array('class' => 'btn btn-primary add_item_modal align-right', 'target' => '_blank'));?>
				</div>
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<div class="portlet-body">
							<table class="table table-bordered table-hover">
							<thead>
							<tr>
								<th width="10px" class="text-center">S/N</th>
								<th width="200px">Title</th>
								<th>Description</th>
								<th width="60px" class="text-center">Categories</th>
								<th width="150px" class="text-center">Action</th>
							</tr>
							</thead>
							<tbody>
								<?php 
									if(!empty($announcement))
									{
										$i=0;
										foreach ($announcement as $row){
											$i++;

											switch($row['category'])
											{
												case 0: $str_category="Public"; break;
												case 1: $str_category="Sub Admin"; break;
												case 2: $str_category="Administrator"; break;
												default: $str_category="Public"; break;
											}
								?>
											<tr>
												<td class="text-center"><?php echo $i; ?></td>
												<td><?php echo $row['title']; ?></td>
												<td><?php echo nl2br($row['description']); ?></td>
												<td><?php echo $str_category; ?></td>
												<td class="text-center actions">
													<?php echo anchor('announcement/management/'.$row['id'], '<i class="fa fa-edit"></i>Edit',array('class' => 'btn default btn-xs blue'));?>
													<?php echo anchor('announcement/delete/'.$row['id'].'/index', '<i class="fa fa-trash"></i>Delete',array('class' => 'btn default btn-xs red','onclick'=>"return confirm('Are you sure to remove this announcement data?')"));?>
												</td>
											</tr>
								<?php 
										}
									}
									else
									{
								?>
										<tr class="gradeX">
											<td colspan="5"> -- No Data Available -- </td>
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

<script>
	function home(){
		window.location.href = '<?PHP echo site_url("announcement/index"); ?>';
	}
</script>

<script src="<?php echo base_url();?>public/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>public/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>	