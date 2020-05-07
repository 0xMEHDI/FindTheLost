<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Gate;

class ItemController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $items = Item::all()->toArray();
    return view('items.index', compact('items'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //If user is a guest
    $user = auth()->user();
    if(!isset($user))
    {
      return back()->with('error', 'Must be logged in');
    }

    return view('items.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //Validates item forms
    $item = $this->validate(request(),
    [
      'name' => 'required|string',
      'category' => 'required',
      'colour' => 'required|string',
      'time_found' => 'required|date_format:Y-m-d H:i:s',
      'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500'
    ]);

    //Handles image uploads
    if ($request->hasFile('image'))
    {
      $fileNameWithExt = $request->file('image')->getClientOriginalName();
      $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('image')->getClientOriginalExtension();
      $fileNameToStore = $filename.'_'.time().'.'.$extension;
      $path =$request->file('image')->storeAs('public/images', $fileNameToStore);
    }
    else
    {
      $fileNameToStore = 'noimage.jpg';
    }

    //Creates a Item object and  sets its values from the input
    $item = new Item;
    $item->name = $request->input('name');
    $item->category = $request->input('category');
    $item->colour = $request->input('colour');
    $item->time_found = $request->input('time_found');
    $item->place_found = $request->input('place_found');
    $item->description = $request->input('description');
    $item->image = $fileNameToStore;
    $item->user_id = auth()->user()->id;
    $item->user_name = auth()->user()->name;
    $item->created_at = now();

    //Save
    $item->save();
    return redirect('items')->with('success', 'Item report successfully submitted');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $user = auth()->user();
    if(!isset($user))
    {
      return back()->with('error', 'Must be logged in');
    }

    $item = Item::find($id);
    return view('items.show', compact('item'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //If user is a guest
    $user = auth()->user();
    if(!isset($user))
    {
      return back()->with('error', 'Must be logged in');
    }

    //If user is neither admin nor reported the item
    $item = Item::find($id);
    if($item['user_id']!=auth()->user()->id && Gate::denies('isAdmin'))
    {
      return back()->with('error', 'Can only edit your own reported items');
    }

    return view('items.edit', compact('item'));
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
    $item = Item::find($id);

    //Validates item forms
    $this->validate(request(),
    [
      'name' => 'required|string',
      'category' => 'required',
      'colour' => 'required|string',
      'time_found' => 'required|date_format:Y-m-d H:i:s',
      'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500'
    ]);

    //Handles image uploads
    if ($request->hasFile('image'))
    {
      $fileNameWithExt = $request->file('image')->getClientOriginalName();
      $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('image')->getClientOriginalExtension();
      $fileNameToStore = $filename.'_'.time().'.'.$extension;
      $path =$request->file('image')->storeAs('public/images', $fileNameToStore);
    }
    else
    {
      $fileNameToStore = 'noimage.jpg';
    }

    //Creates a Item object and  sets its values from the input
    $item->name = $request->input('name');
    $item->category = $request->input('category');
    $item->colour = $request->input('colour');
    $item->time_found = $request->input('time_found');
    $item->place_found = $request->input('place_found');
    $item->description = $request->input('description');
    $item->image = $fileNameToStore;
    $item->updated_at = now();

    //Save
    $item->save();
    return redirect('items')->with('success', 'Item report successfully updated');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $item = Item::find($id);
    $item->delete();
    return redirect('items')->with('success', 'Item report successfully deleted');
  }
}
