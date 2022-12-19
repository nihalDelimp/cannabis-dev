<?php

namespace App\Exports;

use App\Models\EventJoinList;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExportCSV implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $name;
    private $position;
    private $organization;
    private $insterested_status;

    public function __construct($name = null,$position = null ,$organization = null, $insterested_status = null) 
    {
      $this->name = $name;
      $this->position = $position;
      $this->organization = $organization;
      $this->insterested_status = $insterested_status;
    }
    public function collection()
    {
        $temp =  User::where('role',2);
        if(!empty($this->name)){
          $name = $this->name;
          $temp = $temp->where('name','LIKE',"%{$name}%");
            
        }
        if(!empty($this->position)){
            $position = $this->position;
            $temp = $temp->where('position',$position);
            
          }
          if(!empty($this->organization)){
            $organization = $this->organization;
            $temp = $temp->where('organization','LIKE',"%{$organization}%");
            
          }
          
          if(isset($this->insterested_status) && $this->insterested_status != null){
            $temp = $temp->where('insterested_status','LIKE',"%{$this->insterested_status}%");
          }
          $temps = $temp->get();
          $nestedData = [];
          foreach($temps as $key => $temp){

            $position_user = null;
            if($temp->position != 9) {
                $position_user = config('userDetail.admin.user.positions')[$temp->position];
              } else {
                $position_user = $temp->other_position;
              }

              
            
            $nestedData['sn'] = $key+1;
            $nestedData['name'] = $temp->name;
            $nestedData['email'] = $temp->email;
            $nestedData['phone'] = $temp->phone ? $temp->phone : "N/A";
            $nestedData['dob'] = $temp->dob ? Carbon::parse($temp->dob)->format('m-d-Y'): "N/A";
            $nestedData['organization'] = $temp->organization ? $temp->organization : "N/A";
            // $nestedData['Insterested Status'] = $temp->insterested_status == 1? "Yes" : "No";
            $nestedData['position'] = $position_user ?$position_user :'N/A ';
            $nestedData['Instagram Name'] = $temp->instagram_name ? $temp->instagram_name : "N/A";
            $nestedData['Invited Owner'] = !empty($temp->invited_owner) ? $temp->invited_owner : 'N/A';
            $nestedData['Content with us'] = $temp->insterested_status == 1 ? "Yes" : "No";
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
          // "insterested_status",
          "position",
          "instagram_name",
          "invited_owner",
          "Content with us",
        ];
    }
}
