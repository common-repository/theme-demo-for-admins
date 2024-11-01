<?php

	/*
	Plugin Name: Theme Demo for Admins
	Description: Display a different theme to the user if the user is logged in as an admin.
	Plugin URI: http://revivemediaservices.com
	Version: 1.0
	Author: Revive Media Services
	Author URI: http://revivemediaservices.com

	Copyright 2013  REVIVE MEDIA SERVICES  (email : Brandon@Revivemediaservices.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/

	add_filter('template', 'change_theme');
	add_filter('option_template', 'change_theme');
	add_filter('option_stylesheet', 'change_theme');

	add_action('admin_menu', 'plugin_settings');

	function change_theme($theme) {
		if ( current_user_can('manage_options') ) {
			$theme = get_option('theme_to_demo');
		}
		return $theme;
	}

	function plugin_settings() {
		add_menu_page('Theme Demo for Admins by Revive Media Services', 'Theme Demo', 'administrator', 'settings', 'display_settings');
	}

	function display_settings() {
		$themes = wp_get_themes();
	    $html = '
				<div class="wrap">
					<form action="options.php" method="post" name="options">
						<div style="background-color:#000;padding:10px;color:#fff;">
							<h1>Theme Demo for Admins by <a href="http://revivemediaservices.com" title="web design" style="color:#00ff2f;text-decoration:none;">Revive Media Services</a></h1>
						</div>
						
						<div
							style="
								border:1px solid #bebebe;
								padding:5px;
								border-top:0px;
								background: #fdfdfd; /* Old browsers */
								background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ZkZmRmZCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNlOGU4ZTgiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
								background: -moz-linear-gradient(top,  #fdfdfd 0%, #e8e8e8 100%); /* FF3.6+ */
								background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fdfdfd), color-stop(100%,#e8e8e8)); /* Chrome,Safari4+ */
								background: -webkit-linear-gradient(top,  #fdfdfd 0%,#e8e8e8 100%); /* Chrome10+,Safari5.1+ */
								background: -o-linear-gradient(top,  #fdfdfd 0%,#e8e8e8 100%); /* Opera 11.10+ */
								background: -ms-linear-gradient(top,  #fdfdfd 0%,#e8e8e8 100%); /* IE10+ */
								background: linear-gradient(to bottom,  #fdfdfd 0%,#e8e8e8 100%); /* W3C */
								filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#fdfdfd\', endColorstr=\'#e8e8e8\',GradientType=0 ); /* IE6-8 */
							">
							<p>The theme you select below will be visible only when <strong>administrators</strong> are logged in to your Wordpress site.</p>
							<p>The selection below will <strong><u>not</u></strong> affect your default theme choice for "normal" users.</p>
						</div>

						<h2 style="padding-left:20px;">Select Your Settings</h2>
						' . wp_nonce_field('update-options') . '
						<div style="padding-left:60px;">
							<table class="form-table" width="100%" cellpadding="10">
				 				<tbody>
									<tr>
										<td scope="row" align="left">';
											$html .= '
											<label>Theme to Demo</label>
											<select name="theme_to_demo">';
												foreach($themes as $key => $value){
													$html .= '<option value="'.$key.'">'.$value.'</option>';
												}
		$html .= '
											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div style="padding-left:20px;padding-top:20px;">
	 						<input type="hidden" name="action" value="update" />
	 						<input type="hidden" name="page_options" value="theme_to_demo" />
	 						<input type="submit" name="Submit" value="Update" />
	 					</div>
	 				</form>
	 			</div>
		';

	    echo $html;

	}



?>