<?php

namespace Milax\Mconsole\Providers;

use Illuminate\Support\ServiceProvider;
use Milax\Mconsole\Models\MconsoleUploadPreset;
use Milax\Mconsole\Models\Variable;
use String;
use Blade;
use View;

class MconsoleBladeExtensions extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Blade::directive('datetime', function ($expression) {
            return "<?php echo \Carbon\Carbon::now()->format({$expression}); ?>";
        });
        
        Blade::directive('upload', function ($expression) {
            $presets = MconsoleUploadPreset::getCached();
            return "<?php echo View::make('mconsole::partials.upload')->with('presets', '{$presets}'); ?>";
        });
        
        Blade::directive('variable', function ($expression) {
            $string = new String($expression);
            $expression = $string->removeQuote()->removeParenthesis()->getString();
            $variable = Variable::getCached()->where('key', $expression)->first();
            $value = ($variable) ? $variable->value : null;
            
            return "<?php echo \"{$value}\"; ?>";
        });
    }
}
