<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HorizonWindowsServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $this->patchHorizonForWindows();
        }
    }

    protected function patchHorizonForWindows()
    {
        if (!function_exists('pcntl_async_signals')) {
            function pcntl_async_signals($enable) {
                return true;
            }
        }

        if (!function_exists('pcntl_signal')) {
            function pcntl_signal($signo, $callback) {
                return true;
            }
        }

        if (!function_exists('pcntl_signal_dispatch')) {
            function pcntl_signal_dispatch() {
                return true;
            }
        }
    }
}