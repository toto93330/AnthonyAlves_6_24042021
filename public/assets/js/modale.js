///////////////////////////////////////////////////
// Display of the suppression modal in the index
///////////////////////////////////////////////////
var nom, id;

function openIndexModal(e, t) {
    e = e, t = t;
    var n = document.getElementById("modal-delect-trick");
    document.documentElement.style.overflow = "hidden", n.style.display = "block", afficherNom(e), document.getElementById("modal-delect-trick").href = "tricks/detail/" + t + "/delect"
}

function closeIndexModal() {
    var e = document.getElementById("modal-delect-trick");
    document.documentElement.style.overflow = "initial", e.style.display = "none"
}

function afficherNom(e) {
    document.getElementById("nom-du-trick").innerHTML = e
}

function openModalContributor() {
    var n = document.getElementById("modal-view-contributor");
    document.documentElement.style.overflow = "hidden", n.style.display = "block"
}

function closeModalContributor() {
    var e = document.getElementById("modal-view-contributor");
    document.documentElement.style.overflow = "initial", e.style.display = "none"
}

///////////////////////////////////////////////////
// Close Flash info on Click
///////////////////////////////////////////////////
function closeAlerte() {
    var n = document.getElementById("js-alert");
    n.style.display = "none";
}