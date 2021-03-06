<?php

namespace Milax\Mconsole\Seeds;

use DB;
use Schema;
use Milax\Mconsole\Models\Language;
use Milax\Mconsole\Contracts\MconsoleSeeder;

class MconsoleLanguaugeSeeder implements MconsoleSeeder
{
    /**
     * Default options with values to create
     * 
     * @var array
     * @access protected
     */
    protected static $languages = [
        [
            'key' => 'ru',
            'name' => 'Русский',
        ],
        [
            'key' => 'en',
            'name' => 'English',
        ],
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        if (!Schema::hasTable('languages') || DB::table('languages')->count() == 0) {
            collect(self::$languages)->each(function ($language) {
                if (DB::table('languages')->where('key', $language['key'])->count() == 0) {
                    DB::table('languages')->insert([
                        'key' => $language['key'],
                        'name' => $language['name'],
                    ]);
                }
            });
        }

        return 'Installed ' . __CLASS__ . '.';
    }
}
