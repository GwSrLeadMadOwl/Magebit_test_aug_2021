(function darkMode() {
    let t = new Date().getHours().valueOf();
    if (t >= 6 && t <= 19) {
        document.documentElement.classList.remove("dark-mode");
    } else {
        document.documentElement.classList.add("dark-mode");
    }
})();