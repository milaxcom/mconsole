<?php

namespace Milax\Mconsole\Providers;

use Illuminate\Support\ServiceProvider;

class ACLServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        app('API')->acl->register([
            ['GET', 'uploads', 'mconsole::uploads.acl.index'],
            ['GET', 'uploads/create', 'mconsole::uploads.acl.create'],
            ['POST', 'uploads', 'mconsole::uploads.acl.store'],
            ['GET', 'uploads/{uploads}/edit', 'mconsole::uploads.acl.edit'],
            ['PUT', 'uploads/{uploads}', 'mconsole::uploads.acl.update'],
            ['GET', 'uploads/{uploads}', 'mconsole::uploads.acl.show'],
            ['DELETE', 'uploads/{uploads}', 'mconsole::uploads.acl.destroy'],
            ['GET', 'api/uploads/get', 'mconsole::uploads.acl.uploadlist'],
            ['POST', 'api/uploads/upload', 'mconsole::uploads.acl.upload'],
            ['GET', 'api/uploads/delete/{file}', 'mconsole::uploads.acl.uploaddelete'],
        ], 'uploads');
        
        app('API')->acl->register([
            ['GET', 'menus', 'mconsole::menus.acl.index'],
            ['GET', 'menus/create', 'mconsole::menus.acl.create'],
            ['POST', 'menus', 'mconsole::menus.acl.store'],
            ['GET', 'menus/{menu}/edit', 'mconsole::menus.acl.edit'],
            ['PUT', 'menus/{menu}', 'mconsole::menus.acl.update'],
            ['GET', 'menus/{menu}', 'mconsole::menus.acl.show'],
            ['DELETE', 'menus/{menu}', 'mconsole::menus.acl.destroy'],
        ], 'menus');
        
        app('API')->acl->register([
            ['GET', 'presets', 'mconsole::presets.acl.index'],
            ['GET', 'presets/create', 'mconsole::presets.acl.create'],
            ['POST', 'presets', 'mconsole::presets.acl.store'],
            ['GET', 'presets/{presets}/edit', 'mconsole::presets.acl.edit'],
            ['PUT', 'presets/{presets}', 'mconsole::presets.acl.update'],
            ['GET', 'presets/{presets}', 'mconsole::presets.acl.show'],
            ['DELETE', 'presets/{presets}', 'mconsole::presets.acl.destroy'],
        ], 'presets');
        
        app('API')->acl->register([
            ['GET', 'roles', 'mconsole::roles.acl.index'],
            ['GET', 'roles/create', 'mconsole::roles.acl.create'],
            ['POST', 'roles', 'mconsole::roles.acl.store'],
            ['GET', 'roles/{roles}/edit', 'mconsole::roles.acl.edit'],
            ['PUT', 'roles/{roles}', 'mconsole::roles.acl.update'],
            ['GET', 'roles/{roles}', 'mconsole::roles.acl.show'],
            ['DELETE', 'roles/{roles}', 'mconsole::roles.acl.destroy'],
        ], 'roles');
        
        app('API')->acl->register([
            ['GET', 'users', 'mconsole::users.acl.index'],
            ['GET', 'users/create', 'mconsole::users.acl.create'],
            ['POST', 'users', 'mconsole::users.acl.store'],
            ['GET', 'users/{users}/edit', 'mconsole::users.acl.edit'],
            ['PUT', 'users/{users}', 'mconsole::users.acl.update'],
            ['GET', 'users/{users}', 'mconsole::users.acl.show'],
            ['DELETE', 'users/{users}', 'mconsole::users.acl.destroy'],
        ], 'users_list');
        
        
        app('API')->acl->register([
            ['GET', 'languages', 'mconsole::languages.acl.index'],
            ['GET', 'languages/create', 'mconsole::languages.acl.create'],
            ['POST', 'languages', 'mconsole::languages.acl.store'],
            ['GET', 'languages/{languages}/edit', 'mconsole::languages.acl.edit'],
            ['PUT', 'languages/{languages}', 'mconsole::languages.acl.update'],
            ['GET', 'languages/{languages}', 'mconsole::languages.acl.show'],
            ['DELETE', 'languages/{languages}', 'mconsole::languages.acl.destroy'],
        ], 'languages');
        
        app('API')->acl->register([
            ['GET', 'tags', 'mconsole::tags.acl.index'],
            ['GET', 'tags/create', 'mconsole::tags.acl.create'],
            ['POST', 'tags', 'mconsole::tags.acl.store'],
            ['GET', 'tags/{tags}/edit', 'mconsole::tags.acl.edit'],
            ['PUT', 'tags/{tags}', 'mconsole::tags.acl.update'],
            ['GET', 'tags/{tags}', 'mconsole::tags.acl.show'],
            ['DELETE', 'tags/{tags}', 'mconsole::tags.acl.destroy'],
        ], 'tags');
        
        app('API')->acl->register([
            ['GET', 'modules', 'mconsole::modules.acl.index'],
            ['GET', 'modules/{id}/extend', 'mconsole::modules.acl.extend'],
            ['GET', 'modules/{id}/install', 'mconsole::modules.acl.install'],
            ['GET', 'modules/{id}/uninstall', 'mconsole::modules.acl.uninstall'],
        ], 'modules');
        
        app('API')->acl->register([
            ['GET', 'settings', 'mconsole::settings.acl.index'],
            ['POST', 'settings', 'mconsole::settings.acl.store'],
            ['GET', 'settings/clearcache', 'mconsole::settings.acl.clearcache'],
            ['GET', 'settings/reloadtrans', 'mconsole::settings.acl.reloadtrans'],
        ], 'settings');
        
        app('API')->acl->register([
            ['GET', 'variables', 'mconsole::variables.acl.index'],
            ['POST', 'variables', 'mconsole::variables.acl.store'],
        ], 'variables');
    }
}
