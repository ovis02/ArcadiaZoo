<?php
include '../views/includes/header.php';
?>
    <div class="screen">
      <h6 class="title-form">Contactez nous</h6>
      <div class="Formulaire">
         <form action="../actions/message/traitement_contact.php" method="POST">
    <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            placeholder="Email"
            style="max-width: 450px"
            required
        />
    </div>
    <div class="form-group">
        <label for="motif" class="form-label">Motif</label>
        <input
            type="text"
            class="form-control"
            id="motif"
            name="motif"
            placeholder="Motif"
            style="max-width: 450px"
            required
        />
    </div>
    <div class="form-group">
        <label for="description" class="form-label">Description</label>
        <textarea
            class="form-control"
            id="description"
            name="description"
            rows="5"
            placeholder="Description"
            style="max-width: 450px"
            required
        ></textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="form-button">Envoyer</button>
    </div>
</form>
      </div>
<?php include'../views/includes/footer.php'; ?>
