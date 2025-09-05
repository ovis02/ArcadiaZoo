const logoBurgerButton = document.getElementById("logo-burger-button");
const verticalNavbar = document.getElementById("vertical-navbar");
const closeButton = document.getElementById("close-button");

// Fonction pour ouvrir la navbar
function openNavbar() {
  verticalNavbar.classList.add("active");
}

// Fonction pour fermer la navbar
function closeNavbar() {
  verticalNavbar.classList.remove("active");
}

// Toggle via le logo burger
logoBurgerButton.addEventListener("click", (e) => {
  e.preventDefault();
  verticalNavbar.classList.contains("active") ? closeNavbar() : openNavbar();
});

// Bouton "Fermer"
closeButton.addEventListener("click", closeNavbar);

// Cacher la navbar si on repasse en mode desktop
window.addEventListener("resize", () => {
  if (window.innerWidth > 834) {
    closeNavbar();
  }
});

document.addEventListener("DOMContentLoaded", function () {
  // Liste des chemins d'accès des images à faire défiler
  const imagePaths = [
    "/assets/images/jungle/tigre.jpg",
    "/assets/images/savane/elephant.jpg",
    "/assets/images/marais/hipopotame.jpg",
    "/assets/images/savane/lion.jpg",
  ];

  // Sélection de l'élément img avec l'ID 'main-image'
  const imageElement = document.getElementById("main-image");

  // Si l'élément image existe
  if (!imageElement) {
    console.error("L'élément avec l'ID 'main-image' est introuvable.");
    return;
  }

  let currentIndex = 0;

  // Fonction pour changer l'image à intervalles réguliers
  function changeImage() {
    currentIndex = (currentIndex + 1) % imagePaths.length;
    imageElement.src = imagePaths[currentIndex];
  }

  // Définir l'intervalle de temps pour changer l'image (par exemple, toutes les 5 secondes)
  const interval = setInterval(changeImage, 5000); // Temps en millisecondes entre chaque changement d'image
});

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
//formulaire de contact

document.addEventListener("DOMContentLoaded", function () {
  const contactForm = document.getElementById("contactForm");
  const messageContainer = document.getElementById("message-contact");

  if (!contactForm || !messageContainer) {
    console.error("Formulaire ou conteneur de message introuvable.");
    return;
  }

  contactForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(contactForm);

    fetch("/formulaire", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Nettoyage des classes
        messageContainer.classList.remove("success", "error");

        if (data.status === "success") {
          messageContainer.classList.add("success");
          contactForm.reset(); // Réinitialise le formulaire
        } else {
          messageContainer.classList.add("error");
        }

        messageContainer.textContent = data.message;
        messageContainer.style.display = "block";
      })
      .catch((error) => {
        messageContainer.classList.remove("success");
        messageContainer.classList.add("error");
        messageContainer.textContent =
          "Une erreur est survenue. Veuillez réessayer.";
        messageContainer.style.display = "block";
        console.error("Erreur lors de l'envoi du message :", error);
      });
  });
});

// formulaire comments

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("avis_form");
  const msg = document.getElementById("message");
  if (!form || !msg) return;

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    try {
      const res = await fetch(form.action || window.location.href, {
        method: "POST",
        body: new FormData(form),
        headers: { "X-Requested-With": "XMLHttpRequest" },
      });

      const data = await res.json();

      msg.textContent = data.message || (data.ok ? "Merci !" : "Erreur.");
      msg.className = data.ok ? "msg-success" : "msg-error";
      msg.style.display = "block";

      if (data.ok) form.reset();
    } catch (err) {
      msg.textContent = "Une erreur est survenue. Réessayez.";
      msg.className = "msg-error";
      msg.style.display = "block";
    }

    setTimeout(() => (msg.style.display = "none"), 4000);
  });
});

// Incrémentation "J'aime" (simple & robuste)
document.addEventListener("click", async (e) => {
  const b = e.target.closest(".jaime-btn");
  if (!b || b.disabled) return;
  e.preventDefault();

  const url = b.dataset.url;
  const token = b.dataset.token;
  const name = b.dataset.name || "Inconnu";

  let success = false;
  const previousLabel = b.textContent;

  b.disabled = true;
  b.textContent = "…"; // petit indicateur de chargement

  try {
    const res = await fetch(url, {
      method: "POST",
      credentials: "same-origin",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({ token, name }),
    });

    let data = {};
    try {
      data = await res.json();
    } catch {}

    if (!res.ok || !data.ok) {
      throw new Error(data.message || data.error || `HTTP ${res.status}`);
    }

    // Feedback clair + compteur mis à jour
    b.textContent = `❤️ Merci ! (${data.count})`;
    b.setAttribute("aria-pressed", "true");
    b.classList.add("liked");
    success = true;
  } catch (err) {
    alert(`Erreur: ${err.message || err}`);
    b.textContent = previousLabel; // on remet l'ancien libellé si échec
  } finally {
    // Si succès: on garde désactivé (pas de "unlike")
    // Si échec: on réactive pour retenter
    b.disabled = success ? true : false;
  }
});
