@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Item Request Details</div>

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

        <!-- Request Information -->
        <div class="card-body">
          <table class="table table-striped">
            <tr>
              <th>User ID</th>
              <td>{{$item_request['user_id']}}</td>
            </tr>
            <tr>
              <th>Username</th>
              <td>{{$item_request['user_name']}}</td>
            </tr>
            <tr>
              <th>Request ID</th>
              <td>{{$item_request['id']}}</td>
            </tr>
            <tr>
              <th>Item Name</th>
              <td>{{$item_request['item_name']}}</td>
            </tr>
            <tr>
              <th>Request</th>
              <td>{{$item_request['request_text']}}</td>
            </tr>
          </table>

          <!-- Buttons -->
          <div class="col-md-12 col-md-offset-4">
            <a href="{{route('item_requests.index')}}" class="btn btn-primary" role="button">Back</a>
            <a href="{{action('ItemRequestController@edit', $item_request['id'])}}" class="btn btn-warning">Edit</a>
            <a href="{{action('ItemRequestController@approve', $item_request['id'])}}" class="btn btn-primary">Approve</a>
            <a href="{{action('ItemRequestController@deny', $item_request['id'])}}" class="btn btn-warning">Deny</a>
            <div class="float-right">
              <form action="{{action('ItemRequestController@destroy', $item_request['id'])}}" method="post"> @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
