<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Template;
use File;

class TemplateController extends Controller{
 public function __construct(){
   parent::__construct();
   //$this->middleware('adminAuth');
 }

  public function index(){
    $this->subAdmin_accessDenied();
    $this->companyAdmin_accessDenied();
    $this->salesRep_accessDenied();
    $pageHeading = "Manage Email Templates";
    return view('admin.templates.index',compact('pageHeading'));
  }

  public function create(){
    $this->subAdmin_accessDenied();
    $this->companyAdmin_accessDenied();
    $this->salesRep_accessDenied();
    $pageHeading = "Add Email Template";
    return view('admin.templates.create',compact('pageHeading'));
  }

  public function store(Request $request){
    $validate['name'] = 'required|unique:templates';
    $validate['subject'] = 'required';
    $validate['hint'] = 'required';
    $validate['message_en'] = 'required';
    //$validate['message_ar'] = 'required';
    $messages = [];
    $attributes = ['message_en'=>'English Message','message_ar'=>'Arabic Message'];
    $validator = Validator::make($request->all(),$validate,$messages,$attributes);
    if($validator->fails()){
      return redirect()->back()->withInput()->withErrors($validator->errors());
    }
    $insert = array();
    $insert['name'] = $request->name;
    $insert['slug'] = $request->hint;
    $insert['subject'] = $request->subject;
    $insert['hint'] = $request->hint;
    $insert['message_en'] = $request->message_en;
    $insert['message_ar'] = $request->message_en;

    Template::create($insert);
    return redirect(route('template.index',app()->getLocale()))->with('success', 'Template is added successfully.');
  }

  public function show($id)
  {

  }

  public function edit(Request $request, $id){
    $this->subAdmin_accessDenied();
    $this->companyAdmin_accessDenied();
    $this->salesRep_accessDenied();
    $id = $request->segment(4);
    $pageHeading = "Update Template";
    $template = Template::findOrFail($id);
    return view('admin.templates.edit',compact('pageHeading','template'));
  }

 public function update(Request $request, $id){
   $id = $request->segment(4);
   $validate['name'] = 'required|unique:templates,name,'.$id;
   $validate['subject'] = 'required';
   $validate['hint'] = 'required';
   $validate['message_en'] = 'required';
   //$validate['message_ar'] = 'required';
   $messages = [];
   $attributes = ['message_en'=>'English Message','message_ar'=>'Arabic Message'];
   $validator = Validator::make($request->all(),$validate,$messages,$attributes);
   if($validator->fails()){
     return redirect()->back()->withInput()->withErrors($validator->errors());
   }
   $update = array();
   $update['name'] = $request->name;
   $update['slug'] = $request->hint;
   $update['subject'] = $request->subject;
   $update['hint'] = $request->hint;
   $update['message_en'] = $request->message_en;
   $update['message_ar'] = $request->message_en;

   Template::whereId($id)->update($update);
   return redirect(route('template.index',app()->getLocale()))->with('success', 'Template is successfully updated');
 }

 public function destroy(Request $request,$id){
   $id = $request->segment(4);
   $template = Template::findOrFail($id);
   $template->delete();
   return redirect(route('template.index',app()->getLocale()))->with('success', 'Template is deleted successfully.');
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

  public function getTemplates(Request $request){
    $search = $this->getSearchableFields($request->all());
    $columns = array(0=>'id', 1=>'name', 2=>'hint', 3=>'id');

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    $temp =  Template::query();
    if(count($search) > 0){
        $sh = (object)$search;
        if(!empty($sh->from_date) && !empty($sh->to_date) && $sh->from_date!=$sh->to_date){
          $temp->whereRaw('templates.updated_at >= ?', [$sh->from_date]);
          $temp->where('templates.updated_at','<=',[$sh->to_date]);
        }
        else if(!empty($sh->from_date) && !empty($sh->to_date) && $sh->from_date == $sh->to_date){
          $temp->where('templates.updated_at', 'like', '%'.getDateTime($sh->from_date,'Y-m-d').'%');
        }
        else if(!empty($sh->from_date)){
          $temp->where('templates.updated_at', '>=', $sh->from_date);
        }
        else if(!empty($sh->to_date)){
          $temp->where('templates.updated_at', '<=', $sh->to_date);
        }
        if(!empty($sh->name)){
          $temp->where('templates.subject','LIKE',"%{$sh->name}%");
        }
    }

    $temp->offset($start);
    $temp->limit($limit);
    $temp->orderBy($order,$dir);
    $temps = $temp->get(['templates.*']);
      $temp =  Template::query();
      if(count($search) > 0){
        $sh = (object)$search;
        if(!empty($sh->from_date) && !empty($sh->to_date) && $sh->from_date!=$sh->to_date){
          $temp->whereRaw('templates.updated_at >= ?', [$sh->from_date]);
          $temp->where('templates.updated_at','<=',[$sh->to_date]);
        }
        else if(!empty($sh->from_date) && !empty($sh->to_date) && $sh->from_date == $sh->to_date){
          $temp->where('templates.updated_at', 'like', '%'.getDateTime($sh->from_date,'Y-m-d').'%');
        }
        else if(!empty($sh->from_date)){
          $temp->where('templates.updated_at', '>=', $sh->from_date);
        }
        else if(!empty($sh->to_date)){
          $temp->where('templates.updated_at', '<=', $sh->to_date);
        }
        if(!empty($sh->name)){
          $temp->where('templates.subject','LIKE',"%{$sh->name}%");
        }
      }
      $totalData  = $temp->count();
      $totalFiltered = $totalData;
    $data = array();
    if(!empty($temps)){
      foreach ($temps as $key=>$temp){
        $show =  route('template.show', ['id' => $temp->id, 'locale' => app()->getLocale()]);
        $edit =  route('template.edit', ['id' => $temp->id, 'locale' => app()->getLocale()]);
        $destroy = route('template.destroy', ['id' => $temp->id, 'locale' => app()->getLocale()]);
        $nestedData['sn'] = ($start+$key+1);
        $nestedData['name'] = $temp->name;
        $nestedData['hint'] = $temp->hint;
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
}
