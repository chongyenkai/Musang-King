document.addEventListener("DOMContentLoaded", function() {
    const profileIcon = document.getElementById("profile-icon");
    const popup = document.getElementById("popup");
    const closeBtn = document.querySelector(".close-btn");
  
    profileIcon.addEventListener("click", function(event) {
      event.preventDefault();
      popup.style.display = "block";
    });
  
    closeBtn.addEventListener("click", function() {
      popup.style.display = "none";
    });
  
    window.addEventListener("click", function(event) {
      if (event.target === popup) {
        popup.style.display = "none";
      }
    });
  });
  