<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemRequest;
use App\Item;
use Gate;

class ItemRequestController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //If user a guest
    $user = auth()->user();
    if(!isset($user))
    {
      return back()->with('error', 'Must be logged in to view requests');
    }

    $item_requests = ItemRequest::all()->toArray();
    return view('item_requests.index', compact('item_requests'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create($item_id)
  {
    //If user a guest
    $user = auth()->user();
    if(!isset($user))
    {
      return back()->with('error', 'Must be logged in to create requests');
    }

    $item = Item::find($item_id);
    return view('item_requests.create', compact('item'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //Form validation
    $item_request = $this->validate(request(),
    [
      'item_id' => 'required|numeric',
      'item_name' => 'required|string',
      'request_text' => 'required|string'
    ]);

    //Creates new ItemRequest object and sets its fields
    $item_request = new ItemRequest;
    $item_request->item_id = $request->input('item_id');
    $item_request->item_name = $request->input('item_name');
    $item_request->request_text = $request->input('request_text');
    $item_request->approval_status = '1';
    $item_request->user_id = auth()->user()->id;
    $item_request->user_name = auth()->user()->name;
    $item_request->created_at = now();

    $item_request->save();
    return redirect('item_requests')->with('success', 'Item request successfully submitted');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //If user a guest
    $user = auth()->user();
    if(!isset($user))
    {
      return back()->with('error', 'Must be logged in');
    }

    //If user isn't an admin
    if (Gate::denies('isAdmin'))
    {
      return back()->with('error', 'Must be an administrator');
    }

    $item_request = ItemRequest::find($id);
    return view('item_requests.show', compact('item_request'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //If user a guest
    $user = auth()->user();
    if(!isset($user))
    {
      return back()->with('error', 'Must be logged in');
    }

    //If user isn't an admin
    if (Gate::denies('isAdmin'))
    {
      return back()->with('error', 'Must be an administrator');
    }

    $item_request = ItemRequest::find($id);
    return view('item_requests.edit', compact('item_request'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $item_request = ItemRequest::find($id);

    //Form validation
    $this->validate(request(),
    [
      'request_text' => 'required|string',
    ]);

    //Updates an existing ItemRequest object by setting its fields
    $item_request->request_text = $request->input('request_text');
    $item_request->updated_at = now();

    $item_request->save();
    return redirect('item_requests')->with('success', 'Item request successfully updated');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $item_request = ItemRequest::find($id);
    $item_request->delete();
    return redirect('item_requests')->with('success', 'Item request successfully deleted');
  }

  //Fetches all requests for the same item and disapproves all except the specified request
  public function approve($id)
  {
    $item_request = ItemRequest::find($id);
    $item_requests = ItemRequest::all()->where('item_id', $item_request->item_id);

    foreach ($item_requests as $item_req)
    {
      $item_req->approval_status = '3';
      $item_req->updated_at = now();
      $item_req->save();
    }

    $item_request->approval_status = '2';
    $item_request->updated_at = now();
    $item_request->save();

    return redirect('item_requests')->with('success', 'Item request successfully approved');
  }

  //Denies the specified request
  public function deny($id)
  {
    $item_request = ItemRequest::find($id);
    $item_request->approval_status = '3';
    $item_request->updated_at = now();
    $item_request->save();
    return redirect('item_requests')->with('success', 'Item request successfully denied');
  }
}
