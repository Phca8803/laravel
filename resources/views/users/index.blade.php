@extends('layouts.app',['pageSlug' => 'users'])

@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Users</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{route('user.create')}}" class="btn btn-sm btn-primary">Add user</a>
                    </div>
                </div>
            </div>

            @if(isset($message) && isset($messageType) && $messageType == 's') 
            <div class="alert alert-success">
                <span>
                <b></b>{{$message}}</span>
            </div>
            @endif

            <div class="card-body">

                @if($data->count())    
                <div class="">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <tr><th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                        </tr></thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                           <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                              <a class="dropdown-item" href="{{route('user.edit',[$item->id])}}">Edit</a>
                                              <a class="dropdown-item" href="{{route('journalnew.index',['type' => 'management','user' => $item->id])}}">News</a>
                                              <form action="{{route('user.destroy',[$item->id])}}"  method="post">
                                                 @csrf
                                                 @method('delete')
                                                <button class="dropdown-item">Delete</button>
                                              </form>
                                            </div>
                                        </div>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                
                <div class="">
                    Not have any users in system
                </div>
                @endif
                
            </div>
            
        </div>
        
    </div>
</div>
</div>
@endsection
