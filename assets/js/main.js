$("#movie-showcase:gt(0)").hide();

setInterval(function() { 
  $('#movies-showcase > div:first')
  .fadeOut(1000)
  .next()
  .fadeIn(1000)
  .end()
  .appendTo('#movies-showcase');
}, 8000);

let nav = document.getElementById('navigation');
function toggleMenu() {
  nav.classList.toggle('navigation--visible');
}

$('.scroll-btn-right').click(function() {
  event.preventDefault();
  $('.popular-movie-container').animate({
    scrollLeft: "+=900px"
  }, "fast");
});

 $('.scroll-btn-left').click(function() {
  event.preventDefault();
  $('.popular-movie-container').animate({
    scrollLeft: "-=900px"
  }, "fast");
});

$('.new-movies-btn-left').click(function() {
  event.preventDefault();
  $('.new-movie-container').animate({
    scrollLeft: "-=900px"
  }, "fast");
});

 $('.new-movies-btn-right').click(function() {
  event.preventDefault();
  $('.new-movie-container').animate({
    scrollLeft: "+=900px"
  }, "fast");
});

$('.top-series-btn-left').click(function() {
  event.preventDefault();
  $('.top-series-container').animate({
    scrollLeft: "-=900px"
  }, "fast");
});

 $('.top-series-btn-right').click(function() {
  event.preventDefault();
  $('.top-series-container').animate({
    scrollLeft: "+=900px"
  }, "fast");
});

$('.new-series-btn-left').click(function() {
  event.preventDefault();
  $('.new-series-container').animate({
    scrollLeft: "-=900px"
  }, "fast");
});

 $('.new-series-btn-right').click(function() {
  event.preventDefault();
  $('.new-series-container').animate({
    scrollLeft: "+=900px"
  }, "fast");
});

 //Navigation bar scroll event to add background color

 $(function () {
  $(document).scroll(function () {
    var $nav = $(".navigationbar");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });
});