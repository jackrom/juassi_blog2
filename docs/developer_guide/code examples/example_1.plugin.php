<?php
/*
	Juassi 2.0 Plugin Example 1
	Juan Carlos Reyes C Copyright 2013
*/

//stops people from directly trying to run the plugin. Please add this at the top of any plugin you write, thanks. :)
if (!defined('JUASSI_ROOT')) exit;


/*
This is an example of how to hook into the common_loaded section/task
*/
juassi_add_task('example_1', 'common_loaded', 'example_1_function'); 

function example_1_function() {

	echo 'Hello World';
	
}

?>