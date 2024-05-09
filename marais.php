<?php
include 'header.php';
?>
  <div class="background-section-marais">
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
      <div class="service1">      
        <article class="description">
<p>
  Prénom : Crac <br>
  Race : Castor <br>
  Habitat : Marais et cours d'eau <br>
  État de l'animal : <br>
  Nourriture proposée : écorce, branches, plantes aquatiques <br>
  Grammage de la nourriture : 1 à 2 kg <br>
  Date de passage : 00/00/2024
</p>

        </article>
          <article class="service">
          <img
            src="marais/castor.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
         </div>
         <div class="service2">
        <article class="service">
          <img
            src="marais/crocodilenil.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">
    
  Prénom : Godzilla <br>
  Race : Crocodile du Nil <br>
  Habitat : Marais et cours d'eau <br>
  État de l'animal : <br>
  Nourriture proposée : viande de poulet, poisson, bœuf <br>
  Grammage de la nourriture : 2 à 5 kg <br>
  Date de passage : 00/00/2024
</p>

        </article>
      </div>
      <div class="service3">
       
        <article class="description">

  Prénom : Pumba <br>
  Race : Hippopotame <br>
  Habitat : Marais et cours d'eau <br>
  État de l'animal : <br>
  Nourriture proposée : foin, herbe, légumes <br>
  Grammage de la nourriture : 20 à 50 kg <br>
  Date de passage : 00/00/2024
</p>



        </article>
         <article class="service">
          <img
            src="marais/hipopotame.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
      </div>
      <div class="service4">
        <article class="service">
          <img
            src="marais/lamantin.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
        <article class="description">

<p>
  Prénom : Annie <br>
  Race : Lamantin <br>
  Habitat : Marais et cours d'eau <br>
  État de l'animal : <br>
  Nourriture proposée : laitue, algues, légumes aquatiques <br>
  Grammage de la nourriture : 30 à 50 kg <br>
  Date de passage : 00/00/2024
</p>





        </article>
      </div>
      <div class="service5">
      
        <article class="description">
<p>
  Prénom : Shelly <br>
  Race : Tortue <br>
  Habitat : Marais et cours d'eau <br>
  État de l'animal : <br>
  Nourriture proposée : végétaux, fruits, vers de terre <br>
  Grammage de la nourriture : 100 à 200 g <br>
  Date de passage : 00/00/2024
</p>





        </article>
          <article class="service">
          <img
            src="marais/tortuecalifornie.jpg"
            onclick="agrandirImage(this)"
          />
        </article>
      </div>
</section>




    <?php include('footer.php'); ?>