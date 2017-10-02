var leftMenu = document.querySelector('#left-menu');
var leftMenuToggle = document.querySelector('#left-menu-toggle');
var contentContainer = document.querySelector('#ex-container');

if (leftMenuToggle) {
    leftMenuToggle.addEventListener('click', function(e) {
        e.preventDefault();
        if (leftMenuToggle.classList.contains('condensed')) {
            leftMenuToggle.classList.remove('condensed');
            leftMenu.classList.remove('condensed');
            contentContainer.classList.remove('expanded');
            document.cookie = "left_menu_condensed=false; path=/";
        } else {
            leftMenuToggle.classList.add('condensed');
            leftMenu.classList.add('condensed');
            contentContainer.classList.add('expanded');
            document.cookie = "left_menu_condensed=true; path=/";
        }
    });
}