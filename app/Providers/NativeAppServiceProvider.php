<?php

namespace App\Providers;

use Native\Laravel\Facades\Menu;
use Native\Laravel\Facades\Window;
use Native\Laravel\Facades\MenuBar;
use Native\Laravel\Contracts\ProvidesPhpIni;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        Window::open()
            ->maximized()
            ->title('Cuit App');

        MenuBar::create()
            ->icon(storage_path('app/menuBarIconTemplate.png'))
            ->withContextMenu(
                Menu::make(
                    Menu::label('Cuit App'),
                    Menu::separator(),
                    Menu::link('htttp://localhost:8000', 'Open in browser..'),
                    Menu::separator(),
                    Menu::quit(),
                )
            );
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [
        ];
    }
}
