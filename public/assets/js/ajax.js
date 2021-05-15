///////////////////////////////////////////////////
// (AJAX) better interact with user :)
///////////////////////////////////////////////////
var tricks = parseInt(2);
var comments = parseInt(2);
var host = window.location.host;
var protocol = window.location.protocol;
var pathname = window.location.pathname;

function onClickMoreTricks() {
  var w = document.querySelectorAll("#js-trick").length;
  var x = document.getElementById("js-loading-img");
  var y = document.getElementById("js-moretricks-content");
  var z = document.getElementById("js-moretricks-btn");

  x.style.display = "inline-block";

  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
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
          '<a class="btn btn-outline-info btn-sm trick-link" href="/trick/' +
          data[i].slug +
          '">' +
          data[i].title +
          "</a>" +
          "</span>" +
          '<span class="trick-edit">' +
          '<a href="/admin/trick/' +
          data[i].slug +
          '"><i class="fas fa-pencil-alt"></i></a> | ' +
          '<a onclick="openIndexModal(\'' +
          data[i].title +
          '\', ' + data[i].id + ')" data="" style="cursor: pointer;"><i class="fas fa-trash-alt"></i></a>' +
          "</span>" +
          "</div>" +
          "</div>" +
          "</div>" +
          "</div>" +
          "</div>";
      }
    }
  };

  var url = protocol + "//" + host + "/ajax/" + this.tricks;


  xhr.open("GET", url);
  xhr.responseType = "json";
  xhr.send();
}

function onClickRemoveMedia(mediatype, id) {

  if (mediatype == 'image') {

    var elem = document.querySelector(".img-" + id + "");
    elem.style.display = 'none';

    var xhr = new XMLHttpRequest();
    var url = protocol + "//" + host + "/medias/type/" + mediatype + "/" + id + "";
    xhr.open("GET", url);
    xhr.send();
  }

  if (mediatype == 'video') {
    var elem = document.querySelector(".vid-" + id + "");
    elem.style.display = 'none';

    var xhr = new XMLHttpRequest();
    var url = protocol + "//" + host + "/medias/type/" + mediatype + "/" + id + "";
    xhr.open("GET", url);
    xhr.send();
  }

}

function onClickMoreComments() {
  var w = document.querySelectorAll("#js-comment").length;
  var x = document.getElementById("js-loading-img");
  var y = document.getElementById("js-comments-content");
  var z = document.getElementById("js-morecomment-btn");
  var slug = pathname.split('/')[2];

  x.style.display = "inline-block";

  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    console.log(this); // debug
    if (this.readyState == 4 && this.status == 200) {

      var data = this.response;

      this.comments = parseInt(this.comments) + parseInt(1);


      if (data.length <= 5 || w >= data.length) {
        console.log("display none");
        z.style.display = "none";
        z.innerHTML = '<p class="text-center"> Sorry snowborder, No more comments for moments, <br><a href="#create-comment">Create new comment</a> </p>';
        return;
      }

      // FIX LOAD BTN
      setTimeout(timeOut(), 3000);

      function timeOut() {
       
        x.style.display = "none";
      }

      for (var i = 5; i < data.length; i++) {

        var date = new Date(data[i].createdAt.timestamp * 1000);

        console.log(date)

         y.innerHTML += '<div class="comment d-flex justify-content-center align-items-center" id="js-comment" data-aos="flip-left">'+
                  '<span class="user-avatar m-3"><img '
                        +'src="/uploads/avatar/'+ data[i].user.avatar +'"'
                        +'alt=""></span>'
                  +'<span class="user-comment m-3">'+ data[i].content +'<br><span'
                        +'class="comment-info"> Created by '+ data[i].user.firstname +' on '+ date.toLocaleDateString() +'</span>'
                  +'</span>'
               +'</div>';
      }
    }
  };

  var url = protocol+"//"+host+"/ajax/message/"+this.comments+"/trick/"+slug;


  xhr.open("GET", url);
  xhr.responseType = "json";
  xhr.send();
}