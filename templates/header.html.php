<!DOCTYPE html>

<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		
		<title>Coupons Code</title>
		<link rel="shortcut png" type="image/png" href="<?php echo Request::$BASE_PATH.'images/logo.png';?>">
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo Request::$BASE_PATH; ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo Request::$BASE_PATH; ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		
		<?php switch($parameters[0]){ 
			case 'contact': ?>

				<?php
			case 'reminders':
					?>

					<?php
					break;
			 } ?>

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo Request::$BASE_PATH; ?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo Request::$BASE_PATH; ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo Request::$BASE_PATH; ?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo Request::$BASE_PATH; ?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo Request::$BASE_PATH; ?>assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo Request::$BASE_PATH; ?>assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/html5shiv.min.js"></script>
		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/respond.min.js"></script>
		
		<![endif]-->
		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/jquery-2.1.4.min.js"></script>
	</head>

	<body class="no-skin">

        <div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="<?php echo Request::$BASE_PATH; ?>" class="navbar-brand">
						<small>
							<i class="fa fa-home"></i>
							Coupons Code
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="<?php echo Request::$BASE_PATH; ?>#" class="dropdown-toggle">
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo Session::GetUser()->user_name; ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li class="divider"></li>

								<li>
									<a href="<?php echo Request::$BASE_PATH.'logout'; ?>">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>
        <?php if(isset($add_message)&& $add_message!=''){?>
        <div class="alert alert-success" role="alert" STYLE="position: absolute;z-index: 999;left:30%; top: 8%" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong></strong><?php echo $add_message ;?>
        </div>
        <?php }?>
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>
						
						
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li  class="<?php if($parameters[0]=='categories'){ echo 'active'; } ?>">
						<a href="<?php echo Request::$BASE_PATH.'categories'; ?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Categories </span>
						</a>

						<b class="arrow"></b>
					</li>

                    <li  class="<?php if($parameters[0]=='networks'){ echo 'active'; } ?>">
                        <a href="<?php echo Request::$BASE_PATH.'networks'; ?>">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text"> Networks </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li  class="<?php if($parameters[0]=='stores'){ echo 'active'; } ?>">
                        <a href="<?php echo Request::$BASE_PATH.'stores'; ?>">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text"> Stores </span>
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li  class="<?php if($parameters[0]=='codes'){ echo 'active'; } ?>">
                        <a href="<?php echo Request::$BASE_PATH.'codes'; ?>">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text"> Coupons </span>
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li  class="<?php if($parameters[0]=='global_settings'){ echo 'active'; } ?>">
                        <a href="<?php echo Request::$BASE_PATH.'global_settings'; ?>">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text"> Global Setting </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li  class="<?php if($parameters[0]=='sections'){ echo 'active'; } ?>">
                        <a href="<?php echo Request::$BASE_PATH.'sections'; ?>">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text"> Sections </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li  class="<?php if($parameters[0]=='roles'){ echo 'active'; } ?>">
                        <a href="<?php echo Request::$BASE_PATH.'roles'; ?>">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text"> Roles </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li  class="<?php if($parameters[0]=='permissions'){ echo 'active'; } ?>">
                        <a href="<?php echo Request::$BASE_PATH.'permissions'; ?>">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text"> Permissions </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li  class="<?php if($parameters[0]=='users'){ echo 'active'; } ?>">
                        <a href="<?php echo Request::$BASE_PATH.'users'; ?>">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text"> Users </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    
                </ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>


