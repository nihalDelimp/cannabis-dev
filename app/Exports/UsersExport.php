<?php

namespace App\Exports;

use App\Models\EventJoinList;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $eventId;
    private $position;
    private $organization;
    private $participate;

    public function __construct($eventId,$position = null ,$organization = null, $participate = null) 
    {
        $this->eventId = $eventId;
        $this->position = $position;
        $this->organization = $organization;
        $this->participate = $participate;
    }
    public function collection()
    {
        $temp =  EventJoinList::where('event_id',$this->eventId);
        if(!empty($this->position)){
            $position = $this->position;
            $temp = $temp->whereHas('users', function($q) use($position){
              $q->where('position',$position);
            });
          }
          if(!empty($this->organization)){
            $organization = $this->organization;
            $temp = $temp->whereHas('users', function($q) use($organization) {
              $q->where('organization','LIKE',"%{$organization}%");
            });
          }
          
          if(isset($this->participate) && $this->participate != null){
            $temp = $temp->where('is_validate','LIKE',"%{$this->participate}%");
          }
          $temps = $temp->get();
          $nestedData = [];
          foreach($temps as $key => $temp){

            $position_user = null;
            if(array_key_exists($temp->users->position, config('userDetail.admin.user.positions') )) {
              if($temp->users->position != 9) {
                $position_user = config('userDetail.admin.user.positions')[$temp->users->position];
              } else {
                $position_user = $temp->users->other_position;
              }

              
            }
            $nestedData['sn'] = $key+1;
            $nestedData['name'] = $temp->users->name;
            $nestedData['email'] = $temp->users->email;
            $nestedData['phone'] = $temp->users->phone ? $temp->users->phone : "N/A";
            $nestedData['dob'] = $temp->users->dob ? Carbon::parse($temp->users->dob)->format('m-d-Y'): "N/A";
            $nestedData['organization'] = $temp->users->organization ? $temp->users->organization : "N/A";
            $nestedData['Insterested Status'] = $temp->users->insterested_status == 1? "Yes" : "No";
            $nestedData['position'] = $position_user ?$position_user :'N/A ';
            $nestedData['Instagram Name'] = $temp->users->instagram_name ? $temp->users->instagram_name : "N/A";
            $nestedData['Invited Owner'] = $temp->users->insterested_status == 1 ? "Yes" : "No";
            $nestedData['Alright user'] = $temp->is_validate == 1 ? "Yes" : "No";
            $data[] = $nestedData;
          }
         //dd($data);
        return collect($data);//$temps;
    }
    public function headings(): array
    {
        return [
          "S.N",
          "name",
          "email",
          "phone",
          "dob",
          "organization",
          "insterested_status",
          "position",
          "instagram_name",
          "invited_owner",
          "is_validate",
        ];
    }
}
