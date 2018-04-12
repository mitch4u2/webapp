<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use Image;

class UserController extends Controller
{
    /**
     * Show the User Profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('user.show')->with('user',Auth::user());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // $user_id = auth()->user()->id;
        // $user = User::find($user_id);
        return view('user.edit')->with('user',Auth::user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'birthday' => 'required',
            'address' => 'required',                      
        ]);
        
        //  // handle file upload
         if ($request->hasFile('profile_image')) {
            $avatar = $request->file('profile_image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/storage/profile_image/' . $filename));  
         }

        // Update User 
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->birthday = $request->input('birthday');
        $user->address = $request->input('address');
        $user->profile_image = $filename;
         if ($request->hasFile('profile_image')) {
        //     // delete old image
             if ($user->profile_image != 'nouserimage.jpg') {
                 Storage::delete('public/profile_images/' . $user->profile_image);
             }
             $user->profile_image = $filename;
         }
        $user->save();
        return redirect('/profile')->with('success', 'User Updated');
    }

}