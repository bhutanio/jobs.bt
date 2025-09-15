<?php

namespace App\Providers;

use App\Providers\AuthServiceProvider as AppAuthServiceProvider;
use App\Services\AI\AIJobGeneratorService;
use App\Services\AI\AIResumeGeneratorService;
use App\Services\AI\Providers\ProviderClient;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\FortifyServiceProvider as LaravelFortifyServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(LaravelFortifyServiceProvider::class);
        $this->app->register(AppAuthServiceProvider::class);

        // Bind AI services to a simple provider client for now
        $this->app->singleton(ProviderClient::class, fn () => new ProviderClient());
        $this->app->bind(AIResumeGeneratorService::class, ProviderClient::class);
        $this->app->bind(AIJobGeneratorService::class, ProviderClient::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Use Bootstrap 5 pagination views to match the site's styling
        Paginator::useBootstrapFive();

        // Custom named rate limiters per spec
        RateLimiter::for('ai', function (Request $request) {
            $user_id = optional($request->user())->id ?? $request->ip();

            return [
                Limit::perHour(5)->by($user_id . ':ai-hour'),
                Limit::perDay(20)->by($user_id . ':ai-day'),
            ];
        });

        RateLimiter::for('apply', function (Request $request) {
            $user_id = optional($request->user())->id ?? $request->ip();

            return [
                Limit::perHour(10)->by($user_id . ':apply-hour'),
            ];
        });
    }
}
