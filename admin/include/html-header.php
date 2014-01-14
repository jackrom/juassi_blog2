<?php if (!defined('JUASSI_ROOT')) exit; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
            <title><?php echo juassi_get_admin_title(); ?></title>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <style type="text/css" media="screen">@import url(<?php echo JUASSI_REL_ROOT; ?>juassi-resources/css/admin-layout.css)</style>


            <!-- Bootstrap framework -->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/bootstrap/css/bootstrap-responsive.min.css" />
        <!-- gebo blue theme-->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/css/blue.css" id="link_theme" />
        <!-- breadcrumbs-->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/lib/jBreadcrumbs/css/BreadCrumb.css" />
        <!-- tooltips-->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/lib/qtip2/jquery.qtip.min.css" />
        <!-- colorbox -->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/lib/colorbox/colorbox.css" />
        <!-- code prettify -->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/lib/google-code-prettify/prettify.css" />
        <!-- notifications -->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/lib/sticky/sticky.css" />
        <!-- splashy icons -->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/img/splashy/splashy.css" />
		<!-- flags -->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/img/flags/flags.css" />
		<!-- calendar -->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/lib/fullcalendar/fullcalendar_gebo.css" />
            
        <!-- 2col multiselect -->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/lib/multiselect/css/multi-select.css" />
		<!-- enhanced select -->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/lib/chosen/chosen.css" />
        <!-- upload -->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/lib/plupload/js/jquery.plupload.queue/css/plupload-gebo.css" />
            

        <!-- main styles -->
            <link rel="stylesheet" href="<?php echo JUASSI_REL_ROOT; ?>juassi-resources/css/style.css" />

            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />

        <!-- Favicon -->
            <link rel="shortcut icon" href="favicon.ico" />

        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
			<script src="lib/flot/excanvas.min.js"></script>
        <![endif]-->
        
        

</head>

