<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        //
        return view('admin.user.manage-admin');
    }


    public function user()
    {
        //
        return view('admin.user.manage-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function images()
    {
        return view('admin.media.images', [
            'title' => 'Gallery Management',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'Users'],
                ['url' => null, 'label' => 'All Images'],
            ],   
        ]);
    }

    public function videos()
    {
        return view('admin.media.videos', [
            'title' => 'Gallery Management',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'Users'],
                ['url' => null, 'label' => 'All Videos'],
            ],   
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}