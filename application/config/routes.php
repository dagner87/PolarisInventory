<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = true;

/*
| -------------------------------------------------------------------------
| DEFINICION DE RUTAS
| -------------------------------------------------------------------------*/

$route['logusuario']        = "login/verificar";
$route['salir']             = 'login/salir';

/*----------------PANEL GENERAL --------------------*/
$route['load_emp_a']   = 'panel_admin/load_emp_a';
$route['load_emp_obj'] = 'panel_admin/load_emp_obj';
$route['asoc_obj']     = 'panel_admin/asoc_obj';
$route['get_obj_emp']  = 'panel_admin/get_obj_emp';


/*---------------CRUD PRODUCTOS----------------------*/
$route['productos']      = 'producto/get_empleados';
$route['list_productos'] = 'producto/load_productos';
$route['insert_prod']    = 'producto/insert';
$route['update_prod']    = 'producto/update';
$route['delete_prod']    = 'producto/delete';
$route['get_prod']       = 'producto/getdatos';

/*--------------------CRUD PROVEEDORES --------------*/
$route['proveedor']         = 'proveedor/get_proveedores';
$route['load_proveedores']  = 'proveedor/load_proveedores';
$route['insert_prov']       = 'proveedor/insert';
$route['update_prov']       = 'proveedor/update';
$route['delete_prov']       = 'proveedor/delete';
$route['get_prov']          = 'proveedor/getDatos';

/*--------------------CRUD CLIENTES --------------*/
$route['clientes']         = 'cliente/getAll';
$route['load_cliente']     = 'cliente/load_cliente';
$route['insert_cliente']   = 'cliente/insert';
$route['update_cliente']   = 'cliente/update';
$route['delete_cliente']   = 'cliente/delete';
$route['get_cliente']      = 'cliente/getDatos';
$route['buscar_clientes']   = 'cliente/search_clientes';

/*--------------------CRUD CATEGORIAS --------------*/
$route['categoria']        = 'categoria/getAll';
$route['load_categorias']  = 'categoria/load_categorias';
$route['insert_categ']     = 'categoria/insert';
$route['update_categ']     = 'categoria/update';
$route['delete_categ']     = 'categoria/delete';
$route['get_categ']        = 'categoria/getdatos';

/*--------------------CRUD GASTOS --------------*/
$route['gastos']           = 'gasto/getAll';
$route['load_gast']       = 'gasto/load';
$route['insert_gast']     = 'gasto/insert';
$route['update_gast']     = 'gasto/update';
$route['delete_gast']     = 'gasto/delete';
$route['get_gast']        = 'gasto/getdatos';


/*--------------------CRUD Entradas --------------*/

$route['add_entrada']    = 'entradas/add';
$route['adj_entrada']    = 'entradas/adjunto_entrada';
$route['lista_entrada']  = 'entradas/getEntradas';
$route['get_entradas']   = 'entradas/load_entradas';

$route['insert_entrada'] = 'entradas/insert';
$route['delete_entrada'] = 'entradas/delete';


/*--------------------Stocks --------------*/

$route['stock']        = 'entradas/stock';
$route['lista_stocks'] = 'entradas/getStocks';

/*--------------------Ventas --------------*/

$route['insert_venta']  = 'ventas/insert';
$route['ventas']        = 'ventas/addVenta';
$route['lista_ventas']  = 'ventas/getventas';
$route['get_ventas']    = 'ventas/load_ventas';
$route['anular_venta']  = 'ventas/update';




/*------------------**** RUTAS DEPRECATE ***** --------------*/

/*--------------------CRUD cargos --------------*/
$route['cargos']         = 'cargo/get_cargos';
$route['load_carg']      = 'cargo/load_carg';
$route['get_carg']       = 'cargo/getdatos_carg';
$route['insert_carg']    = 'cargo/insert_carg';
$route['update_carg']    = 'cargo/update_carg';
$route['delete_carg']    = 'cargo/delete_carg';

$route['asoc_comp']      = 'cargo/asoc_comp';

/*--------------------CRUD competencias --------------*/
$route['competencias']    = 'competencia/get_comp';
$route['load_comp']       = 'competencia/load_comp';
$route['load_compAsoc']   = 'competencia/load_compAsoc';
$route['get_comp']        = 'competencia/getdatos_comp';
$route['insert_comp']     = 'competencia/insert_comp';
$route['update_comp']     = 'competencia/update_comp';
$route['delete_comp']     = 'competencia/delete_comp';
$route['comp_asoc']       = 'competencia/comp_asoc';




/*--------------------CRUD FUNCIONES--------------*/
$route['funciones']       = 'funcion/get_funciones';
$route['load_funciones']  = 'funcion/load_fun';
$route['get_fun']         = 'funcion/getdatos_fun';
$route['insert_fun']      = 'funcion/insert_fun';
$route['update_fun']      = 'funcion/update_fun';
$route['delete_fun']      = 'funcion/delete_fun';


/*---------------CRUD OBJETIVOS----------------------*/

$route['objetivos']   = 'objetivo/get_objetivos';
$route['load_obj']    = 'objetivo/load_obj';
$route['insert_obj']  = 'objetivo/insert_obj';


