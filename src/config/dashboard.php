<?php

return array(
	'fieldsets' => array(
		'Content' => array(
			'Pages' => array(
				'role' => 'User',
				'icon' => 'icon-file',
				'route' => 'admin.pages.index',
				'children' => array(
					'Menus' => array(
						'icon' => 'icon-list-ul',
						'route' => 'admin.menus.index'
					)
				)
			)
		),
		'Admin' => array(
			'Users' => array(
				'role' => 'Admin',
				'icon' => 'icon-user',
				'route' => 'admin.users.index',
				'children' => array(
					'Roles' => array(
						'route' => 'admin.roles.index',
						'icon' => ''
					),
					'Permissions' => array(
						'route' => 'admin.permissions.index',
						'icon' => ''
					)
				)
			)
		)
	)
);