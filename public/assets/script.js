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
  "public/assets/jungle/tigre.jpg",
  "public/assets/savane/elephant.jpg",
  "public/assets/marais/hipopotame.jpg",
  "public/assets/savane/lion.jpg",
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

  // Affichage des informations supplémentaires sur les animaux
  if (moreInfo.style.display === "none") {
    moreInfo.style.display = "block";
    button.textContent = "Afficher moins...";
  } else {
    moreInfo.style.display = "none";
    button.textContent = "En savoir plus...";
  }
}

//fonction ajax pour la soumission de l'avis sans recharger la page
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("avis_form");
  if (form) {
    form.addEventListener("submit", function (event) {
      event.preventDefault(); // Empêcher le comportement par défaut du formulaire

      console.log("Formulaire soumis");

      let formData = new FormData(this);

      fetch("../../actions/avis/traitement_avis.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          console.log("Réponse reçue :", data);

          let messageDiv = document.getElementById("message");
          if (data.status === "success") {
            messageDiv.style.color = "green";
          } else {
            messageDiv.style.color = "red";
          }
          messageDiv.innerHTML = data.message;
          messageDiv.style.display = "block";
        })
        .catch((error) => {
          console.error("Erreur lors de la soumission du formulaire :", error);
        });
    });
  } else {
    console.error("Le formulaire avec l'ID 'avis_form' est introuvable.");
  }
});

// Ajoute un événement à tous les boutons "J'aime"
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".jaime-btn").forEach((button) => {
    button.addEventListener("click", async () => {
      const animalName =
        button.getAttribute("data-animal") || button.id.split("-")[1];

      // Déterminer l'URL du serveur Node.js
      const serverUrl = `${window.location.origin}/animal/${animalName}/click`; // Utilise l'URL de l'application

      try {
        const response = await fetch(serverUrl, {
          method: "POST",
        });

        if (response.ok) {
          const data = await response.json();
          console.log(`${animalName} compteur incrémenté :`, data.animal.views);

          // Met à jour le compteur sur la page
          const resultDiv = document.querySelector(`#result-${animalName}`);
          if (resultDiv) {
            resultDiv.textContent = `${animalName}: ${data.animal.views}`;
          }
        } else {
          console.error("Erreur lors de l'incrémentation du compteur");
        }
      } catch (error) {
        console.error("Erreur lors de l'incrémentation:", error);
      }
    });
  });
});
