<?php
include '../views/includes/header.php';
include '../config/connexion_bd.php'; // Connexion à la base de données avec PDO

// Prénoms des animaux de cette page
$animalNames = ['Scott', 'Cricri', 'Doug', 'Wolf', 'Spog'];

// Récupérer les informations des animaux par leur prénom
$query = $pdo->prepare("SELECT * FROM animals WHERE prenom IN (".str_repeat('?,', count($animalNames)-1)."?)");
$query->execute($animalNames);
$animals = $query->fetchAll(PDO::FETCH_ASSOC);

// Organiser les données par prénom
$animalsByName = [];
foreach ($animals as $animal) {
    $animalsByName[$animal['prenom']] = $animal;
}
?>

<div class="background-section-mountain">
  <div class="container service-container">
    <div class="row">
      <nav class="col-md-3 service-nav"> 
        <ul>
          <li <?php if(basename($_SERVER['PHP_SELF']) == 'desert.php') echo 'class="active"'; ?>><a href="desert.php">Désert</a></li>
          <li <?php if(basename($_SERVER['PHP_SELF']) == 'jungle.php') echo 'class="active"'; ?>><a href="jungle.php">Jungle</a></li>
          <li <?php if(basename($_SERVER['PHP_SELF']) == 'mountain.php') echo 'class="active"'; ?>><a href="mountain.php">Montagne</a></li>
          <li <?php if(basename($_SERVER['PHP_SELF']) == 'marais.php') echo 'class="active"'; ?>><a href="marais.php">Marais</a></li>
          <li <?php if(basename($_SERVER['PHP_SELF']) == 'savane.php') echo 'class="active"'; ?>><a href="savane.php">Savane</a></li>
        </ul>
      </nav>
      <div class="col-md-9 content animals-intro">
        <h1 class="animals-title">Montagne</h1>
        <p class="intro-animals">
          Bienvenue dans les Montagnes, un monde d'altitude et de majesté au cœur même de notre zoo. Découvrez l'aigle royal, le bouquetin, le chamois, le loup et la marmotte, chacun parfaitement adapté à ce royaume de sommets enneigés et de vallées verdoyantes.
          <br><br>
          Plongez dans cet habitat alpin où chaque pic et chaque vallée révèle la beauté et la résilience de la vie sauvage des Montagnes.
        </p>
      </div>
    </div>
  </div>

  <section class="section-services">
    <!-- Animal 1: Scott - Aigle royal -->
    <div class="service1">
      <article class="description">
        <p>
          Prénom : Scott <br>
          Race : Aigle royal <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
        <div style="display: none">
          Habitat : Régions montagneuses et falaises escarpées <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Scott']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Scott']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Scott']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Scott']['date_passage']))); ?>

        </div>
        <div class="like-button-container">
          <button id="increment-Scott" class="jaime-btn">❤️ J'aime</button>
        </div>
      </article>
      <article class="service">
        <img src="assets/montagne/aigleroyal.jpg" onclick="agrandirImage(this)" />
      </article>
    </div>
    <hr class="service-divider">

    <!-- Animal 2: Cricri - Bouquetin -->
    <div class="service2">
      <article class="service">
        <img src="assets/montagne/bouquetin.jpg" onclick="agrandirImage(this)" />
      </article>
      <article class="description">
        <p>
          Prénom : Cricri <br>
          Race : Bouquetin <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
        <div style="display: none">
          Habitat : Montagnes rocailleuses et pentes escarpées <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Cricri']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Cricri']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Cricri']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Cricri']['date_passage']))); ?>

        </div>
        <div class="like-button-container">
          <button id="increment-Cricri" class="jaime-btn">❤️ J'aime</button>
        </div>
      </article>
    </div>
    <hr class="service-divider">

    <!-- Animal 3: Doug - Chamois -->
    <div class="service3">
      <article class="description">
        <p>
          Prénom : Doug <br>
          Race : Chamois <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
        <div style="display: none">
          Habitat : Montagnes rocailleuses et pentes escarpées <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Doug']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Doug']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Doug']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Doug']['date_passage']))); ?>

        </div>
        <div class="like-button-container">
          <button id="increment-Doug" class="jaime-btn">❤️ J'aime</button>
        </div>
      </article>
      <article class="service">
        <img src="assets/montagne/chamois.jpg" onclick="agrandirImage(this)" />
      </article>
    </div>
    <hr class="service-divider">

    <!-- Animal 4: Wolf - Loup gris -->
    <div class="service4">
      <article class="service">
        <img src="assets/montagne/loup.jpg" onclick="agrandirImage(this)" />
      </article>
      <article class="description">
        <p>
          Prénom : Wolf <br>
          Race : Loup gris <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
        <div style="display: none">
          Habitat : Forêts et montagnes boisées <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Wolf']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Wolf']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Wolf']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Wolf']['date_passage']))); ?>

        </div>
        <div class="like-button-container">
          <button id="increment-Wolf" class="jaime-btn">❤️ J'aime</button>
        </div>
      </article>
    </div>
    <hr class="service-divider">

    <!-- Animal 5: Spog - Marmotte -->
    <div class="service5">
      <article class="description">
        <p>
          Prénom : Spog <br>
          Race : Marmotte <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
        <div style="display: none">
          Habitat : Montagnes rocheuses et prairies alpines <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Spog']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Spog']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Spog']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Spog']['date_passage']))); ?>

        </div>
        <div class="like-button-container">
          <button id="increment-Spog" class="jaime-btn">❤️ J'aime</button>
        </div>
      </article>
      <article class="service">
        <img src="assets/montagne/marmotte.jpg" onclick="agrandirImage(this)" />
      </article>
    </div>
  </section>

<?php include '../views/includes/footer.php'; ?>
