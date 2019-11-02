<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class MakeAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $results = User::where('role', 'admin')->orderBy('name', 'asc')->paginate(10);
      $rank = $results->firstItem();
      return view('admin.index', ['admins' => $results, 'rank' => $rank]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdminRequest $request)
    {
      if ($request->flag) {
        User::create([
            'name' => $request->name,
            'role' => 'admin',
            'role_pending' => 'admin',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Session()->flash('success', 'บันทึกข้อมูลเรียบร้อย');
        return redirect(route('admin.index'));
      } else {
        Session()->flash('error', 'กรุณาเข้าถึงให้ถูกวิธี');
        return back();
      }
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
    public function edit(User $admin)
    {
      return view('admin.create')->with('admin', $admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, User $admin)
    {
      if ($request->flag) {
        if (Hash::check($request->password, $admin->password)) {
          $data = $request->only(['name']);
          if ($request->status == 'approve') {
            $data['role'] = $request->role;
            $data['role_pending'] = ($request->role == 'admin')?'admin':'approve';
          } else {
            $data['role_pending'] = 'noapprove';
          }
        } else {
          Session()->flash('error', 'รหัสผ่านไม่ถูกต้อง');
          return back();
        }
      } else {
        Session()->flash('error', 'กรุณาเข้าถึงให้ถูกวิธี');
        return back();
      }

      $admin->update($data);
      Session()->flash('success', 'อัปเดตข้อมูลเรียบร้อย');
      return redirect(route('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        //
    }
}
