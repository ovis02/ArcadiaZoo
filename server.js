const express = require("express");
const { MongoClient } = require("mongodb");

const app = express();
const port = process.env.PORT || 3000; // Utilise le port fourni par Heroku

// URI de la base de données MongoDB
const uri =
  mongodb+srv://oves7860:<db_password>@arcadiazoo.dheoc.mongodb.net/?retryWrites=true&w=majority&appName=ArcadiaZoo;
const client = new MongoClient(uri);

// Middleware pour gérer les erreurs CORS
app.use((req, res, next) => {
  res.setHeader("Access-Control-Allow-Origin", "*");
  res.setHeader(
    "Access-Control-Allow-Methods",
    "GET, POST, OPTIONS, PUT, PATCH, DELETE"
  );
  res.setHeader(
    "Access-Control-Allow-Headers",
    "X-Requested-With, content-type"
  );
  next();
});

// Démarre le client MongoDB
client
  .connect()
  .then(() => {
    console.log("Connecté à MongoDB!");

    // Démarre le serveur
    app.listen(port, () => {
      console.log(`Le serveur est en écoute sur le port ${port}`);
    });
  })
  .catch((err) => {
    console.error("Erreur de connexion à MongoDB :", err);
  });

// Route GET pour récupérer tous les animaux
app.get("/animals", async (req, res) => {
  try {
    const database = client.db("ArcadiaZoo");
    const collection = database.collection("animalviews");

    // Récupérer tous les animaux
    const animals = await collection.find().toArray();
    res.status(200).json(animals); // Retourne les animaux en format JSON
  } catch (err) {
    console.error("Erreur lors de la récupération des animaux :", err);
    res.status(500).send("Erreur de récupération des animaux : " + err.message);
  }
});
