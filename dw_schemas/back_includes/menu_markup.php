<?php 
add_action('admin_menu', 'dw_schemas_add_settings_submenu');
function dw_schemas_add_settings_submenu() {
	add_options_page('Schemas Settings Page', 'Schemas Settings', 'manage_options', 'schemas_settings', 'dw_schemas_settings_page_render');
}
/**
 * file containing markup for "Basic Structured Data" tab
 */
include __DIR__.'/basic_structured_data_options.php';
/**
 * file containing markup for 'Local Business Structured Data' tab
 */
include __DIR__.'/local_business_structured_data_options.php';
function dw_schemas_settings_page_render() {
	/**
	 * Save value of $_GET variable 'tab' to $active_tab variable for further determining what settings sections to show on page
	 */
	$active_tab = (isset( $_GET[ 'tab' ] )) ? $_GET[ 'tab' ] : 'basic'; ?>
	<div class="wrap">
		<h2 class="nav-tab-wrapper">
		    <a href="?page=schemas_settings&tab=basic" class="nav-tab <?php echo ($active_tab == 'basic') ? 'nav-tab-active' : ''; ?>">Basic Structured Data</a>
		    <a href="?page=schemas_settings&tab=local_business" class="nav-tab <?php echo ($active_tab == 'local_business') ? 'nav-tab-active' : ''; ?>">Local Business</a>
	    </h2>
		<form method='POST' action='options.php'>
			<?php 
				if($active_tab == 'basic'):
					settings_fields('schemas_settings_group');			
					do_settings_sections('schemas_settings');
				else:
					settings_fields('schemas_local_business_settings_group');
					do_settings_sections('schemas_local_business_settings');
				endif;
				submit_button(); 
			?>		
		</form>
	</div>
<?php } ?>
