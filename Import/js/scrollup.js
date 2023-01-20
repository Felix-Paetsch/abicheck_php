window.onload = function() {
// when page is done loading, do:

var btn = $('#scroll-up');

	$(window).scroll(function() {
	  if ($(window).scrollTop() > 300) {
	    btn.addClass('show');
	  } else {
	    btn.removeClass('show');
	  }
	});

	btn.on('click', function(e) {
	  e.preventDefault();
	  $('html, body').animate({scrollTop:0}, '300');
	});

var y;
var z;
var x;

function checkifvisible(){
	y = document.getElementById("footer").offsetTop;
	z = window.scrollY;
	x = $(window).height();
	if ((y - z - x) > 20){
		removeClass("#scroll-up", "scrolled-d");
	}
	else{
		removeClass("#scroll-up", "scrolled-d");
		addClass("#scroll-up", "scrolled-d");
	}
}

$(window).scroll(function() {
  checkifvisible();
});

window.onresize = function(){
	checkifvisible();
};

checkifvisible();}