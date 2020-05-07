@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          <div class="col-md-12 col-md-offset-4">
            <a href="{{route('items.index')}}" class="btn btn-primary">Browse Items</a>
            <a href="{{route('item_requests.index')}}" class="btn btn-primary">Browse Requests</a>
            <a href="{{ route('logout') }}" class="btn btn-danger float-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >{{ __('Logout') }} </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
