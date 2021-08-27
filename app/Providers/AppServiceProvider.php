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
                ],
                [
                    'text' => 'tool_brwc_title',
                    'icon' => 'fas fa-fw fa-chart-line',
                    'url' => '/tools/brwc'
                ],
                [
                    'text' => 'tool_cc_rsmonitoring',
                    'icon' => 'fas fa-fw fa-chart-line',
                    'url' => '/tools/ccrsmonitoring'
                ],
                [
                    'text' => 'tool_earnpscalc_title',
                    'icon' => 'fas fa-fw fa-stopwatch',
                    'url' => '/tools/earnpscalc'
                ],
                [
                    'text' => 'tool_enigma_title',
                    'icon' => 'fas fa-fw fa-link',
                    'url' => '/tools/enigma'
                ],
                [
                    'text' => 'tool_morse_title',
                    'icon' => 'fas fa-fw fa-link',
                    'url' => '/tools/morse'
                ],
                [
                    'text' => 'tool_vigenere_title',
                    'icon' => 'fas fa-fw fa-link',
                    'url' => '/tools/vigenere'
                ],
                [
                    'text' => 'tool_secompcalc_title',
                    'icon' => 'fas fa-fw fa-calculator',
                    'url' => '/tools/secompcalc'
                ],
                [
                    'text' => 'tool_stcolids_title',
                    'icon' => 'fas fa-fw fa-list',
                    'url' => '/tools/stcolids'
                ],
                [
                    'text' => 'tool_strrev_title',
                    'icon' => 'fas fa-fw fa-history',
                    'url' => '/tools/strrev'
                ],
                [
                    'text' => 'tool_teammix_title',
                    'icon' => 'fas fa-fw fa-random',
                    'url' => '/tools/teammix'
                ],
                [
                    'text' => 'tool_whatismyip_title',
                    'icon' => 'fas fa-fw fa-question',
                    'url' => '/tools/whatismyip'
                ],
            ]);
            //ACP Stuff
            $uid = Auth::id();
            if(is_numeric($uid) && $uid > 0) {
                //add internal stuff
                $items = array_merge($items, [
                    'header' => 'Administration'
                ]);
            }
            //Add to menu
            foreach($items as $item) {
                $event->menu->add($item);
            }
        });
    }
}
