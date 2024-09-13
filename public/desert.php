<?php
include '../views/includes/header.php';
include '../config/connexion_bd.php'; // Connexion à la base de données

// Prénoms des animaux du désert
$animalNames = ['Nick', 'Feunard', 'Abo', 'Doma', 'Zed'];

// Récupére les informations des animaux par leur prénom
$query = $pdo->prepare("SELECT * FROM animals WHERE prenom IN (".str_repeat('?,', count($animalNames)-1)."?)");
$query->execute($animalNames);
$animals = $query->fetchAll(PDO::FETCH_ASSOC);

// Organise les données par prénom
$animalsByName = [];
foreach ($animals as $animal) {
    $animalsByName[$animal['prenom']] = $animal;
}
?>

<div class="background-section-desert">
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
        <h1 class="animals-title">Désert</h1>
        <p class="intro-animals">
          Bienvenue dans notre zoo, une oasis de découverte au cœur de la nature sauvage. Explorez notre désert reconstitué, un monde de vastes enclos rocailleux et de ciels infinis. Ici, la vie prospère malgré les défis, avec des créatures extraordinaires adaptées à ce milieu unique. Rencontrez le majestueux cobra royal, le charmant fennec, la redoutable vipère du désert, le gracieux dromadaire et l'insaisissable iguane du désert, chacun illustrant une résilience remarquable dans ce paysage désolé mais magnifique.
        </p>
      </div>
    </div>
  </div>

<section class="section-services">
  <!-- Animal 1: Nick - Vipère des sables -->
  <div class="service1">
    <article class="description">
      <p>
        Prénom : Nick <br>
        Race : Vipère des sables <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Zones désertiques d'Afrique du Nord et du Moyen-Orient <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Nick']['etat_animal']); ?> <br>
       Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Nick']['nourriture_proposee']); ?> <br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Nick']['grammage_nourriture']); ?> <br>
       Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Nick']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Nick" class="jaime-btn" data-animal="Nick">❤️ J'aime</button>
      </div>
    </article>
    <article class="service">
      <img src="assets/desert/viperedesert.jpg" onclick="agrandirImage(this)" />
    </article>
  </div>
  <hr class="service-divider">

  <!-- Animal 2: Feunard - Fennec -->
  <div class="service2">
    <article class="service">
      <img src="assets/desert/fenec.jpg" onclick="agrandirImage(this)" />
    </article>
    <article class="description">
      <p>
        Prénom : Feunard <br>
        Race : Fennec <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Déserts d'Afrique du Nord <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Feunard']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Feunard']['nourriture_proposee']); ?><br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Feunard']['grammage_nourriture']); ?> <br>
        Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Feunard']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Feunard" class="jaime-btn" data-animal="Feunard">❤️ J'aime</button>
      </div>
    </article>
  </div>
  <hr class="service-divider">

  <!-- Animal 3: Abo - Cobra royal -->
  <div class="service3">
    <article class="description">
      <p>
        Prénom : Abo <br>
        Race : Cobra royal <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Forêts tropicales, plaines et déserts d'Asie <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Abo']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Abo']['nourriture_proposee']); ?><br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Abo']['grammage_nourriture']); ?> <br>
        Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Abo']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Abo" class="jaime-btn" data-animal="Abo">❤️ J'aime</button>
      </div>
    </article>
    <article class="service">
      <img src="assets/desert/cobraroyal.jpg" onclick="agrandirImage(this)" />
    </article>
  </div>
  <hr class="service-divider">

  <!-- Animal 4: Doma - Dromadaire -->
  <div class="service4">
    <article class="service">
      <img src="assets/desert/dromadaire.jpg" onclick="agrandirImage(this)" />
    </article>
    <article class="description">
      <p>
        Prénom : Doma <br>
        Race : Dromadaire <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Déserts d'Afrique du Nord et du Moyen-Orient <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Doma']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Doma']['nourriture_proposee']); ?><br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Doma']['grammage_nourriture']); ?> <br>
        Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Doma']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Doma" class="jaime-btn" data-animal="Doma">❤️ J'aime</button>
      </div>
    </article>
  </div>
  <hr class="service-divider">

  <!-- Animal 5: Zed - Iguane du désert -->
  <div class="service5">
    <article class="description">
      <p>
        Prénom : Zed <br>
        Race : Iguane du désert <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
      <div style="display: none">
        Habitat : Déserts d'Amérique du Nord <br>
        État de l'animal : <?php echo htmlspecialchars($animalsByName['Zed']['etat_animal']); ?> <br>
        Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Zed']['nourriture_proposee']); ?><br>
        Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Zed']['grammage_nourriture']); ?> <br>
        Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Zed']['date_passage']))); ?>

      </div>
      <div class="like-button-container">
        <button id="increment-Zed" class="jaime-btn" data-animal="Zed">❤️ J'aime</button>
      </div>
    </article>
    <article class="service">
      <img src="assets/desert/iguanedesert.jpg" onclick="agrandirImage(this)" />
    </article>
  </div>
</section>

<?php include '../views/includes/footer.php'; ?>
