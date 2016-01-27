<?php
/*
 *	Master template file
 *
 *	Contains variables for content input
 *	-	$title				-	string	-	Page title, for <title> and og:title (if not default)
 *	-	$css_files			-	array	-	list of additional CSS files
 *	-	$js_header_files	-	array	-	list of additional JS files
 *	-	$js_footer_files	-	array	-	list of additional JS files
 *	-	$body_content		-	boolean -	false if body tag should be empty of HTML tags, except
 *											footer JS and Google Analytics
 */
?>

<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" class="no-js">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php
		if (isset($title))
		{
			$final_title = $title;
		}
		else
		{
			$final_title = Lang::get('core.app_title');
		}
		?>
		<title>{{ $final_title }}</title>

 		<meta property="og:title" content="">
		<meta property="og:site_name" content="">

		<meta property="og:description" content="">
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?php echo url(); ?>/{{ Request::path() }}">
		<meta property="og:image" content="">


		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="Culex d.o.o., info@culex.hr">
		<meta name="Publisher" content="">

		<link rel="icon" href="{{ URL::asset('favicon.png') }}">
		<!--[if IE]><link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}"><![endif]-->

		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="{{ URL::asset('favicon.png') }}">

		<link rel="apple-touch-icon-precomposed" href="{{ URL::asset('favicon.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::asset('favicon.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::asset('favicon.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::asset('favicon.png') }}">
 
		{{-- Load the Modernizr before everything, for feature detection --}}
		{{ HTML::script('js/core/modernizr.js') }}
   		<!-- jQuery 2.1.4 -->
		{{ HTML::script('js/core/jquery.min.js') }}
  		<!-- jQuery UI 1.11.4 -->
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	    <script>
	      $.widget.bridge('uibutton', $.ui.button);
	    </script>
   		<!-- Bootstrap 3.3.5 -->
		{{ HTML::style('css/core/bootstrap.min.css') }}
    	<!-- Font Awesome -->
   		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    	<!-- Ionicons -->
    	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

   		<!-- AdminLTE skin -->
   		{{ HTML::style('css/core/AdminLTE.min.css') }}
   		<!-- Skin for AdminLTE -->
   		
   		<!-- Animate CSS -->
    	{{ HTML::style('css/core/animate.css') }}
    	{{ HTML::style('css/core/skin-yellow.min.css') }}
    	{{ HTML::style('css/core/custom.css') }}
		{{-- Loop that implements additional CSS for a module and/or view --}}
		@if (isset($css_files) && is_array($css_files))
			@foreach  ($css_files as $css_file)
		{{ HTML::style($css_file) }}
			@endforeach
		@endif

		{{ HTML::script('js/core/jquery.noty.packaged.min.js') }}
		{{ HTML::script('js/core/noty.app.theme.js') }}


		{{-- Loads default path to a JS variable (no trailing slash) --}}
		<script>
		var rootPath = "{{{ url('/') }}}";
		</script>

  
		{{-- Loop that implements additional header JS for a module and/or view --}}
		@if (isset($js_header_files) && is_array($js_header_files))
			@foreach ($js_header_files as $js_file)
		{{ HTML::script($js_file) }}
			@endforeach
		@endif


	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->

	</head>
	<body class="hold-transition skin-yellow sidebar-mini">

		<div class="wrapper">
