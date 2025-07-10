@extends('website.websitelayout.master')
@section('content')

<!-- main-area -->
<main>
    <!-- slider-area -->
    <section class="slider-area slider-bg custom_funde_banner_grediant yellow-bottom-border">
        <div class="slider-active mt-5">
            <div class="slider-item">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 order-0 order-lg-2">
                            <div class="slider-img text-center" data-animation="fadeInRight" data-delay="1s">
                                {{---- @if (!empty($indexcontent->content))
                                @if (Str::contains($indexcontent->content, ['.mp4', '.avi', '.mov', '.wmv']))
                                <h1>hello video{{$indexcontent->heading}}</h1>
                                <video class="video_bfc_content24" id="myVideo" loop controls muted>
                                    <source src="{{ Storage::disk('s3')->url($indexcontent->content) }}" type="video/mp4">
                                    <source src="movie.ogg" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                                @else
                                <h1>hello image</h1>
                                <img class="video_bfc_content24" src="{{ Storage::disk('s3')->url($indexcontent->content) }}" alt="">
                                @endif
                                @endif ----}}
                                @if (!empty($indexcontent->ytlink))
                                @php
                                // Convert normal YouTube link to embed link if needed
                                $videoId = null;

                                if (Str::contains($indexcontent->ytlink, 'watch?v=')) {
                                $videoId = Str::after($indexcontent->ytlink, 'watch?v=');
                                $videoId = Str::contains($videoId, '&') ? Str::before($videoId, '&') : $videoId;
                                $embedUrl = "https://www.youtube.com/embed/$videoId?autoplay=1&mute=1&loop=1&playlist=$videoId";
                                } elseif (Str::contains($indexcontent->ytlink, 'embed/')) {
                                $videoId = Str::after($indexcontent->ytlink, 'embed/');
                                $videoId = Str::contains($videoId, '?') ? Str::before($videoId, '?') : $videoId;
                                $embedUrl = "https://www.youtube.com/embed/$videoId?autoplay=1&mute=1&loop=1&playlist=$videoId";
                                } else {
                                $embedUrl = $indexcontent->ytlink; // fallback if custom URL
                                }
                                @endphp

                                <iframe class="video_bfc_content24"
                                    src="{{ $embedUrl }}"
                                    frameborder="0"
                                    allow="autoplay; fullscreen"
                                    allowfullscreen>
                                </iframe>
                                @elseif (!empty($indexcontent->content))
                                <img class="video_bfc_content24"
                                    src="{{ Storage::disk('s3')->url($indexcontent->content) }}"
                                    alt="Content Image">
                                @endif

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="banner-content">
                                <!-- <h6 class="sub-title" data-animation="fadeInUp" data-delay=".2s">{{ $indexcontent->heading }}</h6> -->
                                <h2 class="title" data-animation="fadeInUp" data-delay=".4s">{!! $indexcontent->subheading !!}</h2>
                                <div class="banner-meta mb-0" data-animation="fadeInUp" data-delay=".6s">
                                    <p class="text-dark">{!! $indexcontent->description !!}</p>
                                    <ul>
                                        @php
                                        $metakeyArray = json_decode($indexcontent->attribute);
                                        if (!empty($metakeyArray) && is_array($metakeyArray)) {
                                        $totalItems = count($metakeyArray);
                                        $counter = 0;

                                        foreach ($metakeyArray as $key => $item) {
                                        echo '<li class="category" style="margin-right: 7px;color:#000;"><span>' . $item->value;
                                                $counter++;
                                                if ($counter < $totalItems) {
                                                    echo ',' ;
                                                    }
                                                    echo '</span></li>' ;
                                                    }
                                                    }
                                                    @endphp
                                                    <li class="release-time">
                                                    <span class="text-dark"><i class="far fa-calendar-alt text-dark"></i> {{ date('Y') }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ $indexcontent->watchlink }}" class="banner-btn btn mediabox" data-animation="fadeInUp" data-delay=".8s"><i class="fas fa-play"></i> Watch Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider-area-end -->

    <!-- Show-area -->
    <section id="show-section" class="ucm-area ucm-bg yellow-bottom-border">
        <div class="ucm-bg-shape"></div>

        <div class="container">
            <div class="row align-items-end mb-50">
                <div class="col-lg-6">
                    <div class="section-title text-center text-lg-left">
                        <h2 class="title orange-text">{{ $firstsectionsheadings->heading }}</h2>
                        <span class="text-dark">
                            {!! $firstsectionsheadings->subheading !!}
                        </span>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="tvShow" role="tabpanel" aria-labelledby="tvShow-tab">
                    <div class="ucm-active-categoryshow owl-carousel top-show-bfcnav-arrow">
                        @foreach($showtypes as $showtype)
                        <div class="gallery-item movie-item mb-50">
                            <?php
                            // Generate a short hashed representation of the ID
                            $shortId = base64_encode($showtype->id);
                            // Construct the URL with parameters
                            $url = route('showdetails', [
                                'title' => str_replace(' ', '_', $showtype->title),
                                'subtitle' => str_replace(' ', '_', $showtype->subtitle),
                                'id' => $shortId
                            ]);
                            ?>
                            <a href="{{ $url }}">
                                <div>
                                    <div class="movie-poster fixed-img-clear">
                                        <!-- <img src="{{ asset('storage/' . $showtype->thumbnail) }} " alt="{{ $showtype->title }}"> -->
                                        <img src="{{ Storage::disk('s3')->url($showtype->thumbnail) }} " alt="{{ $showtype->title }}">
                                    </div>
                                    <div class="movie-content text-left">
                                        <div class="top d-block">
                                            <h5 class="title">
                                                {{ $showtype->title }}
                                            </h5>
                                        </div>
                                        <div class="top">
                                            <h4 class="title logo_color">{{ $showtype->assigned_shows_count }} episodes</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Show-area-end -->

    <!-- Watch More Area -->
    <section id="" class="ucm-area ucm-bg yellow-bottom-border" >
        <div class="ucm-bg-shape second-sectionfunde-gradient"></div>
        <div class="container">
            <div class="row align-items-end mb-50">
                <div class="col-lg-6">
                    <div class="section-title text-center text-lg-left">
                        <!-- <h2 class="title teal-text">{{ $secondsectionsheadings->heading }}</h2> -->
                        <h2 class="title teal-text">Watch More</h2>
                        <span class="teal-text"> {!! $secondsectionsheadings->subheading !!}</span>
                    </div>
                </div>
            </div>

            <!-- <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tvShow" role="tabpanel" aria-labelledby="tvShow-tab">
                    <div class="ucm-active-categoryshow owl-carousel top-show-bfcnav-arrow">
                        @foreach($shows as $show)
                        <div class="gallery-item">
                            <img src="{{ Storage::disk('s3')->url($show->thumbnail) }}" alt="{{ $show->title }}">
                            <div class="play-btn-watch bfc-long-video">
                                <a href="{{ $show->url }}?rel=0" class="banner-btn btn mediabox wow fadeInUp" data-wow-delay=".8s" data-wow-duration="1.8s">
                                    <i class="fas fa-play"></i> Watch Now
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div> -->
        </div>
        <div class="container">

            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="tvShow" role="tabpanel" aria-labelledby="tvShow-tab">
                    <div class="ucm-active-categoryshow owl-carousel top-show-bfcnav-arrow">
                        @foreach($shows as $showtype)
                        <div class="gallery-item movie-item mb-50">
                            <?php
                            // Generate a short hashed representation of the ID
                            $shortId = base64_encode($showtype->id);
                            // Construct the URL with parameters
                            $url = route('showdetails', [
                                'title' => str_replace(' ', '_', $showtype->title),
                                'subtitle' => str_replace(' ', '_', $showtype->subtitle),
                                'id' => $shortId
                            ]);
                            ?>
                            <a href="{{ $url }}">
                                <div>
                                    <div class="movie-poster fixed-img-clear">
                                        <!-- <img src="{{ asset('storage/' . $showtype->thumbnail) }} " alt="{{ $showtype->title }}"> -->
                                        <img src="{{ Storage::disk('s3')->url($showtype->thumbnail) }} " alt="{{ $showtype->title }}">
                                    </div>
                                    <div class="movie-content text-left">
                                        <div class="top d-block">
                                            <h5 class="title">
                                                {{ $showtype->title }}
                                            </h5>
                                        </div>
                                        <div class="top">
                                            <h4 class="title logo_color">{{ $showtype->assigned_shows_count }} episodes</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Watch More Area End -->

    <!-- Show PlayList Area -->
    @foreach($assignshowtypes as $index => $showtype)
    <section class="ucm-area ucm-bg yellow-bottom-border">
        <div class="ucm-bg-shape {{ $index % 2 === 0 ? '' : 'second-sectionfunde-gradient' }}"></div>
        <div class="container">
            <div class="row align-items-end mb-50">
                <div class="col-lg-6">
                    <div class="section-title text-center text-lg-left">
                        <h2 class="title orange-text">{{ $showtype->title }}</h2>
                        <span class="teal-text">{{ $showtype->subtitle }}</span>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tvShow" role="tabpanel" aria-labelledby="tvShow-tab">
                    <div class="ucm-active-categoryshow owl-carousel">
                        @foreach($showassigns->where('showtype_id', $showtype->id) as $showassign)
                        <div class="movie-item mb-50">
                            <div class="play-btn-watch">
                                <a href="{{ $showassign->url }}?rel=0" class="banner-btn btn mediabox wow fadeInUp" data-wow-delay=".8s" data-wow-duration="1.8s">
                                    <i class="fas fa-play"></i> Watch Now
                                </a>
                            </div>
                            <div>
                                <div class="movie-poster">
                                    <img src="{{ Storage::disk('s3')->url($showassign->thumbnail) }}" alt="{{ $showassign->title }}">
                                </div>
                                <div class="movie-content">
                                    <div class="top d-block">
                                        <h5 class="title">{!! Str::limit(strip_tags($showassign->title), 34) !!}</h5>
                                    </div>
                                    <div class="bottom">
                                        <ul>
                                            <li><span class="quality">hd</span></li>
                                            <li>
                                                <span class="duration"><i class="far fa-heart"></i> </span>
                                                <span class="rating"><i class="fas fa-thumbs-up"></i> </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    <!-- Show PlayList Area End -->

    <!-- Shorts-area -->
    <!-- <section id="shorts-section" class="tv-series-area tv-series-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-md-left text-center mb-50">
                        <h2 class="title pb-2 teal-text">
                            {{ $shortssectionsheadings->heading }}
                        </h2>
                      
                        <span class="teal-text">
                            {!! $shortssectionsheadings->subheading !!}
                        </span>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tvShow" role="tabpanel" aria-labelledby="tvShow-tab">
                    <div class="ucm-active owl-carousel">
                        @foreach($shorts as $short)
                        <div class="movie-item mb-50">
                            <div class="play-btn-watch">
                                <a href="{{ $short->url }}?rel=0" class="banner-btn btn mediabox wow fadeInUp" data-wow-delay=".8s" data-wow-duration="1.8s"><i class="fas fa-play"></i> Watch Now</a>
                            </div>
                            <div>
                                <div class="movie-poster shorts-size-fixed">
                                   <img src="{{ Storage::disk('s3')->url($short->thumbnail) }} " alt="{{ $short->title }}">
                                </div>
                                <div class="movie-content">
                                    <div class="top d-block">
                                        <h5 class="title">{!! Str::limit(strip_tags($short->title), 20) !!}</h5>
                                    </div>
                                    <div class="bottom">
                                        <ul>
                                            <li><span class="quality">hd</span></li>
                                            <li>
                                                <span class="duration"><i class="far fa-heart"></i> </span>
                                                <span class="rating"><i class="fas fa-thumbs-up"></i> </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Shorts-area-end -->

    <!-- newsletter-area -->
    <!-- <section class="newsletter-area newsletter-bg" data-background="{{asset('assets/webassets/img/bg/newsletter_bg.jpg')}}"> -->
    <section class="newsletter-area newsletter-bg" id="contact-section">
        <div class="container">
            <div class="newsletter-inner-wrap">
                <div id="enqmsg" style="background:#dff1d8;height:40px;width:max-content;display:none;padding:0 10px;">
                    <span style="color:#3c763d;line-height:40px;font-size:15px;"> &nbsp;&nbsp; Thankyou For Enquiry </span>
                </div>
                <div id="enqerror" style="background:#dff1d8;height:40px;width:max-content;display:none;padding:0 10px;">
                    <span style="color:#3c763d;line-height:40px;font-size:15px;"> &nbsp;&nbsp;Failed to send emails. Please try again later.</span>
                </div>
                <br />
                <form action="{{route('sendmail')}}" id="contactForm" autocomplete="off" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="row newsletter-form">
                                <div class="col-md-6">
                                    <input type="text" id="username" name="name" required placeholder="Enter your Name">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" id="email" name="email" required placeholder="Enter your Email">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="newsletter-form">
                                <input type="text" id="message" name="message" required placeholder="Enter your Messages">
                            </div>
                        </div>
                    </div>
                    <div class="row  align-items-center pt-2">
                        <div class="col-lg-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="data_consent" required>
                                <label class="form-check-label text-dark text-justify" for="flexCheckChecked">
                                    I, hereby accord my consent to process my above mentioned personal data by BFC Content for the purpose of user engagement in accordance with the provisions of DPDP Act 2023.
                                    </br> To know more <a target="_blank" href="https://basicfundeclear.com/DPDP_Act"> click here</a></label>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center pt-2">
                        <div class="col-lg-12">
                            <button class="btn px-3" id="ContactBtn" style="height:40px; border-radius:10px;" name="submit">Send <i class="fa fa-spin fa-spinner" id="contactSpin" style="display:none;"></i></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        </div>
    </section>
    <!-- newsletter-area-end -->

</main>
<!-- main-area-end -->
@endsection()
@push('validation-js')

<script src="{{asset('assets/webassets/js/form-validation.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var video = document.getElementById('myVideo');
        var hasVisited = localStorage.getItem('hasVisited') === 'true'; // Check if the user has visited before

        // Function to attempt video playback
        function attemptAutoplay() {
            video.play().catch(function(error) {
                console.log("Autoplay failed:", error);
            });
        }

        // Function to handle the first click to unmute and play the video
        function handleFirstClick() {
            video.muted = false; // Unmute the video
            attemptAutoplay(); // Play the video
            document.removeEventListener('click', handleFirstClick); // Remove this handler after first use
        }

        // First visit: set up initial behavior
        if (!hasVisited) {
            localStorage.setItem('hasVisited', 'true'); // Mark the visit
            document.addEventListener('click', handleFirstClick); // Add click listener for the first click
        } else {
            // Subsequent visits: play video muted
            video.muted = true;
            attemptAutoplay();
        }
    });
</script>

@endpush