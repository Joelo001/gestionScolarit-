import React, { useState } from "react";
import FormField from "./componentsForm/FormField";
import FormSelect from "./componentsForm/FormSelect";
import { sendFormData } from "../Services/api";
const Form = () => {
  const [formData, setFormData] = useState({
    nom: "",
    prenom: "",
    adresse: "",
    num_tel: "",
    quartier: "",
    date_naissance: "",
    parentName: "",  // Assure-toi que l'ID et la propriété sont cohérents
    niveau_académique:"",
    occupation: "",
    parentTelephone: "",  // Assure-toi que cette clé correspond aussi à l'ID
    serie: "Serie A", // Valeur par défaut
  });

  const handleChange = (e) => {
    const { id, value, files } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [id]: files ? files[0] : value,
    }));
  };
  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await sendFormData(formData);
      alert("Données envoyées avec succès !");
      console.log("Réponse du serveur :", response);
    } catch (error) {
      console.error("Erreur :", error);
      alert("Une erreur s'est produite.");
    }
  };
return (
  <div className="container">
  <div className="row">
    <div className="col-8 offset-2">
      <form className="row g-3" onSubmit={handleSubmit}>
        <FormField id="nom" name="nom" label="Nom" value={formData.nom} onChange={handleChange} />
        <FormField id="prenom" name="prenom" label="Prénom" value={formData.prenom} onChange={handleChange} />
        <FormField id="adresse" name="adresse" type="email" label="Email" value={formData.adresse} onChange={handleChange} />
        <FormField id="num_tel" name="num_tel" label="Numéro de téléphone" value={formData.num_tel} onChange={handleChange} />
        <FormField id="quartier" name="quartier" label="Quartier" value={formData.quartier} onChange={handleChange} />
        <FormField id="niveau_académique" name="niveau_académique" label="Niveau académique" value={formData.niveau_académique} onChange={handleChange} />
        <FormSelect id="serie" label="Série" value={formData.serie} onChange={handleChange} options={["Serie A", "Serie D", "Serie C", "Serie F3"]} />
        <FormField id="date" name="date" type="date" label="Date de naissance" value={formData.date_naissance} onChange={handleChange} />
        <FormField id="parentName" name="parentName" label="Nom des parents" value={formData.parentName} onChange={handleChange} />
        <FormField id="parentTelephone" name="parentTelephone" label="Téléphone des parents" value={formData.parentTelephone} onChange={handleChange} />
        <FormField id="occupation" name="occupation" label="Occupation" value={formData.occupation} onChange={handleChange} />
        <div className="col-12">
          <button type="submit" className="btn btn-primary">Valider</button>
        </div>
      </form>
    </div>
  </div>
</div>
);
};
export default Form;