<header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="{{ URL::asset('img/core/seatow-logo.png') }}" /></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="{{ URL::asset('img/core/seatow-logo.png') }}" /></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
             
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>

	      <!-- Main Header -->
  <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ URL::asset('img/core/maca.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
            </div>
          </div>


          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
           
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ URL::route('getDashboard') }}"><i class="fa fa-2x fa-home"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-2x fa-user"></i> <span>Clients</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::route('ClientGetAddEntry') }}">Add Client</a></li>
                <li><a href="{{ URL::route('clientLanding') }}">List Clients</a></li>
               
              </ul>
            </li>
             <li class="treeview">
              <a href="#"><i class="fa fa-2x fa-ship"></i> <span>Boats</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::route('BoatsGetAddEntry') }}">Add Boat</a></li>
               
                <li><a href="{{ URL::route('boatsLanding') }}">List Boats</a></li>

                 <li><a href="{{ URL::route('BoatsGetAddHull') }}">Add Hull</a></li>
                <li><a href="{{ URL::route('BoatsGetAddMake') }}">Add Make</a></li>
              </ul>
            </li>
           <li class="treeview">
              <a href="#"><i class="fa fa-2x fa-database"></i> <span>Membership</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::route('MembershipGetAddEntry') }}">Add Membership</a></li>
                <li><a href="{{ URL::route('membershipLanding') }}">List Membersihps</a></li>
              </ul>
            </li>
             <li class="treeview">
              <a href="#"><i class="fa fa-2x fa-credit-card"></i> <span>Billing</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::route('InvoiceGetAddEntry') }}">Add Invoice</a></li>
                <li><a href="{{ URL::route('invoiceLanding') }}">List Invoices</a></li>
              </ul>
            </li>
           </li>
             <li class="treeview">
              <a href="#"><i class="fa fa-2x fa-group"></i> <span>Employee</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::route('EmployeeGetAddEntry') }}">Add Employee</a></li>
                <li><a href="{{ URL::route('employeeLanding') }}">List Employees</a></li>
              </ul>
            </li>
              <li class="treeview">
              <a href="#"><i class="fa fa-2x fa-map"></i> <span>Franchisee</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::route('FranchiseeGetAddEntry') }}">Add Franchisee</a></li>
                <li><a href="{{ URL::route('franchiseeLanding') }}">List Franchisee</a></li>
              </ul>
            </li>
            <li><a href="{{ URL::route('messagesLanding') }}"><i class="fa fa-2x fa-comment"></i> <span>Messages</span></a></li>
            <li><a href="{{ URL::route('getProfile') }}"><i class="fa fa-2x fa-asterisk"></i> <span>My profile</span></a></li>
             <li><a href="{{ URL::route('getOptions') }}"><i class="fa fa-2x fa-cog"></i> <span>Options</span></a></li>
              <li><a href="{{ URL::route('getSignOut') }}"><i class="fa fa-2x fa-sign-out"></i> <span>Logout</span></a></li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>



	      <!-- Content Wrapper. Contains page content -->
	      <div class="content-wrapper">
  
	        <!-- Main content -->
	        <section class="content-header">

	          <!-- Your Page Content Here -->
			
				{{ $content or null }}
		
 			<!-- End page content  -->

	        </section><!-- /.content -->
	      </div><!-- /.content-wrapper -->

	      <!-- Main Footer -->
	      <footer class="main-footer">
	        <!-- To the right -->
	        <div class="pull-right hidden-xs">
	       
	        </div>
	        <!-- Default to the left -->
	        <strong>Copyright &copy; 2015 <a href="http://seatow-europe.com/" target="_blank">Sea Tow Europe Operations Ltd.</a></strong> All rights reserved.
	      </footer>



	      <!-- Control Sidebar -->
	      <aside class="control-sidebar control-sidebar-dark">
	        <!-- Create the tabs -->
	        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
	          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
	          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
	        </ul>
	        <!-- Tab panes -->
	        <div class="tab-content">
	          <!-- Home tab content -->
	          <div class="tab-pane active" id="control-sidebar-home-tab">
	            <h3 class="control-sidebar-heading">Recent Activity</h3>
	            <ul class="control-sidebar-menu">
	              <li>
	                <a href="javascript::;">
	                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
	                  <div class="menu-info">
	                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
	                    <p>Will be 23 on April 24th</p>
	                  </div>
	                </a>
	              </li>
	            </ul><!-- /.control-sidebar-menu -->

	            <h3 class="control-sidebar-heading">Tasks Progress</h3>
	            <ul class="control-sidebar-menu">
	              <li>
	                <a href="javascript::;">
	                  <h4 class="control-sidebar-subheading">
	                    Custom Template Design
	                    <span class="label label-danger pull-right">70%</span>
	                  </h4>
	                  <div class="progress progress-xxs">
	                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
	                  </div>
	                </a>
	              </li>
	            </ul><!-- /.control-sidebar-menu -->

	          </div><!-- /.tab-pane -->
	          <!-- Stats tab content -->
	          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
	          <!-- Settings tab content -->
	          <div class="tab-pane" id="control-sidebar-settings-tab">
	            <form method="post">
	              <h3 class="control-sidebar-heading">General Settings</h3>
	              <div class="form-group">
	                <label class="control-sidebar-subheading">
	                  Report panel usage
	                  <input type="checkbox" class="pull-right" checked>
	                </label>
	                <p>
	                  Some information about this general settings option
	                </p>
	              </div><!-- /.form-group -->
	            </form>
	          </div><!-- /.tab-pane -->
	        </div>
	      </aside><!-- /.control-sidebar -->
	      <!-- Add the sidebar's background. This div must be placed
	           immediately after the control sidebar -->
	      <div class="control-sidebar-bg"></div>
	    </div><!-- ./wrapper -->



			@if (Session::has('message'))
			<script>
			var n = noty({
				text: '{{{ Session::get('message') }}}',
				type: 'alert', // Alert, Success, Error, Warning, Information, Confirm
				theme: 'app', // or 'defaultTheme'
				layout: 'bottomRight', // top - topLeft - topCenter - topRight - center - centerLeft - centerRight - bottom - bottomLeft - bottomCenter - bottomRight
				animation: {
					open: 'animated bounceInUp',
					close: 'animated bounceOutDown',
				}
			});
			</script>
			@endif

			@if (Session::has('error_message'))
			<script>
			var n = noty({
				text: '{{{ Session::get('error_message') }}}',
				type: 'error',
				theme: 'app',
				layout: 'bottomRight',
				animation: {
					open: 'animated bounceInUp',
					close: 'animated bounceOutDown',
				}
			});
			</script>
			@endif

			@if (Session::has('info_message'))
			<script>
			var n = noty({
				text: '{{{ Session::get('info_message') }}}',
				type: 'information',
				theme: 'app',
				layout: 'bottomRight',
				animation: {
					open: 'animated bounceInUp',
					close: 'animated bounceOutDown',
				}
			});
			</script>
			@endif

			@if (Session::has('warning_message'))
			<script>
			var n = noty({
				text: '{{{ Session::get('warning_message') }}}',
				type: 'warning',
				theme: 'app',
				layout: 'bottomRight',
				animation: {
					open: 'animated bounceInUp',
					close: 'animated bounceOutDown',
				}
			});
			</script>
			@endif

			@if (Session::has('success_message'))
			<script>
			var n = noty({
				text: '{{{ Session::get('success_message') }}}',
				type: 'success',
				theme: 'app',
				layout: 'bottomRight',
				animation: {
					open: 'animated bounceInUp',
					close: 'animated bounceOutDown',
				}
			});
			</script>
			@endif

 

	
			{{-- Loop that implements additional footer JS for a module or specific view --}}
			@if (isset($js_footer_files) && is_array($js_footer_files))
				@foreach ($js_footer_files as $js_file)
				{{ HTML::script($js_file) }}
				@endforeach
			@endif

    		<!-- REQUIRED JS SCRIPTS -->


   			<!-- Bootstrap 3.3.5 -->
			{{ HTML::script('js/core/bootstrap.min.js') }}
			<!-- Slimscroll -->
		    {{ HTML::script('js/core/jquery.slimscroll.min.js') }}
		    <!-- FastClick -->
		   	{{ HTML::script('js/core/fastclick.min.js') }}
			<!-- AdminLTE App --> 
			{{ HTML::script('js/core/app.min.js') }}

	</body>
</html>