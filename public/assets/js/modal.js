///////////////////////////////////////////////////
// Display of the suppression modal in the index
///////////////////////////////////////////////////

var nom;
var id;

function openIndexModal(nom, id) {
  nom = nom;
  id = id;
  var x = document.getElementById("modal");
  document.documentElement.style.overflow = "hidden";
  x.style.display = "block";
  afficherNom(nom);
  document.getElementById("modal-delect-trick").href ="tricks/detail/" + id + "/delect";
}

function closeIndexModal() {
  var x = document.getElementById("modal");
  document.documentElement.style.overflow = "initial";
  x.style.display = "none";
}

function afficherNom(nom) {
  document.getElementById("nom-du-trick").innerHTML = nom;
}
