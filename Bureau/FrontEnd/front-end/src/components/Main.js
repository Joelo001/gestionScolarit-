import React from "react";
import Card from "./Card";
import Tab from "./Tab";
import Navbar from "./Navbar";
const Main  = () =>{
     // Données pour les cartes et le tableau
     const stats = [
        { title: "Notification", value: "$72,540", percentage: "+9.0%", description: "Since Last Month" },
        { title: "Événements", value: "$72,540", percentage: "+9.0%", description: "Since Last Month" },
        { title: "Étudiants Inscrits", value: "$72,540", percentage: "+9.0%", description: "Since Last Month" },
    ];

    const students = [
        { id: 1, name: "Mark", address: "Otto", action: "@mdo" },
        { id: 2, name: "Jacob", address: "Thornton", action: "@fat" },
        { id: 3, name: "Larry the Bird", address: "Twitter", action: "@twitter" },
    ];
    const tableHeaders = ["N°", "Nom & Prénom", "Adresse", "Action"];
    
    return (
        <main className="content px-3 py-4">
            <Navbar />
            <div className="container-fluid">
                {/* Section des statistiques */}
                <div className="mb-3">
                    <h3 className="fw-bold fs-4 mb-3">Axis-Academy</h3>
                    <div className="row">
                        {stats.map((stat, index) => (
                            <Card key={index} {...stat} />
                        ))}
                    </div>
             </div>
                {/* Section de la liste des élèves */}
                <div className="mb-3">
                    <h3 className="fw-bold fs-4 my-3">Liste des Élèves</h3>
                    <div className="row">
                    <div className="col-12">
                        <Tab headers={tableHeaders} data={students} />
                    </div>
                </div>
            </div>
            </div>
        </main>
    );
};

export default Main;