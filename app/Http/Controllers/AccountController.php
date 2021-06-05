<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Image;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = $this->getUser();

        return view('account.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAccountRequest $request)
    {
        $this->createNewProfile($request);
        $this->createNewImage($request);

        return redirect()->route('home');
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
        $user = $this->getUser();

        return view('account.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, $id)
    {
        $this->updateOldProfile($request);

        if ($request->has('profile')) {
            $this->updateOldImage($request);
        }

        $user = $this->getUser();

        return redirect()->route('profile', ['username' => $user->name]);
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

    private function getUser()
    {
        return Auth::user();
    }

    private function getProfile()
    {
        return Auth::user()->profile;
    }

    private function getCreateRequestData(CreateAccountRequest $request)
    {
        return $request->except('_token');
    }

    private function createNewProfile(CreateAccountRequest $request)
    {
        $parameters = $request->only(['bio', 'username', 'email', 'phone', 'website', 'gender']);

        $profile = new Profile($parameters);
        Auth::user()->profile()->save($profile);
    }

    private function createPathForProfile()
    {
        return 'public/profiles/' . $this->getUser()->name;
    }

    private function getStoragePathForProfile(string $filename)
    {
        return 'storage/profiles/' . $this->getUser()->name . '/' . $filename;
    }

    private function saveImage(CreateAccountRequest|UpdateAccountRequest $request)
    {
        return $request->file('profile')->store('public/profiles');;
    }

    private function createNewImage(CreateAccountRequest $request)
    {
        $profile = Auth::user()->profile;

        $image = $this->saveImage($request);

        $profile->image()->create(['url' => $image]);
    }

    private function updateOldProfile(UpdateAccountRequest $request)
    {
        $parameters = $request->only(['bio', 'username', 'email', 'phone', 'website', 'gender']);

        Auth::user()->profile->update($parameters);
    }

    private function updateOldImage(UpdateAccountRequest $request)
    {
        $profile = $this->getProfile();
        $imagePath = $this->saveImage($request);

        $image = [
            'url' => $imagePath
        ];

        $profile->image->update($image);
    }

}
