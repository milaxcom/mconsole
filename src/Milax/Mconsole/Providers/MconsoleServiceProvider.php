<?php

namespace Milax\Mconsole\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class MconsoleServiceProvider extends ServiceProvider
{
    public $register = [
        'middleware' => [
            'mconsole' => \Milax\Mconsole\Http\Middleware\MconsoleMiddleware::class,
        ],
        
        'providers' => [
            \Intervention\Image\ImageServiceProvider::class,
            \Collective\Html\HtmlServiceProvider::class,
            \Milax\Mconsole\Providers\MconsoleBladeExtensions::class,
            \Milax\Mconsole\Providers\CommandsServiceProvider::class,
            \Milax\Mconsole\Providers\MconsoleValidatorServiceProvider::class,
            \Milax\Mconsole\Providers\ViewComposersServiceProvider::class,
            \Milax\Mconsole\Providers\ScheduleServiceProvider::class,
        ],
        
        'aliases' => [
            // Third party packages
            'Gravatar' => \Milax\Gravatar::class,
            'Image' => \Intervention\Image\Facades\Image::class,
            'Form' => \Collective\Html\FormFacade::class,
            'Html' => \Collective\Html\HtmlFacade::class,
            'Debugbar' => \Barryvdh\Debugbar\Facade::class,
            
            // Traits
            'Cacheable' => \Milax\Cacheable::class,
            'HasRedirects' => \Milax\Mconsole\Traits\Controllers\HasRedirects::class,
            'DoesNotHaveShow' => \Milax\Mconsole\Traits\Controllers\DoesNotHaveShow::class,
            'HasUploads' => \Milax\Mconsole\Traits\Models\HasUploads::class,
            'HasLinks' => \Milax\Mconsole\Traits\Models\HasLinks::class,
            'HasTags' => \Milax\Mconsole\Traits\Models\HasTags::class,
            'HasState' => \Milax\Mconsole\Traits\Models\HasState::class,
            'System' => \Milax\Mconsole\Traits\Models\System::class,
            'CascadeDelete' => \Milax\Mconsole\Traits\Models\CascadeDelete::class,
            
            // Own classes
            'DocsParser' => \Milax\Mconsole\Docs\DocsParser::class,
        ],
        
        // Interface to Implementation bindings
        'bindings' => [
            'Milax\Mconsole\Contracts\Menu' => \Milax\Mconsole\Menu\FileMenu::class,
            'Milax\Mconsole\Contracts\Localizator' => \Milax\Mconsole\Processors\ContentLocalizator::class,
            'Milax\Mconsole\Contracts\ListRenderer' => \Milax\Mconsole\Renderers\GenericListRenderer::class,
            'Milax\Mconsole\Contracts\FormRenderer' => \Milax\Mconsole\Renderers\GenericFormRenderer::class,
            'Milax\Mconsole\Contracts\PagingHandler' => \Milax\Mconsole\Handlers\GenericPagingHandler::class,
        ],
        
        // Dependencies for injection
        'dependencies' => [
            'FileMenu' => \Milax\Mconsole\Menu\FileMenu::class,
            'DatabaseMenu' => \Milax\Mconsole\Menu\DatabaseMenu::class,
            'GetFilterHandler' => \Milax\Mconsole\Handlers\Filters\GetFilterHandler::class,
            'ParseDown' => \Parsedown::class,
        ],
        
    ];
    
    public $routes = [
        __DIR__ . '/../Http/routes.php',
    ];
    
    public $config = [
        'mconsole.php',
    ];
    
    public $translations = [
        __DIR__ . '/../../../resources/lang',
    ];
    
    public $views = [
        __DIR__ . '/../../../resources/views',
    ];
    
