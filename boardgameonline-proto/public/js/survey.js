/* Script - Comprend l'animation du questionnaire
recupère
*/

// Declaration du JSON-answer
let answers = {
    score1: '',
    score2: '',
    score3: '',
    score4: '',
    score5: '',
}

// Variable des boutons
let stars = document.querySelectorAll(".btn-star");

// Sélectionner le score d'une question
const selectScore = (e) => {
    // TagName du bouton écouteur de l'évènement
    // console.log("e.target.parentElement.name: ", e.target.parentElement.name);
    // Évènement
    // console.log("e.target: ", e.target);
    // Bouton écouteur de l'évènement
    // console.log("e.target.parentElement: ", e.target.parentElement);

    // Récupère la note selectionnée
    let starSelected = e.target.parentElement;
    // Correction d'un bug
    if (starSelected.nodeName === "BUTTON") {
        // Récupère le champ scoreId
        let scoreSelected = starSelected.parentElement;
        // Animation - Boucle pour mettre à jour la note sélectionnée
        for (let i = 1; i < 6; i++) {
            let starList = scoreSelected.querySelectorAll(".btn-star");
            // Afficher le score sélectionné
            if (i <= starSelected.name) {
                starList[i-1].innerHTML = '<i class="fa-solid fa-star"></i>';
            } else {
                starList[i-1].innerHTML = '<i class="fa-regular fa-star"></i>';
            }
        }
        // Ajouter la note sélectionnée pour le scoreId
        answers[scoreSelected.id] = starSelected.name;
        // Check answers added
        console.log(answers);
    }

}

// Ajouter l'écouteur d'évènement pour chaque btn star
stars.forEach(starChild =>
    starChild.addEventListener("click", selectScore)
);