// /* ------------------------------ Owl Carousel ------------------------------ */
// $(".hero-carousel").owlCarousel({
// 	loop: true,
// 	margin: 10,
// 	nav: false,
// 	autoplay: true,
// 	responsive: {
// 		0: {
// 			items: 1,
// 		},
// 		600: {
// 			items: 1,
// 		},
// 		1000: {
// 			items: 1,
// 		},
// 	},
// });

// $(".recipe-carousel").owlCarousel({
// 	loop: true,
// 	margin: 10,
// 	nav: false,
// 	autoplay: true,
// 	autoplayTimeout: 5000,
// 	autoplayHoverPause: false,

// 	responsive: {
// 		0: {
// 			items: 1,
// 		},
// 		600: {
// 			items: 2,
// 		},
// 		1000: {
// 			items: 3,
// 		},
// 	},
// });

// /* -------------------------------- DashBoard ------------------------------- */

// /* ----------------------------- Menu Show Hide ----------------------------- */
const sideMenu = document.querySelector("aside");
const menuButton = document.getElementById("menu__button");
const closeIcon = document.querySelector("#close__icon");
const themeChange = document.querySelector("#theme__toggle");
const lightSwitch = document.querySelector("#lightOption");

menuButton.addEventListener("click", () => {
	sideMenu.style.display = "block";
	// console.log("Hello");
});
closeIcon.addEventListener("click", () => {
	sideMenu.style.display = "none";
});

themeChange.addEventListener("click", () => {
	document.body.classList.toggle("dark__theme-variables");
	console.log("get");
	lightSwitch.classList.toggle("active__theme");
	document.querySelector(".theme__chng").classList.toggle("active__theme");
});