    public $require = [
        __DIR__ . '/../defines.php',
        __DIR__ . '/../helpers.php',
    ];
    
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        parent::__construct($app);
    }
    
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Register API singleton
        $this->app->singleton('API', function ($app) {
            return new \Milax\Mconsole\API\APIManager;
        });
        
        // Register mconsole APIs
        app('API')->register('notifications', new \Milax\Mconsole\API\Notifications(\Milax\Mconsole\Models\MconsoleNotification::class));
        app('API')->register('search', new \Milax\Mconsole\API\Search);
        app('API')->register('modules', new \Milax\Mconsole\API\Modules(\Milax\Mconsole\Models\MconsoleModule::class, $this));
        app('API')->register('menu', new \Milax\Mconsole\API\Menu(new \Milax\Mconsole\Menu\FileMenu));
        app('API')->register('quotes', new \Milax\Mconsole\API\Quotes);
        app('API')->register('options', new \Milax\Mconsole\API\Options(\Milax\Mconsole\Models\MconsoleOption::class));
        app('API')->register('presets', new \Milax\Mconsole\API\Presets(\Milax\Mconsole\Models\MconsoleUploadPreset::class));
        app('API')->register('translations', new \Milax\Mconsole\API\Translations($this));
        app('API')->register('quickmenu', new \Milax\Mconsole\API\QuickMenu);
        app('API')->register('uploads', new \Milax\Mconsole\API\Uploads);
        app('API')->register('info', new \Milax\Mconsole\API\Info);
        app('API')->register('links', new \Milax\Mconsole\API\Links(\Milax\Mconsole\Models\Link::class));
        app('API')->register('tags', new \Milax\Mconsole\API\Tags(\Milax\Mconsole\Models\Tag::class));
        
        // Run one time setup
        app('API')->modules->scan();
        app('API')->info->setAppVersion('0.3.6');
        
        if (env('APP_ENV') == 'local') {
            app('API')->translations->load();
        }
        
        // Register mconsole singleton
        $this->app->singleton('Mconsole', function ($app) {
            return $this;
        });
        
        // Register service providers
        foreach ($this->register['providers'] as $class) {
            $this->app->register($class);
        }
        
        foreach ($this->routes as $route) {
            require $route;
        }
        
        $this->loadTranslationsFrom(storage_path('app/lang'), 'mconsole');
        
        foreach ($this->views as $view) {
            $this->loadViewsFrom($view, 'mconsole');
        }
        
        // Assets
        $this->publishes([
            __DIR__ . '/../../../../public' => base_path('public/massets'),
        ], 'assets');
        
        // Custom configurations
        foreach ($this->config as $config) {
            if (!file_exists(config_path($config))) {
                $this->publishes([
                    __DIR__ . '/../../../../src/config/' . $config => config_path($config),
                ], 'config');
            } else {
                $this->mergeConfigFrom(
                    __DIR__ . '/../../../../src/config/' . $config, 'config'
                );
            }
        }
        
        // Copy database migrations
        $migrations = [];
        $dir = __DIR__ . '/../../../migrations/';
        collect(scandir(__DIR__ . '/../../../migrations'))->each(function ($file) use (&$dir, &$migrations) {
            if (strpos($file, '.php') !== false) {
                $migrations[$dir . $file] = base_path('database/migrations/' . $file);
            }
        });
        $this->publishes($migrations, 'migrations');
        
        app('API')->search->register(function ($text) {
            return \App\User::select('id', 'name', 'email')->where('email', 'like', sprintf('%%%s%%', $text))->orWhere('name', 'like', sprintf('%%%s%%', $text))->get()->transform(function ($user) {
                return [
                    'icon' => 'user',
                    'title' => $user->name,
                    'description' => $user->email,
                    'link' => sprintf('/mconsole/users/%s/edit', $user->id),
                ];
            });
        }, 'users');
        
        app('API')->search->register(function ($text) {
            return \Milax\Mconsole\Models\Upload::select('id', 'type', 'path', 'filename', 'copies')->where('id', (int) $text)->orWhere('filename', 'like', sprintf('%%%s%%', $text))->orderBy('type')->get()->transform(function ($file) {
                return [
                    'icon' => 'file',
                    'title' => file_get_original_name($file->filename),
                    'filepath' => $file->filename,
                    'path' => $file->path,
                    'description' => '',
                    'basepath' => '/storage/uploads',
                    'original' => $file->type == 'image' ? sprintf('/storage/uploads/%s/original/%s', $file->path, $file->filename) : sprintf('/storage/uploads/%s/%s', $file->path, $file->filename),
                    'copies' => $file->copies,
                    'preview' => $file->type == 'image' ? sprintf('/storage/uploads/%s/mconsole/%s', $file->path, $file->filename) : '',
                    'link' => '#',
                ];
            });
        }, 'uploads');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Required files
        foreach ($this->require as $file) {
            require $file;
        }
        
        foreach ($this->register['middleware'] as $alias => $class) {
            $this->app['router']->middleware($alias, $class);
        }
        
        foreach ($this->register['aliases'] as $alias => $class) {
            AliasLoader::getInstance()->alias($alias, $class);
        }
        
        foreach ($this->register['bindings'] as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
        
        foreach ($this->register['dependencies'] as $dependency => $class) {
            $this->app->bind($dependency, function ($app) use (&$class) {
                return new $class();
            });
        }
        
        $this->app->when('\Milax\Mconsole\Http\Controllers\MenusController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new \Milax\Mconsole\Repositories\MenusRepository(\Milax\Mconsole\Models\Menu::class);
            });
        
        $this->app->when('\Milax\Mconsole\Http\Controllers\PresetsController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new \Milax\Mconsole\Repositories\PresetsRepository(\Milax\Mconsole\Models\MconsoleUploadPreset::class);
            });
        
        $this->app->when('\Milax\Mconsole\Http\Controllers\RolesController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new \Milax\Mconsole\Repositories\RolesRepository(\Milax\Mconsole\Models\MconsoleRole::class);
            });
        
        $this->app->when('\Milax\Mconsole\Http\Controllers\TagsController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new \Milax\Mconsole\Repositories\TagsRepository(\Milax\Mconsole\Models\Tag::class);
            });
            
        $this->app->when('\Milax\Mconsole\Http\Controllers\UploadsController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new \Milax\Mconsole\Repositories\UploadsRepository(\Milax\Mconsole\Models\Upload::class);
            });
        
        $this->app->when('\Milax\Mconsole\Http\Controllers\UsersController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new \Milax\Mconsole\Repositories\UsersRepository(\App\User::class);
            });
        
        $this->app->when('\Milax\Mconsole\Http\Controllers\SettingsController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new \Milax\Mconsole\Repositories\SettingsRepository(\Milax\Mconsole\Models\MconsoleOption::class);
            });
        
        $this->app->when('\Milax\Mconsole\Http\Controllers\VariablesController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new \Milax\Mconsole\Repositories\VariablesRepository(\Milax\Mconsole\Models\Variable::class);
            });
    }
}
