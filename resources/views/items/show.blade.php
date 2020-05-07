@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Item Details</div>

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

        <div class="card-body">
          <!-- If item was reported by current user -->
          @if($item['user_id']==auth()->user()->id)
          <h6>This is an item you reported</h6>
          <hr />
          @endif

          <!-- Item Information -->
          <table class="table table-striped">
            @if(Gate::allows('isAdmin'))
            <tr>
              <th>User ID</th>
              <td>{{$item['user_id']}}</td>
            </tr>
            <tr>
              <th>Username</th>
              <td>{{$item['user_name']}}</td>
            </tr>
            <tr>
              <th>Item ID</th>
              <td>{{$item['id']}}</td>
            </tr>
            @endif
            <tr>
              <th>Name</th>
              <td>{{$item['name']}}</td>
            </tr>
            <tr>
              <th>Category</th>
              <td>{{$item['category']}}</td>
            </tr>
            <tr>
              <th>Colour</th>
              <td>{{$item['colour']}}</td>
            </tr>
            <tr>
              <th>Time Found</th>
              <td>{{$item['time_found']}}</td>
            </tr>
            <tr>
              <th>Place Found</th>
              <td>{{$item['place_found']}}</td>
            </tr>
            <tr>
              <th>Description</th>
              <td>{{$item['description']}}</td>
            </tr>
            <tr>
              <th>Image</th>
              <td>
                <img style="max-width:500px; max-height:500px" src="{{asset('storage/images/'.$item['image'])}}" alt="No Image">
              </td>
            </tr>
          </table>

          <!-- Buttons -->
          <div class="col-md-12 col-md-offset-4">
            <a href="{{route('items.index')}}" class="btn btn-primary" role="button">Back</a>
            @if(Gate::allows('isAdmin') || $item['user_id']==auth()->user()->id)
            <a href="{{action('ItemController@edit', $item['id'])}}" class="btn btn-warning">Edit</a>
            @endif
            <div class="float-right">
              <form action="{{action('ItemController@destroy', $item['id'])}}" method="post"> @csrf
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
