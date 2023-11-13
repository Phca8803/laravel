@extends('layouts.app', ['pageSlug' => __('new_form')])

@section('_title_', (isset($journalNew) ? 'Edit New' : 'Create New'))

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">@yield('_title_')</h5>
                
                </div>
                <form method="post" action="{{ isset($journalNew) ? route('journalnew.update', ['user' => $user->id,'journalNew' => $journalNew->id]) : route('journalnew.store', ['user' => $user->id]) }}" autocomplete="off">
                    <div class="card-body">

                            {{ method_field(isset($journalNew) ? 'PUT' : 'POST')}}
                            
                            @csrf
                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Title" value="{{ old('title',(isset($journalNew) ? $journalNew->title : '' )) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>Text</label>
                                <input type="textarea" name="text" class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}" placeholder="Text" value="{{ old('text', (isset($journalNew) ? $journalNew->text : '' )) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
