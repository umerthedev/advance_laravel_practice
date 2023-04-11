<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Message;

class UserConController extends Controller
{
   //u_contact form save
    public function u_contact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Message::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Message sent successfully');
    }

    //u_contact form view   
    public function u_contact_view()
    {
        $messages = Message::latest()->paginate(5);
        return view('admin.contact.message', compact('messages'));
    }
    //DeleteMsg
    public function DeleteMsg($id){
        Message::find($id)->delete();
        return Redirect()->back()->with('success', 'Message deleted successfully');
    }
}
