

document.getElementById("affich_menu").addEventListener("click", (e) => {
    e.preventDefault();
    afficher_menu();

});

function afficher_menu() {
    var x = document.getElementById("my_menu");
    if (x.style.display == "flex") {
      x.style.display = "none";
    } else {
      x.style.display = "flex";
    }
  }
