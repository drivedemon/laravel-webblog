<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
  function action(Request $request) {
    DB::enableQueryLog();
    if ($request->ajax()) {
      $output = '';
      $flagNdata = '';
      $path = url()->previous();
      $result = $request->get('query');
      if ($result) {
        if (strpos($path, 'tags') !== false) {
          $param = 'tag';
          $param_e = 'tags.edit';
          $param_d = 'tags.destroy';
          $data = DB::table('tags')
            ->leftJoin('post_tag', 'tags.id', '=', 'post_tag.tag_id')
            ->select('tags.id', 'tags.name', DB::raw('COUNT(post_tag.tag_id) as count_data'))
            ->groupBy('tags.id', 'tags.name')
            ->where('tags.name', 'like', '%'.$result.'%')
            ->orderBy('tags.name', 'asc')
            ->paginate(10);
        } elseif (strpos($path, 'categories') !== false) {
          $param = 'category';
          $param_e = 'categories.edit';
          $param_d = 'categories.destroy';
          $data = DB::table('categories')
            ->leftJoin('posts', 'categories.id', '=', 'posts.category_id')
            ->select('categories.id', 'categories.name', DB::raw('COUNT(posts.category_id) as count_data'))
            ->where('categories.name', 'like', '%'.$result.'%')
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('count_data', 'desc')
            ->paginate(10);
        } elseif (strpos($path, 'posts') !== false) {
          $param = 'post';
          $param_e = 'posts.edit';
          $param_d = 'posts.destroy';
          if (auth()->user()->Permission()) {
            $data = DB::table('posts')
            ->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'categories.name')
            ->where('title', 'like', '%'.$result.'%')
            ->orderBy('posts.title', 'asc')
            ->paginate(10);
          } else {
            $data = DB::table('posts')
            ->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'categories.name')
            ->where([['title', 'like', '%'.$result.'%'], ['user_id', auth()->user()->id],])
            ->orderBy('posts.title', 'asc')
            ->paginate(10);
          }
        }
      } else {
        if (strpos($path, 'tags') !== false) {
          $param = 'tag';
          $param_e = 'tags.edit';
          $param_d = 'tags.destroy';
          $data = DB::table('tags')
            ->leftJoin('post_tag', 'tags.id', '=', 'post_tag.tag_id')
            ->select('tags.id', 'tags.name', DB::raw('COUNT(post_tag.tag_id) as count_data'))
            ->groupBy('tags.id', 'tags.name')
            ->orderBy('count_data', 'desc')
            ->get();
        } elseif (strpos($path, 'categories') !== false) {
          $param = 'category';
          $param_e = 'categories.edit';
          $param_d = 'categories.destroy';
          $data = DB::table('categories')
            ->leftJoin('posts', 'categories.id', '=', 'posts.category_id')
            ->select('categories.id', 'categories.name', DB::raw('COUNT(posts.category_id) as count_data'))
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('count_data', 'desc')
            ->get();
        } elseif (strpos($path, 'posts') !== false) {
          $param = 'post';
          $param_e = 'posts.edit';
          $param_d = 'posts.destroy';
          if (auth()->user()->Permission()) {
            $data = DB::table('posts')
            ->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'categories.name')
            ->orderBy('posts.title', 'asc')
            ->get();
          } else {
            $data = DB::table('posts')
            ->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'categories.name')
            ->where('user_id', auth()->user()->id)
            ->orderBy('posts.title', 'asc')
            ->get();
          }
        }
      }
      $total = $data->count();
      if ($total > 0) {
        if ($param == 'post') {
          foreach ($data as $value) {
            $output .= "<tr>
            <td align=\"center\"><img src=\"storage/".$value->image."\" width=\"90px\" height=\"70px\"></td>
            <td>&emsp;".$value->title."<br>
              <small class=\"text-muted\">&emsp; - ".$value->description."</small></td>
            <td class=\"text-center\">"."<a href=".route('categories.edit', ['category' => $value->category_id])." >".$value->name."</a>"."</td>
            <td class=\"text-center\">"."<a href=".route($param_e, [$param => $value->id])." class='btn btn-info btn-sm'>แก้ไข</a>"."</td>
            <td class=\"text-center\">".
              "<form class=\"delete_form\" action=".route($param_d, [$param => $value->id])." method=\"post\">
                <input type=\"hidden\" name=\"_token\" value=\"".csrf_token()."\">
                <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                <input type=\"submit\" value=\"ลบ\" class=\"btn btn-danger btn-sm\">
              </form>"
            .'</td>
            </tr>';
          }
        } else {
          foreach ($data as $value) {
            $output .= '<tr>
            <td>&emsp;'.$value->name.'</td>
            <td class="text-center">'.$value->count_data.'</td>
            <td class="text-center">'."<a href=".route($param_e, [$param => $value->id])." class='btn btn-info btn-sm'>แก้ไข</a>".'</td>
            <td class="text-center">'.
              "<form class=\"delete_form\" action=".route($param_d, [$param => $value->id])." method=\"post\">
                <input type=\"hidden\" name=\"_token\" value=\"".csrf_token()."\">
                <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                <input type=\"submit\" value=\"ลบ\" class=\"btn btn-danger btn-sm\">
              </form>"
            .'</td>
            </tr>';
          }
        }
      }
      $datanew = array('table_data' => $output, 'total_data' => $total);
      $json = json_encode($datanew);
      return $json;
    }
  }
}
