<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('admin.menu.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'menu_title' => 'required',
            'menu_sub_title' => 'required',
            'menu_description' => 'required',
            'menu_price' => 'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png',
        ]);


        $image = $request->file('image');
        $slug = str::slug($request->menu_title);
        // $menu = menu::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. 
            $image->getClientOriginalExtension();
            if (!file_exists('uploads/menu'))
            {
                mkdir('uploads/menu', 0777 , true);
            }
            $image->move('uploads/menu',$imagename);
        }else {
            $imagename = 'dafault.png';
        }
        $menu = new menu();
        $menu->menu_title = $request->menu_title;
        $menu->menu_sub_title = $request->menu_sub_title;
        $menu->menu_description = $request->menu_description;
        $menu->menu_price = $request->menu_price;
        $menu->image = $imagename;
        $menu->save();
        return redirect()->route('menu.index')->with('successMsg','menu Successfully Saved');
    
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
        return view('admin.menu.edit',compact('menu'));
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
        $this->validate($request,[
            'menu_title' => 'required',
            'menu_sub_title' => 'required',
            'menu_description' => 'required',
            'menu_price' => 'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png',
        ]);


        $image = $request->file('image');
        $slug = str::slug($request->menu_title);
        $menu = Menu::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. 
            $image->getClientOriginalExtension();
            if (!file_exists('uploads/menu'))
            {
                mkdir('uploads/menu', 0777 , true);
            }
            $image->move('uploads/menu',$imagename);
        }else {
            $imagename = $menu->image;
        }

        $menu->menu_title = $request->menu_title;
        $menu->menu_sub_title = $request->menu_sub_title;
        $menu->menu_description = $request->menu_description;
        $menu->menu_price = $request->menu_price;
        $menu->image = $imagename;
        $menu->save();
        return redirect()->route('menu.index')->with('successMsg','menu Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $menu = Menu::find($id);
        if (file_exists('uploads/menu/'.$menu->image))
        {
            unlink('uploads/menu/'.$menu->image);
        }
        $menu->delete();
        return redirect()->back()->with('successMsg','Menu Successfully Deleted');
    
    }
}
