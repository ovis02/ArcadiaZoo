import express from "express";
import { MongoClient, ObjectId } from "mongodb";
import cors from "cors";

const app = express();
const port = 3000;

// Middleware
app.use(express.json());
app.use(cors());

// Configuration MongoDB
const uri = "mongodb://localhost:27017";
const client = new MongoClient(uri);
const dbName = "arcadiaZoo";
const collectionName = "animals";

async function incrementViews(animalName) {
  await client.connect();
  const db = client.db(dbName);
  const collection = db.collection(collectionName);

  const result = await collection.findOneAndUpdate(
    { name: animalName },
    { $inc: { views: 1 } },
    { returnDocument: "after" }
  );

  return result.value;
}

// Endpoint pour incrémenter le compteur
app.post("/animal/:name/click", async (req, res) => {
  const animalName = req.params.name;

  try {
    const updatedAnimal = await incrementViews(animalName);
    if (updatedAnimal) {
      res.json({ animal: updatedAnimal });
    } else {
      res.status(404).json({ error: "Animal non trouvé" });
    }
  } catch (error) {
    res.status(500).json({ error: "Erreur serveur" });
  }
});

app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});
