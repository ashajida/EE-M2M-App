const init = (function () {

  // responsive menu function
  const burgerMenu = () => {
    let burger = document.querySelector(".burger");
    let navBar = document.querySelector(".links");

    //responsive menu button
    if (burger && navBar) {
      burger.addEventListener("click", function () {
        navBar.classList.toggle("active");
        burger.classList.toggle("toggle");
      });
    } else {
      return;
    }
  };

  burgerMenu();

})();