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