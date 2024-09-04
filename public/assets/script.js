// Sélectionnez le logo burger bouton et la barre de navigation verticale
const logoBurgerButton = document.getElementById("logo-burger-button");
const verticalNavbar = document.getElementById("vertical-navbar");

// Créez une variable pour suivre l'état de la barre de navigation
let isNavbarVisible = false;

// Fonction pour ouvrir la barre de navigation
function openNavbar() {
  verticalNavbar.style.display = "flex"; // Affiche la barre verticale
  isNavbarVisible = true;
}

// Fonction pour fermer la barre de navigation
function closeNavbar() {
  verticalNavbar.style.display = "none"; // Cache la barre verticale
  isNavbarVisible = false;
}

// Sélectionnez le bouton "Fermer"
const closeButton = document.getElementById("close-button");

// Ajoute un gestionnaire d'événement au bouton "Fermer"
closeButton.addEventListener("click", () => {
  closeNavbar();
});

// Ajoute un gestionnaire d'événement au logo burger bouton
logoBurgerButton.addEventListener("click", () => {
  if (!isNavbarVisible) {
    openNavbar();
  } else {
    closeNavbar();
  }
});

// Fonction pour cacher la barre de navigation verticale lorsque la largeur de l'écran est supérieure à 834px
function hideVerticalNavbarOnDesktop() {
  if (window.innerWidth > 834) {
    verticalNavbar.style.display = "none";
  }
}

// Appeler la fonction pour cacher la barre de navigation verticale au chargement de la page
hideVerticalNavbarOnDesktop();

// Écouter les changements de taille de l'écran et cacher la barre de navigation verticale si nécessaire
window.addEventListener("resize", hideVerticalNavbarOnDesktop);

// Sélectionnez le lien "Admin" et le formulaire de connexion admin
const adminLink = document.querySelector(".admin");
const loginForm = document.querySelector(".login-form");

// Fonction pour ouvrir le formulaire de connexion admin
function openAdminLoginForm() {
  loginForm.style.display = "block"; // Affiche le formulaire de connexion
}

// Fonction pour fermer le formulaire de connexion admin
function closeAdminLoginForm() {
  loginForm.style.display = "none"; // Cache le formulaire de connexion
}

// Ajoute un gestionnaire d'événement au lien "Admin" pour ouvrir/fermer le formulaire
adminLink.addEventListener("click", (event) => {
  event.preventDefault(); // Empêche le comportement par défaut du lien

  // Vérifie si le formulaire est déjà affiché
  if (loginForm.style.display === "block") {
    closeAdminLoginForm(); // Ferme le formulaire s'il est déjà ouvert
  } else {
    openAdminLoginForm(); // Ouvre le formulaire s'il est caché
  }
});

// Liste des chemins d'accès des images à faire défiler
const imagePaths = [
  "assets/jungle/tigre.jpg",
  "assets/savane/elephant.jpg",
  "assets/marais/hipopotame.jpg",
  "assets/savane/lion.jpg",
];
const imageElement = document.getElementById("main-image");
let currentIndex = 0;

// Fonction pour changer l'image à intervalles réguliers
function changeImage() {
  currentIndex = (currentIndex + 1) % imagePaths.length;
  imageElement.src = imagePaths[currentIndex];
}

// Définir l'intervalle de temps pour changer l'image (par exemple, toutes les 5 secondes)
const interval = setInterval(changeImage, 5000); // Temps en millisecondes entre chaque changement d'image

function toggleInfo(button) {
  const moreInfo = button.parentElement.nextElementSibling;

  // Affichage des informations supplémentaires
  if (moreInfo.style.display === "none") {
    moreInfo.style.display = "block";
    button.textContent = "Afficher moins...";
  } else {
    moreInfo.style.display = "none";
    button.textContent = "En savoir plus...";
  }
}

/*fonction j'aime*/
document
  .getElementById("increment-Godzilla")
  .addEventListener("click", async () => {
    try {
      const response = await fetch(
        "http://localhost:3000/animal/Godzilla/click",
        {
          method: "POST",
        }
      );

      if (response.ok) {
        const data = await response.json();
        console.log("Compteur Godzilla incrémenté:", data);
        document.getElementById(
          "result"
        ).innerHTML = `Godzilla: ${data.animal.views}`;
      } else {
        console.error("Erreur lors de l'incrémentation du compteur");
      }
    } catch (error) {
      console.error("Erreur lors de l'incrémentation:", error);
    }
  });
