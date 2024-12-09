<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Routing\Route;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  private function shareMenuData($path, $key)
  {
    $menuJson = file_get_contents(base_path($path));
    $menuData = json_decode($menuJson);

    // Share all menuData to all the views
    $this->app->make('view')->share($key, [$menuData]);
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    $this->shareMenuData('resources/menu/verticalMenu.json', 'menuData');
    $this->shareMenuData('resources/menu/navMenu.json', 'navData');
  }
}
