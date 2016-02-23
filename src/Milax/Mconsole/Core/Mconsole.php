<?php

namespace Milax\Mconsole\Core;

define('version', '0.0.10');

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
		self::loadViewComposers();
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
		if (strlen($lang = Auth::user()->lang) > 0)
			App::setLocale($lang);
	}
	
	/**
	 * Load view composers.
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	public static function loadViewComposers()
	{
		view()->composer('mconsole::partials.menu', 'Milax\Mconsole\Http\Composers\MenuComposer');
		view()->composer('mconsole::app', 'Milax\Mconsole\Http\Composers\OptionsComposer');
	}
}