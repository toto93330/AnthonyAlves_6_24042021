///////////////////////////////////////////////////
// (AJAX) better interact with user :)
///////////////////////////////////////////////////
var tricks = parseInt(2);

function onClickMoreTricks() {
    var w = document.querySelectorAll("#js-trick").length; 
  var x = document.getElementById("js-loading-img");
  var y = document.getElementById("js-moretricks-content");
  var z = document.getElementById("js-moretricks-btn");

  x.style.display = "inline-block";

  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    console.log(this);
    if (this.readyState == 4 && this.status == 200) {
        
      var data = this.response;
      this.tricks = parseInt(this.tricks) + parseInt(1);


      if (data.length <= 10 || w >= data.length) {
        console.log("display none");
        z.style.display = "none";
         z.innerHTML = '<p class="text-center"> Sorry snowborder, No more tricks for moments, <br><a href="">Create more tricks for community</a> </p>';
         return;
      }

      // FIX LOAD BTN
      setTimeout(timeOut(), 3000);
      function timeOut() {
        x.style.display = "none";
      }

      for (var i = 10; i < data.length; i++) {
        y.innerHTML +=
          '<div class="col" data-aos="flip-left" id="js-trick">' +
          '<div class="card shadow-sm">' +
          '<img class="card-img-top home" style="height: 241px; object-fit: cover;" src="/uploads/tricks/' +
          data[i].imageCard +
          '" alt="Trick">' +
          '<div class="card-body row row-cols-12 row-cols-sm-12 row-cols-md-12">' +
          '<div class="col">' +
          '<div class="d-flex justify-content-between">' +
          '<span class="trick-name">' +
          '<a class="btn btn-outline-info btn-sm trick-link" href="/tricks/' +
          data[i].slug +
          '">' +
          data[i].title +
          "</a>" +
          "</span>" +
          '<span class="trick-edit">' +
          '<a href=""><i class="fas fa-pencil-alt"></i></a> | ' +
          '<a onclick="openIndexModal("' +
          data[i].title +
          '",1)" data="" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></a>' +
          "</span>" +
          "</div>" +
          "</div>" +
          "</div>" +
          "</div>" +
          "</div>";
      }
    }
  };

  var url = "https://127.0.0.1:8000" + "/" + this.tricks;


  xhr.open("GET", url);
  xhr.responseType = "json";
  xhr.send();
}
