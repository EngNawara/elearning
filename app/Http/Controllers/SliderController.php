<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sliders = Slider::all();
        // dd($sliders);
        return view('sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //'title','description','image','status'
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/Slider'), $imageName);
            $slider->image = 'storage/Slider/' . $imageName;
        }
        $slider->save();

        return redirect()->route('slider.index')->with('success', 'Slider Created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $slider = Slider::find($id);
        return view('sliders.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title'=>'nullable',
            'description'=>'nullable',
            'status' => 'nullable',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->status = $request->status;
        $slider->description = $request->description;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/Slider'), $imageName);
            $slider->image = 'storage/Slider/' . $imageName;
        }
        $slider->save();
        return redirect()->route('slider.index')->with('success', 'Slider Updates Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
