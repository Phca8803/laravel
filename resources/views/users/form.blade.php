@extends('layouts.app', ['pageSlug' => __('user_form')])

@section('_title_', (isset($user) ? 'Edit User' : 'Create User'))

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">@yield('_title_')</h5>
                
                </div>
                <form method="post" action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}" autocomplete="off">
                    <div class="card-body">

                            {{ method_field(isset($user) ? 'PUT' : 'POST')}}
                            
                            @csrf
                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name',(isset($user) ? $user->name : '' )) }}">
                                {!! $errors->first('name','<span class="help-block m-b-none">:message</span>') !!}
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('Email address') }}</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', (isset($user) ? $user->email : '' )) }}">
                                {!! $errors->first('email','<span class="help-block m-b-none">:message</span>') !!}
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label>{{ __('New Password') }}</label>
                                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="">
                                {!! $errors->first('password','<span class="help-block m-b-none">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label>{{ __('Confirm New Password') }}</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="">
                                {!! $errors->first('password_confirmation','<span class="help-block m-b-none">:message</span>') !!}
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(isset($user))
      {!! JsValidator::formRequest('App\Http\Requests\UserUpdateRequest') !!}
    @else
      {!! JsValidator::formRequest('App\Http\Requests\UserStoreRequest') !!}
    @endif

@endsection
