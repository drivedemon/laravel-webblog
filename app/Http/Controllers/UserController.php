<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
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
