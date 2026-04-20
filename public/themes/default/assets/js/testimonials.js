$(document).ready(function () {
    $('.slick-carousel').slick({
        dots: true,
        infinite: true,
        speed: 800,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: true,
        centerMode: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    centerMode: false
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerMode: false
                }
            }
        ]
    });

    // Add animation to cards on load
    $('.testimonial-card').each(function (index) {
        $(this).delay(200 * index).queue(function (next) {
            $(this).addClass('animate-in');
            next();
        });
    });
});