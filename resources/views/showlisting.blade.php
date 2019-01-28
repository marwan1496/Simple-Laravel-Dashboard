@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <h2 class="card-header">{{$listing->name}}
              <span class="float-right">
                <a href="/listings" class="btn btn-primary btn-sm">Go Back</a>
              </span>
            </h2>

            <div class="card-body">
                @if($listing != null)

                  <p>{{$listing->email}}</p>
                  <p><a href="{{$listing->website}}" target="_blank">{{$listing->website}}</a></p>
                  <p>{{$listing->address}}</p>
                  <p>{{$listing->phone}}</p>

                  <p>{{$listing->bio}}</p>

                @endif
                <a href="/listings/{{$listing->id}}/edit">Edit</a>


                {!! Form::open(['action' => ['ListingsController@destroy',$listing->id],'method' => 'POST','class' => 'float-right','onsubmit'=>'return confirm("Are You Sure?")']) !!}

                    {{ Form::hidden('_method','DELETE')}}

                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection
