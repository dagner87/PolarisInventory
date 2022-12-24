    <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile" style="background: url(<?= base_url() ?>plantilla/assets/images/background/fondo_menu.png) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?= base_url() ?>plantilla/assets/images/users/profile.png" alt="user" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?= $this->session->userdata('nombre');?></a>
                        <div class="dropdown-menu animated flipInY"> <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a> <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a> <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            <div class="dropdown-divider"></div> <a href="<?= base_url() ?>salir" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a> </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">  <a href="<?= base_url() ?>" >MENU</a></li>
                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">Movimientos</span></a>
                            <ul aria-expanded="false" class="collapse">
						     	<li><a href="<?= base_url() ?>ventas">Ventas</a></li>
						     	<li><a href="<?= base_url() ?>lista_ventas">Lista Ventas</a></li>
								<li><a href="<?= base_url() ?>gastos">Gastos</a></li> 
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop"></i><span class="hide-menu">Inventario</span></a>
                            <ul aria-expanded="false" class="collapse">
							 <li><a href="<?= base_url() ?>add_entrada">Entradas</a></li>
							 <li><a href="<?= base_url() ?>lista_entrada">Lista entradas</a></li>
                             <li><a href="<?= base_url() ?>stock">Stocks</a></li>     
                            </ul>
                        </li>
                      
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Configuracion</span></a>
                            <ul aria-expanded="false" class="collapse">
						    	<li><a href="<?= base_url() ?>clientes">Clientes</a></li>
                                <li><a href="<?= base_url() ?>producto"> Productos</a></li>
                                <li><a href="<?= base_url() ?>categoria">Categorias</a></li>
                                <li><a href="<?= base_url() ?>proveedor">Proveedores</a></li>	
                            </ul>
                        </li>
						<li class="nav-devider"></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse">
							  <li><a href="<?= base_url() ?>r_more_sell">Mas vendidos</a></li>
							  <li><a href="<?= base_url() ?>reportes">Ventas mensuales</a></li>
                            </ul>
                        </li>
                        
                 
                     
                        
                         
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item--><a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item--><a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item--><a href="<?= base_url() ?>salir" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> </div>
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->

		    <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
        <!-- ============================================================== -->


         <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Panel</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active"><?= $crud ?></li>
                        </ol>
                    </div>
                    
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
 
