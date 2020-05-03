<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MenuPosition;
use Brian2694\Toastr\Facades\Toastr;

class MenuPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuPositions = MenuPosition::all();
        return view('admin.menu-position.index', compact('menuPositions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required'
        ]);

        $menuPosition = new MenuPosition();
        $menuPosition->name = $request->name;
        $menuPosition->alias = $request->alias;
        $menuPosition->code = $request->code;
        $menuPosition->description = $request->description;
        $menuPosition->is_active = $request->is_active;
        $menuPosition->is_default = $request->is_default;
        $menuPosition->save();

        Toastr::success('Menu Position Successfully Saved :)' ,'Success');

        return redirect()->route('admin.menu-position.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menuPosition = MenuPosition::find($id);
        $menuPositions = MenuPosition::all();
        return view('admin.menu-position.edit', compact('menuPosition', 'menuPositions'));
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
        $menuPosition = MenuPosition::find($id);

        $menuPosition->name = $request->name;
        $menuPosition->alias = $request->alias;
        $menuPosition->code = $request->code;
        $menuPosition->description = $request->description;
        $menuPosition->is_active = $request->is_active;
        $menuPosition->is_default = $request->is_default;
        $menuPosition->save();

        Toastr::success('Menu Position Successfully Updated :)', 'Success');

        return redirect()->route('admin.menu-position.index', compact('menuPosition'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MenuPosition::find($id)->delete();

        Toastr::success('Menu Position Successfully Deleted :)', 'Success');

        return redirect()->route('admin.menu-position.index');
    }

    public function unpublishedMenuPosition($id){
        $menuPosition = MenuPosition::find($id);
        $menuPosition->is_default = 0;
        $menuPosition->save();
        Toastr::success('Menu Position Successfully Unpublished :)' ,'Success');
        return redirect()->back();
    }

    public function publishedMenuPosition($id){
        $menuPosition = MenuPosition::find($id);
        $menuPosition->is_default = 1;
        $menuPosition->save();
        Toastr::success('Menu Position Successfully Published :)' ,'Success');
        return redirect()->back();
    }

    public function unpublishedMenuPositionActive($id){
        $menuPosition = MenuPosition::find($id);
        $menuPosition->is_active = 0;
        $menuPosition->save();
        Toastr::success('Menu Position Successfully Unpublished :)' ,'Success');
        return redirect()->back();
    }

    public function publishedMenuPositionActive($id){
        $menuPosition = MenuPosition::find($id);
        $menuPosition->is_active = 1;
        $menuPosition->save();
        Toastr::success('Menu Position Successfully Published :)' ,'Success');
        return redirect()->back();
    }
}
