$(document).ready(function(){
    var $container = $('.containerSlider');
    var $slides = $('.containerSlider').find('img');
    var currentSlide = 1;
    var animateSpeed = 2000;
    var interval = 3000;

    var successCallback = function() {
        if (currentSlide < ($slides.length - 1)) {
            currentSlide++;
        } else {
            $container.css({'marginLeft': '0px'});
            currentSlide =1;
        }
    };

    var animateSlide = function() {
        $container.animate({'marginLeft':'-='+'320px'}, animateSpeed, successCallback);
    };

    setInterval(animateSlide, interval);
});


$(document).ready(function(){
    $('.toggle').on('click', function() {
        $('.container').stop().addClass('active');
    });

    $('.close').on('click', function() {
        $('.container').stop().removeClass('active');
    });

});

//home slider
$(document).ready(function(){
    var $container = $('.containerHome');
    var $slides = $('.containerHome').find('img');
    var currentSlide = 1;
    var animateSpeed = 3000;
    var interval = 3000;

    var successCallback = function() {
        if (currentSlide < ($slides.length - 1)) {
            currentSlide++;
        } else {
            $container.css({'marginLeft': '0px'});
            currentSlide =2;
        }
    };

    var animateSlide = function() {
        $container.animate({'marginLeft':'-='+'750px'}, animateSpeed, successCallback);
    };

    setInterval(animateSlide, interval);
});

//modal

var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closeModal")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    // if (event.target == modal) {
        modal.style.display = "none";
    // }
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}