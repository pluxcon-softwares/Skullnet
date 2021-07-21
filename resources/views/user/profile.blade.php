@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div class="row" style="margin-top: 5%;">
        <div class="col-md-6 col-sm-6  ">
            <div class="x_panel sg-shadow">
              <div class="x_title_danger">
                <h2><i class="fa fa-user"></i> Contact & Personal Info</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <!-- /.User Information -->
                <form data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Last Login IP </label>
                        <div class="col-md-6 col-sm-6 ">
                        <input type="text" value="{{$user->login_ip}}" disabled  class="form-control">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Registered Date</label>
                        <div class="col-md-6 col-sm-6 ">
                        <input type="text" value="{{ $user->created_at }}" disabled  class="form-control">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Username</label>
                        <div class="col-md-6 col-sm-6 ">
                        <input type="text" value="{{ $user->username }}" disabled  class="form-control">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                        <div class="col-md-6 col-sm-6 ">
                        <input type="text" value="{{ $user->email }}" disabled  class="form-control">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Balance</label>
                        <div class="col-md-6 col-sm-6 ">
                        <input type="text" value="${{ $user->wallet ? $user->wallet : '0.00' }}" disabled  class="form-control">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Last Logout</label>
                        <div class="col-md-6 col-sm-6 ">
                        <input type="text" value="{{$user->last_logout}}" disabled  class="form-control">
                        </div>
                    </div>


                </form>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-sm-6  ">
            <!-- /.Change Password -->
            <div class="x_panel sg-shadow">
                <div class="x_title_primary">
                  <h2><i class="fa fa-edit"></i> Change Password</h2>
                  <div class="clearfix"></div>

                  @include('partials.messages')

                </div>
                <div class="x_content">
                    <form method="POST" action="{{ route('change.password') }}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                        <!-- CSRF Form Field -->
                        @csrf

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="old_password">Current Password <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                            <input type="password" required="required" placeholder="Old Password" name="old_password" class="form-control {{ $errors->has('old_password') ? 'parsley-error' : ''}}">
                                @if ($errors->has('old_password'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('old_password') }}</li>
                                </ul>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="new_password">New Password <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                            <input type="password" required="required" name="new_password" placeholder="New Password" class="form-control {{ $errors->has('new_password') ? 'parsley-error' : ''}}">
                                @if ($errors->has('new_password'))
                                <ul class="parsley-errors-list filled">
                                    <li class="parsley-required">{{ $errors->first('new_password') }}</li>
                                </ul>
                                @endif
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="new_password_confirmation">Confirm Password <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                            <input type="password" required="required" name="new_password_confirmation" placeholder="Verfiy Password" class="form-control">

                            </div>
                        </div>

                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Change Password</button>
                            </div>
                        </div>

                    </form>
                </div>
              </div>
          </div>
    </div>

@endsection

@section('extra_script')
    <script>
        $(function(){

        });
    </script>
@endsection
