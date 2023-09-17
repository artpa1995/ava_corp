@extends('user.layout.app')
@section('title')Home @endsection
@section('contents')
<div style="text-align:center">Ava</div>

<style>


.slider-wrapper {
  margin: 1rem;
  position: relative;
  overflow: hidden;
}

.slides-container {
  height: calc(100vh - 2rem);
  width: 100%;
  display: flex;
  overflow: scroll;
  scroll-behavior: smooth;
  list-style: none;
  margin: 0;
  padding: 0;
}

.slide-arrow {
  position: absolute;
  display: flex;
  top: 0;
  bottom: 0;
  margin: auto;
  height: 4rem;
  background-color: white;
  border: none;
  width: 2rem;
  font-size: 3rem;
  padding: 0;
  cursor: pointer;
  opacity: 0.5;
  transition: opacity 100ms;
}

.slide-arrow:hover,
.slide-arrow:focus {
  opacity: 1;
}

#slide-arrow-prev {
  left: 0;
  padding-left: 0.25rem;
  border-radius: 0 2rem 2rem 0;
}

#slide-arrow-next {
  right: 0;
  padding-left: 0.75rem;
  border-radius: 2rem 0 0 2rem;
}

.slide {
  width: 100%;
  height: 100%;
  flex: 1 0 100%;
}

.slide:nth-child(1) {
  background-color: #49b293;
}

.slide:nth-child(2) {
  background-color: #b03532;
}

.slide:nth-child(3) {
  background-color: #6a478f;
  margin: 0;
}

.slide:nth-child(4) {
  background-color: #da6f2b;
}
</style>

<script src="https://www.youtube.com/iframe_api"></script>
<section class="slider-wrapper">
  <button class="slide-arrow" id="slide-arrow-prev">
    &#8249;
  </button>
  <button class="slide-arrow" id="slide-arrow-next">
    &#8250;
  </button>
  <ul class="slides-container" id="slides-container">
    <li class="slide">
      <iframe id="video1" width="1280" height="720" src="https://www.youtube.com/embed/nidQCt_HEsY" title="Miyagi &amp; Эндшпиль feat. Рем Дигга - I Got Love (Official Video)" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </li>
    <li class="slide">
      <iframe width="1280" height="533" src="https://www.youtube.com/embed/FnmVH8KM8to" title="Ara Martirosyan &amp; Anastasia Brukhtiy &quot;Ser E&quot;-Արա Մարտիրոսյան - Անաստասիա Բրուխտի &quot;Սեր Է&quot;- 2023 New" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </li>
    <li class="slide">
      <img src="{{url('image/opportunity_120.png')}}" alt="">
    </li>
    <li class="slide">
      <img src="{{url('image/campaign_120.png')}}" alt="">
    </li>
  </ul>
</section>



<script>
window.addEventListener("DOMContentLoaded", function() {
  var video = document.getElementById("video1");
  video.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
});

function onYouTubeIframeAPIReady() {
    var player = new YT.Player('video1', {
      events: {
        'onReady': onPlayerReady
      }
    });
  }

  function onPlayerReady(event) {
    event.target.playVideo();
  }

function playYouTubeVideo() {
    var player = new YT.Player('video1');
    player.playVideo();
  }

  // Add an event listener to wait for the YouTube API to be ready
  window.onYouTubeIframeAPIReady = function() {
    playYouTubeVideo();
  };

const slidesContainer = document.getElementById("slides-container");
const slide = document.querySelector(".slide");
const prevButton = document.getElementById("slide-arrow-prev");
const nextButton = document.getElementById("slide-arrow-next");

nextButton.addEventListener("click", () => {
  const slideWidth = slide.clientWidth;
  slidesContainer.scrollLeft += slideWidth;
});

prevButton.addEventListener("click", () => {
  const slideWidth = slide.clientWidth;
  slidesContainer.scrollLeft -= slideWidth;
});
</script>
<script src="https://www.youtube.com/iframe_api"></script>
@endsection
