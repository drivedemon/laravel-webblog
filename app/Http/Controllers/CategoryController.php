<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return view('categories.index');
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('categories.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(CreateCategoryRequest $request)
  {
    Category::create(['name'=>$request->name]);
    Session()->flash('success', 'บันทึกข้อมูลเรียบร้อย');
    return redirect(route('categories.index'));
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
  public function edit(Category $category)
  {
    return view('categories.create')->with('category', $category);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(UpdateCategoryRequest $request, Category $category)
  {
    $category->update(['name' => $request->name]);
    Session()->flash('success', 'อัปเดตข้อมูลเรียบร้อย');
    return redirect(route('categories.index'));
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy(Category $category)
  {
    if ($category->post()->count() > 0) {
      Session()->flash('error', 'ไม่สามารถลบได้ เนื่องจากมีบทความใช้งานอยู่');
      return back();
    }
    $category->delete();
    Session()->flash('success', 'ลบข้อมูลเรียบร้อย');
    return redirect(route('categories.index'));
  }
}
