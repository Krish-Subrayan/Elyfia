<?php
$sitemenu = array(
	array(
		'title' => 'Dashboard',
		'url' => 'dashboard.php',
		'class' => 'fa-dashboard',
		'access' => array(1),
		/* @uses the old ${section} variable to flag a menu as active (ex: $dashboard = 'active') */
		'active_flag' => 'dashboard'
	),
array(
		'title' => 'Admin',
		'url' => '#',
		'class' => 'fa-th',
		'access' => array(1),
		'items' => array(
			array( 'title'=>'List Admin',				'url'=>'list_admin.php',				'class'=>'' ),
			array( 'title'=>'Create Admin',		'url'=>'create_admin.php',		'class'=>'' )
		),
		'active_flag' => 'admin',
	),

array(
		'title' => 'Nurse',
		'url' => '#',
		'class' => 'fa-th',
		'access' => array(1),
		'items' => array(
			array( 'title'=>'List Nurse',				'url'=>'list_nurse.php',				'class'=>'' ),
			array( 'title'=>'Create Nurse',		'url'=>'create_nurse.php',		'class'=>'' )
		),
		'active_flag' => 'nurse',
	),

	array(
		'title' => 'Patients',
		'url' => '#',
		'class' => 'fa-th',
		'access' => array(1),
		'items' => array(
			array( 'title'=>'List Patients',				'url'=>'list_patients.php',				'class'=>'' ),
			array( 'title'=>'Create Patients',		'url'=>'create_patient.php',		'class'=>'' )
		),
		'active_flag' => 'patients',
	),
	array(
		'title' => 'Devices',
		'url' => '#',
		'class' => 'fa-th',
		'access' => array(1),
		'items' => array(
			array( 'title'=>'List Devices',				'url'=>'list_devices.php',				'class'=>'' )
		),
		'active_flag' => 'devices',
	),
	array(
		'title' => 'Activites',
		'url' => '#',
		'class' => 'fa-files-o',
		'access' => array(1),
		'items' => array(
			array( 'title'=>'Calories',		'url'=>'calories_data.php',	'class'=>'' ),
			array( 'title'=>'Steps',		'url'=>'steps_data.php',	'class'=>'' ),
			array( 'title'=>'Sleeping',		'url'=>'sleeping_data.php',	'class'=>'' )
		),
		'active_flag' => 'activities',
	)
);
