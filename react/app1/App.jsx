import React from 'react';
import {useState} from 'react';


const Formulaire = () => {

    const [machin ,setMachin]=useState("");

    const handleChange=(ceQueTuViensDeMettre)=>{
        setMachin(ceQueTuViensDeMettre.target.value);
    }

    return(
        <div>
            {machin}
            <input type="text" onChange={handleChange} />
        </div>
    );

}

export default Formulaire;



































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
