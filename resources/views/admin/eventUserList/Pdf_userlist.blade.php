<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style type="text/css" media="all">
      /* .akh {
          background-color: red;
          width : 50% !important;
      }
      /* .akh {
        page-break-after: always;
      } */

  </style>
</head>
<body>
<table id="leads" class="akh table table-bordered table-hover" style="box-sizing:border-box; border:1px solid #c8c8c8;" cellspacing="0" cellpadding="0" border="0">
  <thead>
  <tr>
    
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >Sn.</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >Name</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >Email</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >Phone</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >Organization</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >DOB</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >Position</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >Instagram Name</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >Interested</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >Is participated user</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >Invited Owner</th>
  </tr>
  </thead>
  @foreach($temps as $key => $val)
    <tr>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >{{$key + 1}}</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >{{$val->users->name }}</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >{{$val->users->email }}</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >{{$val->users->phone }}</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >{{$val->users->organization }}</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >{{$val->users->dob }}</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >
      @if($val->users->position != 9) 
        {{ config('userDetail.admin.user.positions')[$val->users->position] }}
        @else 
        {{$val->users->other_position}}
      @endif
      
    </th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >{{$val->users->instagram_name}}</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >{{$val->users->insterested_status == 1 ? "Yes" : "No"}}</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >{{$val->is_validate == 1 ? "Yes" : "No" }}</th>
    <th style=" font-size:10px; font-family:Verdana, Geneva, sans-serif;text-align: center; border:1px solid"  >{{$val->users->invited_owner}}</th>
    
    </tr>
  @endforeach
</table>
</body>
</html>


