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
  				$q->select('id','category_id','title', 'sub_title', 'link_id')
  				->skip(0)
  				->take(5);
  			}])
  			->orderBy('id', 'desc')
  			->limit($limit)
  			->offset(($page- 1) * $page)
  			->get();

  		$this->response['status'] = "1";
		$this->response['data']['categories'] = $categories;

		$this->sendResponse($this->response);
  	}

}