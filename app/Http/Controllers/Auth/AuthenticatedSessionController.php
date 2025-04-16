<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\CartItem;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Get authenticated user
        $user = Auth::user();

        // Sync guest session cart to DB
        if ($request->session()->has('cart')) {
            $sessionCart = $request->session()->get('cart');

            $cart = Cart::firstOrCreate([
                'user_id' => $user->id,
                'status' => 'active',
            ]);

            foreach ($sessionCart as $laptop_id => $item) {
                $existing = $cart->items()->where('laptop_id', $laptop_id)->first();
                if ($existing) {
                    $existing->increment('quantity', $item['quantity']);
                } else {
                    $cart->items()->create([
                        'laptop_id' => $laptop_id,
                        'quantity' => $item['quantity'],
                        'sale_price' => $item['sale_price'],
                    ]);
                }
            }

            $request->session()->forget('cart'); // Clear session cart
        }

        // Redirect based on role
        return $user->role === 'admin' 
                ? redirect()->intended(RouteServiceProvider::ADMIN)->with('success', 'Login Successful')
                : redirect()->intended(RouteServiceProvider::USER());
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
