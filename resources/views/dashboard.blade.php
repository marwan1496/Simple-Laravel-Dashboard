@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard <span class="float-right">
                  <a href="/listings/create" class="btn btn-success btn-sm">Add Listings</a>
                </span></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Your Listings</h3>
                    @if(count($listings))
                    <table class="table table-striped">
                      <tr>
                        <th>Company</th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr>
                        @foreach($listings as $listing)
                        <tr>
                          <td><a href="/listings/{{$listing->id}}">{{$listing->name}}</a></td>
                          <td></td>
                          <td></td>
                        </tr>
                        @endforeach
                      </tr>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
