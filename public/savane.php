<?php
include '../views/includes/header.php';
include '../config/connexion_bd.php'; // Connexion à la base de données avec PDO

// Prénoms des animaux de la savane
$animalNames = ['Tembo', 'Jasiri', 'Kito', 'Raja', 'Simba', 'RhinoFamily', 'Zuri'];

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

<div class="background-section-savane">
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
        <h1 class="animals-title">Savane</h1>
        <p class="intro-animals">
          Bienvenue dans la Savane, un vaste horizon de beauté naturelle au cœur de notre zoo. Découvrez cet habitat emblématique où l'éléphant d'Afrique, la girafe, le guépard, le lion, le rhinocéros et le zèbre évoluent en harmonie.<br><br>
          Parcourez ces étendues sauvages où chaque pas révèle la majesté de la vie animale. Plongez dans ce monde fascinant où chaque créature incarne la splendeur de la vie sauvage de la Savane.
        </p>
      </div>
    </div>
  </div>

  <section class="section-services">
    <!-- Animal 1: Tembo - Élephant d'Afrique -->
    <div class="service1">      
      <article class="description">
<p>
  Prénom : Tembo <br>
  Race : Éléphant d'Afrique <br>
          <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
          </p>
        <div style="display: none">
  Habitat : Savane <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Tembo']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Tembo']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Tembo']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Tembo']['date_passage']))); ?>

        </div>
        <div class="like-button-container">
          <button id="increment-Tembo" class="jaime-btn">
            ❤️ J'aime
          </button>
        </div>
      </article>
      <article class="service">
        <img src="assets/savane/elephant.jpg" onclick="agrandirImage(this)" />
      </article>
    </div>
    <hr class="service-divider">

    <!-- Animal 2: Jasiri - Girafe -->
    <div class="service2">
      <article class="service">
        <img src="assets/savane/girafe.jpg" onclick="agrandirImage(this)" />
      </article>
      <article class="description">
<p>
  Prénom : Jasiri <br>
  Race : Girafe <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
<div style="display: none">
  Habitat : Savane <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Jasiri']['etat_animal']); ?> <br>
            Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Jasiri']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Jasiri']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Jasiri']['date_passage']))); ?>

        </div>
           <!-- Animal 4: Kito - Jeune Girafe -->
        <p>
  Prénom : Kito <br>
  Race : Girafe (Jeune) <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
<div style="display: none">
  Habitat : Savane <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Kito']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Kito']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Kito']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Kito']['date_passage']))); ?>

        </div>
        <div class="like-button-container">
          <button id="increment-JasiriKito" class="jaime-btn">
            ❤️ J'aime
          </button>
        </div>
      </article>
    </div>
    <hr class="service-divider">

    <!-- Animal 4: Raja - Guépard -->
    <div class="service3">
      <article class="description">
<p>
  Prénom : Raja <br>
  Race : Guépard <br>
            <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
            </p>
        <div style="display: none">
  Habitat : Savane <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Raja']['etat_animal']); ?> <br>
Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Raja']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Raja']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Raja']['date_passage']))); ?>
        </div>
        <div class="like-button-container">
          <button id="increment-Raja" class="jaime-btn">
            ❤️ J'aime
          </button>
        </div>
      </article>
      <article class="service">
        <img src="assets/savane/guepard.jpg" onclick="agrandirImage(this)" />
      </article>
    </div>
    <hr class="service-divider">

    <!-- Animal 5: Simba - Lion -->
    <div class="service4">
      <article class="service">
        <img src="assets/savane/lion.jpg" onclick="agrandirImage(this)" />
      </article>
      <article class="description">
<p>
  Prénom : Simba <br>
  Race : Lion <br>
         <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
          </p>
        <div style="display: none">
          Habitat : Savane <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Simba']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Simba']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Simba']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Simba']['date_passage']))); ?>
        </div>
        <div class="like-button-container">
          <button id="increment-Simba" class="jaime-btn">
            ❤️ J'aime
          </button>
        </div>
      </article>
    </div>
    <hr class="service-divider">

    <!-- Animal 6: RhinoFamily - Rhinocéros -->
    <div class="service5">
      <article class="description">
<p>
  Prénom : Rhino, Rina et Rocco <br>
  Race : Rhinocéros <br>
           <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
           </p>
        <div style="display: none">
            Habitat : Savane <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['RhinoFamily']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['RhinoFamily']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['RhinoFamily']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['RhinoFamily']['date_passage']))); ?>
        </div>
        <div class="like-button-container">
          <button id="increment-RhinoFamily" class="jaime-btn">
            ❤️ J'aime
          </button>
        </div>
      </article>
      <article class="service">
        <img src="assets/savane/rhinoceros.jpg" onclick="agrandirImage(this)" />
      </article>
    </div>
    <hr class="service-divider">

    <!-- Animal 7: Zuri - Zèbre -->
    <div class="service6">
      <article class="service">
        <img src="assets/savane/zèbre.jpg" onclick="agrandirImage(this)" />
      </article>
      <article class="description">
    <p>
  Prénom : Zara <br>
  Race : Zèbre <br>
             <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
             </p>
        <div style="display: none">
            Habitat : Savane <br>
          État de l'animal : <?php echo htmlspecialchars($animalsByName['Zuri']['etat_animal']); ?> <br>
          Nourriture proposée : <?php echo htmlspecialchars($animalsByName['Zuri']['nourriture_proposee']); ?> <br>
          Grammage de la nourriture : <?php echo htmlspecialchars($animalsByName['Zuri']['grammage_nourriture']); ?> <br>
          Date de passage : <?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($animalsByName['Zuri']['date_passage']))); ?>
        </div>
        <div class="like-button-container">
          <button id="increment-Zuri" class="jaime-btn">
            ❤️ J'aime
          </button>
        </div>
      </article>
    </div>
    <hr class="service-divider">
  </section>
</div>

<?php
include '../views/includes/footer.php';
?>
