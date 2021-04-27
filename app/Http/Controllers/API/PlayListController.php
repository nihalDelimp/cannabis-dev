<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PlayListController extends Controller{
  	public function __construct()
  	{
	    parent::__construct();
	    $this->response = $this->error = array();
	    $this->response['status'] = "0";
  	}

  	public function categoriesWithVideos()
  	{
  		$limit = request()->get('limit') ?? 0;
  		$page = request()->get('page') ?? 1;

  		$categories = Category::where('status', 1)
  			->with(['videos' => function($q) {
  				$q->select('id','category_id','title', 'sub_title', 'link_id', 'image', 'slug');
  			}])
  			->orderBy('id', 'desc')
  			->limit($limit)
  			->offset(($page - 1) * $page)
  			->get();

  		$categories = $categories->map(function($item, $key) {

  			$item->videos = $item->videos->map(function($video, $key) {
	  			$video->image_path = $video->image_path;
	  			return $video;
	  		});

  			return $item;
  		});

  		$this->response['status'] = "1";
		$this->response['data']['categories'] = $categories;

		$this->sendResponse($this->response);
  	}

  	public function featuredVideo()
  	{
  		if(!$video = Post::where('is_feature', '1')->first()) {
  			$this->response['status'] = "0";
  			$this->response['data']['error'] = $this->langError(["Sorry, there is no data to display."]);
			$this->sendResponse($this->response);
  		}
  		$video->image_path = $video->image_path;
  		$video->category_name = $video->category->title;
  		$video->user_name = 'John Smith';
  		$video->makeHidden('category');

  		$this->response['status'] = "1";
		$this->response['data']['video'] = $video;

		$this->sendResponse($this->response);
  	}

}