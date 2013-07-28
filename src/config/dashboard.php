<?php

return array(
	'fieldsets' => array(
		'Content' => array(
			'Pages' => array(
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
				'icon' => 'icon-user',
				'route' => 'admin.users.index',
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
		)
	)
);