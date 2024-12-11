import React from "react";

const Champs = ({ prenom, setPrenom, nom, setNom }) => {

    // Gestionnaires pour mettre à jour les champs de texte
    const handleChangePrenom = (evt) => setPrenom(evt.target.value);
    const handleChangeNom = (evt) => setNom(evt.target.value);
 

    return (

        <div className = "row justify-content-center my-5">

        <div className = "col-auto">

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

    );
};

export default Champs;