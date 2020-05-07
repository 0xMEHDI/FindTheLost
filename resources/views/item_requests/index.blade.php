@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">Item Requests</div>

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
          <!-- When viewing requests submitted by current user -->
          @if(Gate::denies('isAdmin'))
          <h6>Viewing your submitted requests</h6>
          <br />
          @endif

          <!-- Requests Table -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Request</th>
                <th>Approval Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($item_requests as $item_request)
              @if(Gate::allows('isAdmin') || $item_request['user_id']==auth()->user()->id)
              <tr>
                <td style="padding-top: 20px;">{{$item_request['item_name']}}</td>
                <td style="padding-top: 20px;">{{$item_request['request_text']}}</td>
                <td style="padding-top: 20px;">{{$item_request['approval_status']}}</td>
                <td>
                  @if(Gate::allows('isAdmin'))
                  <a href="{{action('ItemRequestController@show', $item_request['id'])}}" class="btn btn-primary">Details</a>
                  @else
                  <form action="{{action('ItemRequestController@destroy', $item_request['id'])}}" method="post"> @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
                  @endif
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
