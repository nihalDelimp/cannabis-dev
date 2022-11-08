<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\EventJoinList;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageHeading = "Manage Users";
        $users = User::all();
        return view('admin.users.index',compact('pageHeading','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageHeading = "Create Users";
        $events = Event::get();
        return view('admin.users.create',compact('pageHeading','events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $insert = [];
        $insert = [
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
            'phone'=> $request->phone,
            'dob'=> $request->dob,
            'position'=> $request->position,
            'organization'=> $request->organization,
            'instagram_name'=> $request->instagram_name,
            'invited_owner'=> 1,
            'insterested_status'=> 1,
        ];
        $user = User::create($insert);
        return redirect(route('users.index',app()->getLocale()))->with('success','User create successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id, User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id, User $user)
    {
        $pageHeading = "Update Users";
        
        return view('admin.users.edit',compact('pageHeading','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateUserRequest $request, User $user)
    {
        //dd($request->all());
        $user->update($request->all());
        return redirect(route('users.index',app()->getLocale()))->with('success', 'Users is successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, User $user)
    {
       $user->delete();
       return redirect(route('users.index',app()->getLocale()))->with('success','User Delete successfully.');
    }
    
    public function getSearchableFields($request){
        // dd($search['insterested_status']);
        $search = [];

        $searchableFields = ['name','email','phone','organization','position','instagram_name','insterested_status'];
        foreach($searchableFields as $field){
          if(isset($request[$field])){
            //echo $request[$field]."</br>";
            $search[$field] = $request[$field];
           
          }
        }
        // dd($search);
        return $search;
      }
      public function getRegisturSearchableFields($request){
        //event_id ,participate,position,organization,insterested_status
        $search = [];

        $searchableFields = ['event_id','participate','position','organization','insterested_status'];
        // $searchableFields = ['name','email','phone','organization','position','instagram_name','insterested_status'];
        foreach($searchableFields as $field){
          if(isset($request[$field])){
            //echo $request[$field]."</br>";
            $search[$field] = $request[$field];
           
          }
        }
        //dd($search);
        return $search;
      }
    public function getUsers(Request $request){
        $search = $this->getSearchableFields($request->all());
    //    ;name`, `email`, `phone`, `organization`, `dob`, `position`, `instagram_name`, `insterested_status`, `invited_owner`,
    //     `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`
        $columns = array(
            0=>'id', 1=>'name', 2=>'email', 3=>'phone', 4=>'organization', 5=>'dob',
            6=>'position', 7=>'instagram_name', 8=>'insterested_status', 9=>'password',
             10=>'created_at', 11=>'updated_at');
    
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        //dd($request->input('order.0.column'));
        $dir = $request->input('order.0.dir');
    
        $temp =  User::where('role','!=',1);
        //dd(count($search));//User::where('role','!=',1);
        if(count($search) > 0){
            $sh = (object)$search;
    
          //dd($sh);
            if(!empty($sh->name)){
              $temp->where('users.name','LIKE',"%{$sh->name}%");
            }
            if(isset($sh->insterested_status)){
              $temp->where('users.insterested_status','=',$sh->insterested_status);
            }
            // if(!empty($sh->user_id)){
            //   $temp->where('events.user_id','=',$sh->user_id);
            // }
        }
        //$temp->where('posts.post_type','=','1');
        $temp->offset($start);
        $temp->limit($limit);
        $temp->orderBy($order,$dir);
        $temps = $temp->get();
        $totalData  = User::where('role','!=',1)->get()->count();
        $totalFiltered = $totalData;
        $data = array();
        
        if(!empty($temps)){
          foreach ($temps as $key=>$temp){
           //$show =  route('events.show', ['events' => $temp->id, 'locale' => app()->getLocale()]);
            $destroy = route('users.destroy', [app()->getLocale(),$temp->id]);
            $edit =  route('users.edit', [ app()->getLocale(),$temp->id]);
            $nestedData['sn'] = ($start+$key+1);
            $nestedData['name'] = $temp->name;
            $nestedData['email'] = $temp->email;
            $nestedData['phone'] = $temp->phone ? $temp->phone : "N/A";
            $nestedData['dob'] = $temp->dob ? Carbon::parse($temp->dob)->format('m-d-Y'): "N/A";
            $nestedData['organization'] = $temp->organization ? $temp->organization : "N/A";
            $nestedData['insterested_status'] = $temp->insterested_status == 1? "Yes" : "No";
            $nestedData['position'] = $temp->position ? $temp->position : "N/A";
            $nestedData['instagram_name'] = $temp->instagram_name ? $temp->instagram_name : "N/A";
            $nestedData['invited_owner'] = $temp->invited_owner == 1 ? "Yes" : "No";
            
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
    public function getRegisteredUsers(Request $request){
      
      $search = $this->getRegisturSearchableFields($request->all());
      // dd();
      if($request['event_id'] != null) {
        $columns = array(
            0=>'id', 1=>'name', 2=>'email', 3=>'phone', 4=>'organization', 5=>'dob',
            6=>'position', 7=>'instagram_name', 8=>'insterested_status', 9=>'password',
             10=>'created_at', 11=>'updated_at');
    
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        // echo $start ."--dkf</br>";
        // dd($request->input('order.0.column'));
        $dir = $request->input('order.0.dir');
    
        $temp =  EventJoinList::where('event_id',$search['event_id']);
        if(count($search) > 0){
            $sh = (object)$search;
            //dd( $sh);
            if(!empty($sh->position)){
              $position = $sh->position;
              // $temp->where('users.position','LIKE',"%{$sh->position}%");
              $temp = $temp->whereHas('users', function($q) use($position){
                $q->where('position',$position);
                // $q->where('position','LIKE',"%{$position}%");
              });
              //dd($temp->count());
            }
            if(!empty($sh->organization)){
              $organization = $sh->organization;
              $temp = $temp->whereHas('users', function($q) use($organization) {
                $q->where('organization','LIKE',"%{$organization}%");
              });
            }
            
            if(isset($sh->participate) && $sh->participate != null){
              $temp = $temp->where('is_validate','LIKE',"%{$sh->participate}%");
              // echo $sh->participate;
              // dd( $temp->get()->count());
            } 
        }
        $temp->offset($start);
        $temp->limit($limit);
        $temp->orderBy($order,$dir);
        $temps = $temp->get();
        $totalData  = $temps->count();
        $totalFiltered = $totalData;
        $data = array();
        
        if(!empty($temps)){
          foreach ($temps as $key=>$temp){
           //$show =  route('events.show', ['events' => $temp->id, 'locale' => app()->getLocale()]);
            // $destroy = route('users.destroy', [app()->getLocale(),$temp->id]);
            // $edit =  route('users.edit', [ app()->getLocale(),$temp->id]);
            // echo $temp->users->position;
            // echo config('userDetail.admin.user.positions')[$temp->users->position];
            //dd(config('userDetail.admin.user.positions'));
            $position_user = null;
            //dd($position_user = config('userDetail.admin.user.positions')[$temp->users->position]);
          
            if(array_key_exists($temp->users->position, config('userDetail.admin.user.positions') )) {
              if($temp->users->position != 9) {
                $position_user = config('userDetail.admin.user.positions')[$temp->users->position];
              } else {
                $position_user = $temp->users->other_position;
              }

              
            }
            
            

            $nestedData['sn'] = ($start+$key+1);
            $nestedData['name'] = $temp->users->name;
            $nestedData['email'] = $temp->users->email;
            $nestedData['phone'] = $temp->users->phone ? $temp->users->phone : "N/A";
            $nestedData['dob'] = $temp->users->dob ? Carbon::parse($temp->users->dob)->format('m-d-Y'): "N/A";
            $nestedData['organization'] = $temp->users->organization ? $temp->users->organization : "N/A";
            $nestedData['insterested_status'] = $temp->users->insterested_status == 1? "Yes" : "No";
            $nestedData['position'] = $position_user ?$position_user :'N/A ';
            $nestedData['instagram_name'] = $temp->users->instagram_name ? $temp->users->instagram_name : "N/A";
            $nestedData['invited_owner'] = $temp->users->insterested_status == 1 ? "Yes" : "No";
            $nestedData['is_validate'] = $temp->is_validate == 1 ? "Yes" : "No";
            
            // $nestedData['options'] = "";
            // $nestedData['options'] .= "&nbsp;&nbsp;<a href='{$edit}' class='btn btn-warning'><i class='fa fa-pencil' aria-hidden='true'></i></a>";
            // $nestedData['options'] .= "&nbsp;&nbsp;<form style='display:inline-block;' action='{$destroy}' method='post'>
            //   <input type='hidden' name='_token' value='".csrf_token()."'>
            //   <input type='hidden' name='_method' value='DELETE'>
            //   <button type='submit' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'><i class='fa fa-trash' aria-hidden='true'></i></button>
            // </form>";
            $data[] = $nestedData;
          }
        }
      } else {
        $totalData = 0;
        $totalFiltered = 0;
        $data = [];
      }
    
        $json_data = array(
        "draw"            => intval($request->input('draw')),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data
        );
        echo json_encode($json_data);
    }
    public function downloadPdf(Request $request){
      // dd($request->all());
      $temp =  EventJoinList::where('event_id',$request['event_id']);
      if(!empty($request->position)){
        $position = $request->position;
        // $temp->where('users.position','LIKE',"%{$sh->position}%");
        $temp = $temp->whereHas('users', function($q) use($position){
          $q->where('position',$position);
          // $q->where('position','LIKE',"%{$position}%");
        });
        //dd($temp->count());
      }
      if(!empty($request->organization)){
        $organization = $request->organization;
        $temp = $temp->whereHas('users', function($q) use($organization) {
          $q->where('organization','LIKE',"%{$organization}%");
        });
      }
      
      if(isset($request->participate) && $request->participate != null){
        $temp = $temp->where('is_validate','LIKE',"%{$request->participate}%");
      }
      $temps = $temp->get();
      //dd($temps);
      $count = $temp->get()->count();
      $pdf = Pdf::loadView('admin.eventUserList.Pdf_userlist',compact('temps','count'))->setOptions(['defaultFont' => 'sans-serif']);
      return $pdf->download('user_list.pdf');
      //dd($temp->get()->count());
    }
}
