@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 ">
      <div class="card">
        <div class="card-header">Edit Item Report</div>

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
          <form class="form-horizontal" method="POST" action="{{ action('ItemController@update', $item['id']) }}" enctype="multipart/form-data" >
            @method('PATCH')
            @csrf

            <!-- Name -->
            <div class="col-md-12 form-group">
              <input class="form-control" type="text" name="name" placeholder="Name" value="{{$item['name']}}" />
              <small class="form-text text-muted float-right">Required</small>
            </div>

            <!-- Category -->
            <div class="col-md-12 form-group">
              <select class="form-control" type="text" name="category">
                <option value="pet" type="radio" {{ $item['category']=='Pet' ? 'selected' : '' }} >Pet</option>
                <option value="phone" type="radio" {{ $item['category']=='Phone' ? 'selected' : '' }} >Phone</option>
                <option value="jewellery" type="radio" {{ $item['category']=='Jewellery' ? 'selected' : '' }} >Jewellery</option>
              </select>
              <small class="form-text text-muted float-right">Required</small>
            </div>

            <!-- Colour -->
            <div class="col-md-12 form-group">
              <input class="form-control" type="text" name="colour" placeholder="Colour" value="{{$item['colour']}}" />
              <small class="form-text text-muted float-right">Required</small>
            </div>

            <!-- Time Found -->
            <div class="col-md-12 form-group">
              <input class="form-control" type="text" name="time_found" placeholder="Time Found" value="{{$item['time_found']}}" />
              <small class="form-text text-muted float-right">Required</small>
            </div>

            <br />

            <!-- Place Found -->
            <div class="col-md-12 form-group">
              <input class="form-control" type="text" name="place_found" placeholder="Place Found" value="{{$item['place_found']}}" />
            </div>

            <!-- Description -->
            <div class="col-md-12 form-group">
              <textarea class="form-control" name="description" placeholder="Description">{{$item['description']}}</textarea>
            </div>

            <!-- Image -->
            <div class="col-md-12 form-group">
              <label>Upload Image</label>
              <input class="form-control-file" type="file" name="image" placeholder="image" value="{{$item['image']}}" />
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
