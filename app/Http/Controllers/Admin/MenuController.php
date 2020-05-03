<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;
use App\MenuPosition;
use App\Page;
use Str;
use Brian2694\Toastr\Facades\Toastr;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        $menuPositions = MenuPosition::where('is_active', 1)->get();
        $pages = Page::where('is_active', 1)->get();
        return view('admin.menu.index', compact('menus', 'menuPositions', 'pages'));
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

            'title' => 'required'
        ]);
        
        $slug = strtolower($request->title);

        $menu = new Menu();
        $menu->title = $request->title;
        $menu->slug = $slug;
        $menu->parent_id = $request->parent_id;
        $menu->menu_position_id = $request->menu_position_id;
        $menu->page_id = $request->page_id;
        $menu->url = $request->url;
        $menu->display_order = $request->display_order;
        $menu->description = $request->description;
        $menu->is_active = $request->is_active;
        $menu->save();

        Toastr::success('Menu Successfully Saved :)' ,'Success');

        return redirect()->route('admin.menu.index');
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
        $menu = Menu::find($id);
        // dd($menu);
        $menus = Menu::all();
        $menuPositions = MenuPosition::all();
        $pages = Page::all();
        return view('admin.menu.edit', compact('menu', 'menus', 'menuPositions', 'pages'));
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
        $this->validate($request, [

            'title' => 'required|unique:menus'
        ]);

        $menu = Menu::find($id);
        
        $slug = strtolower($request->title);

        $menu->title = $request->title;
        $menu->slug = $slug;
        $menu->parent_id = $request->parent_id;
        $menu->menu_position_id = $request->menu_position_id;
        $menu->page_id = $request->page_id;
        $menu->url = $request->url;
        $menu->display_order = $request->display_order;
        $menu->description = $request->description;
        $menu->is_active = $request->is_active;
        $menu->save();

        Toastr::success('Menu Successfully Saved :)' ,'Success');

        return redirect()->route('admin.menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::find($id)->delete();

        Toastr::success('Menu Successfully Deleted :)', 'Success');

        return redirect()->route('admin.menu.index');
    }

    public function unpublishedMenu($id){
        $menu = Menu::find($id);
        $menu->is_active = 0;
        $menu->save();
        Toastr::success('Menu Successfully Unpublished :)' ,'Success');
        return redirect()->back();
    }

    public function publishedMenu($id){
        $menu = Menu::find($id);
        $menu->is_active = 1;
        $menu->save();
        Toastr::success('Menu Successfully Published :)' ,'Success');
        return redirect()->back();
    }
}
