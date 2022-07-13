// Declaration des constantes et variables.
const section = document.querySelector('#taches-container');
const input = document.querySelector('#select-new-player');
const check = document.querySelector('input[type="checkbox"]');
const button = document.querySelector('#btn-add-play');
const toast = document.querySelector('#toast');
let count = 3; //Nombre de players 0

// let gameName = document.getElementById('game-name').innerHTML;

// Supprime l'éventuel dernier slash de l'URL.
let urlcourante = document.location.href.replace(/\/$/, "");
// Garde dans la variable queue_url uniquement la portion derrière le dernier slash de l'URL courante.
queue_url = urlcourante.substring (urlcourante.lastIndexOf( "/" )+1 );

// Liste de joueurs définie par défaut.
let taches = [
    {
        txt: 'Player 1 - favori',
        id: '1',
    },
    {
        txt: 'Player 2',
        id: '2',
    },
    {
        txt: 'Player 3',
        id: '3',
    },
];


// Afficher un toast pour confirmer l'action effectuée.
const displayToast = (message, type) => {
    toast.innerHTML = message; // Modification du message du toast.

    // Applique une couleur en fonction de l'action.
    switch (type) {
        case 'suppression':
            toast.style.color = '#fafafa';
            toast.style.background = 'rgba(255, 0, 0, 0.6)';
            break;
        case 'ajout':
            toast.style.color = '#373737';
            toast.style.background = 'rgba(0, 255, 0, 0.3)';
            break;
        case 'modification':
            toast.style.color = '#fafafa';
            toast.style.background = 'rgba(0, 0, 255, 0.5)';
            break;
    }

    toast.style.transform = 'translate3d(0,0,0)'; //Affiche le toast.

    // Programmation de la disparition du toast 4s après son arrivée.
    setTimeout(() => {
        toast.style.transform = 'translate3d(-100%,0,0)';
        toast.style.color = 'transparent';
    }, 4000);
};

// Fonction qui ajoute un joueur à la playersList.
const addTask = () => {
    let selectedPlayer = document.getElementById("select-new-player").options[document.getElementById('select-new-player').selectedIndex].text;
    // si la sélection n'est pas celle d'origine
    if (selectedPlayer.value === "Sélectionner l'ami à inviter") return;
    count++;
    // Si le joueur est déjà présent dans la playersList alors ne pas l'ajouter.
    taches.forEach((tache, key) => {
        if (tache.txt === selectedPlayer) {
            console.log(tache.txt + " est un doublon");
        }
    });

    // on Push dans le tableau des taches la nouvelle tache
    // avec le txt de l'input et la valeur du checkbox pour
    // savoir si la tache est urgente.
    taches.push({
        txt: input.value,
        id: count,
    });

    input.value = '';
    // check.checked = false;

    // On met à jour l'affichage avec le nouveau tableau (complété et trié).
    displayTasks();
    displayToast('Joueur ajoutée', 'ajout');


};

// Fonction pour enlever un joueur.
const removeTask = (event) => {
    let index = null;

    // on cherche le joueur qui correspond au bouton de suppression cliqué.
    taches.forEach((tache, key) => {
        if (tache.id === event.target.id) {
            index = key;
        }
    });

    // on supprime le joueur.
    taches.splice(index, 1);
    console.log(index);
    console.log(taches);
    count--;

    // on met à jour l'affichage.
    displayTasks();
    displayToast('Joueur supprimé de la table', 'suppression');
};

// Fonction pour modifier l'intitulé.
const editTask = (event) => {
    // on récupère le nouveau texte.
    // TODO: modifier le mode de saisie du nouveau joueur
    let newText = window.prompt('Ecrivez la nouvelle valeur de la tâche');
    let index = null;

    taches.forEach((tache, key) => {
        if (tache.id === event.target.dataset.id) {
            index = key;
        }
    });

    // on met à jour le tableau.
    taches[index].txt = newText;

    // on met à jour l'affichage.
    displayTasks();
    displayToast('La tâche a bien été modifiée', 'modification');
};

