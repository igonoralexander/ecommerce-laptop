<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;
use App\Models\ContactUs;
use App\Models\Client;
use App\Models\TechStack;
use App\Models\BlogPost;
use App\Models\AboutUs;
use App\Models\Tag;
use App\Models\MainSlider;
use App\Models\ServicesSection;
use App\Models\Project;
use App\Models\BlogCategory;
use App\Models\AboutSection;
use App\Models\ParallaxSection;
use App\Models\Causes;
use App\Models\Events;
use App\Models\Volunters;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\TermsCondition;
use App\Models\PrivacyPolicy;
use App\Models\WhyChooseUs;
use App\Models\CoreValue;
use App\Models\FAQ;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Use View::composer to pass data to all views
        View::composer('*', function ($view) {
            // Fetch necessary data
            $settings = SiteSetting::first();

            $view->with([
                'settings' => $settings,
            ]);
        });
    }
}
