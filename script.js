
let exps = [];

const getReviews = async () => {
  const res = await axios.get("docs/experiences.json");
  return res.data.experiences;
};

window.onload = async () => {
  exps = await getReviews(); 

  exps.forEach(e => {
    $(".reviews").append(`
      <div class="review">
        <h3>${e.name}</h3>
        <p>${e.exp}</p>
      </div>
    `);
  });
};

$(window).on("scroll", function () {
  let opacity = Math.min($(this).scrollTop() / 300, 1);
  $("nav").css("background-color", `rgba(61, 71, 72,${opacity})`);
});
