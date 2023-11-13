@extends('layouts.app',['pageSlug' => 'journalNews'])

@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">{{($type == 'management' ? 'News of ' . $user->name : 'Our News')}}</h4>
                    </div>
                    @if($type == 'management')
                    <div class="col-4 text-right">
                        <a href="{{route('journalnew.create',['user' => $user->id])}}" class="btn btn-sm btn-primary">Add news</a>
                    </div>
                    @endif
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
                            <tr><th scope="col">Title</th>
                            <th scope="col">Text</th>
                            <th scope="col"></th>
                        </tr></thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td>{{$item->text}}</td>
                                @if($type == 'management')
                                  <td class="text-right">
                                      <div class="dropdown">
                                         <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-v"></i></a>
                                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{route('journalnew.edit',['user' => $user->id,'journalNew' => $item->id])}}">Edit</a>
                                            <form action="{{route('journalnew.destroy',['user' => $user->id,'journalNew' => $item->id])}}"  method="post">
                                               @csrf
                                               @method('delete')
                                              <button class="dropdown-item">Delete</button>
                                            </form>
                                          </div>
                                      </div>
                                  </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                
                <div class="">
                    Not have any news
                </div>
                @endif
                
            </div>
            
        </div>
        
    </div>
</div>
</div>
@endsection