<body>
<?php include 'include/style_switcher.php';?>
<div id="maincontainer" class="clearfix">
<header>
				<!-- MENU PRINCIPAL ------------------------------------------------------------------------------------------------------------------------------------------------------>

		<div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="index.php"><i class="icon-home icon-white"></i> Juassi Admin</a>
                            <ul class="nav user_menu pull-right">
                                <li class="hidden-phone hidden-tablet">
                                    <div class="nb_boxes clearfix">
                                        <a data-toggle="modal" data-backdrop="static" href="#myMail" class="label ttip_b" title="Mensajes Nuevos"><i class="splashy-mail_light"></i></a>
                                        <a data-toggle="modal" data-backdrop="static" href="#myTasks" class="label ttip_b" title="Tareas Nuevas"><?php //echo juassi_total_eventCalendar_count(); ?> <i class="splashy-calendar_week"></i></a>
                                        <a data-toggle="modal" data-backdrop="static" href="#" class="label ttip_b" title="Hora"><strong>Hora: </strong> <?php echo customerTime(); ?> </a>
                                        <a data-toggle="modal" data-backdrop="static" href="#" class="label ttip_b" title="Fecha"><strong>Fecha: </strong> <?php echo customerDate(); ?> </a>
                                    </div>
                                </li>
								<li class="divider-vertical hidden-phone hidden-tablet"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle nav_condensed" data-toggle="dropdown"><i class="flag-es"></i> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                    	<li><a href="javascript:void(0)"><i class="flag-us"></i> English</a></li>
										<li><a href="javascript:void(0)"><i class="flag-de"></i> Deutsch</a></li>
										<li><a href="javascript:void(0)"><i class="flag-fr"></i> Français</a></li>
										<li><a href="javascript:void(0)"><i class="flag-es"></i> Español</a></li>
										<li><a href="javascript:void(0)"><i class="flag-ru"></i> Pусский</a></li>
                                    </ul>
                                </li>
                                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
										<li><a href="user_profile.html">Mi Perfil</a></li>
										<li><a href="javascrip:void(0)">Otras acciones</a></li>
										<li class="divider"></li>
										<li><a href="logout.php">logout (<?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?>)</a></li>
                                    </ul>
                                </li>
                            </ul>
							<a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
								<span class="icon-align-justify icon-white"></span>
							</a>
                            <nav>
                                <div class="nav-collapse">
                                    <ul class="nav">
                                        <li>
                                            <a href="event-viewer.php"><i class="icon-list-alt icon-white"></i> Eventos </a>
                                        
                                        </li>
                                        <li>
                                            <a href="personal-settings.php"><i class="splashy-sprocket_dark icon-white"></i> Mi Configuraci&oacute;n </a>
                                        </li>
                                        <li>
                                            <a href="post.php"><i class="splashy-document_letter_blank icon-white"></i> Crear art&iacute;culo </a>
                                        </li>
                                        <li>
                                        </li>
                                        <li>
                                            <a href="documentacion.html"><i class="splashy-help icon-white"></i> Ayuda</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo juassi_get_config('address') . '/'; ?>"><i class="splashy-refresh_backwards icon-white"></i> Ir a P&aacute;gina Principal</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="peque">

                        <?php juassi_run_section('admin_home_side_bar'); ?>
						<div id="welcome">
						<p>Bienvenidos: <?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?> || <span>Usuario:</span> (<?php echo juassi_htmlentities(juassi_get_user_data('user_name')); ?>).</p>
							<?php juassi_run_section('admin_home_body'); ?>
								<br style="clear:both" />
						</div>
						<div id="informacion">
						Powered by:  <a href="http://www.juassi.com/"><span> Juassi Studios</span></a>  <?php echo juassi_htmlentities(juassi_get_config('program_version')); ?>, Tiempo de generaci&oacute;n <?php echo juassi_stop_timer(4) . ' Segundos'; ?>, Memoria usada
						<?php echo juassi_memory_usage(); ?>
						</div>

                    </div>
                </div>
                <div class="modal hide fade" id="myMail">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button>
                        <h3>Nuevos Mensajes</h3>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">In this table jquery plugin turns a table row into a clickable link.</div>
                        
                        <table class="table table-condensed table-striped" data-rowlink="a">
                            <thead>
                                <tr>
                                    <th>Enviado por</th>
                                    <th>Asunto</th>
                                    <th>Fecha</th>
                                    <th>Adjuntos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Erin Church</td>
                                    <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                                    <td>24/05/2012</td>
                                    <td>15KB</td>
                                </tr>
                                <tr>
                                    <td>Koby Auld</td>
                                    <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                                    <td>25/05/2012</td>
                                    <td>28KB</td>
                                </tr>
                                <tr>
                                    <td>Anthony Pound</td>
                                    <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                                    <td>25/05/2012</td>
                                    <td>33KB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="btn">Ir al mailbox</a>
                    </div>
                </div>
                <div class="modal hide fade" id="myTasks">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button>
                        <h3>Nuevas tareas</h3>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">In this table jquery plugin turns a table row into a clickable link.</div>
                        <table class="table table-condensed table-striped" data-rowlink="a">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Summary</th>
                                    <th>Updated</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>P-23</td>
                                    <td><a href="javascript:void(0)">Admin should not break if URL&hellip;</a></td>
                                    <td>23/05/2012</td>
                                    <td class="tac"><span class="label label-important">High</span></td>
                                    <td>Open</td>
                                </tr>
                                <tr>
                                    <td>P-18</td>
                                    <td><a href="javascript:void(0)">Displaying submenus in custom&hellip;</a></td>
                                    <td>22/05/2012</td>
                                    <td class="tac"><span class="label label-warning">Medium</span></td>
                                    <td>Reopen</td>
                                </tr>
                                <tr>
                                    <td>P-25</td>
                                    <td><a href="javascript:void(0)">Featured image on post types&hellip;</a></td>
                                    <td>22/05/2012</td>
                                    <td class="tac"><span class="label label-success">Low</span></td>
                                    <td>Updated</td>
                                </tr>
                                <tr>
                                    <td>P-10</td>
                                    <td><a href="javascript:void(0)">Multiple feed fixes and&hellip;</a></td>
                                    <td>17/05/2012</td>
                                    <td class="tac"><span class="label label-warning">Medium</span></td>
                                    <td>Open</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="btn">Go to task manager</a>
                    </div>

</div>
</header>

<div id="contentwrapper">
  <div class="main_content">
  	<div class="row-fluid">
	   <div class="span12">
	      <?php if (juassi_in_admin()) { ?>
	      <?php $juassi_ln->prepare_links(); ?>

				<ul class="dshb_icoNav tac">
					<?php $juassi_ln->display_top_links(); ?>
				</ul>
			</div>
			<?php } ?>
		</div>
<?php if ($juassi_ln->lower_links()) { ?>
    
        <div class="container-fluid">
                <nav style="height:20px;">
                        <div class="nav-collapse" style="display:inline; float:left; position:relative;">
                                <ul class="nav" style="display:inline;float:left; position:relative;">
                                        <?php $juassi_ln->display_lower_links(); ?>
                                </ul>
                        </div>
                </nav>
        </div>
<?php }



