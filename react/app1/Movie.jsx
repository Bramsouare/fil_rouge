import React, { useState } from "react";
import DataTable from "react-data-table-component";

const Movie = () => 
{
    // État qui contiendra la liste des films récupérés de l'API
    const [movies, setMovies] = useState("");

    // Déclare un état "query" pour la saisie de l'utilisateur
    const [query, setQuery] = useState("");

    const [erreur, setErreur] = useState("");

    const columns = [

        {
            name : <b>adult</b>,
            selector : (row) => row.adult,
            sortable : true
        },
        {
            name : <b>backdrop_path</b>,
            selector : (row) => row.backdrop_path,
            sortable : true
        },
        {
            name : <b>title</b>,
            selector : (row) => row.title,
            sortable : true
        },


        
    ]

    // Déclare une fonction pour gérer la recherche
    const handleSearch = () => 
    { 
        // Envoie une requête GET à l'URL pour récupérer les films en fonction de la recherche
        fetch(`https://api.themoviedb.org/3/search/movie?api_key=f33cd318f5135dba306176c13104506a&query=`+query)
        .then((response) => (response.json() ) ) 
        .then((data) => ( setMovies(data.results)))  // Mise à jour de l'état avec les résultats
        .catch((error) => (console.log(error)));
            console.log(movies.length);

        // Affiche un message si aucun film n'est trouvé
        if (!movies.length)  
        { 
            setMovies("");
            /* Message si aucun film n'est trouvé */
            setErreur("Entrez un nom de film svp")  ;                             
        }
        else
        {          
            setErreur("");
    
        } 

    };
  
    return (
       <>
        <div className="mt-5 w-100 d-flex justify-content-center">
            <div className=" flex-column w-50 mt-5">
                <input
                    type = "text"
                    placeholder = "Rechercher un film..."
                    className="mt-5"
                    value = {query}
                    onChange = {(e) => setQuery(e.target.value)} // Met à jour l'état "query"
                    />
                <button onClick = {handleSearch}>Rechercher</button>
                <p>{erreur}</p>
               <DataTable
                columns={columns}
                data={movies}
                defaultSautFieldId={1}
              />
            </div> 
        </div>
        </>
    );

};

export default Movie;
