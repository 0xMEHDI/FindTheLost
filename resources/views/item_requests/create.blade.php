@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 ">
      <div class="card">
        <div class="card-header">Submit Item Request</div>

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

        <!-- Form -->
        <div class="card-body">
          <form class="form-horizontal" method="POST" action="{{url('item_requests') }}" enctype="multipart/form-data">
            @csrf

            <!-- Item ID -->
            <div class="col-md-12 form-group">
              <input readonly class="form-control" type="hidden" name="item_id" value="{{$item['id']}}" style="background-color:lightgrey;"/>
            </div>

            <!-- Item Name -->
            <div class="col-md-12 form-group">
              <input readonly class="form-control" type="text" name="item_name" value="{{$item['name']}}" style="background-color:lightgrey;"/>
            </div>

            <!-- Request Text -->
            <div class="col-md-12 form-group">
              <textarea class="form-control" name="request_text" placeholder="Request"></textarea>
              <small class="form-text text-muted float-right">Required</small>
            </div>

            <!-- Buttons -->
            <br />
            <hr />
            <div class="col-md-12 col-md-offset-4">
              <a href="{{route('items.index')}}" class="btn btn-primary">Back</a>
              <input type="reset" class="btn btn-warning" />
              <div class="float-right">
                <input type="submit" class="btn btn-primary" />
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
