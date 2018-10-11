<div class="page-header-menu">
		<div class="container-fluid">
			<!-- BEGIN HEADER SEARCH BOX -->
			<form class="search-form" action="extra_search.html" method="GET">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="query">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
				</div>
			</form>
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN MEGA MENU -->
			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
			<div class="hor-menu ">
				<ul class="nav navbar-nav">
					<li class="menu-dropdown mega-menu-dropdown ">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Announcement (D)<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu" style="min-width: 220px">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<div class="col-md-12">
											<ul class="mega-menu-submenu">
												<li>
													<?php echo anchor('announcement/index/2', '<i class="fa fa-angle-right"></i>Administrator');?>
												</li>
												<li>
													<?php echo anchor('announcement/index/1', '<i class="fa fa-angle-right"></i>Sub Admin');?>
												</li>
												<li>
													<?php echo anchor('announcement/index/0', '<i class="fa fa-angle-right"></i>Public');?>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li class="menu-dropdown mega-menu-dropdown ">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Placeout <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu" style="min-width: 220px">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<div class="col-md-12">
											<ul class="mega-menu-submenu">
												<li>
													<?php echo anchor('placeout/index', '<i class="fa fa-angle-right"></i>Simple Entries (D)');?>
												</li>
												<li>
													<?php echo anchor('report/win_loss', '<i class="fa fa-angle-right"></i>Win/Loss Report (P)');?>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li class="menu-dropdown mega-menu-dropdown ">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Report <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu" style="min-width: 400px">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<div class="col-md-6">
											<ul class="mega-menu-submenu">
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Payment Entries </a>
												</li>
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Payment Report </a>
												</li>
											</ul>
										</div>
										<div class="col-md-6">
											<ul class="mega-menu-submenu">
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Due Balance </a>
												</li>
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Shareholder Report </a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li class="menu-dropdown mega-menu-dropdown ">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Management <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu" style="min-width: 400px">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<div class="col-md-6">
											<ul class="mega-menu-submenu">
												<li>
													<?php echo anchor('member/index', '<i class="fa fa-angle-right"></i>Member (D)');?>
												</li>
												<li>
													<?php echo anchor('agent/index', '<i class="fa fa-angle-right"></i>Agent (D)');?>
												</li>
												<li>
													<?php echo anchor('shareholder/index', '<i class="fa fa-angle-right"></i>Shareholder (D)');?>
												</li>
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Sub Admin </a>
												</li>
											</ul>
										</div>
										<div class="col-md-6">
											<ul class="mega-menu-submenu">
												<li>
													<?php echo anchor('url/index', '<i class="fa fa-angle-right"></i>URL List (D)');?>
												</li>
												<li>
													<?php echo anchor('currency/index', '<i class="fa fa-angle-right"></i>Currency List (D)');?>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li class="menu-dropdown mega-menu-dropdown ">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Transaction <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu" style="min-width: 400px">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<div class="col-md-6">
											<ul class="mega-menu-submenu">
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Sales </a>
												</li>
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Purchase Order </a>
												</li>
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Invoice List </a>
												</li>
											</ul>
										</div>
										<div class="col-md-6">
											<ul class="mega-menu-submenu">
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Product List </a>
												</li>
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Vendor List </a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li class="menu-dropdown mega-menu-dropdown ">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Journal <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu" style="min-width: 400px">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<div class="col-md-6">
											<ul class="mega-menu-submenu">
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Credit </a>
												</li>
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Debit </a>
												</li>
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Fund Transfer </a>
												</li>
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Statement </a>
												</li>
											</ul>
										</div>
										<div class="col-md-6">
											<ul class="mega-menu-submenu">
												<li>
													<?php echo anchor('ledger/index', '<i class="fa fa-angle-right"></i>General Ledger (D)');?>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li class="menu-dropdown mega-menu-dropdown ">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Account <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu" style="min-width: 220px">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<div class="col-md-12">
											<ul class="mega-menu-submenu">
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Status </a>
												</li>
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Cash Flow Statement </a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li class="menu-dropdown mega-menu-dropdown ">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
						Administration <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu" style="min-width: 400px">
							<li>
								<div class="mega-menu-content">
									<div class="row">
										<div class="col-md-6">
											<ul class="mega-menu-submenu">
												<li>
													<?php echo anchor('project/index', '<i class="fa fa-angle-right"></i>Project List (D)');?>
												</li>
												<li>
													<?php echo anchor('account/index', '<i class="fa fa-angle-right"></i>Account List (D)');?>
												</li>
											</ul>
										</div>
										<div class="col-md-6">
											<ul class="mega-menu-submenu">
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													Project Overview </a>
												</li>
												<li>
													<a href="ui_general.html">
													<i class="fa fa-angle-right"></i>
													View Log </a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<!-- END MEGA MENU -->
		</div>
	</div>