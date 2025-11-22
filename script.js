
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

$(window).on("scroll",function(){
  let pos = $(window).scrollTop();
  let size = 380 + pos * 0.2;
  const sec = document.querySelector('.abtsection');
  const height = sec.offsetHeight;
  if(pos>=0 && pos<height){
    size = 380 + pos * 0.3;
    if (size>400) size = 400;
    if (size<380) size = 380;
    $("#img1").css("height",size+"px");
  }else if(pos>=height && pos<height*2){
    size = 380 + (pos-height) * 0.3;
    if (size>400) size = 400;
    if (size<380) size = 380;
    $("#img2").css("height",size+"px");
  }else if(pos>=height*2 && pos<height*3){
    size = 380 + (pos-height*2) * 0.3;
    if (size>400) size = 400;
    if (size<380) size = 380;
    $("#img3").css("height",size+"px");
  }
});
const swiper = new Swiper('.swiper', {
      slidesPerView: 3,
      spaceBetween: 20,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        loop: true
});
function initMap(){
  const location = {lat:37.38322999945196,lng: 2.040267971827429};
  const map = new google.maps.Map(document.querySelector('.map'),{
    zoom: 12,
    center: location,
  });
  const marker = new google.maps.Marker({
    position: location,
    map: map,
  });
}
