@if(!$comments->isEmpty())
  @foreach($comments as $comment)
  <div class="box-comment user-box-comment">
    <img class="img-circle img-sm" src="{{ url('profile/dummy-profile-image.jpg') }}">
    <div class="comment-text">
          <span class="username">
            {{$comment->name}}
            <span class="text-muted">(
              @if($comment->role == 1)
                {{langMessage('Super Admin')}}
              @elseif($comment->role == 2)
                {{langMessage('Sub Admin')}}
              @elseif($comment->role == 3)
                {{langMessage('Company Admin')}}
              @else
                {{langMessage('Sales Representative')}}
              @endif)
            </span>
            <span class="text-muted pull-right">{{getDateTime($comment->created_at,'Y-m-d  h:i A')}}</span>
          </span><!-- /.username -->
      {{$comment->comment}}
    </div>
  </div>
  @endforeach
@else
<div class="box-comment">
  <div class="comment-text">
    {{langMessage('No comments found')}}
  </div>
</div>
@endif
