<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContactDataRequest;
use App\Models\ContactData;

class ContactFormController extends Controller
{
    public function store(StoreContactDataRequest $request)
    {

        // Insert the Contact Form Data
        ContactData::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Contact information submitted successfully.',
        ], 201);
    }
}
