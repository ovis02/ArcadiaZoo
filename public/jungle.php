<?php
include '../views/includes/header.php';
?>
  <div class="background-section-jungle">
  <div class="container service-container">
    <div class="row">
      <nav class="col-md-3 service-nav"> 
        <ul>
          <li <?php if(basename($_SERVER['PHP_SELF']) == 'desert.php') echo 'class="active"'; ?>><a href="desert.php">Desert</a></li>
      <li <?php if(basename($_SERVER['PHP_SELF']) == 'jungle.php') echo 'class="active"'; ?>><a href="jungle.php">Jungle</a></li>
     <li <?php if(basename($_SERVER['PHP_SELF']) == 'mountain.php') echo 'class="active"'; ?>><a href="mountain.php">Montagne</a></li>
               <li <?php if(basename($_SERVER['PHP_SELF']) == 'marais.php') echo 'class="active"'; ?>><a href="marais.php">Marais</a></li>
         <li <?php if(basename($_SERVER['PHP_SELF']) == 'savane.php') echo 'class="active"'; ?>><a href="savane.php">Savane</a></li>
        </ul>
      </nav>
      <div class="col-md-9 content animals-intro">
        <h1 class="animals-title">Jungle</h1>
        <p class="intro-animals">

  Bienvenue dans la Jungle, un monde d'exploration et de diversité au cœur même de notre zoo. Découvrez l'anaconda, le jaguar, le macaque, le perroquet et le tigre, chacun adapté à ce royaume de végétation dense et de mystère.<br>
  <br>
  Plongez dans cet habitat exotique où chaque recoin révèle la beauté et l'ingéniosité de la vie sauvage de la Jungle.
</p>

      </div>
    </div>
  </div>
<section class="section-services">
      <div class="service1">      
        <article class="description">
 <p>
  Prénom : Killer <br>
  Race : Anaconda <br>
       <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
       </p>
<div style="display: none">
  Habitat : Forêts tropicales d'Amérique du Sud <br>
  État de l'animal : <br>
  Nourriture proposée : petits mammifères, oiseaux, poissons <br>
  Grammage de la nourriture : 1 à 2 kg <br>
  Date de passage : 00/00/2024
</div>
<div class="like-button-container">
  <button id="increment-Killer" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>
        </article>
          <article class="service">
          <img
            src="assets/jungle/anaconda.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
         </div>
         <hr class="service-divider">
         <div class="service2">
        <article class="service">
          <img
            src="assets/jungle/jaguar.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">
          <p>
  Prénom : Garry <br>
  Race : Jaguar <br>
         <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
         </p>
<div style="display: none">
  Habitat : Forêts tropicales d'Amérique du Sud <br>
  État de l'animal : <br>
  Nourriture proposée : mammifères de taille moyenne, poissons, oiseaux <br>
  Grammage de la nourriture : 2 à 3 kg <br>
  Date de passage : 00/00/2024
</div>
<div class="like-button-container">
  <button id="increment-Garry" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>
        </article>
      </div>
      <hr class="service-divider">
      <div class="service3">
       
        <article class="description">
    <p>
  Prénom : Kaki <br>
  Race : Macaque <br>
    <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
<div style="display: none">
  </p>
  Habitat : Forêts tropicales d'Asie <br>
  État de l'animal : <br>
  Nourriture proposée : fruits, graines, insectes <br>
  Grammage de la nourriture : 300 à 400 grammes <br>
  Date de passage : 00/00/2024
</div>
<div class="like-button-container">
  <button id="increment-Kaki" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>
        </article>
         <article class="service">
          <img
            src="assets/jungle/macaque.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
      </div>
      <hr class="service-divider">
      <div class="service4">
        <article class="service">
          <img
            src="jungle/perroquet.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">
     <p>
  Prénom : Spin <br>
  Race : Perroquet Ara Rouge <br>
      <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
      </p>
<div style="display: none">
  Habitat : Forêts tropicales d'Amérique du Sud <br>
  État de l'animal : <br>
  Nourriture proposée : fruits, graines, noix <br>
  Grammage de la nourriture : 150 à 200 grammes <br>
  Date de passage : 00/00/2024
</p>
</div>
<div class="like-button-container">
  <button id="increment-Spin" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>

        </article>
      </div>
      <hr class="service-divider">
      <div class="service5">
      
        <article class="description">
        <p>
  Prénom : Rex <br>
  Race : Tigre du Bengale <br>
        <button class="info" onclick="toggleInfo(this)">En savoir plus...</button>
        </p>
<div style="display: none">
  Habitat : Forêts tropicales et mangroves d'Asie du Sud <br>
  État de l'animal : <br>
  Nourriture proposée : cervidés, sangliers, buffles <br>
  Grammage de la nourriture : 5 à 7 kg <br>
  Date de passage : 00/00/2024
</div>
<div class="like-button-container">
  <button id="increment-Rex" class="jaime-btn">
    ❤️ J'aime
  </button>
</div>
        </article>
          <article class="service">
          <img
            src="assets/jungle/tigre.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
      </div>
</section>




    <?php include '../views/includes/footer.php'; ?>