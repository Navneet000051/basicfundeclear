@extends('website.websitelayout.master')
@section('content')
<main>
    @if(!$rentstudios->isEmpty())
    <section class="mentor_bg_clr pb-5 custom_funde_banner_grediant gallery_top_margin">
        <div class="container px-0 px-md-5 pt-md-4">
            <div class="tab-container nlf_media_tab_content">
                <!-- Tab Buttons -->
                <div class="tab-buttons">
                    <button class="tab-button active" data-tab="tab1">Gallery</button>
                    <button class="tab-button" data-tab="tab2">Videos</button>
                </div>
                <!-- Images Contents -->
                <div id="tab1" class="tab-content active">
                    <div class="container">
                        <div class="row popup-gallery">
                            @php
                            $onlyImages = $rentstudios->filter(function($item) {
                            return empty($item->url);
                            });
                            @endphp

                            @forelse($onlyImages as $rentstudio)
                            <div class="col-6 col-md-4 py-2">
                                <a class="hover_affect_nlf position-relative" href="{{ Storage::disk('s3')->url($rentstudio->thumbnail) }}" title="{{ $rentstudio->title }}">
                                    <img src="{{ Storage::disk('s3')->url($rentstudio->thumbnail) }}" alt="{{ $rentstudio->title }}">
                                    <span class="singicon_btn_nlf">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            @empty
                            <div class="col-12">
                                <div class="alert alert-warning text-center" role="alert">
                                    No images available in the gallery.
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Video Contents -->
                <div id="tab2" class="tab-content">
                    <div class="container">
                        <div class="video-gallery row">
                            @php
                            $onlyVideos = $rentstudios->filter(function($item) {
                            return !empty($item->url);
                            });
                            @endphp

                            @forelse($onlyVideos as $rentstudio)
                            <div class="col-12 col-md-4 py-2">
                                <div class="movie-item rounded_5">
                                    <div class="play-btn-watch">
                                        <a href="{{ $rentstudio->url }}" class="banner-btn btn mediabox wow fadeInUp" data-wow-delay=".8s" data-wow-duration="1.8s">
                                            <i class="fas fa-play"></i> Watch Now
                                        </a>
                                    </div>
                                    <div>
                                        <div class="movie-poster">
                                            <img src="{{ Storage::disk('s3')->url($rentstudio->thumbnail) }}" alt="{{ $rentstudio->title }}">
                                        </div>
                                        <div class="movie-content">
                                            <div class="top d-block">
                                                <h5 class="title">{{ $rentstudio->title }}</h5>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">hd</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-heart"></i></span>
                                                        <span class="rating"><i class="fas fa-thumbs-up"></i></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <div class="alert alert-warning text-center" role="alert">
                                    No videos available in the gallery.
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>



        </div>
    </section>
    <!-- newsletter-area -->

    <section class="newsletter-area newsletter-bg">
        <div class="container">
            <div class="newsletter-inner-wrap">
                 <div id="enqmsg" style="background:#dff1d8;height:40px;width:max-content;display:none;padding:0 10px;">
                    <span style="color:#3c763d;line-height:40px;font-size:15px;"> &nbsp;&nbsp; Thankyou For Enquiry </span>
                </div>
                <div id="enqerror" style="background:#dff1d8;height:40px;width:max-content;display:none;padding:0 10px;">
                    <span style="color:#3c763d;line-height:40px;font-size:15px;"> &nbsp;&nbsp;Failed to send emails. Please try again later.</span>
                </div>
                <br />
                <form action="{{route('rentenquiry')}}" id="rentenquiryForm" autocomplete="off" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row newsletter-form">
                                <div class="col-md-6 py-2">
                                    <input type="text" name="name" id="name" required placeholder="Enter Name">
                                </div>
                                <div class="col-md-6 py-2">
                                    <input type="tel" name="mobile" id="mobile" required placeholder="Enter Mobile Number">
                                </div>
                                <div class="col-12 py-2">
                                    <input type="email" name="email" id="email" required placeholder="Enter  Email">
                                </div>
                                <div class="col-md-6 py-2">
                                    <input type="date" name="start_date" id="fromDate" required>
                                </div>
                                <div class="col-md-6 py-2">
                                    <input type="date" name="end_date" id="toDate" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="newsletter-form py-2">
                                <textarea class="textarea" name="message" id="message" required rows="6" placeholder="Enter Message"></textarea>
                                <button class="btn mt-3" name="submit">Send</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- newsletter-area-end -->
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
<script src="{{asset('assets/webassets/js/form-validation.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    $('form').parsley();
    $('#name, #email, #mobile, #message').keypress(function(e) {
        if (this.value.length === 0 && e.which === 32) e.preventDefault();
    });
      $('input[name="mobile"]').on('input', function() {
         $(this).val($(this).val().replace(/\D/g, '')); // Remove non-digits
         if ($(this).val().length > 10) {
             $(this).val($(this).val().substr(0, 10)); // Limit to 10 digits
         }
     });
});

</script>
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

<script>
    // popup-gallery
    jQuery(document).ready(function($) {
        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Preload previous and next images
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title') || '';
                }
            }
        });

    });
</script>
<script>
    const fromDate = document.getElementById('fromDate');
    const toDate = document.getElementById('toDate');

    fromDate.addEventListener('change', function() {
        toDate.min = this.value;
        if (toDate.value < this.value) {
            toDate.value = '';
        }
    });
</script>
@endpush