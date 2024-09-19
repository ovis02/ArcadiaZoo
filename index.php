<?php
// Inclure le fichier de connexion à la base de données
include_once "config/connexion_bd.php";

// Sélectionne les avis validés
$sql = "SELECT pseudo, commentaire, date_creation FROM Avis WHERE est_valide = 1 ORDER BY date_creation DESC";
$stmt = $pdo->query($sql);
include 'views/includes/header.php';
?>
    <div class="background-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="presentation-container">
              <div class="text-container">
                <h1>Bienvenue à Arcadia</h1>
                <p>
                  Bienvenue à Arcadia, le zoo où la nature prend vie ! Plongez
                  dans un monde fascinant où la diversité des habitats rencontre
                  la richesse de la faune.<br />

                  Explorez la majesté de la savane, où le rugissement des lions
                  résonne au loin, tandis que les éléphants parcourent
                  paisiblement les vastes plaines. Observez avec émerveillement
                  la grâce des girafes se nourrissant des feuilles des
                  acacias.<br />

                  Dans les profondeurs mystérieuses de la jungle, rencontrez les
                  regards pénétrants des tigres, rois indomptables de la
                  canopée. Laissez-vous enchanter par la mélodie des singes
                  hurleurs et la splendeur colorée des aras.<br />

                  En gravissant les sommets escarpés de nos montagnes, découvrez
                  le monde secret des bouquetins et des chamois, maîtres de
                  l'escalade.<br />

                  Plongez dans les étendues arides et envoûtantes du désert, où
                  le cobra royal règne en souverain solitaire. Émerveillez-vous
                  devant la résilience des dromadaires, symboles de l'adaptation
                  aux conditions extrêmes, ainsi que devant le regard fier du
                  fennec, de la vipère du désert et de l'iguane du désert.<br />

                  Explorez les marais luxuriants et secrets, où les hippopotames
                  se prélassent paisiblement parmi les roseaux.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="image-container">
              <img id="main-image" src="assets/jungle/tigre.jpg" alt="Tigre" class="img-fluid" />
            </div>
          </div>
        </div>
      </div>
      <div class="centered-section">
        <h2>Explorez la diversité de nos habitats</h2>
        <p>
          Rencontrez nos animaux emblématiques de la savane, des marais et des
          montagnes, et plongez dans leurs mondes fascinants.
        </p>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="rectangle">
              <img
                src="assets/savane/lion.jpg"
                alt="Image 1"
                class="image img-fluid"
              />
              <div class="description-contain">
                <p>
                  Rencontrez le roi de la savane - le lion. Découvrez sa majesté
                  et sa puissance
                </p>
                <a href="savane.php#lion"
                  >En savoir plus...<img
                    src="assets/logo/iconeLien.png"
                    alt="Logo En Savoir Plus"
                /></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="rectangle">
              <img
                src="assets/marais/crocodilenil.jpg"
                alt="Image 2"
                class="image img-fluid"
              />
              <div class="description-contain">
                <p>Explorez le monde mystérieux des crocodiles des marais</p>
                <a href="marais.php#croco"
                  >En savoir plus...<img
                    src="assets/logo/iconeLien.png"
                    alt="Logo En Savoir Plus"
                /></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="rectangle">
              <img
                src="assets/montagne/loup.jpg"
                alt="Image 3"
                class="image img-fluid"
              />
              <div class="description-contain">
                <p>
                  Plongez dans l'essence majestueuse du loup gris, maître des forêts sauvages
                </p>
                <a href="mountain.php#loup"
                  >En savoir plus...<img
                    src="assets/logo/iconeLien.png"
                    alt="Logo En Savoir Plus"
                /></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="transparent-rectangle">
          <h3>Laisser un avis</h3>
   <form id="avis_form">
                <div class="form-group">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" />
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" />
                </div>
                <div class="form-group">
                    <label for="commentaire">Commentaire :</label>
                    <textarea class="form-control" id="commentaire" name="commentaire" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-submit" style="background-color: #dae8e1">Laisser un avis</button>
            </form>
            <!-- Div pour afficher le message -->
   
        </div>
      </div>
       <div id="message" style="display: none;"></div>
    <!-- Section pour afficher les avis validés -->
 <div class="container">
        <?php while ($row = $stmt->fetch()): ?>
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="comment-info">
                    <h4>Pseudo</h4>
                    <p><?php echo htmlspecialchars($row['pseudo']); ?></p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="comment-info">
                    <h4>Date</h4>
                    <p><?php echo htmlspecialchars($row['date_creation']); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="comment-content">
                    <h4>Commentaires</h4>
                    <p><?php echo htmlspecialchars($row['commentaire']); ?></p>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

           <?php include 'views/includes/footer.php'; ?>