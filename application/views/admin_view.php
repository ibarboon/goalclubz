<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo $title; ?></title>
		<!-- Bootstrap Core CSS -->
		<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
		<!-- jQuery-UI CSS -->
		<link href="<?php echo base_url('assets/jquery-ui/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('assets/jquery-ui/jquery-ui.theme.min.css'); ?>" rel="stylesheet" type="text/css">
		<!-- Custom CSS -->
		<link href="<?php echo base_url('assets/css/sb-admin.css'); ?>" rel="stylesheet" type="text/css">
		<!-- Custom Fonts -->
		<link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
		<style type="text/css">
			#page-wrapper { min-height: 600px; }
			#page-wrapper .breadcrumb { margin-top: 20px; }
			.table-matches .match-time { width: 10%  }
			.table-matches .home,
			.table-matches .away { 
				width: 25%;
			}
			.table-matches .ft { width: 10%; }
			.table-matches .remarks { width: 30%; }
			.table-matches .home { text-align: right; }
			.table-matches .match-time, .table-matches .ft { text-align: center; }
		</style>
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div id="wrapper">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo site_url('admin'); ?>"><?php echo $title; ?></a>
				</div>
				<ul class="nav navbar-right top-nav">
					<li>
						<a href="javascript: void(0);"><i class="fa fa-fw fa-user"></i> <?php echo $user_signin; ?></a>
					</li>
					<li>
						<a href="<?php echo site_url('admin/signout'); ?>"><i class="fa fa-fw fa-power-off"></i> Sign Out</a>
					</li>
				</ul>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav side-nav">
						<?php
							foreach ($side_nav_list as $side_nav) :
							echo ($side_nav['a_href'] === $current_page)? '<li class="active">': '<li>';
						?>
							<a href="<?php echo site_url('admin/'.$side_nav['a_href']); ?>"><i class="fa fa-fw <?php echo $side_nav['i_class']; ?>"></i> <?php echo $side_nav['display_value']; ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</nav>
			<div id="page-wrapper">
				<div class="container-fluid">
					<?php $this->load->view($view); ?>
				</div><!-- end .container-fluid -->
			</div><!-- end #page-wrapper -->
		</div><!-- end #wrapper -->
		<!-- jQuery -->
		<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
		<!-- jQuery-UI -->
		<script src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js'); ?>"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
	</body>
</html>