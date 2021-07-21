@extends('user.layouts.master')

@section('title')

@endsection

@section('content')

@include('user.layouts.top_widgets')

<div class="row" style="margin-top: 3%;">

    <div class="col-md-6 col-sm-6">
        <!-- Message Board -->
        <div class="x_panel sg-shadow" style="background-color:#ECEEF9 ;">
          <div class="x_title">
            <h2><i class="fa fa-comment"></i> Message Board</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content" id="message">
            <ul class="list-unstyled timeline">
                @foreach ($message_boards as $message)
                <li>
                    <div class="block">
                      <div class="tags">
                        <a href="" class="tag">
                          <span>{{ $message->admin->username }}</span>
                        </a>
                      </div>
                      <div class="block_content">
                        <h2 class="title">
                            <a href="#" class="view_message" data-message_id="{{$message->id}}">{{ $message->title }}</a>
                        </h2>
                        <div class="byline">
                          <span>{{ $message->created_at->diffForHumans() }}</span>
                        </div>

                      </div>
                    </div>
                  </li>
                @endforeach
            </ul>
          </div>
        </div>
        <!-- /. Messaeg Board -->
      </div>


    <div class="col-md-6 col-sm-6">
        <!-- My Account Card -->
        <div class="x_panel sg-shadow" style="background-color:#ECEEF9 ;">
          <div class="x_title">
            <h2><i class="fa fa-user"></i> My Account</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div class="tab-content">
              <a href="{{route('add.money')}}" class="btn btn-lg btn-danger" style="padding: 2% 7%;"><i class="fa fa-plus-circle"></i> Add Balance</a>
              <a href="{{route('purchases')}}" class="btn btn-lg btn-success" style="padding: 2% 7%;"><i class="fa fa-shopping-cart"></i> My Orders</a>
              <a href="{{route('tickets')}}" class="btn btn-lg btn-success" style="padding: 2% 7%;"><i class="fa fa-comments-o"></i> Open Ticket</a>
            </div>
          </div>
        </div>
        <!-- /.My Account Card -->
      </div>
</div>

<!-- Modal - View Account Modal -->
    <div class="modal fade" id="viewMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Message Board</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <!-- Content Here -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
        </div>
      </div>


@endsection

@section('extra_script')

<script>
$(function(){
  $("a.view_message").on('click', function(e){
    e.preventDefault();
    var message_id = e.currentTarget.dataset.message_id;
    $.ajax({
      url: '/message/' + message_id,
      method: 'GET',
      success: function(res){
        $('#viewMessageModal .modal-body').empty();
        $('#viewMessageModal .modal-body').append(`
        <h2>${res.message.title}</h2>
        <p>${res.message.body}</p>
        <span>${moment(res.message.created_at).format("ddd, hA")}</span>
        `);
        $('#viewMessageModal').modal('show');
      }
    });
  });
});
</script>

@endsection
