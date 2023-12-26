if (location.pathname === "/register" || location.pathname === "/login") {
  document.querySelector(".side-bar").remove();
  document.querySelector(".header").remove();
}

if (location.pathname !== "/register" || location.pathname !== "/login") {
  let elem = document.querySelector("a > div.auth");
  elem !== null && elem.remove();
}

if (location.pathname == "/admin") {
  document.querySelector(".side-bar").remove();
}
