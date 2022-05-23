const container = document.querySelector('#taches-container');
const input = document.querySelector('#select-new-player');
const check = document.querySelector('input[type="checkbox"]');
const button = document.querySelector('#btn-add-player');
var count = 1; //Nombre des taches créées (elles ne sont pas toutes forcément encore là)

//tâches qui seront la par défaut
let taches = [];

//Fonction qui ajoute une tâche
const addTask = () => {
    //si l'input est vide la fonction est avortée
    if (!input.value) return;
    count++;

    // on Push dans le tableau des taches la nouvelle tache
    // avec le txt de l'input
    taches.push({
        txt: input.value,
        count: count,
    });

    //on met à jour l'affichage avec le nouveau tableau (complété et trié)
    displayTasks();
};

//Fonction pour enlever une tache
const removeTask = (event) => {
    let index = null;

    //on cherche la tache qui correspond au bouton de suppression cliqué
    taches.forEach((tache, key) => {
        if (tache.id == event.target.id) {
            index = key;
        }
    });

    // on supprime la tache
    taches.splice(index, 1);
    console.log(index);
    console.log(taches);

    //on met à jour l'affichage
    displayTasks();
};

//Fonction pour modifier l'intitulé d'une tache
const editTask = (event) => {
    //on récupère le nouveau texte
    let newText = window.prompt('Ecrivez la nouvelle valeur de la tâche');
    let index = null;

    taches.forEach((tache, key) => {
        if (tache.id == event.target.dataset.id) {
            index = key;
        }
    });

    //on met à jour le tableau
    taches[index].txt = newText;

    //on met à jour l'affichage
    displayTasks();
};

//fonction pour mettre à jour l'affichage des taches sur la page
const displayTasks = () => {
    container.innerHTML = '';

    //pour chaque élément du tableau, on crée la tache, ainsi que tous ses éléments
    // d'affichage ou de fonctionnalités (boutons par ex.)
    taches.forEach((tache) => {
        let task = document.createElement('div');
        let taskText = document.createElement('div');
        task.style.borderRadius = "50px";
        task.classList.add("mt-3", "ms-5","align-items-center","card","w-50","bg-light");
        taskText.textContent = tache.txt;

        let iconsContainer = document.createElement('div');
        iconsContainer.style.display = 'flex';
        iconsContainer.style.gap = '10px';

        // let edit = document.createElement('div');
        // edit.className = 'edit-container';
        // edit.innerHTML = `<i class="fas fa-pencil-alt" data-id=${tache.id}></i>`;
        // edit.onclick = editTask;
        // edit.title = 'Modifier le joueur';

        let bin = document.createElement('div');
        bin.className = 'trash-container';
        bin.innerHTML = `<i class="fas fa-trash-alt" id="${tache.id}"></i>`;
        bin.onclick = removeTask;
        bin.title = "Supprimer le joueur";
        task.id = `task${tache.id}`;

        task.appendChild(taskText);
        iconsContainer.appendChild(edit);
        iconsContainer.appendChild(bin);
        task.appendChild(iconsContainer);

        container.appendChild(task);
    });
};

//Affichage initial des taches.
displayTasks();

button.onclick = addTask;
