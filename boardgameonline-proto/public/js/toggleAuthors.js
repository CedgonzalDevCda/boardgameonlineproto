// toggleAuthors.js

// Fonction pour basculer la visibilité des auteurs
function toggleAuthors() {
    const authorsDiv = document.querySelector('.show-author');
    authorsDiv.classList.toggle('d-none'); // Toggle la classe 'd-none' pour cacher ou afficher les auteurs
}

// Ajout d'un écouteur d'événement au clic sur le bouton
document.addEventListener('DOMContentLoaded', function() {
    const toggleAuthorsButton = document.getElementById('toggle-authors');
    toggleAuthorsButton.addEventListener('click', toggleAuthors);
});