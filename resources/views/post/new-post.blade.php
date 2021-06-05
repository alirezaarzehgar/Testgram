@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- image uploading --}}
            <div>
                <input type="file" name="images[]" id="images" multiple>
                <label class="text-danger" for="images">{{$errors->first('images')}}</label>
            </div>

            {{-- title and body --}}
            <div class="col-5">
                <div class="row d-flex justify-content-around my-5">
                    <div>
                        <h5>{{ __('local.title') }}</h5>
                    </div>

                    <div>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Title">
                        <label class="text-danger" for="title">{{$errors->first('title')}}</label>
                    </div>
                </div>

                <div class="row d-flex justify-content-around my-5">
                    <div>
                        <h5>{{ __('local.descryption') }}</h5>
                    </div>

                    <div>
                        <textarea name="body" id="body" cols="30" rows="10" placeholder="Descryption">{{ old('body') }}</textarea>
                        <label class="text-danger" class="text-danger" for="body">{{$errors->first('body')}}</label>
                    </div>
                </div>
                <button class="btn btn-primary">{{__('local.submit')}}</button>
            </div>
        </form>
    </div>
@endsection
