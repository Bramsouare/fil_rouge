import React, { useState } from "react";


const Movie = () => 
{
    // État qui contiendra la liste des films récupérés de l'API
    const [movies, setMovies] = useState("");

    // Déclare un état "query" pour la saisie de l'utilisateur
    const [query, setQuery] = useState("");

    const [erreur, setErreur]=useState("");

    const [table, setTable]=useState("");
    



    // Déclare une fonction pour gérer la recherche
    const handleSearch = () => 
    { 
      
            // Envoie une requête GET à l'URL pour récupérer les films en fonction de la recherche
           fetch(`https://api.themoviedb.org/3/search/movie?api_key=f33cd318f5135dba306176c13104506a&query=`+query)
            .then((response) => (response.json() ) ) 
            .then((data) => ( setMovies(data.results)))  // Mise à jour de l'état avec les résultats
            .catch((error) => (console.log(error)));
            // Affiche un message si aucun film n'est trouvé
            if (movies.length)   { 
                setTable("")
                /* Message si aucun film n'est trouvé */
                setErreur("Entrez un nom de film svp")  ;                             
            }
            else{          
                    setErreur("");
                // Si des films sont trouvés, les afficher
                setTable(<ul>
                    {movies[0].map((movie) => (
                        <li key = {movie.id}>
                            {movie.title} 
                            {/* (Sortie : {movie.release_date || "N/A"}) */}
                        </li>
                    ))}
                </ul>); 
            } 
  
        console.log(movies);
    };
  
      

   
    return (
       
        <div className="mt-5">
            <div className=" d-flex justify-content-center mt-5">
                <input
                    type = "text"
                    placeholder = "Rechercher un film..."
                    className="mt-5"
                    value = {query}
                    onChange = {(e) => setQuery(e.target.value)} // Met à jour l'état "query"
                    />
                <button onClick = {handleSearch} >Rechercher</button>
            </div> 
        </div>
    );

};

export default Movie;
