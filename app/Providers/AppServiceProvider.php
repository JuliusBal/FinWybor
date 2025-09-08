<?php

namespace App\Providers;

use App\Observers\CategoryObserver;
use App\Observers\PostObserver;
use App\Repositories\PostRepository;
use App\Services\CategoryService;
use App\Services\Search\SpatieSearchService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\Post;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PostRepository::class);
        $this->app->singleton(CategoryService::class);
        $this->app->singleton(SpatieSearchService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        Category::observe(CategoryObserver::class);

        Blade::directive('canonical', function ($expr = null) {
            $code = "<?php echo '<link rel=\"canonical\" href=\"' . e(app(Canonical::class)->build(request'";

            if ($expr) {
                $code .= ", ...[$expr]";
            } else {
                $code .= ", null, []";
            }

            $code .= ")) . '\">'; ?>";
            return $code;
        });
    }
}
