﻿@include('UserPanel/inc/header')
    @include('UserPanel/inc/menu')
    @include('UserPanel/inc/mobile_header')
    <main class="main single-page">
      <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('homepage')}}" rel="nofollow">トップ</a>
                    <span class="active">ブランド</span> 
                </div>
            </div>
        </div>
      <div class="all-brand my-xs-p25 my-xs-pb0">
        <div class="container">
          <div class="row">
              @foreach($brands as $brand) 
              <div class="col w-20">
                <div class="brand-inner my-xs-n0">
                  <a onclick='filterBrandProduct("{{$brand->zokusei}}")' href="#">
                    <div class="logo">
                      @php
                      $file_name = url('storage/category/images'.'/'.$brand->image1);
                      @endphp
                      <img src="{{$file_name}}" alt="logo" class="img-fluid">
                    </div>
                    <div class="name">
                      {{$brand->zokusei}}
                    </div>
                  </a>
                </div>
              </div>
              @endforeach
          </div>
        </div>
      </div>
    </main>
    @include('UserPanel/inc/footer')