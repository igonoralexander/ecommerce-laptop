<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch the first site settings record
        $siteSettings = SiteSetting::first();
    
       // If no settings exist, redirect to creation page with an error message
        if (!$siteSettings) {
            return view('admin.site-settings.create', [
                'title' => 'Site Settings',
                'breadcrumbs' => [
                    ['url' => '#', 'label' => 'Settings'],
                    ['url' => null, 'label' => 'Create Site Settings'],
                ],   
            ])->with('error', 'No site settings found. Please create settings first.');
        }

    
        // Decode JSON fields before passing to the view
        $siteSettings->social_links = json_decode($siteSettings->social_links, true);
    
        // Return the view with data
        return view('admin.site-settings.index', compact('siteSettings'))->with([
            'title' => 'Site Settings',
            'breadcrumbs' => [
                ['url' => route('admin.site-settings.index'), 'label' => 'Settings'],
                ['url' => null, 'label' => 'Site Settings'],
            ],
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.site-settings.create', [
            'title' => 'Site Settings',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'Settings'],
                ['url' => null, 'label' => 'Create Site Settings'],
            ],   
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'contact_email' => 'required|email',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'business_hours' => 'nullable|string|max:255',
            'timezone' => 'nullable|string',
            'currency' => 'nullable|string',
            'site_language' => 'nullable|string',
            'social_links' => 'nullable|array',
            'social_links.*' => 'nullable|url',
            'filename' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // For file upload validation
        ]);

        // Handle the file upload (if there is one)
        if ($request->hasFile('filename')) {
            // Store the file in 'public/logos'
            $path = $request->file('filename')->store('logos');

            // Convert the stored path to be accessible from 'storage/'
            $logoPath = str_replace('public/', 'storage/', $path);
        } else {
            $logoPath = SiteSetting::where('id', 1)->value('logo'); // Retain existing logo if no new file is uploaded
        }

        // Save or update the site settings in the database
        SiteSetting::updateOrCreate(
            ['id' => 1], // Update the existing site settings record
            [
                'site_name' => $request->site_name,
                'site_tagline' => $request->site_tagline,
                'contact_email' => $request->contact_email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'country' => $request->country,
                'business_hours' => $request->business_hours,
                'timezone' => $request->timezone,
                'currency' => $request->currency,
                'site_language' => $request->site_language,
                'social_links' => $request->social_links ? json_encode($request->social_links) : null, // Save as JSON
                'logo' => $logoPath,  // Save the correct file path of the logo
            ]
        );

        // Redirect to the index page or to a confirmation page
        return redirect('/admin/site-settings')->with('success', 'Site settings saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'contact_email' => 'required|email',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'business_hours' => 'nullable|string|max:255',
            'timezone' => 'nullable|string',
            'currency' => 'nullable|string',
            'site_language' => 'nullable|string',
            'social_links' => 'nullable|array',
            'social_links.*' => 'nullable|url',
            'filename' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // For file upload validation
        ]);

        // Handle the file upload (if there is one)
        if ($request->hasFile('filename')) {
            // Store the file in 'public/logos'
            $path = $request->file('filename')->store('logos');

            // Convert the stored path to be accessible from 'storage/'
            $logoPath = str_replace('public/', 'storage/', $path);
        } else {
            $logoPath = SiteSetting::where('id', 1)->value('logo'); // Retain existing logo if no new file is uploaded
        }

        // Save or update the site settings in the database
        SiteSetting::updateOrCreate(
            ['id' => 1], // Update the existing site settings record
            [
                'site_name' => $request->site_name,
                'site_tagline' => $request->site_tagline,
                'contact_email' => $request->contact_email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'country' => $request->country,
                'business_hours' => $request->business_hours,
                'timezone' => $request->timezone,
                'currency' => $request->currency,
                'site_language' => $request->site_language,
                'social_links' => $request->social_links ? json_encode($request->social_links) : null, // Save as JSON
                'logo' => $logoPath,  // Save the correct file path of the logo
            ]
        );

        // Redirect to the index page or to a confirmation page
        return redirect('/admin/site-settings')->with('success', 'Site settings saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
