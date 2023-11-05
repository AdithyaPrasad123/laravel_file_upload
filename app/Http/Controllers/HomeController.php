<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Register;

class HomeController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function doregister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048',
        ]);
        $data = $request->all();
        $path= 'asset/storage/images/'.$data['image'];
        $fileName = time().$request->file('image')->getClientoriginalName();
        $path=$request->file('image')->storeAs('image',$fileName,'public');
        $datas["image"]='/storage/'.$path;
        $data['image']=$fileName;
        Register::create($data);
        return redirect()->route('register')->with('success',"Registered");
    }
    public function view()
    {
        $data=Register::all();
        return view('view',compact('data'));
    }
    public function edit($id)
    {
        $row=Register::find($id);
        return view('edit',compact('row'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'image'=>'mimes:jpeg,jpg,png,gif|max:2024',
        ]);
        $data=Register::find($id);
        $data->name=$request->input('name');
        $data->price=$request->input('price');

        if($request->hasFile('image'))
        {
            $path= 'asset/storage/images/'.$data->image;
            if(File::exists('$path'))
            {
                File::delete($path);
            } 
            $fileName = time().$request->file('image')->getClientoriginalName();
            $path=$request->file('image')->storeAs('image',$fileName,'public');
            $datas["image"]='/storage/'.$path;
            $data->image=$fileName;
            $data->update();
        }
        $data->update();
        return redirect()->route('view')->with('success',"Updated");
    }
    public function delete($id)
    {
        $row=Register::find($id);
        if(!$row)
        {
            return redirect()->route('view')->with('success',"Something Went Wrong");
        }
        $row->delete();
        return redirect()->route('view')->with('success',"Deleted");
    }
}
