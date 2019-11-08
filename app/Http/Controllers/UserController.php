<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
  // user self edit profile
  public function selfEdit() {
    $id = auth()->user()->id;
    return view('users.user.selfuser')->with('user', User::where('id', $id)->first());
  }

  public function selfUpdate(Request $request, User $user) {
    $request->validate(
      ['name' => 'required|min:1|max:100'],
      ['name.required' => 'กรุณากรอกข้อมูล']
    );
    $user->update(['name' => $request->name]);
    Session()->flash('success', 'ดำเนินการเรียบร้อย');
    return redirect(route('users.status'));
  }

  // approve module
  public function approveIndex() {
    $results = User::where('role', 'pending')->where('role_pending', '!=', 'noapprove')->orderBy('created_at', 'asc')->paginate(10);
    $rank = $results->firstItem();
    return view('users.approve.index', ['users' => $results, 'rank' => $rank]);
  }

  public function approve(Request $request, User $user) {
    $user->update(['role' => $request->role, 'role_pending' => 'approve']);
    Session()->flash('success', 'ดำเนินการเรียบร้อย');
    return redirect(route('users.status'));
  }

  public function noapprove(User $user) {
    $user->update(['role_pending' => 'noapprove']);
    Session()->flash('success', 'ดำเนินการเรียบร้อย');
    return redirect(route('users.status'));
  }

  // setting user module
  public function detailIndex() {
    $results = User::where('role', '!=', 'admin')->orderBy('name', 'asc')->paginate(10);
    $rank = $results->firstItem();
    return view('users.user.index', ['users' => $results, 'rank' => $rank]);
  }

  public function search(Request $request) {
    $name = $request->name?$request->name:'';
    $type = $request->type?$request->type:'';
    $status = $request->status?$request->status:'';
    if ($status == 'pending') {
      $type1 = 'pending';
      if ($type != '') {
        $results = User::where([
          ['role', '!=', 'admin'],
          ['name', 'like', '%'.$name.'%'],
          ['role', 'like', '%'.$type1.'%'],
          ['role_pending', '=', $type],
          ])
          ->orderBy('name', 'asc')->paginate(10);
      } else {
        $results = User::where([
          ['role', '!=', 'admin'],
          ['name', 'like', '%'.$name.'%'],
          ['role', 'like', '%'.$type1.'%'],
          ['role_pending', '!=', 'noapprove'],
          ])
          ->orderBy('name', 'asc')->paginate(10);
      }
    } elseif ($status == 'approve') {
      $results = User::where([
        ['role', '!=', 'admin'],
        ['name', 'like', '%'.$name.'%'],
        ['role', 'like', '%'.$type.'%'],
        ['role_pending', '=', $status],
        ])
        ->orderBy('name', 'asc')->paginate(10);
    } else {
      if ($type != '' && $status == '') {
        $results = User::where([
          ['role', '!=', 'admin'],
          ['name', 'like', '%'.$name.'%'],
          ['role', 'like', '%'.$type.'%'],
          ])
          ->orWhere([
            ['role', '!=', 'admin'],
            ['name', 'like', '%'.$name.'%'],
            ['role_pending', 'like', '%'.$type.'%'],
            ])
          ->orderBy('name', 'asc')->paginate(10);
      } else {
        $results = User::where([
          ['role', '!=', 'admin'],
          ['name', 'like', '%'.$name.'%'],
          ['role', 'like', '%'.$type.'%'],
          ['role_pending', 'like', '%'.$status.'%'],
          ])
          ->orderBy('name', 'asc')->paginate(10);
      }
    }
    $rank = $results->firstItem();
    return view('users.user.index', ['users' => $results, 'rank' => $rank, 'sname' => $name, 'stype' => $type, 's_status' => $status]);
  }

  public function edit(User $user) {
    return view('users.user.edit')->with('user', $user);
  }

  public function update(UpdateUserRequest $request, User $user) {
    $role = $request->status;
    if ($role == 'noapprove') {
      $data = ['name' => $request->name, 'role' => 'pending', 'role_pending' => 'noapprove'];
    } elseif ($role == 'role_pick') {
      $data = ['name' => $request->name, 'role' => 'pending', 'role_pending' => $request->role];
    } else {
      $data = ['name' => $request->name, 'role' => $request->role, 'role_pending' => 'approve'];
    }
    $user->update($data);
    Session()->flash('success', 'อัปเดตข้อมูลเรียบร้อย');
    return redirect(route('users.detail'));
  }

  public function destroy(User $user)
  {
    $user->delete();
    Session()->flash('success', 'ลบข้อมูลเรียบร้อย');
    return redirect(route('users.detail'));
  }
}
