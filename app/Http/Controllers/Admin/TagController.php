<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Tag;

class TagController extends Controller{
  public function __construct(){
    parent::__construct();
    //$this->middleware('adminAuth');
  }

  public function index(){
    $pageHeading = "Manage Tag";
    return view('admin.tag.index',compact('pageHeading'));
  }

  public function create(){
    $pageHeading = "Add Tag";
    return view('admin.tag.create',compact('pageHeading'));
  }

  public function edit(Request $request){
    $id = $request->segment(4);
    $pageHeading = "Update Tag";
    $tag = Tag::where(['id'=>$id])->first();
    return view('admin.tag.edit',compact('pageHeading','tag'));
  }

  public function store(Request $request){
    $validate['title'] = 'required|unique:tags';
    $validate['post_type'] = 'required';
    $validate['status'] = 'required';
    $messages = [];
    $attributes = ['post_type'=>'Type'];
    $validator = Validator::make($request->all(),$validate,$messages,$attributes);
    if($validator->fails()){
      return redirect()->back()->withInput()->withErrors($validator->errors());
    }
    $insert = array();
    $insert['title'] = $request->title;
    $insert['slug'] = Str::slug($request->title, '-');
    $insert['post_type'] = $request->post_type;
    $insert['status'] = $request->status;
    $news = Tag::create($insert);
    return redirect(route('tag.index',app()->getLocale()))->with('success', 'Tag added successfully.');
  }

  public function update(Request $request){
    $id = $request->segment(4);
    $validate['title'] = 'required|unique:tags,title,'.$id;
    $validate['post_type'] = 'required';
    $validate['status'] = 'required';
    $messages = [];
    $attributes = ['post_type'=>'Type'];
    $validator = Validator::make($request->all(),$validate,$messages,$attributes);
    if($validator->fails()){
      return redirect()->back()->withInput()->withErrors($validator->errors());
    }
    $update = array();
    $update['title'] = $request->title;
    $update['slug'] = Str::slug($request->title, '-');
    $update['post_type'] = $request->post_type;
    $update['status'] = $request->status;
    Tag::whereId($id)->update($update);
    return redirect(route('tag.index',app()->getLocale()))->with('success', 'Tag updated successfully.');
  }

  public function getSearchableFields($request){
    $search = [];
    $searchableFields = ['name','subject','from_date','to_date'];
    foreach($searchableFields as $field){
      if(!empty($request[$field])){
        $search[$field] = $request[$field];
      }
    }
    return $search;
  }

  public function getTag(Request $request){
    $search = $this->getSearchableFields($request->all());
    $columns = array(0=>'id', 1=>'title', 2=>'post_type', 3=>'status', 4=>'created_at', 5=>'id');

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    $temp =  Tag::query();
    if(count($search) > 0){
        $sh = (object)$search;
        if(!empty($sh->name)){
          $temp->where('tags.title','LIKE',"%{$sh->name}%");
        }
    }

    $temp->offset($start);
    $temp->limit($limit);
    $temp->orderBy($order,$dir);
    $temps = $temp->get(['tags.*']);
      $temp =  Tag::query();
      if(count($search) > 0){
        $sh = (object)$search;
        if(!empty($sh->name)){
          $temp->where('tags.title','LIKE',"%{$sh->name}%");
        }
      }
      $totalData  = $temp->count();
      $totalFiltered = $totalData;
    $data = array();
    if(!empty($temps)){
      foreach ($temps as $key=>$temp){
        $show =  route('tag.show', ['tag' => $temp->id, 'locale' => app()->getLocale()]);
        $edit =  route('tag.edit', ['tag' => $temp->id, 'locale' => app()->getLocale()]);
        $destroy = route('tag.destroy', ['tag' => $temp->id, 'locale' => app()->getLocale()]);
        $nestedData['sn'] = ($start+$key+1);
        $nestedData['name'] = $temp->title;
        $nestedData['post_type'] = ($temp->post_type == '1')?langMessage('News'):langMessage('Video');
        $nestedData['status'] = ($temp->status == '1')?langMessage('Active'):langMessage('Inactive');
        $nestedData['created_at'] = $this->getDateTime($temp->created_at,'Y, F d');
        $nestedData['options'] = "";
        $nestedData['options'] .= "&nbsp;&nbsp;<a href='{$edit}' class='btn btn-warning'><i class='fa fa-pencil' aria-hidden='true'></i></a>";
        $nestedData['options'] .= "&nbsp;&nbsp;<form style='display:inline-block;' action='{$destroy}' method='post'>
          <input type='hidden' name='_token' value='".csrf_token()."'>
          <input type='hidden' name='_method' value='DELETE'>
          <button type='submit' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'><i class='fa fa-trash' aria-hidden='true'></i></button>
        </form>";
        $data[] = $nestedData;
      }
    }

    $json_data = array(
    "draw"            => intval($request->input('draw')),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
    );
    echo json_encode($json_data);
  }

  public function destroy(Request $request){
    $id = $request->segment(4);
    $tag = Tag::findOrFail($id);
    $tag->posts()->detach();
    $tag->delete();
    return redirect(route('category.index',app()->getLocale()))->with('success', 'Tag has been deleted successfully.');
  }
}
