const express = require("express");
const { MongoClient } = require("mongodb");

const app = express();
const port = process.env.PORT || 3000; // Utilise le port fourni par Heroku

// URI de la base de données MongoDB
const uri =
  "mongodb+srv://oves7860:Mohammad786.@arcadiazoo.dheoc.mongodb.net/ArcadiaZoo?retryWrites=true&w=majority";
const client = new MongoClient(uri);

// Middleware pour gérer les erreurs
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

app.get("/", async (req, res) => {
  try {
    await client.connect();
    console.log("Connecté à MongoDB!");

    const database = client.db("ArcadiaZoo");
    const collection = database.collection("animalviews");

    // Exemple d'opération : Récupérer tous les animaux
    const animals = await collection.find().toArray();

    res.status(200).json(animals); // Retourne les animaux en format JSON
  } catch (err) {
    console.error("Erreur de connexion :", err);
    res.status(500).send("Erreur de connexion à la base de données");
  } finally {
    await client.close(); // Ferme la connexion après les opérations
  }
});

// Démarre le serveur
app.listen(port, () => {
  console.log(`Le serveur est en écoute sur le port ${port}`);
});
