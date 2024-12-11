const apiKey = "f33cd318f5135dba306176c13104506a"; // Clé API
const baseUrl = "https://api.themoviedb.org/3"; // Base de l'API

// Ajouter un écouteur d'événements sur le bouton de recherche
document.getElementById("search-btn").addEventListener("click", () => 
    
    {
    // Récupérer la valeur entrée dans le champ de recherche
    const query = document.getElementById("search").value.trim();

    // Vérifier si une valeur a été saisie
    if (query) 
    {
        fetchMovies(query); // Lancer la recherche
    }
});

// Fonction pour effectuer la requête à l'API de films par titre de recherche 
function fetchMovies(query) 
{
    // Construire l'URL de la requête vers l'API de films par titre de recherche 
    const url = `${baseUrl}/search/movie?api_key=${apiKey}&query=${encodeURIComponent(query)}`;

    // Effectuer une requête GET vers l'API de films par titre de recherche 
    fetch(url)

        // Traiter la résponse de l'API
        .then(response =>     
        {
            // Vérifier si la réponse est OK
            if (!response.ok) 
            {
                // Lancer une erreur si la réponse n'est pas OK 
                throw new Error(`Erreur HTTP : ${response.status}`);
            }

            // Retourner la réponse en tant qu'objet JSON
            return response.json();
        })

        // Traiter les résultats de l'API
        .then(data => 
        {
            // Vérifier si des résultats existent
            if (data.results && data.results.length > 0) 
            {
                displayMovies(data.results); // Afficher les films
            } 
            else 
            {
                displayNoResults(); // Message si aucun résultat
            }
        })

    // Traiter l'erreur de l'API 
    .catch(error => console.error('Erreur :', error)); 
}

// Fonction pour afficher les films
function displayMovies(movies) 
{
    // Obtenir la liste de films du DOM et la vider 
    const movieList = document.getElementById("movie-list");

    movieList.innerHTML = ""; // Réinitialiser la liste

    // Parcourir chaque film et l'afficher
    movies.forEach(movie => 
    {
        // Créer un nouvel élément <li> pour chaque film
        const listItem = document.createElement("li");

        // Ajouter le titre et la date de sortie au nouvel élément 
        listItem.textContent = `${movie.title} (Sortie : ${movie.release_date || "N/A"})`;

        // Ajouter le nouvel élément au DOM 
        movieList.appendChild(listItem);
    });
}

// Fonction pour afficher un message si aucun film n'est trouvé
function displayNoResults() 
{
    // Obtenir la liste de films du DOM et la vider 
    const movieList = document.getElementById("movie-list");

    // Afficher le message d'erreur     
    movieList.innerHTML = "<li>Aucun film trouvé pour cette recherche.</li>";
}
