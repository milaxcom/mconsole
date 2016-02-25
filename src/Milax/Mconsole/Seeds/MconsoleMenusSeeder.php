<?php

namespace Milax\Mconsole\Seeds;

use DB;

class MconsoleMenusSeeder
{
	
	/**
	 * Table name for options
	 * 
	 * (default value: 'mconsole_options')
	 * 
	 * @var string
	 * @access protected
	 */
	protected static $table = 'mconsole_menus';
	
	/**
	 * Default options with values to create
	 * 
	 * @var array
	 * @access protected
	 */
	 protected static $menus = [
         [
             'name' => 'Pages',
             'key' => 'pages',
             'translation' => 'menu.pages.name',
             'visible' => true,
             'enabled' => true,
             'child' => [
                 [
                     'name' => 'All pages',
                     'key' => 'pages_all',
                     'translation' => 'menu.pages.list.name',
                     'url' => 'pages',
                     'description' => 'menu.pages.list.description',
                     'route' => 'mconsole.pages.index',
                     'visible' => true,
                     'enabled' => true,
                 ],
                 [
                     'name' => 'Create page',
                     'key' => 'pages_form',
                     'translation' => 'menu.pages.form.name',
                     'url' => 'pages/create',
                     'description' => 'menu.pages.form.description',
                     'route' => 'mconsole.pages.store',
                     'visible' => true,
                     'enabled' => true,
                 ],
                 [
                     'name' => 'Edit pages',
                     'key' => 'pages_update',
                     'translation' => 'menu.pages.update.name',
                     'description' => 'menu.pages.update.description',
                     'route' => 'mconsole.pages.edit',
                     'visible' => false,
                     'enabled' => true,
                 ],
                 [
                     'name' => 'Delete pages',
                     'key' => 'pages_delete',
                     'translation' => 'menu.pages.delete.name',
                     'description' => 'menu.pages.delete.description',
                     'route' => 'mconsole.pages.destroy',
                     'visible' => false,
                     'enabled' => true,
                 ],
             ],
         ],
         [
             'name' => 'Users',
             'key' => 'users',
             'translation' => 'menu.users.name',
             'visible' => true,
             'enabled' => true,
             'child' => [
				 [
				 	'name' => 'All users',
				 	'key' => 'users_all',
				 	'translation' => 'menu.users.list.name',
				 	'url' => 'users',
				 	'description' => 'menu.users.list.description',
				 	'route' => 'mconsole.users.index',
				 	'visible' => true,
				 	'enabled' => true,
				 ],
				 [
				 	'name' => 'Create user',
				 	'key' => 'users_create',
				 	'translation' => 'menu.users.create.name',
				 	'url' => 'users/create',
				 	'description' => 'menu.users.create.description',
				 	'route' => 'mconsole.users.create',
				 	'visible' => true,
				 	'enabled' => true,
				 ],
				 [
				 	'name' => 'Edit users',
				 	'key' => 'users_update',
				 	'translation' => 'menu.users.update.name',
				 	'description' => 'menu.users.update.description',
				 	'route' => 'mconsole.users.edit',
				 	'visible' => false,
				 	'enabled' => true,
				 ],
				 [
				 	'name' => 'Delete users',
				 	'key' => 'users_delete',
				 	'translation' => 'menu.users.delete.name',
				 	'description' => 'menu.users.delete.description',
				 	'route' => 'mconsole.users.destroy',
				 	'visible' => false,
				 	'enabled' => true,
				 ],
				 [
				    'name' => 'All roles',
				    'key' => 'roles_all',
				    'translation' => 'menu.roles.list.name',
				    'url' => 'roles',
				    'description' => 'menu.roles.list.description',
				    'route' => 'mconsole.roles.index',
				    'visible' => true,
				    'enabled' => true,
				 ],
				 [
				    'name' => 'Create role',
				    'key' => 'roles_create',
				    'translation' => 'menu.roles.create.name',
				    'url' => 'roles/create',
				    'description' => 'menu.roles.create.description',
				    'route' => 'mconsole.roles.create',
				    'visible' => false,
				    'enabled' => true,
				 ],
				 [
				    'name' => 'Edit roles',
				    'key' => 'roles_update',
				    'translation' => 'menu.roles.update.name',
				    'description' => 'menu.roles.update.description',
				    'route' => 'mconsole.roles.edit',
				    'visible' => false,
				    'enabled' => true,
				 ],
				 [
				    'name' => 'Delete roles',
				    'key' => 'roles_delete',
				    'translation' => 'menu.roles.delete.name',
				    'description' => 'menu.roles.delete.description',
				    'route' => 'mconsole.roles.destroy',
				    'visible' => false,
				    'enabled' => true,
				 ],
                 [
                     'name' => 'All permissions',
                     'key' => 'permissions_all',
                     'translation' => 'menu.permissions.list.name',
                     'url' => 'permissions',
                     'description' => 'menu.permissions.list.description',
                     'route' => 'mconsole.permissions.index',
                     'visible' => true,
                     'enabled' => true,
                 ],
                 [
                     'name' => 'Edit permissions',
                     'key' => 'permissions_update',
                     'translation' => 'menu.permissions.update.name',
                     'description' => 'menu.permissions.update.description',
                     'route' => 'mconsole.permissions.store',
                     'visible' => false,
                     'enabled' => true,
                 ],
             ],
         ],
     ];
	