// Fonction pour mettre à jour l'affichage de la liste de joueurs sur la page.
const displayTasks = () => {
    section.innerHTML = '';

    // pour chaque élément du tableau, on crée la tache, ainsi que tous ses éléments
    // d'affichage ou de fonctionnalités (boutons par ex.)
    taches.forEach((tache) => {
        let task = document.createElement('div');
        task.style.borderRadius = "50px";
        task.classList.add('row', 'p-0', 'mt-3', 'ms-5', 'mx-0', 'bg-dark', 'text-white', 'justify-content-between', 'align-items-center', 'card', 'w-50');
        let taskText = document.createElement('div');
        taskText.classList.add('col-4');
        taskText.textContent = tache.txt;

        //
        let iconsContainer = document.createElement('div');
        iconsContainer.classList.add('row', 'justify-content-around', 'col-4');


        // let edit = document.createElement('div');
        // edit.classList.add('edit-container', 'col-5');
        // edit.innerHTML = `<i class="fas fa-pencil-alt" data-id=${tache.id}></i>`;
        // edit.onclick = editTask;
        // edit.title = 'Modifier la tâche';

        //
        let bin = document.createElement('div');
        bin.classList.add('trash-container', 'col-5');
        bin.innerHTML = `<i class="fas fa-trash-alt" id="${tache.id}"></i>`;
        bin.onclick = removeTask;
        bin.title = "Supprimer l'élément";
        task.id = `task${tache.id}`;

        task.appendChild(taskText);
        // iconsContainer.appendChild(edit);
        iconsContainer.appendChild(bin);
        task.appendChild(iconsContainer);

        section.appendChild(task);
    });
};

// Affichage initial des taches.
displayTasks();

button.onclick = addTask;

console.log(taches);

// Bouton Lancer les invitations.
let buttonInvit = document.getElementById("btn-invit")

// Lancer les invitations depuis la page.
const launchInvit = () => {

    // event.preventDefault();

    // Initialise la liste des joueurs.
    let invitationList = [];

    // Mettre à jour la liste des joueurs.
    taches.forEach((tache, key) => {
        let playerName = tache.txt
        let playerId = tache.id
        invitationList.push({'playerName': playerName , 'playerId': playerId });
    });

    // Modifier l'adresse URL pour envoi requête.
    let queue_game_url = queue_url.replace('#launch-invitation',"");

    // TODO: Créer une fonction fetch pour simplifier le code

    // Préparation de la requête de récupération des infos du jeu.
    let dataGamePromise = fetch(`/game/${queue_game_url}`)
        .then((request) => request.json())
        .then((data)=>{
            console.log(data)
        });
    ;
    // Envoi requête de récupération des infos du jeu.
    dataGamePromise.then(async (response) => {
        try{
            console.log(response);
            const contenu = await response.json();
            console.log(contenu);
        } catch (e) {
            console.log(e);
        }
    });

    // Préparation de la requête de récupération de l'utilisateur connecté.
    let UserPromise = fetch(`/user`)
        .then((request) => request.json())
        .then((data)=>{
            console.log(data)
        });
    ;
    // Envoi requête de récupération de l'utilisateur connecté.
    UserPromise.then(async (response) => {
        try{
            console.log(response);
            const contenu = await response.json();
            console.log(contenu);
            // const
        } catch (e) {
            console.log(e);
        }
    });

    // Check du nombre de joueurs à faire côté serveur.

    // $nbPlayer >= game.minPlayer
    // $nbPlayer <= game.maxPlayer

    // Créer la gameroom pour le jeu associé.
    let promise01 = fetch(`/gameroom/${queue_game_url}/new`, {
        method: "POST",
        body: JSON.stringify({
            'gamesId': queue_game_url,
            'nbPlayer':  invitationList.length,
            'dateInvit': '2022-05-05 08:00:00',   // Now
            'hashInvit': 'testduhash',            // fct à définir
            'hashTimeout': '2022-06-05 08:00:00', // Now +24h
            'leader': 'jesaispasqui',             // user connecté
        }),
        headers: {
            "Content-Type": "application/json"
        },
    });

    // Envoi requête de récupération de l'utilisateur connecté.
    promise01.then(async (response) => {
        try{
            console.log(response);
            const contenu = await response.json();
            console.log(contenu);
        } catch (e) {
            console.log(e);
        }
    });

    // test fetch POST sur jsonplaceholder
    // invitationList.forEach((playerInvit, key) => {
    //
    //     //https://jsonplaceholder.typicode.com/users
    //     let promise02 = fetch("new", {
    //         method: "POST",
    //         body: JSON.stringify({
    //             'gamesId': '1',
    //             'nbPlayer':  invitationList.length,
    //             'dateInvit': '2022-05-05 08:00:00',
    //             'hashInvit': 'testduhash',
    //             'hashTimeout': '2022-06-05 08:00:00',
    //             'leader': 'jesaispasqui',
    //         }),
    //         headers: {
    //             "Content-Type": "application/json"
    //         },
    //     });
    //
    //     //
    //     promise02.then(async (response) => {
    //         try{
    //             console.log(response);
    //             const contenu = await response.json();
    //             console.log(contenu);
    //         } catch (e) {
    //             console.log(e);
    //         }
    //     });
    //
    // });
}

buttonInvit.addEventListener("click", launchInvit);
