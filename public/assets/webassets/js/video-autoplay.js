// video-autoplay.js
document.addEventListener('DOMContentLoaded', function() {
    var video = document.getElementById('myVideo');

    document.addEventListener('mousemove', function(event) {
        video.muted = false;
        video.play();
    });

    // Autoplay the video muted initially
    video.muted = true;
    video.play();
});