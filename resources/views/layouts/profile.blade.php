@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="card card-profile p-3">
                <div class="row d-flex justify-content-center">
                    <div class="col-8">
                        <form id="form" action="@yield('route')" method="POST" enctype="multipart/form-data">
                            @csrf
                            @yield('method')

                            <div class="row mb-4">
                                <div class="mr-5">
                                    <img class="profile" style="width: 40px; height: 40px;" src="{{ $user->profile?->image->path() ?? '/storage/default-profile.png' }}" alt="not found">
                                </div>
                                <div class="col profile-right-side">
                                    <h4>{{$user->name}}</h4>
                                    <input class="btn btn-link" type="file" name="profile" value="{{ __('local.change_profile_photo') }}" @section('profile-attrs') required @show >
                                    <p class="text-danger">{{ $errors->first('profile') }}</p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="mr-3">
                                    <h5>{{ __('local.Username') }}</h5>
                                </div>
                                <div class="col">
                                    <input class="w-100" type="text" name="username" placeholder="{{ __('local.Username') }}"  @section('username-val') value="{{ old('username') ?? $user->profile?->username }}" @show @section('username-attrs') required @show >
                                    <p class="text-danger">{{ $errors->first('username') }}</p>
                                    <div class="text-info mb-1">
                                        {{ __('local.username_hint') }}
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="mr-4">
                                    <h5>{{ __('local.Website') }}</h5>
                                </div>
                                <div class="col">
                                    <input class="w-100" type="text" name="website" placeholder="{{ __('local.Website') }}" @section('website-val') value="{{ old('website') ?? $user->profile?->website }}" @show>
                                    <p class="text-danger">{{ $errors->first('website') }}</p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="mr-5">
                                    <h5>{{ __('local.Bio') }}</h5>
                                </div>
                                <div class="col">
                                    <div class="mb-4">
                                        <textarea cols="10" rows="2" class="w-100" type="text" name="bio" placeholder="{{ __('local.Bio') }}" form="form"> {{ old('bio') ?? $user->profile?->bio }} </textarea>
                                    <p class="text-danger">{{ $errors->first('bio') }}</p>
                                    </div>
                                    <div class="text-info">
                                        {{ __('local.bio_hint') }}
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="mr-5">
                                    <h5>{{ __('local.Email') }}</h5>
                                </div>
                                <div class="col">
                                    <input class="w-100" type="email" name="email" placeholder="{{ __('local.Email') }}" @section('email-val') value="{{ old('email') ?? $user->email }}" @show @section('email-attrs') required @show >
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="mr-0">
                                    <h5>{{ __('local.Phone') }}</h5>
                                </div>
                                <div class="col">
                                    <input class="w-100" type="text" name="phone" placeholder="{{ __('local.Phone') }}" @section('phone-val') value="{{ old('phone') ?? $user->profile?->phone }}" @show>
                                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="mr-0">
                                    <h5>{{ __('local.Gender') }}</h5>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="male" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="femail">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Female
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" value="other">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Other
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary">submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

