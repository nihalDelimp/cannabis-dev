@if(!$users->isEmpty())
  <option value="">{{'select'}}</option>
  @foreach($users as $user)
    <option value="{{$user->id}}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
  @endforeach
@else
  <option value="">{{'no sales representatives found'}}</option>
@endif
