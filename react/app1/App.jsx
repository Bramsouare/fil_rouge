import React from "react";
import DataTable from "react-data-table-component";
import { useState } from "react";

// import axios from "axios";

const App = () => {

    // Variables d'état pour le prénom et le nom
    const [prenom, setPrenom] = useState('Ibrahima');
    const [nom, setNom] = useState('Souare');
    

    // Gestionnaires pour mettre à jour les champs de texte
    const handleChangePrenom = (evt) => setPrenom(evt.target.value);
    const handleChangeNom = (evt) => setNom(evt.target.value);

    // Variable d'état pour le compteur
    const [compteur, setCompteur] = useState(0);

    // Gestionnaires pour les boutons
    const handleIncrement = () => setCompteur(compteur + 1);
    const handleDecrement = () => setCompteur(compteur - 1);

    // Variable d'état pour la liste
    const [liste, setListe] = useState([]);

    // Variable d'état pour le nouvel élément
    const [nouvelElement, setNouvelElement] = useState('');

    // Gestionnaire pour ajouter un nouvel élément
    const handleAddItem = () => {

        // Si le nouvel élément n'est pas vide
        if (nouvelElement.trim()) {

            // Mise à jour de la liste
            setListe([...liste, nouvelElement.trim()]);

            // Efface le nouvel élément
            setNouvelElement('');
        }
    };

    // Tableau de colonnes pour la DataTable
    const columns = 
    [
        {
            style : {
                fontWeight : 'bold'
            },

            name : <b>Nom</b>,
            selector : (row) => row.nom,
            sortable : true,
        },
        {
            name : <b>Prenom</b>,
            selector : (row) => row.prenom,
            sortable : true,        
        },
        {
            name : <b>Ville</b>,
            selector : (row) => row.ville,
            sortable : true,
        }
    ];

    // Tableau de données pour la DataTable
    const [data, setData] = useState(
        [
            { 
            
                nom : 'Souare',
                prenom : 'Ibrahima',
                ville : 'Beauvais'
                
            },
            { 
            
                nom : 'lemsatef',
                prenom : 'sara',
                ville : 'Beauvais'
            },
            { 
            
                nom : 'Souare',
                prenom : 'fatoumata',
                ville : 'Paris'
            }
        ]
    );

    return (
        
        <div className="container mt-5">
            
            {/* Affichage du message */}

            <div className = "row justify-content-center my-5">

                <div className = "col-auto">
                    <h1 className = "text-center">Bonjour {prenom} {nom}</h1>
                </div>

            </div>

            {/* Champs de saisie */} 

            <div className="row justify-content-center my-5">

                <div className="col-auto">

                    <label>Prénom </label>
                    <input
                        type = "text"
                        className = "form-control"
                        value = {prenom}
                        onChange = {handleChangePrenom}
                    />

                </div>

                <div className = "col-auto">

                    <label>Nom </label>
                    <input
                        type = "text"
                        className = "form-control"
                        value = {nom}
                        onChange = {handleChangeNom}
                    />

                </div>
            </div>

            {/* Affichage du compteur */}

            <div className = "row justify-content-center my-5">
                
                <div className = "col-auto text-center">

                    <h2>Compteur : {compteur}</h2>

                    <button className = "btn btn-primary me-2" onClick = {handleIncrement}>
                        Augmenter
                    </button>

                    <button className="btn btn-danger" onClick = {handleDecrement}>
                        Diminuer
                    </button>

                </div>
            </div>
        
            {/* Liste */}

            <div className = "container my-5">

                <div className = "row justify-content-center">

                    <div className = "col-auto">
                        <h2 className = "text-center">Liste d'éléments</h2>
                    </div>

                </div>

                {/* Champ d'ajout */}

                <div className = "row justify-content-center mt-5">

                    <div className = "col-auto">

                        {/** Champ de saisie */}

                        <input
                            type = "text"
                            className = "form-control"
                            value = {nouvelElement}
                            onChange = { (evt) => setNouvelElement (evt.target.value) }
                            placeholder = "Entrez un élément"
                        />
                    </div>
                    <div className = "col-auto">
                        <button
                            className = "btn btn-success"
                            onClick = {handleAddItem}
                        >
                            Ajouter un élément
                        </button>
                    </div>
                </div>

                {/* Affichage de la liste */}

                <div className = "row justify-content-center">

                    <div className = "col-auto">

                        <ul className = "list-group">

                            {/** Contenu de la liste  */}

                            {liste.map( (item, index) => (

                                <li
                                    className = "list-group-item"
                                    key = {`${item}-${index}`}
                                > 
                                    {item}
                                </li>
                            ))}

                        </ul>

                    </div>

                </div>

            </div>

            {/* Affichage de la DataTable */}

            <DataTable
                columns = {columns}
                data = {data}
                defaultSortFieldId = {1}
            />
    
        </div>
    );
};

export default App;
   
        
        
  

























// import React, { useState, useEffect } from 'react';

// const App = (props) => {

//     // Variable contenant des données
//     const [prenom, setPrenom] = useState('Ibrahima');
//     const [nom, setNom] = useState('Souare');
//     const [liste, setListe] = useState([1, 2, 3]);

//     // Fonction pour changer le prénom 
//     const handleclick1 = () => 
//         {
//             setPrenom (Match.random (). toString (36). replace (/[^a-z]+/g,''));
//         }

//     // Déclencher quand le prénom change 
//     useEffect (() =>

//         {
//             console.log("useEffect 1")
//         }, [prenom]
//     )

//     // Fonction déclanchée a la modification des champs
//     // Récupération et mise à jours des données récupérer
//     const handleChangeNom = (evt) => setNom(evt.target.value);

//     const handleChangePrenom = (evt) => setPrenom(evt.target.value);

//     console.log ("render App...");

//     return (

//         <div>
            
//             {
//             /* Affichage du message de salutation */}
//             <div className="d-flex justify-content-center">
//                 <h1>Salut {prenom} {nom}</h1>
//             </div>

//             {/* Affichage de la liste */}

//             <div className="d-flex justify-content-center">
//                 <ul>
//                     {/** Parcourt chaque élément */}
//                     {liste.map(

//                         // item : La valeur actuelle de l'élément 1, 2, 3
//                         // index : La position de l'élément dans le tableau
//                         (item, index) => 
//                             (
//                                 <li
//                                     // Indique que chaque éléments est unique
//                                     key = {index} > {item}
//                                 </li>
//                             )
//                         )
//                     }
//                 </ul>
//             </div>


//             {/* Affichage du formulaire */}

//             <div className="d-flex justify-content-center">
//                 <form>
//                     <div>
//                         <label>Nom :</label>
//                         <input
//                             type="text"
//                             value={nom}
//                             onChange={handleChangeNom}
//                         />
//                     </div>
//                     <div>
//                         <label>Prénom :</label>
//                         <input
//                             type="text"
//                             value={prenom}
//                             onChange={handleChangePrenom}
//                         />
//                     </div>
//                 </form>
//             </div>

//             <div>
//                 {/** Prénom actuelle */}
//                 {prenom}
//             </div>

//             {/** Bouton pour changer le prénom */}
//             <button onClick = {handleclick1}>Change le prénom</button>
//         </div>
//     );
// };

// export default App;
