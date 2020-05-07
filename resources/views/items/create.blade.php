@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 ">
      <div class="card">
        <div class="card-header">Submit Item Report</div>

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
          <form class="form-horizontal" method="POST" action="{{url('items') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="col-md-12" class="form-group">
              <input class="form-control" type="text" name="name" placeholder="Name" />
              <small class="form-text text-muted float-right">Required</small>
            </div>

            <!-- Category -->
            <div class="col-md-12" class="form-group">
              <select class="form-control" type="text" name="category" >
                <option disabled selected value style="display:none">Select Category</option>
                <option value="pet">Pet</option>
                <option value="phone">Phone</option>
                <option value="jewellery">Jewellery</option>
              </select>
              <small class="form-text text-muted float-right">Required</small>
            </div>

            <!-- Colour -->
            <div class="col-md-12" class="form-group">
              <input class="form-control" type="text" name="colour" placeholder="Colour" />
              <small class="form-text text-muted float-right">Required</small>
            </div>

            <!-- Time Found -->
            <div class="col-md-12" class="form-group">
              <input class="form-control" type="text" name="time_found" placeholder="Time Found" />
              <small class="form-text text-muted float-right">Required</small>
            </div>

            <br /><br />

            <!-- Place Found -->
            <div class="col-md-12" class="form-group">
              <input class="form-control" type="text" name="place_found" placeholder="Place Found" />
            </div>
            <br />

            <!-- Description -->
            <div class="col-md-12" class="form-group">
              <textarea class="form-control" name="description" placeholder="Description"></textarea>
            </div>
            <br />

            <!-- Image -->
            <div class="col-md-12 form-group">
              <label>Upload Image</label>
              <input class="form-control-file" type="file" name="image" placeholder="image"/>
            </div>

            <!-- Buttons -->
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
