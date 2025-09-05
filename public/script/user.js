function validerAvis(id) {
  fetch(`/employee/valider-avis/${id}`, {
    method: "PATCH",
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("L'avis a été validé !");
        location.reload(); // Rafraîchir la page
      } else {
        alert("Erreur: " + data.message);
      }
    })
    .catch((error) => console.error("Erreur:", error));
}

function supprimerAvis(id) {
  if (!confirm("Voulez-vous vraiment supprimer cet avis ?")) {
    return;
  }

  fetch(`/employee/supprimer-avis/${id}`, {
    method: "DELETE",
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("L'avis a été supprimé !");
        location.reload(); // Rafraîchir la page
      } else {
        alert("Erreur: " + data.message);
      }
    })
    .catch((error) => console.error("Erreur:", error));
}

// Toggle des lignes d'édition ET des sous-tableaux (child rows)
document.addEventListener("click", function (e) {
  const btn = e.target.closest(
    ".btn-toggle-edit, .btn-cancel-edit, .btn-toggle-children, .btn-cancel-children"
  );
  if (!btn) return;

  const targetId = btn.getAttribute("data-target");
  if (!targetId) return;

  const row = document.getElementById(targetId);
  if (!row) return;

  // Ne fermer que dans le même tableau (utile sur /admin avec plusieurs sections)
  const table = btn.closest("table");
  const selector = ".edit-row, .child-row";
  const scopeRows = table
    ? table.querySelectorAll(selector)
    : document.querySelectorAll(selector);

  scopeRows.forEach((r) => {
    if (r !== row) r.classList.add("d-none");
  });

  const willOpen = row.classList.contains("d-none");
  row.classList.toggle("d-none");

  // Bonus UX : focus premier champ + scroll doux à l’ouverture
  if (willOpen) {
    const firstField = row.querySelector("input, select, textarea, button");
    if (firstField) firstField.focus({ preventScroll: true });
    row.scrollIntoView({ behavior: "smooth", block: "center" });
  }
});

// Confirmation générique (tout formulaire qui possède data-confirm)
document.addEventListener("submit", function (e) {
  const form = e.target;
  const msg = form.getAttribute("data-confirm");
  if (!msg) return;
  if (!window.confirm(msg)) e.preventDefault();
});

//stats

// public/js/stats-likes.js
(function bootLikesStats() {
  // Attendre le DOM si nécessaire
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", bootLikesStats);
    return;
  }

  const scope = document.getElementById("stats-likes");
  if (!scope) return;

  const input = scope.querySelector("#likes-filter");
  const tbody = scope.querySelector("#likes-tbody");
  if (!input || !tbody) return;

  const emptyRow = tbody.querySelector("[data-empty-row]");
  const rows = Array.from(tbody.querySelectorAll("tr")).filter(
    (tr) => !tr.hasAttribute("data-empty-row")
  );

  input.addEventListener("input", () => {
    const q = input.value.trim().toLowerCase();
    let visible = 0;

    rows.forEach((tr) => {
      const nameCell = tr.children[1]; // 2e colonne = nom
      const show =
        !q || (nameCell && nameCell.textContent.toLowerCase().includes(q));
      tr.style.display = show ? "" : "none";
      if (show) visible++;
    });

    if (emptyRow) emptyRow.style.display = visible ? "none" : "";
  });
})();
