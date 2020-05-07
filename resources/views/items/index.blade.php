@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">Lost and Found</div>

        <!-- Display errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <!-- Display success status -->
        @if (\Session::has('success'))
        <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
        </div>
        @endif

        <!-- Display error status -->
        @if (\Session::has('error'))
        <div class="alert alert-danger">
          <p>{{ \Session::get('error') }}</p>
        </div>
        @endif

        <!-- Items Table -->
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Colour</th>
                <th>Time Found</th>
                @auth
                <th>Actions</th>
                @endauth
              </tr>
            </thead>
            <tbody>
              @foreach($items as $item)
              <tr>
                <td style="padding-top: 20px;">{{$item['name']}}</td>
                <td style="padding-top: 20px;">{{$item['category']}}</td>
                <td style="padding-top: 20px;">{{$item['colour']}}</td>
                <td style="padding-top: 20px;">{{$item['time_found']}}</td>
                @auth
                <td>
                  <a href="{{action('ItemController@show', $item['id'])}}" class="btn btn-primary">Details</a>
                  <a href="{{action('ItemRequestController@create', $item['id']) }}" class="btn btn-primary">Request</a>
                </td>
                @endauth
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
