document.addEventListener('DOMContentLoaded', function() {
  var openMenuButton = document.getElementById('openMenu');
  var sideMenu = document.getElementById('sideMenu');

  if (openMenuButton && sideMenu) {
      openMenuButton.addEventListener('click', function() {
          sideMenu.style.width = '700px';
      });

      var closeMenuButton = document.getElementById('closeMenu');
      if (closeMenuButton) {
          closeMenuButton.addEventListener('click', function() {
              sideMenu.style.width = '0';
          });
      }
  }
});
