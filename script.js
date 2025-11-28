
let exps = [];

const getReviews = async () => {
  const res = await axios.get("/docs/experiences.json");
  return res.data.experiences;
};
// $(window).on("scroll", function () {
//   let opacity = Math.min($(this).scrollTop() / 300, 1);
//   $("#nav1").css("background-color", `rgba(61, 71, 72,${opacity})`);
// });

window.onload = async () => {
  exps = await getReviews();

  exps.forEach(e => {
    $(".reviews").append(`
      <div class="review">
        <h3>${e.name} ${e.Lname}</h3>
        <p>${e.exp}</p>
      </div>
    `);
  });
};

$(window).on("scroll", function () {
  let opacity = Math.min($(this).scrollTop() / 300, 1);
  $("#nav1").css("background-color", `rgba(61, 71, 72,${opacity})`);
});
$(".add").click(() => {
  $(".form1").removeClass("hide");
});
$(".close").click(() => {
  $("#reviewForm")[0].reset();
  $(".form1").addClass("hide");
});
$("#reviewForm").on("submit", function (e) {
  e.preventDefault();

  const newReview = {
    name: $("#name").val(),
    Lname: $("#Lname").val(),
    exp: $("#experience").val(),
  };

  axios.post("/add-review", newReview)
    .then(() => {
      alert("Review added!");
      $(".form1").addClass("hide");

      // immediately show it without reload:
      $(".reviews").append(`
        <div class="review">
          <h3>${newReview.name} ${newReview.Lname}</h3>
          <p>${newReview.exp}</p>
        </div>
      `);
    })
    .catch(err => console.error(err));
});

$(window).on('scroll', function () {
  const windowBottom = $(window).scrollTop() + $(window).height(); // bottom of viewport

  $('.fade-slide').each(function () {
    const imgTop = $(this).offset().top; // distance from top of page

    // Check if image is entering the viewport
    if (windowBottom > imgTop + 50 && !$(this).hasClass('animated')) {
      $(this).addClass('animated'); // mark image so it animates only once

      // Animate opacity and position simultaneously
      $(this).animate({
        opacity: 1, // fade in
        top: 0      // slide up to original position
      }, 1000);     // duration: 1 second
      $(this).parent().find('.fade-text').delay(150).animate({
        opacity: 1, // fade in
      }, 600);

    }
  });
});
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
console.log('mmmmmmmmmmmmmmmmmmmmmm');
const items = document.querySelectorAll('.accor-item');

items.forEach(item => {
  const btn = item.querySelector('.icon');
  const body = item.querySelector('.item-body');
  btn.addEventListener('click', () => {
    $(body).slideToggle(400);
    if (btn.textContent === '+') {
      btn.textContent = '-';
    } else {
      btn.textContent = '+';
    }
  });
});


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
      slidesPerView: 3,
      spaceBetween: 100
    },
    700: {
      slidesPerView: 1,
      spaceBetween: 30
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 60
    }
  }
});
const mapCon = document.getElementById('map');
if (mapCon) {
  var map = L.map('map').setView([36.486592451438696, 6.822039510391554], 10);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    // attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);
  L.marker([37.38322999945196, -2.040267971827429]).addTo(map)
    .bindPopup('Salama Clinic')
    .openPopup();
}
// function initMap() {
//   const location = { lat: 37.38322999945196, lng: 2.040267971827429 };
//   const map = new google.maps.Map(document.querySelector('.map'), {
//     zoom: 12,
//     center: location,
//   });
//   const marker = new google.maps.Marker({
//     position: location,
//     map: map,
//   });
// }

// $('.Service').on('click', function () {
//   c
//   $('.blur').fadeIn(200);
//   $('#' + id).fadeIn(200);
// })