// assets/js/dark-mode.js
// change to dark mode based on user OS preferences and listen for changes of this setting

function setDarkMode() {
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

setDarkMode();

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', setDarkMode);