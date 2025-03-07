<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Faq;

class FaqController extends Controller
{
    //

    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faqs.index', [
            'faqs' => $faqs,
            'title' => 'FAQs',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'FAQs'],
            ],   
        ]);
    }


    public function create()
    {
        //
        return view('admin.faqs.create', [
            'title' => 'Add FAQs',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'FAQs'],
                ['url' => null, 'label' => 'Add FAQ'],
            ],   
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|unique:faqs',
            'answer' => 'required',
        ], [
            'question.required' => 'Enter Question',
            'answer.required' => 'Enter Answer',
        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        // Respond with a JSON response
        return response()->json(['success' => true, 'message' => 'FAQ has been added successfully']);
    }


    public function edit(Faq $faq)
    {
        $faq = Faq::findOrFail($faq->id);
        return view('admin.faqs.edit', [
            'faq' => $faq,
            'title' => 'Edit FAQs',
            'breadcrumbs' => [
                ['url' => '#', 'label' => 'FAQs'],
                ['url' => '#', 'label' => 'Edit FAQ'],
            ],   
        ]);
    }

    public function update(Request $request, Faq $faq)
    {
        //
        $faq = Faq::findOrFail($faq->id);
        
        $request->validate([
            'question' => 'nullable|unique:faqs,question,' . $faq->id,
            'answer' => 'nullable',
        ], [
            'question.required' => 'Enter Question',
            'answer.required' => 'Enter Answer',
        ]);
        
        $faq->question = $request ->question;
        $faq->answer   = $request ->answer;

        $faq -> update();
 
        // Return the updated data as a JSON response
        return response()->json([
            'success' => true,
            'message' => 'FAQ has been updated successfully',
            'updated_question' => $faq->question,
            'updated_answer' => $faq->answer,
        ]);
    }

    public function destroy(FAQ $faq)
    {
        //
        $faq = FAQ::find($faq->id);
        $faq->delete();

        return response()->json(['success' => true, 'message' => 'FAQ has been deleted successfully']);
    }

}
