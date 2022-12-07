<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Sponsor;
use File;

class SponsorController extends Controller{
  public function __construct(){
    parent::__construct();
    //$this->middleware('adminAuth');
  }

  public function index(){
    $pageHeading = "Manage Sponsor";
    return view('admin.sponsor.index',compact('pageHeading'));
  }

  public function create(){
    $pageHeading = "Add Sponsor";
    return view('admin.sponsor.create',compact('pageHeading'));
  }

  public function edit(Request $request){
    $id = $request->segment(4);
    $pageHeading = "Update Sponsor";
    $sponsor = Sponsor::where(['id'=>$id])->first();
    return view('admin.sponsor.edit',compact('pageHeading','sponsor'));
  }

  public function store(Request $request){
    $image = $request->file('image');
    $validate['name'] = 'required';
    $validate['link'] = 'required|url';
    $validate['status'] = 'required';
    $validate['image'] = 'required|mimes:jpeg,png,jpg|max:51200';
    $messages = [];
    $attributes = ['name'=>'Sponsor Name','image'=>'Sponser Image'];
    $validator = Validator::make($request->all(),$validate,$messages,$attributes);
    if($validator->fails()){
      return redirect()->back()->withInput()->withErrors($validator->errors());
    }
    $insert = array();
    $insert['name'] = $request->name;
    $insert['link'] = $request->link;
    $insert['status'] = $request->status;
    if(!empty($image)){
      $destinationPath = public_path('images/sponsors');
      File::makeDirectory($destinationPath, $mode = 0777, true, true);
      $insert['image'] = time().'-'.'sponsor.'.$image->getClientOriginalExtension();
      $image->move($destinationPath, $insert['image']);
    }
    $sponsor = Sponsor::create($insert);
    return redirect(route('sponsor.index',app()->getLocale()))->with('success', 'Sponsor added successfully.');
  }

  public function update(Request $request){
    $id = $request->segment(4);
    $image = $request->file('image');
    $validate['name'] = 'required';
    $validate['link'] = 'required|url';
    $validate['status'] = 'required';
    if(!empty($image)){
      $validate['image'] = 'mimes:jpeg,png,jpg|max:51200';
    }
    $messages = [];
    $attributes = ['name'=>'Sponsor Name','image'=>'Sponser Image'];
    $validator = Validator::make($request->all(),$validate,$messages,$attributes);
    if($validator->fails()){
      return redirect()->back()->withInput()->withErrors($validator->errors());
    }
    $update = array();
    $update['name'] = $request->name;
    $update['link'] = $request->link;
    $update['status'] = $request->status;
    if(!empty($image)){
      $destinationPath = public_path('images/sponsors');
      File::makeDirectory($destinationPath, $mode = 0777, true, true);
      $update['image'] = time().'-'.'sponsor.'.$image->getClientOriginalExtension();
      $image->move($destinationPath, $update['image']);
      $this->removeNewsImage($id);
    }
    Sponsor::whereId($id)->update($update);
    return redirect(route('sponsor.index',app()->getLocale()))->with('success', 'Sponsor updated successfully.');
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

  public function getSponsor(Request $request){
    $search = $this->getSearchableFields($request->all());
    $columns = array(0=>'id', 1=>'name', 2=>'post_type', 3=>'status', 4=>'created_at', 5=>'id');

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    $temp =  Sponsor::query();
    if(count($search) > 0){
        $sh = (object)$search;
        if(!empty($sh->name)){
          $temp->where('sponsors.name','LIKE',"%{$sh->name}%");
        }
    }

    $temp->offset($start);
    $temp->limit($limit);
    $temp->orderBy($order,$dir);
    $temps = $temp->get(['sponsors.*']);
      $temp =  Sponsor::query();
      if(count($search) > 0){
        $sh = (object)$search;
        if(!empty($sh->name)){
          $temp->where('sponsors.name','LIKE',"%{$sh->name}%");
        }
      }
      $totalData  = $temp->count();
      $totalFiltered = $totalData;
    $data = array();
    if(!empty($temps)){
      foreach ($temps as $key=>$temp){
        $show =  route('sponsor.show', ['sponsor' => $temp->id, 'locale' => app()->getLocale()]);
        $edit =  route('sponsor.edit', ['sponsor' => $temp->id, 'locale' => app()->getLocale()]);
        $destroy = route('sponsor.destroy', ['sponsor' => $temp->id, 'locale' => app()->getLocale()]);
        $nestedData['sn'] = ($start+$key+1);
        $nestedData['sponsor_name'] = $temp->name;
        $nestedData['status'] = ($temp->status == '1')?langMessage('Active'):langMessage('Inactive');
        $nestedData['image'] = '<img src="'.asset('images/sponsors/'.$temp->image).'" alt="'.$temp->name.'" width="75" height="75">';
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
    $sponsor = Sponsor::findOrFail($id);
    if(!empty($sponsor->image)  && file_exists(public_path('images/sponsors/'.$sponsor->image))){
      @unlink(public_path('images/sponsors/'.$sponsor->image));
    }
    $sponsor->delete();
    return redirect(route('sponsor.index',app()->getLocale()))->with('success', 'Tag has been deleted successfully.');
  }

  public function removeNewsImage($sponsor_id){
    $sponsor = Sponsor::findOrFail($sponsor_id);
    if(!empty($sponsor->image)  && file_exists(public_path('images/sponsors/'.$sponsor->image))){
      @unlink(public_path('images/sponsors/'.$sponsor->image));
    }
  }
}
