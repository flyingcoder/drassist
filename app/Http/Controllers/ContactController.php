<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('contacts.create');
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
        $contact = Contact::find($id);
        return view('contacts.edit', compact('contact')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateContact(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'phone_number'=>'required',
            'email'=>'required'
        ]);

        $contact = Contact::findOrFail($id);
        $contact->name =  $request->get('name');
        $contact->phone_number = $request->get('phone_number');
        $contact->email = $request->get('email');
        $contact->relationship = $request->get('relationship');
        $data = $contact->save();

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteContact($id)
    {
        $contact = Contact::findOrfail($id);
        $contact->delete();
        return response()->json($contact, 200);
    }

     public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone_number'=>'required',
            'email'=>'required'
        ]);

        $contact = Contact::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'relationship' => $request->relationship,
        ]);

        return response()->json($contact, 200);
    }

    public function getContacts($id) {
        $user = User::findOrFail($id);
        $data = $user->contacts;
        return response()->json($data, 200);

    }
}
