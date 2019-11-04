<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Tag;

class SearchController extends Controller
{
  function action(Request $request) {
    if ($request->ajax()) {
      $output = '';
      $path = url()->previous();
      $result = $request->get('query');
      if ($result) {
        if (strpos($path, 'tags') !== false) {
          $data = Tag::where('name', 'like', '%'.$result.'%')->orderBy('name', 'asc')->get();
        } elseif (strpos($path, 'categories') !== false) {
          $data = DB::table('categories')->where('name', 'like', '%'.$result.'%')->orderBy('name', 'asc')->paginate(10);
        } elseif (strpos($path, 'posts') !== false) {
          $data = DB::table('posts')->where(['name', 'like', '%'.$result.'%'], ['user_id', auth()->user()->id])->orderBy('name', 'asc')->paginate(10);
        }
      } else {
        if (strpos($path, 'tags') !== false) {
          $data = DB::table('tags')
          ->leftJoin('post_tag', 'tags.id', '=', 'post_tag.tag_id')
          ->select('tags.id', 'tags.name', DB::raw('COUNT(post_tag.tag_id) as ctag'))
          ->groupBy('tags.id', 'tags.name')
          ->orderBy('ctag', 'desc')
          ->get();
        } elseif (strpos($path, 'categories') !== false) {
          $data = DB::table('categories')->orderBy('name', 'asc')->paginate(10);
        } elseif (strpos($path, 'posts') !== false) {
          $data = DB::table('posts')->where('user_id', auth()->user()->id)->orderBy('name', 'asc')->paginate(10);
        }
      }
      $total = $data->count();
      if ($total > 0) {
        foreach ($data as $value) {
          $output .= '<tr>
          <td>&emsp;'.$value->name.'</td>
          <td class="text-center">'.$value->ctag.'</td>
          <td class="text-center">'."<a href=".route('tags.edit', ['tag' => $value->id])." class='btn btn-info btn-sm'>แก้ไข</a>".'</td>
          <td class="text-center">'.
            "<form class=\"delete_form\" action=".route('tags.destroy', ['tag' => $value->id])." method=\"post\">
              <input type=\"hidden\" name=\"_token\" value=\"".csrf_token()."\">
              <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
              <input type=\"submit\" value=\"ลบ\" class=\"btn btn-danger btn-sm\">
            </form>"
          .'</td>
          </tr>';
        }
      } else {
        $output = "<tr><td align='center' colspan='4'>ไม่พบข้อมูล</td></tr>";
      }
      $datanew = array('table_data' => $output, 'total_data' => $total);
      $json = json_encode($datanew);
      return $json;
    }
  }
}
