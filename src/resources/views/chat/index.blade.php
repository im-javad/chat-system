@extends('layouts.app')

@section('content')
<section class="gradient-custom">
  <div class="container py-5">
    <div class="row">
      <div class="alert alert-danger" role="alert">
        Please type your message adn then send!
      </div>
      <div class="col-md-6 col-lg-5 col-xl-5 mb-4 mb-md-0">
        <h5 class="font-weight-bold mb-3 text-center text-white">Online Users</h5>
        <div class="card mask-custom">
          <div class="card-body">
            <ul class="list-unstyled mb-0">
              @foreach ($onlineUsers as $user)
              <li class="p-2">
                <a href="#!" class="d-flex justify-content-between link-light">
                  <div class="d-flex flex-row">
                    <img src="https://th.bing.com/th/id/OIP.TSmyNYPpLJLvzpTeS4kF6wHaF2?pid=ImgDet&rs=1" alt="avatar"
                      class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                    <div class="pt-1">
                      <p class="fw-bold mb-0">{{$user->name}}</p>
                      <p class="small text-white">{{$user->email}}</p>
                    </div>
                  </div>
                  <div class="pt-1">
                    <span class="text-white float-end"><i class="fas fa-check" aria-hidden="true"></i></span>
                  </div>
                </a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-7 col-xl-7">
        <ul class="list-unstyled text-white">
          <div class="messages-body">
          @foreach ($allMessages as $message)
            <li class="d-flex justify-content-between mb-4" id="{{ $userMessage->contains('user_id' , $message->user_id) ? 'current-user' : ''}}">
              <img src="https://th.bing.com/th/id/OIP.TSmyNYPpLJLvzpTeS4kF6wHaF2?pid=ImgDet&rs=1" alt="avatar"
                class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
              <div class="card mask-custom">
                <div class="card-header d-flex justify-content-between p-3"
                  style="border-bottom: 1px solid rgba(255,255,255,.3);">
                  <p class="fw-bold mb-0">{{ $message->user->name }}</p>
                  <p class="text-light small mb-0"><i class="far fa-clock"></i> 12 mins ago</p>
                </div>
                <div class="card-body">
                  <p class="mb-0">
                    {{ $message->body }}
                  </p>
                </div>
              </div>
            </li>
          @endforeach
          </div>
          <li class="mb-3">
            <div class="form-outline form-white m-t-35" style="position: relative;">
              <textarea class="form-control message-body" id="message-body" rows="4" placeholder="Type..."></textarea>
              <label class="form-label" for="messageBody">Message</label>
            </div>
          </li>
          <button id="send-message" type="submit" class="btn btn-light btn-lg btn-rounded float-end">Send</button>
        </ul>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $('button#send-message').click(function(e){
        e.preventDefault();
        var message = $("#message-body").val();
        $.ajax({
          url: "{{ route('msg') }}",
          type:'POST',
          data: {_token: '{!! csrf_token() !!}' , message:message},
          success: function(response) {
            $('div.alert-danger').fadeOut(500);
            $('.messages-body').append(response);
          },
          error: function() {
            $('div.alert-danger').fadeIn(500);
          }
        });
      });
    });
  </script>
</section>
@endsection
