import React from "react";

// Gestionnaire pour ajouter un nouvel élément
const Liste = ({ liste, setListe, nouvelElement, setNouvelElement, handleAddItem }) => {

    return (

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
    );
};

export default Liste;