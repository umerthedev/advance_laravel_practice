<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Contact;

class ContactController extends Controller
{
   
   //user home contact route
    public function HomeContact(){
        $usercontact = DB::table('contacts')->first();
        return view('user_profile.user_contact',compact('usercontact'));
    }
   
    //ContactController

    public function Contact(){
        $contact = Contact::all();
        return view('admin.contact.conIndex',compact('contact'));
    }
    //AddContact
    public function AddContact(){
        return view('admin.contact.conAdd');
    }

    //store.contact
    public function StoreContact(Request $request){
        $validateData = $request->validate([
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        
        Contact::insert([
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('contact.profile')->with('success','Contact Inserted Successfully');


    }
    //EditContact
    public function EditContact($id){
        $showcontact = Contact::find($id);
        return view('admin.contact.conEdit',compact('showcontact'));
    }


    //UpdateContact
    public function UpdateContact(Request $request, $id){

        $updateContact = Contact::find($id)->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);
        return Redirect()->route('contact.profile')->with('success','Contact Updated Successfully');

    }

    //DeleteContact
    public function DeleteContact($id){
        Contact::find($id)->delete();
        return Redirect()->back()->with('success','Contact Deleted Successfully');
    }

}
