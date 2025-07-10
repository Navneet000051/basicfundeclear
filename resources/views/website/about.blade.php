@extends('website.websitelayout.master')
@section('content')
<main>
    <!-- welcome-area -->
    <section class="live-area live-bg fix pb-5 custom_funde_banner_grediant ">
    <!-- <section class="live-area live-bg fix pb-5 custom_funde_banner_grediant " data-background="{{asset('assets/webassets/img/bg/live_bg.jpg')}}"> -->
        <div class="container pt-md-5 pt-4">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6 order-md-1 order-2">
                    <div class="section-title title-style-two mb-25">
                        <span class="sub-title">{{ $aboutcontent->heading }}</span>
                        <h2 class="title">{!! $aboutcontent->subheading !!}</h2>
                    </div>
                    <div class="live-movie-content text-justify">
                        <p class="mb-3">
                        {!! $aboutcontent->description !!}
                        </p>

                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 order-md-2 order-1 text-center">
                    <div class="live-movie-img wow fadeInRight abou-Bfc-content-img" data-wow-delay=".2s" data-wow-duration="1.8s">
                        <!-- <img src="{{asset('assets/webassets/img/images/FB-Cover.png')}}" alt=""> -->
                        @if (!empty($aboutcontent->content))
        @if (Str::contains($aboutcontent->content, ['.mp4', '.avi', '.mov', '.wmv'])) <!-- Assuming these are video file extensions -->
            <!-- Video section -->
            <video class="video_bfc_content24" id="myVideo" loop autoplay muted="false" controls>
                <!-- <source src="{{ asset('storage/'.$aboutcontent->content) }}" type="video/mp4"> -->
                <source src="{{ Storage::disk('s3')->url($aboutcontent->content) }}" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        @else
            <!-- Image section -->
            <!-- <img src="{{ asset('storage/'.$aboutcontent->content) }}" alt=""> -->
            <img src="{{ Storage::disk('s3')->url($aboutcontent->content) }}" alt="" loading="lazy">
        @endif
    @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- welcome-area-end -->

    <section class="ucm-area ucm-bg py-md-5 py-0">
    <div class="container">
    @foreach($teammembers as $index => $teammember)
        <div class="row justify-content-md-center justify-content-around my-4 py-md-5 py-3 border_section_dotted">
            @if($index % 2 == 0)
                <!-- Even index: Image on the left -->
                <div class="col-md-4 text-center mb-md-0 mb-5">
                    <div class="first_team_member_image">
                        <img src="{{ Storage::disk('s3')->url($teammember->thumbnail) }}" class="w-100" loading="lazy">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="live-movie-content text-justify">
                        <h4 class="text-dark">{{ $teammember->name }} ({{ $teammember->designation }})</h4>
                        <p>{!! $teammember->description !!}</p>
                    </div>
                </div>
            @else
                <!-- Odd index: Image on the right -->
                <div class="col-md-6 order-md-1 order-2">
                    <div class="live-movie-content text-justify">
                        <h4 class="text-dark">{{ $teammember->name }} ({{ $teammember->designation }})</h4>
                        <p>{!! $teammember->description !!}</p>
                    </div>
                </div>
                <div class="col-md-4 text-center order-md-2 order-1 mb-md-0 mb-5">
                    <div class="first_team_member_image float-right">
                        <img src="{{ Storage::disk('s3')->url($teammember->thumbnail) }}" alt="{{ $teammember->name }}" class="w-100" loading="lazy">
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>

    </section>



</main>
<!-- main-area-end -->

<!-- ---------------footer section ------------- -->
@endsection
@push('validation-js')
<script src="{{asset('assets/webassets/js/video-autoplay.js')}}"></script>
@endpush