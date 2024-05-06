<?php
include 'header.php';
?>
    <div class="screen">
      <h6 class="title-form">Contactez nous</h6>
      <div class="Formulaire">
        <form>
          <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder="Email"
              style="max-width: 450px"
            />
          </div>
          <div class="form-group">
            <label for="motif" class="form-label">Motif</label>
            <input
              type="text"
              class="form-control"
              id="motif"
              placeholder="Motif"
              style="max-width: 450px"
            />
          </div>
          <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea
              class="form-control"
              id="description"
              rows="5"
              placeholder="Description"
              style="max-width: 450px"
            ></textarea>
          </div>
          <div class="text-center">
            <button type="submit" class="form-button">Envoyer</button>
          </div>
        </form>
      </div>
<?php include('footer.php'); ?>
