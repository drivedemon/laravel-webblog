<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
  public function approveIndex() {
    return view('users.approve.index')->with('users', User::where('role', 'pending')->where('role_pending', '!=', 'noapprove')->orderBy('created_at', 'asc')->paginate(7));
  }

  public function approve(Request $request, User $user) {
    $user->update(['role' => $request->role, 'role_pending' => 'approve']);
    Session()->flash('success', 'ดำเนินการเรียบร้อย');
    return redirect(route('users.status'));
  }

  public function noapprove(Request $request, User $user) {
    $user->update(['role_pending' => 'noapprove']);
    Session()->flash('success', 'ดำเนินการเรียบร้อย');
    return redirect(route('users.status'));
  }
}
