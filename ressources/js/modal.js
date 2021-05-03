var nom, id;

function openIndexModal(e, t) {
    e = e, t = t;
    var n = document.getElementById("modal");
    document.documentElement.style.overflow = "hidden", n.style.display = "block", afficherNom(e), document.getElementById("modal-delect-trick").href = "tricks/detail/" + t + "/delect"
}

function closeIndexModal() {
    var e = document.getElementById("modal");
    document.documentElement.style.overflow = "initial", e.style.display = "none"
}

function afficherNom(e) {
    document.getElementById("nom-du-trick").innerHTML = e
}

function openModal() {
    var n = document.getElementById("modal");
    document.documentElement.style.overflow = "hidden", n.style.display = "block"
}

function closeAlerte() {
    var n = document.getElementById("js-alert");
    n.style.display = "none";
}