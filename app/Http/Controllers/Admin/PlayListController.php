<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use File;
use ImageResize;
use Carbon\Carbon;

class PlayListController extends Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$pageHeading = "Play-list Categories";
		$categories = Category::where(['post_type'=>'2','status'=>'1'])->get();
    	return view('admin.play-list.index',compact('pageHeading','categories'));
	}

	public function view($locale, $id)
	{
		if(!$category = Category::find($id)) {

		}
		$pageHeading = $category->title." Videos";
		$videos = $category->videos;
		return view('admin.play-list.videos',compact('pageHeading','videos'));
	}

	public function dataTable()
	{
	    $categories = Category::where(['post_type'=>'2','status'=>'1'])->get();

	    $categories = $categories->map(function ($item, $key) {

	    	$item->sn = $key + 1;
	    	$item->options = "&nbsp;&nbsp;<a href=".route('play.list.view', ['id'=>$item->id, 'locale'=>app()->getLocale()])." class='btn btn-warning'><i class='fa fa-eye' aria-hidden='true'></i></a>";
	    	$item->video_count = $item->videos->count();
	    	$item->created = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at, config('app.timezone'))->format('Y, F d');
		    return $item;
		});

		$totalData  = $categories->count();

	    $json_data = array(
		       	"draw"            => intval(request()->input('draw')),
			    "recordsTotal"    => intval($totalData),
			    "recordsFiltered" => intval($totalData),
			    "data"            => $categories
	    );

	    return response()->json($json_data);
	}

	public function sort()
	{
		foreach(request()->get('item') as $key => $id) {

			$video = Post::find($id);
			$video->sort = $key;
			$video->save();
		}

		$data = [
			'error' => false,
			'message' => 'Rearranged Successfully',
		];
		return response()->json(compact('data'));
	}

}