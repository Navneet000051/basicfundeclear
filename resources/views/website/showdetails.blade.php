@extends('website.websitelayout.master')
@section('content')
<main>
    @if(!$showdetails->isEmpty())
    <section class="live-area live-bg fix pb-5 second-sectionfunde-gradient" data-background1="{{ asset('assets/webassets/img/bg/live_bg.jpg') }}">
        <div class="container pt-3">
            <div class="section-title details_show_episode_section">
                <h2 class="title teal-text">{{ $showtypes->title }}</h2>
                <span class="teal-text">
                    {{ $showtypes->subtitle }}
                </span>
            </div>
            <div class="p-50 bg-light details_show_episode_section position-relative bfc-card-gradient">
                @foreach($showdetails as $showdetail)

                <div class="row justify-content-center show_border_content hover_effect_deatils_link">
                    <div class="col-md-3">
                        <a href="{{ $showdetail->url }}" class="banner-btn mediabox wow fadeInUp" data-wow-duration=".8s">
                            <div class="movie-poster mb-0">
                                <img src="{{ Storage::disk('s3')->url($showdetail->thumbnail) }} " alt="{{ $showdetail->title }}" class="p-0 mb-0" loading="lazy">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="live-movie-content text-justify show_title_onhover">
                            {!! $showdetail->description !!}
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </section>
    @else
    <section class="live-area live-bg fix pb-5" data-background="{{ asset('assets/webassets/img/bg/live_bg.jpg') }}">
        <div class="container pt-3">
            <div class="section-title details_show_episode_section">
                <h2 class="title teal-text text-center">No Data Available</h2>

            </div>
        </div>
    </section>
    @endif
</main>

@endsection
@push('validation-js')
<script>
    // JavaScript for Tab Functionality
    document.addEventListener("DOMContentLoaded", function() {
        const tabButtons = document.querySelectorAll(".tab-button");
        const tabContents = document.querySelectorAll(".tab-content");

        tabButtons.forEach(button => {
            button.addEventListener("click", function() {
                const tabId = this.getAttribute("data-tab");

                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove("active"));
                tabContents.forEach(content => content.classList.remove("active"));

                // Add active class to the clicked button and corresponding tab
                this.classList.add("active");
                document.getElementById(tabId).classList.add("active");
            });
        });
    });
</script>
@endpush