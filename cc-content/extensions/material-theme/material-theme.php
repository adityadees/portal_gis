<?php 
app()->load->library('cc_app');
app()->load->library('cc_html');



$base_url_extension = url_extension(basename(__DIR__)); 

/*register script file*/
app()->cc_html->registerCssFile( $base_url_extension.'/adminlte-material/dist//css/bootstrap-material-design.min.css');
app()->cc_html->registerCssFile( $base_url_extension.'/adminlte-material/dist//css/ripples.min.css');
app()->cc_html->registerCssFile( $base_url_extension.'/adminlte-material/dist//css/MaterialAdminLTE.min.css');
app()->cc_html->registerCssFile( $base_url_extension.'/adminlte-material/dist//css/skins/all-md-skins.min.css');
app()->cc_html->registerCssFile( $base_url_extension.'/adminlte-material//custom.css');

app()->cc_html->registerScriptFileBottom( $base_url_extension.'/adminlte-material/dist//js/material.min.js');
app()->cc_html->registerScriptFileBottom( $base_url_extension.'/adminlte-material/dist//js/ripples.min.js');
app()->cc_html->registerScriptFileBottom( $base_url_extension.'/adminlte-material/custom.js');
