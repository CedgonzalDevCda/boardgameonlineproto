const section = document.querySelector('#taches-container');
const input = document.querySelector('#select-new-player');
const check = document.querySelector('input[type="checkbox"]');
const button = document.querySelector('#btn-add-play');
const toast = document.querySelector('#toast');
var count = 3; //Nombre des taches créées (elles ne sont pas toutes forcément encore là)

//tâches qui seront la par défaut
let taches = [
  {
    txt: 'Player 1 - favori',
    urgent: true,
    id: 1,
  },
  {
    txt: 'Player 2',
    urgent: false,
    id: 2,
  },
  {
    txt: 'Player 3',
    urgent: false,
    id: 3,
  },
];

const test = () => {
  let selectedPlayer;
  selectedPlayer = document.getElementById("select-new-player").options[document.getElementById('select-new-player').selectedIndex].text;
  displayToast(`Joueur ${selectedPlayer} sélectionné`, 'ajout');
}

input.addEventListener("change", test);

//Afficher la petite fenetre en haut à droite pour confirmer l'action effectuée
const displayToast = (message, type) => {
  toast.innerHTML = message; // Modification du message du toast

  //Applique une couleur en fonction de l'action
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

  toast.style.transform = 'translate3d(0,0,0)'; //Affiche le toast

  //programmation de la disparition du toast 4s après son arrivée
  setTimeout(() => {
    toast.style.transform = 'translate3d(0,-100%,0)';
    toast.style.color = 'transparent';
  }, 4000);
};

//Fonction qui ajoute une tâche
const addTask = () => {
  let selectedPlayer = selectedPlayer = document.getElementById("select-new-player").options[document.getElementById('select-new-player').selectedIndex].text;;
  // si la sélection n'est pas celle d'origine
  if (selectedPlayer.value == "Sélectionner l'ami à inviter") return;
  count++;

  // on Push dans le tableau des taches la nouvelle tache
  // avec le txt de l'input, et la valeur du checkbox pour
  // savoir si la tache est urgente
  taches.push({
    txt: input.value,
    urgent: check.checked,
    count: count,
  });

  //on trie le tableau en fonction des tâches urgentes
  // taches.sort(taskSort);

  input.value = '';
  check.checked = false;

  //on met a jour l'affichage avec le nouveau tableau (complété et trié)
  displayTasks();
  displayToast('La tâche a bien été ajoutée', 'ajout');
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

  //on met a jour l'affichage
  displayTasks();
  displayToast('La tâche a bien été supprimée', 'suppression');
};

//Fonction pour modifier l'intitulé d'une tache
const editTask = (event) => {
  //on récupere le nouveau texte
  let newText = window.prompt('Ecrivez la nouvelle valeur de la tâche');
  let index = null;

  taches.forEach((tache, key) => {
    if (tache.id == event.target.dataset.id) {
      index = key;
    }
  });

  //on met a jour le tableau
  taches[index].txt = newText;

  //on met a jour l'affichage
  displayTasks();
  displayToast('La tâche a bien été modifiée', 'modification');
};

//fonction pour mettre à jour l'affichage des taches sur la page
const displayTasks = () => {
  section.innerHTML = '';

  //pour chaque élément du tableau, on crée la tache, ainsi que tous ses éléments
  // d'affichage ou de fonctionnalités (boutons par ex.)
  taches.forEach((tache) => {
    let task = document.createElement('div');
    task.classList.add('mt-3', 'ms-5', 'mx-0', 'bg-secondary.bg-gradient', 'row', 'justify-content-between', 'align-items-center', 'card', 'w-50');
    let taskText = document.createElement('div');
    taskText.textContent = tache.txt;

    let iconsContainer = document.createElement('div');
    iconsContainer.classList.add('row', 'justify-content-around', 'border');

    let edit = document.createElement('div');
    edit.classList.add('edit-container', 'col-5', 'border');
    edit.innerHTML = `<i class="fas fa-pencil-alt" data-id=${tache.id}></i>`;
    edit.onclick = editTask;
    edit.title = 'Modifier la tâche';

    let bin = document.createElement('div');
    bin.classList.add('trash-container', 'col-5', 'border');
    bin.innerHTML = `<i class="fas fa-trash-alt" id="${tache.id}"></i>`;
    bin.onclick = removeTask;
    bin.title = "Supprimer l'élément";
    task.id = `task${tache.id}`;

    task.appendChild(taskText);
    iconsContainer.appendChild(edit);
    iconsContainer.appendChild(bin);
    task.appendChild(iconsContainer);

    section.appendChild(task);
  });
};

//Affichage initial des taches.
displayTasks();

button.onclick = addTask;
