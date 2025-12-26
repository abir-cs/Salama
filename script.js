
$(window).on("scroll", function () {
  let opacity = Math.min($(this).scrollTop() / 300, 1);
  $("#nav1").css("background-color", `rgba(61, 71, 72,${opacity})`);
});


$("#birthday").max = new Date().toISOString().split("T")[0];
$("#date").max = new Date().toISOString().split("T")[0];

$(".clear").click(() => {
  $("#appointment")[0].reset();
});

//------------------ about page images and text animations ------------------------------------

$(window).on('scroll', function () {
  const windowBottom = $(window).scrollTop() + $(window).height();

  $('.fade-slide').each(function () {
    const imgTop = $(this).offset().top;

    if (windowBottom > imgTop + 50 && !$(this).hasClass('animated')) {
      $(this).addClass('animated');

      $(this).animate({
        opacity: 1,
        top: 0
      }, 1000);
      $(this).parent().find('.fade-text').delay(150).animate({
        opacity: 1,
      }, 600);

    }
  });
});
//-------------------- the OG services page stuff ------------------------------
$('.Service').hover(function () {
  $(this).find('img').stop().animate({
    'width': '110%',
    'height': '120%'
  }, 300);
  $(this).find('.overlay').stop().animate({
    'height': '70%'
  }, 300)
  $(this).find('p').stop().animate({
    'top': '0%'
  }, 300)

  $(this).find('h3').css('color', '#36678f');

}, function () {
  $(this).find('img').stop().animate({
    'width': '100%',
    'height': '100%'
  }, 300);
  $(this).find('.overlay').stop().animate({
    'height': '0%'
  }, 300)
  $(this).find('p').stop().animate({
    'top': '-100%'
  }, 300)
  $(this).find('h3').css('color', '#3D4748');
});

const srv = document.querySelectorAll('.Service');
const blurr = document.querySelector('.blur');
const exitbtn = document.getElementById('exit');
console.log('Buttons found:', srv);
srv.forEach(Service => {
  Service.addEventListener('click', function () {
    const id = Service.dataset.target;
    const cardd = document.getElementById(id);
    blurr.style.display = 'block';
    cardd.style.display = 'block';
    document.body.classList.add('noscroll');
  });
  exitbtn.addEventListener('click', function () {
    const id = Service.dataset.target;
    const cardd = document.getElementById(id);
    blurr.style.display = 'none';
    cardd.style.display = 'none';
    document.body.classList.remove('noscroll');
  })
});
$('.Service').on('click', function () {
  $('.blur').fadeIn(200);
  $('#' + id).fadeIn(200);
})
//------------------------ accordion animations ------------------------------------------

const items = document.querySelectorAll('.accor-item');

items.forEach(item => {
  const btn = item.querySelector('.icon');
  const body = item.querySelector('.item-body');
  btn.addEventListener('click', () => {
    $(body).slideToggle(400);
    if (btn.textContent === '+') {
      btn.textContent = '-';
      item.style.border = '1.5px solid #36678f';
      $(item).animate({ backgroundColor: 'rgba(54, 103, 143, 0.18)' }, 400);
    } else {
      btn.textContent = '+';
      item.style.border = '1.5px solid #3D4748';
      $(item).animate({ backgroundColor: 'rgba(54, 103, 143, 0)' }, 400);
    }
  });
});

//--------------------- Doctors swiper (about page) ---------------------------------------

const swiper = new Swiper('.swiper', {
  slidesPerView: 3,
  spaceBetween: 100,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  scrollbar: {
    el: '.swiper-scrollbar',
    draggable: true,
  },
  mousewheel: true,
  loop: true,
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 100
    },
    700: {
      slidesPerView: 2,
      spaceBetween: 100
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 70
    }
  }
});

