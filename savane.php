<?php
include 'header.php';
?>
  <div class="background-section-savane">
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
        <h1 class="animals-title">Savane</h1>
        <p class="intro-animals">




  Bienvenue dans la Savane, un vaste horizon de beauté naturelle au cœur de notre zoo. Découvrez cet habitat emblématique où l'éléphant d'Afrique, la girafe, le guépard, le lion, le rhinocéros et le zèbre évoluent en harmonie.<br>
  <br>
  Parcourez ces étendues sauvages où chaque pas révèle la majesté de la vie animale. Plongez dans ce monde fascinant où chaque créature incarne la splendeur de la vie sauvage de la Savane.
        </p>




      </div>
    </div>
  </div>
<section class="section-services">
      <div class="service1">      
        <article class="description">
<p>
  Prénom : Tembo <br>
  Race : Éléphant d'Afrique <br>
  Habitat : Savane <br>
  État de l'animal : <br>
  Nourriture proposée : herbes, feuilles, écorce <br>
  Grammage de la nourriture : 100 à 300 kg <br>
  Date de passage : 00/00/2024
</p>


        </article>
          <article class="service">
          <img
            src="savane/elephant.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
         </div>
         <div class="service2">
        <article class="service">
          <img
            src="savane/girafe.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">
<p>
  Prénom : Jasiri <br>
  Race : Girafe <br>
  Habitat : Savane <br>
  État de l'animal : <br>
  Nourriture proposée : feuilles d'acacia, branches <br>
  Grammage de la nourriture : 30 à 75 kg <br>
  Date de passage : 00/00/2024
</p>
<p>
  Prénom : Kito <br>
  Race : Girafe (Jeune) <br>
  Habitat : Savane <br>
  État de l'animal : <br>
  Nourriture proposée : lait maternel, feuilles tendres <br>
  Grammage de la nourriture : 5 à 15 kg <br>
  Date de passage : 00/00/2024
</p>


        </article>
      </div>
      <div class="service3">
       
        <article class="description">

<p>
  Prénom : Raja <br>
  Race : Guépard <br>
  Habitat : Savane <br>
  État de l'animal : <br>
  Nourriture proposée : viande de poulet, agneau, mouton <br>
  Grammage de la nourriture : 2 à 4 kg <br>
  Date de passage : 00/00/2024
</p>



        </article>
         <article class="service">
          <img
            src="savane/guepard.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
      </div>
      <div class="service4">
        <article class="service">
          <img
            src="savane/lion.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">

<p>
  Prénom : Simba <br>
  Race : Lion <br>
  Habitat : Savane <br>
  État de l'animal : <br>
  Nourriture proposée : viande de bœuf, poulet, poisson <br>
  Grammage de la nourriture : 5 à 10 kg <br>
  Date de passage : 00/00/2024
</p>






        </article>
      </div>
      <div class="service5">
      
        <article class="description">
<p>
  Prénom : Rhino, Rina et Rocco <br>
  Race : Rhinocéros <br>
  Habitat : Savane <br>
  État des animaux : <br>
  Nourriture proposée : foin, herbes, branches <br>
  Grammage de la nourriture : 50 à 100 kg par rhinocéros <br>
  Date de passage : 00/00/2024
</p>
        </article>
          <article class="service">
          <img
            src="savane/rhinoceros.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
      </div>
</section>

  <div class="service6">
        <article class="service">
          <img
            src="savane/zèbre.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">

<p>
  Prénom : Zara <br>
  Race : Zèbre <br>
  Habitat : Savane <br>
  État de l'animal : <br>
  Nourriture proposée : herbes, feuilles, écorce <br>
  Grammage de la nourriture : 10 à 15 kg <br>
  Date de passage : 00/00/2024
</p>







        </article>
      </div>


    <?php include('footer.php'); ?>