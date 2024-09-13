<?php
include '../views/includes/header.php';
include '../config/connexion_bd.php'; // Connexion à la base de données

// Prénoms des animaux du marais
$animalNames = ['Crac', 'Godzilla', 'Pumba', 'Annie', 'Shelly'];

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


<div class="background-section-marais">
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
        <h1 class="animals-title">Marais</h1>
        <p class="intro-animals">
          Bienvenue dans les Marais, un écosystème luxuriant au cœur de notre zoo. Explorez cet habitat humide où le castor, le crocodile du Nil, l'hippopotame, le lamantin et la tortue de Californie prospèrent.<br>
          <br>
          Plongez dans ce monde aquatique où chaque créature révèle la beauté de la vie sauvage des Marais.
        </p>
      </div>
    </div>
  </div>

<section class="section-services">
  <!-- Animal 1: Crac - Castor -->
  <div class="service1">      
    <article class="description">
      <p>
        Prénom : Crac <br>
        Race : Castor <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Marais et cours d'eau <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Crac']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Crac']['nourriture_proposee']); ?> <br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Crac']['grammage_nourriture']); ?> <br>
     Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Crac']['date_passage']))); ?>


      </div>
      <div class="like-button-container">
        <button id="increment-Crac" class="jaime-btn">❤️ J'aime</button>
      </div>
    </article>
    <article class="service">
      <img src="assets/marais/castor.jpg" onclick="agrandirImage(this)" />
    </article>
  </div>
  <hr id="croco" class="service-divider">

  <!-- Animal 2: Godzilla - Crocodile du Nil -->
  <div class="service2">
    <article class="service">
      <img src="assets/marais/crocodilenil.jpg" onclick="agrandirImage(this)" />
    </article>
    <article class="description">
      <p>
        Prénom : Godzilla <br>
        Race : Crocodile du Nil <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Marais et cours d'eau <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Godzilla']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Godzilla']['nourriture_proposee']); ?> <br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Godzilla']['grammage_nourriture']); ?> <br>
        Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Godzilla']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Godzilla" class="jaime-btn" data-animal="Godzilla">❤️ J'aime</button>
        <div id="result-Godzilla">Godzilla: 0</div> <!-- Ce div affichera le nombre de "J'aime" -->
      </div>
    </article>
  </div>
  <hr class="service-divider">

  <!-- Animal 3: Pumba - Hippopotame -->
  <div class="service3">
    <article class="description">
      <p>
        Prénom : Pumba <br>
        Race : Hippopotame <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Marais et cours d'eau <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Pumba']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Pumba']['nourriture_proposee']); ?> <br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Pumba']['grammage_nourriture']); ?> <br>
        Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Pumba']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Pumba" class="jaime-btn">❤️ J'aime</button>
      </div>
    </article>
    <article class="service">
      <img src="assets/marais/hipopotame.jpg" onclick="agrandirImage(this)" />
    </article>
  </div>
  <hr class="service-divider">

  <!-- Animal 4: Annie - Lamantin -->
  <div class="service4">
    <article class="service">
      <img src="assets/marais/lamantin.jpg" onclick="agrandirImage(this)" />
    </article>
    <article class="description">
      <p>
        Prénom : Annie <br>
        Race : Lamantin <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Marais et cours d'eau <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Annie']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Annie']['nourriture_proposee']); ?> <br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Annie']['grammage_nourriture']); ?> <br>
        Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Annie']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Annie" class="jaime-btn">❤️ J'aime</button>
      </div>
    </article>
  </div>
  <hr class="service-divider">

  <!-- Animal 5: Shelly - Tortue de Californie -->
  <div class="service5">
    <article class="description">
      <p>
        Prénom : Shelly <br>
        Race : Tortue de Californie <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Marais et cours d'eau <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Shelly']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Shelly']['nourriture_proposee']); ?> <br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Shelly']['grammage_nourriture']); ?> <br>
        Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Shelly']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Shelly" class="jaime-btn">❤️ J'aime</button>
      </div>
    </article>
    <article class="service">
      <img src="assets/marais/tortuecalifornie.jpg" onclick="agrandirImage(this)" />
    </article>
  </div>
</section>

<?php include '../views/includes/footer.php'; ?>
