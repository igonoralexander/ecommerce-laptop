<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

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
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
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

use App\Models\Laptop;
use Illuminate\Support\Facades\Auth;

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

            $cartCount = 0;
            $cartItems = [];

            // Global settings
            $settings = SiteSetting::first();
            $brands = Brand::all();
            $products = Laptop::with(['brand', 'images'])->latest()->get();

            if (Auth::check()) {
                // For logged-in users
                $user = Auth::user();
    
                $cart = Cart::where('user_id', $user->id)
                    ->where('status', 'active')
                    ->first();

                if ($cart) {
                    $cartItemModels = CartItem::with('laptop')
                        ->where('cart_id', $cart->id)
                        ->get();

                        $cartCount = $cartItemModels->sum('quantity');

                        $cartItems = $cartItemModels->mapWithKeys(function ($item) {

                        // Use relationship, fallback to image path if needed
                        $image = $item->laptop->main_image ?? $item->laptop->images->first()->image ?? '/images/default.jpg';

                            return [
                                $item->laptop_id => [
                                    'id' => $item->laptop_id,
                                    'name' => $item->laptop->title,
                                    'quantity' => $item->quantity,
                                    'sale_price' => $item->sale_price,
                                    'image' => $image,
                                ]
                            ];
                    })->toArray();
                }

                } else {
                    // For guests
                    $cartItems = Session::get('cart', []);
                    $cartCount = collect($cartItems)->sum('quantity');
                }

                // Calculate subtotal
                $subtotal = collect($cartItems)->sum(function ($item) {
                    return $item['sale_price'] * $item['quantity'];
                });

                // Share with all views
                $view->with([
                    'settings' => $settings,
                    'brands' => $brands,
                    'modalProducts' => $products,
                    'cartItems' => $cartItems,
                    'cartCount' => $cartCount,
                    'cartSubtotal' => number_format($subtotal, 2)
                ]);
        });
    }
}
