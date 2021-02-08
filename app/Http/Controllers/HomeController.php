<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageFromContact;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.home');
    }

    public function contact()
    {
        return view('guest.contact');
    }

    public function contactSent(Request $request)
    {
        $form_data = $request->all();
        $new_lead = new Lead();
        $new_lead->fill($form_data);
        $new_lead->save();
        Mail::to('commerciale@boolpress.com')
        // ->replayTo($form_data['email'])
        ->send(new MessageFromContact($new_lead));
        return redirect()->route('contact.thankyou');
    }

    public function thankYou()
    {
        return view('guest.thankyou');
    }
}
