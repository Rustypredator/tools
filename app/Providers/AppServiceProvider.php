<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $uid = Auth::id();
            //Add Support Links
            $items = [
                [
                    'text' => 'support_discord',
                    'icon' => 'fab fa-fw fa-discord',
                    'url' => 'https://discord.gg/DrKNGQn',
                    'topnav' => true
                ],
                [
                    'text' => 'support_forum',
                    'icon' => 'fas fa-fw fa-comments',
                    'url' => 'https://rusty.info/',
                    'topnav' => true
                ]
            ];
            //Add Tools
            $items = array_merge($items, [
                ['header'=>'TOOLS'],
                [
                    'text' => 'tool_pwgen_title',
                    'icon' => 'fas fa-fw fa-key',
                    'url' => '/tools/pwgen'
                ]
            ]);
            //ACP Stuff
            if(is_numeric($uid) && $uid > 0) {
                //add internal stuff
                $items = array_merge($items, [
                    'header' => 'Administration'
                ]);
            }
            //Add to menu
            $event->menu->add($items);
        });
    }
}
