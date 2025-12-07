<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function message(MessageContactRequest $request){

        $data = $request->validated();
        Contact::create($data);
        return back()->with('status-message','Message sent successfully');
    }
}