	/**
	 * List of menu keys that need to be deleted
	 * @var array
	 */
	protected static $toDelete = [
		
	];
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public static function run()
	{
		// Insert new menu items
		foreach (self::$menus as $menu) {
			$exist = DB::table(self::$table)->where('key', $menu['key'])->first();
			if (!is_null($exist)) {
				$id = $exist->id;
				self::update($id, $menu);
			} else {
				$id = self::insert($menu);
			}
			if (null !== $menu['child'] && count($menu['child']) > 0) {
				foreach ($menu['child'] as $child) {
					$childExist = DB::table(self::$table)->where('key', $child['key'])->first();
					if (!is_null($childExist)) {
						$child['menu_id'] = $id;
						self::update($childExist->id, $child);
					} else {
						self::insert(array_merge($child, ['menu_id' => $id]));
					}
				}
			}
		};
		
		// Delete unused menu items
		foreach (self::$toDelete as $key)
			DB::table(self::$table)->where('key', $key)->delete();
		
		return 'Installed ' . __CLASS__ . '.';
	}
	
	/**
	 * Insert new menu item.
	 * 
	 * @access protected
	 * @static
	 * @param mixed $menu
	 * @return void
	 */
	protected static function insert($menu)
	{
		return DB::table(self::$table)->insertGetId([
			'menu_id' => (isset($menu['menu_id'])) ? $menu['menu_id'] : 0,
			'name' => (isset($menu['name'])) ? $menu['name'] : '',
			'key' => (isset($menu['key'])) ? $menu['key'] : '',
			'url' => (isset($menu['url'])) ? $menu['url'] : '',
			'translation' => (isset($menu['translation'])) ? $menu['translation'] : '',
			'description' => (isset($menu['description'])) ? $menu['description'] : '',
			'visible' => (isset($menu['visible'])) ? $menu['visible'] : true,
			'enabled' => (isset($menu['enabled'])) ? $menu['enabled'] : true,
			'route' => (isset($menu['route'])) ? $menu['route'] : '',
		]);
	}
	
	/**
	 * Update existing menu item.
	 * 
	 * @access protected
	 * @static
	 * @param mixed $id
	 * @param mixed $menu
	 * @return void
	 */
	protected static function update($id, $menu)
	{
		DB::table(self::$table)->where('id', $id)->update([
			'menu_id' => (isset($menu['menu_id'])) ? $menu['menu_id'] : 0,
			'name' => (isset($menu['name'])) ? $menu['name'] : '',
			'key' => (isset($menu['key'])) ? $menu['key'] : '',
			'url' => (isset($menu['url'])) ? $menu['url'] : '',
			'translation' => (isset($menu['translation'])) ? $menu['translation'] : '',
			'description' => (isset($menu['description'])) ? $menu['description'] : '',
			'route' => (isset($menu['route'])) ? $menu['route'] : '',
		]);
	}
}
