<?php

namespace Milax\Mconsole\Core;

define('version', '0.0.9');

use Milax\Mconsole\Models\MconsoleMenu;

use Cache;
use Auth;
use View;
use DB;
use App;

/**
 * Core Mconsole class.
 */
class Mconsole
{
	
	/**
	 * Boot mconsole support vars.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function boot()
	{
		self::setLang();
		self::bootMenu();
		self::bootOptions();
	}
	
	/**
	 * Set language depending on user settings.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function setLang()
	{
// 		App::setLocale('en');
	}
	
	/**
	 * Build menu UI tree.
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	public static function bootMenu()
	{
		$all = MconsoleMenu::all();
		$menu = $all->where('menu_id', 0);
		$menu->each(function ($parent) use (&$all) {
			$parent->child = $all->where('menu_id', $parent->id);
		});

		View::share('mconsole_menu', $menu);
	}
	
	/**
	 * Build options.
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	public static function bootOptions()
	{
		$options = new \ stdClass();
		collect(DB::table('mconsole_options')->get())->each(function ($option) use (&$options) {
			$options->{$option->key} = $option->value;
		});

		View::share('mconsole_options', $options);
	}
	
}