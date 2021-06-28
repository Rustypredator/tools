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
            $tools = [
                (object)[
                    'translate_key' => 'tool_pwgen_title',
                    'icon' => 'fas fa-fw fa-key',
                    'url' => '/tools/pwgen'
                ]
            ];
            $event->menu->add(['header'=>'TOOLS']);
            //Add Tools
            foreach($tools as $i => $tool) {
                $event->menu->add([
                    'text' => $tool->translate_key,
                    'icon' => $tool->icon,
                    'url' => $tool->url
                ]);
            }
            if(is_numeric($uid) && $uid > 0) {
                //add internal stuff
                $event->menu->add([
                    'header' => 'Administration'
                ]);
            }
        });
    }
}
