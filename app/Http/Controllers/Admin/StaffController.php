<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::all();
        return view('admin.staffs', compact('staffs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'      => 'required',
            'email'     => 'required|email|unique:staffs',
            'password'  => 'required',  
        ]);

        $staff              = new Staff();
        
        if($request->hasFile('gambar')){
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('uploads'), $imageName);
        }

        $staff->gambar       = $imageName;
        $staff->name        = $request->name;
        $staff->email       = $request->email;
        $staff->password    = Hash::make($request->password);
        $staff->role        = 'Staff';
        $staff->save();
        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $staff              = Staff::find($id);

        if($request->hasFile('gambar')){
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('uploads'), $imageName);
        }else{
            $imageName = $staff->gambar;
        }
     
        $staff->gambar      = $imageName;
        $staff->name        = $request->name;
        $staff->email       = $request->email;
        $staff->role        = 'Staff';
        $staff->update();
        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil diupdate');
    }

    public function destroy($id)
    {
        $staff = Staff::find($id);
        $staff->delete();
        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil dihapus');
    }
}
