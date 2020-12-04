<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aboutus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutuss = Aboutus::all();
        return view('admin.aboutus.index',compact('aboutuss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.aboutus.create');
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
            'title' => 'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png',
        ]);


        $image = $request->file('image');
        $slug = str::slug($request->title,);
        // $aboutus = aboutus::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. 
            $image->getClientOriginalExtension();
            if (!file_exists('uploads/aboutus'))
            {
                mkdir('uploads/aboutus', 0777 , true);
            }
            $image->move('uploads/aboutus',$imagename);
        }else {
            $imagename = 'dafault.png';
        }
        $aboutus = new Aboutus();
        $aboutus->title = $request->title;
        $aboutus->image = $imagename;
        $aboutus->save();
        return redirect()->route('aboutus.index')->with('successMsg','aboutus Successfully Saved');
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
        $aboutus = Aboutus::find($id);
        return view('admin.aboutus.edit',compact('aboutus'));
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
            'title' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);


        $image = $request->file('image');
        $slug = str::slug($request->title);
        $aboutus = Aboutus::find($id);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. 
            $image->getClientOriginalExtension();
            if (!file_exists('uploads/aboutus'))
            {
                mkdir('uploads/aboutus', 0777 , true);
            }
            $image->move('uploads/aboutus',$imagename);
        }else {
             $imagename = $aboutus->image;
        }

        $aboutus->title = $request->title;
        $aboutus->image = $imagename;
        $aboutus->save();
        return redirect()->route('aboutus.index')->with('successMsg','aboutus Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aboutus = Aboutus::find($id);
        if (file_exists('uploads/aboutus/'.$aboutus->image))
        {
            unlink('uploads/aboutus/'.$aboutus->image);
        }
        $aboutus->delete();
        return redirect()->back()->with('successMsg','Aboutus Successfully Deleted');
    
    }
}
