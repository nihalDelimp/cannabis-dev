<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sponsor;

class AdvertisementController extends Controller{
  	public function __construct()
  	{
	    parent::__construct();
	    $this->response = $this->error = array();
	    $this->response['status'] = "0";
  	}

    public function getAdvertisement(Request $request){
      $advertisements = [];
      $limit = $request->limit;
      $advertisement = Sponsor::query();
      $advertisement->where('status','1');
      $advertisement->inRandomOrder();
      $advertisement->offset(0);
      $advertisement->limit($limit);
      $advertisements = $advertisement->get(['name','link','image']);
      if(count($advertisements)>0){
        foreach($advertisements as $advertisement){
          $advertisement->image = url('images/sponsors',$advertisement->image);
        }
      }
      $this->response['status'] = "1";
  		$this->response['data']['advertisements'] = $advertisements;
      $this->sendResponse($this->response);
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

	  		$videos_four = $item->videos->slice(0,4)->all();

	  		$item->videos_four = $videos_four;

	  		$item->makeHidden('videos');

  			return $item;
  		});

  	$this->response['status'] = "1";
		$this->response['data']['categories'] = $categories;
		$this->sendResponse($this->response);
  	}

}
