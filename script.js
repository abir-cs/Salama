
let exps = [];

const getReviews = async () => {
  const res = await axios.get("/docs/experiences.json");
  return res.data.experiences;
};
$(window).on("scroll", function () {
  let opacity = Math.min($(this).scrollTop() / 300, 1);
  $("nav").css("background-color", `rgba(61, 71, 72,${opacity})`);
});

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

