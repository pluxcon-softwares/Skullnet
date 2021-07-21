@extends('user.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @include('user.layouts.top_widgets')

    <div class="row mt-2 mb-1">
        <div class="col-md-8 mr-auto ml-auto sg-shadow" style="background-color: #eeeeee; border-radius:5px;">
            <h3>All Site Rules</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mr-auto ml-auto">
            @if (count($rules) < 0)
        <div class="card">
            <div class="card-body" style="background-color: #293A50; color:#fff; border-radius:5px;">
              <p class="card-text">No Rules Available</p>
            </div>
          </div>
        @else
            @foreach ($rules as $rule)
                <div class="card mt-1">
                <div class="card-body" style="background-color: #293A50; color:#fff; border-radius:5px;">
                  <p class="card-text">{{ $rule->rule }}</p>
                </div>
              </div>
            @endforeach
        @endif
        </div>
    </div>
@endsection
