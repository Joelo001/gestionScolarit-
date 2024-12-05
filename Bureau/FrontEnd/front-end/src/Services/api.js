export const sendFormData = async (formData) => {
  const formDataToSend = new FormData();
  
  // Ajout des données au FormData
  for (const key in formData) {
    formDataToSend.append(key, formData[key]);
  }

  // Conversion en objet JSON
  const jsonData = {};
  formDataToSend.forEach((value, key) => {
    jsonData[key] = value;
  });

 // Envoi des données au serveur via fetch
let url = 'http://127.0.0.1:8000/api/students/student';
fetch(url, {
  method: "POST",
  headers: {
    "Content-Type": "application/json",
    "Accept": "application/json"
  },
  body: JSON.stringify(jsonData) // Conversion en JSON
})
  .then(response => {
    if (!response.ok) {
      throw new Error(`Erreur HTTP! statut : ${response.status}`);
    }
    return response.json(); // Conversion de la réponse en JSON
  })
  .then(data => {
    console.log("Réponse du serveur :", data);
  })
  .catch(error => {
    console.error("Erreur lors de l'envoi :", error);
  });

};
