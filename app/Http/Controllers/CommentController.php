<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\CreateCommentuserRequest;

class CommentController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
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
  public function store(CreateCommentuserRequest $request)
  {
    DB::table('post_user_comment')->insert(
      [
        'post_id' => $request->pid,
       'user_id' => auth()->user()->id,
       'comment' => $request->comment,
       'created_at' =>  now(),
       'updated_at' =>  now(),
      ]
    );

    Session()->flash('success', 'บันทึกข้อมูลเรียบร้อย');
    return redirect()->back();
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
    if ($request->comment) {
      DB::table('post_user_comment')
            ->where('id', $id)
            ->update(['comment' => $request->comment, 'updated_at' => now()]);

      Session()->flash('success-comment', 'บันทึกข้อมูลเรียบร้อย');
      return redirect()->back();
    } else {
      Session()->flash('error-comment', 'กรุณาใส่ข้อความ');
      return redirect()->back();
    }
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    DB::table('post_user_comment')->where('id', '=', $id)->delete();
    Session()->flash('success-comment', 'ลบข้อมูลเรียบร้อย');
    return redirect()->back();
  }
}
