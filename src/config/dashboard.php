<?php

return array(
	'Pages' => array(
		'fieldset' => 'Content',
		'icon' => 'icon-file',
		'route' => 'admin.pages.index',
		'children' => array(
			'Menus' => array(
				'icon' => 'icon-list-ul',
				'route' => 'admin.menus.index'
			)
		)
	),
	'Users' => array(
		'icon' => 'icon-user',
		'route' => 'admin.users.index',
		'fieldset' => 'Admin',
		'children' => array(
			'Groups' => array(
				'route' => 'admin.groups.index',
				'icon' => ''
			),
			'Permissions' => array(
				'route' => 'admin.permissions.index',
				'icon' => ''
			)
		)
	)
);