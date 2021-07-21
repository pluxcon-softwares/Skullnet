@extends('admin.layouts.admin-master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @include('admin.partials.top_widgets')

    <div class="row mt-5">

        <div class="col-md-12 col-sm-12 mt-0">
            <div class="x_panel">
                <div class="x_title">
                  <h2>Message Board</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-sm-3 mail_list_column">
                      <button id="compose_message" class="btn btn-sm btn-success btn-block" type="button">COMPOSE MESSAGE</button>
                      <div id="scroll_message">
                        @if(count($messages) > 0)
                        @foreach ($messages as $message)
                        <a href="#" class="view_message" data-view_message="{{ $message->id }}">
                            <div class="mail_list">
                              <div class="left">
                                <i class="fa fa-user"></i>
                              </div>
                              <div class="right">
                                <h3>{{ $message->admin->username }} <small>{{$message->created_at->diffForHumans()}}</small></h3>
                                <p>{{ $message->title }}</p>
                              </div>
                            </div>
                          </a>
                        @endforeach
                        @else
                            <h3>No Message Available</h3>
                        @endif
                      </div>
                    </div>
                    <!-- /MAIL LIST -->

                    <!-- CONTENT MAIL -->
                    <div class="col-sm-9 mail_view">
                      <div class="inbox-body" id="inbox-body">
                        <div class="mail_heading row">
                          <div class="col-md-12">
                            <h4></h4>
                          </div>
                        </div>

                        <div class="view-mail">
                            <h2>No Message</h2>
                        </div>
                      </div>

                    </div>
                    <!-- /CONTENT MAIL -->
                  </div>
                </div>
              </div>
        </div>
    </div>


    <!-- Modal - View Account Modal -->
    <div class="modal fade" id="createMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createMessageFrm">
                @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create New Message</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <!-- Content Here -->
                        <div class="form-group">
                            <label for="addTitle" class="control-label">Title</label>
                            <input type="text" name="title" id="addTitle" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="addBody" class="control-label">Message</label>
                            <textarea name="body" id="addBody" cols="30" rows="10" class="addBody form-control"></textarea>
                            <script type="text/javascript">
                                $('.addBody').wysihtml5();
                            </script>
                        </div>

                        <div class="form-group">
                            <label for="addIsPublished" class="control-label">Is Published?</label>
                            <select name="is_published" id="addIsPublished" class="form-control">
                                <option value="1" class="isPublishedOption" selected>Yes</option>
                                <option value="0" class="isPublishedOption">No</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-sm btn-secondary">Submit</button>
                </div>
            </form>
              </div>
        </div>
      </div>

@endsection

@section('extra_script')
    <script>
        $(function(){

            //Create Message
            function createMessage(){
                $("#compose_message").on('click', function(){
                    $("#createMessageModal").modal('show');
                });

                $("#createMessageFrm").submit(function(e){
                    e.preventDefault();
                    var csrfToken = $("input[name=_token]");
                    var inputTitle = $("input[id=addTitle]");
                    var textareaBody = $("textarea[id=addBody]");
                    var selectIsPublished = $("select[id=addIsPublished]");
                    $.ajax({
                        url: '/admin/message/create',
                        method: 'POST',
                        dataType: 'JSON',
                        data: {
                            '_token': csrfToken.val(),
                            'title' : inputTitle.val(),
                            'body' : textareaBody.val(),
                            'is_published' : selectIsPublished.val()
                        },
                        success: function(res){
                            console.log(res);
                            if(res.errors){
                                $("span.error_msg").remove();
                                $(`<span class="error_msg" style="color:red; font-size:12px;">${res.errors.title ? res.errors.title : ''}</span>`)
                                .insertAfter(inputTitle);

                                $(`<span class="error_msg" style="color:red; font-size:12px;">${res.errors.body ? res.errors.body : ''}</span>`)
                                .insertAfter(textareaBody);
                            }
                            if(res.success){
                                swal({
                                    title: "Message Board",
                                    text: res.success,
                                    icon: "success"
                                });
                                window.location.reload();
                            }
                        }
                    });
                });
            }
            createMessage()

            //View Message
            function viewMessage(){
                $("#scroll_message").on('click', '.view_message', function(e){
                    e.preventDefault();
                    var message_id = e.currentTarget.dataset.view_message;
                    $.ajax({
                        url: '/admin/message/view/' + message_id,
                        method: 'GET',
                        success: function(res){
                            $("#inbox-body h4").text(res.message.title);
                            $("#inbox-body .view-mail h2").text(res.message.body);
                        }
                    });
                });
            }
            viewMessage();
        });
    </script>
@endsection
