"use strict";

$("#modal-1").fireModal({ body: "Modal body text goes here." });
$("#modal-2").fireModal({ body: "Modal body text goes here.", center: true });

let modal_3_body =
  '<p>Object to create a button on the modal.</p><pre class="language-javascript"><code>';
modal_3_body += "[\n";
modal_3_body += " {\n";
modal_3_body += "   text: 'Login',\n";
modal_3_body += "   submit: true,\n";
modal_3_body += "   class: 'btn btn-primary btn-shadow',\n";
modal_3_body += "   handler: function(modal) {\n";
modal_3_body += "     alert('Hello, you clicked me!');\n";
modal_3_body += "   }\n";
modal_3_body += " }\n";
modal_3_body += "]";
modal_3_body += "</code></pre>";

$("#modal-3").fireModal({
  title: "Import Data",
  body: modal_3_body,
  buttons: [
    {
      text: "Click, me!",
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {
        alert("Hello, you clicked me!");
      },
    },
  ],
});

let modal_siswa_body = "<p>Contoh Format Data Import</p>";
modal_siswa_body +=
  "<p class='fw-bold font-weight-bold'>Nama | Nisn | Tingkatan | No Kelas | Jurusan | Sesi | Ruangan</p>";
// modal_siswa_body += "\n";
modal_siswa_body +=
  "<label class='fw-bold font-weight-bold'>Import Siswa</label>";
modal_siswa_body += `<form class="import" action="/siswa/s/import" enctype="multipart/form-data" method="post">
                    <input type="hidden" value="${$('meta[name="_token"]').attr(
                      "content"
                    )}" name="_token" id="">
                    <input type="file" name="file" id="">
                </form>`;

$("#modal-siswa").fireModal({
  title: "Import Data Siswa",
  body: modal_siswa_body,
  buttons: [
    {
      text: "Import",
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {
        $(".import").submit();
      },
    },
  ],
});

let modal_guru_body = "<p>Contoh Format Data Import</p>";
modal_guru_body += "<p class='fw-bold font-weight-bold'>| Nama |</p>";
// modal_guru_body += "\n";
modal_guru_body +=
  "<label class='fw-bold font-weight-bold'>Import Guru</label>";
modal_guru_body += `<form class="import" action="/guru/g/import" enctype="multipart/form-data" method="post">
                    <input type="hidden" value="${$('meta[name="_token"]').attr(
                      "content"
                    )}" name="_token" id="">
                    <input type="file" name="file" id="">
                </form>`;

$("#modal-guru").fireModal({
  title: "Import Data Guru",
  body: modal_guru_body,
  buttons: [
    {
      text: "Import",
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {
        $(".import").submit();
      },
    },
  ],
});
let modal_jurusan_body = "<p>Contoh Format Data Import</p>";
modal_jurusan_body += "<p class='fw-bold font-weight-bold'>| Jurusan |</p>";
// modal_jurusan_body += "\n";
modal_jurusan_body +=
  "<label class='fw-bold font-weight-bold'>Import Jurusan</label>";
modal_jurusan_body += `<form class="import" action="/jurusan/j/import" enctype="multipart/form-data" method="post">
                    <input type="hidden" value="${$('meta[name="_token"]').attr(
                      "content"
                    )}" name="_token" id="">
                    <input type="file" name="file" id="">
                </form>`;

$("#modal-jurusan").fireModal({
  title: "Import Data Jurusan",
  body: modal_jurusan_body,
  buttons: [
    {
      text: "Import",
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {
        $(".import").submit();
      },
    },
  ],
});

function updateStatus(id, nama, status) {
  let modal_absen_body = `<h6>Mengubah Status ${nama}</h6> `;
  // modal_absen_body += "\n";
  modal_absen_body += `<form class="update-status" action="/updateStatus/${id}" method="post">
    <input type="hidden" value="${$('meta[name="_token"]').attr(
      "content"
    )}" name="_token" id="">
<div class="form-group d-flex" style="gap:20px">

                                                                    <div class="custom-control custom-radio">
                                                                        <label>
                                                                            <input class="with-gap" name="status"
                                                                                id="alpha" value="hadir"
                                                                                ${
                                                                                  status ==
                                                                                  "hadir"
                                                                                    ? "checked"
                                                                                    : ""
                                                                                }
                                                                                type="radio"  />
                                                                            <span for="alpha">hadir</span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio">
                                                                        <label>
                                                                            <input class="with-gap" name="status"
                                                                                id="belum hadir" value="belum hadir"
                                                                                 ${
                                                                                   status ==
                                                                                   "belum hadir"
                                                                                     ? "checked"
                                                                                     : ""
                                                                                 }
                                                                                type="radio"  />
                                                                            <span for="alpha">belum hadir</span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio">
                                                                        <label>
                                                                            <input class="with-gap" name="status"
                                                                                id="alpha" value="alpa"
                                                                                 ${
                                                                                   status ==
                                                                                   "alpa"
                                                                                     ? "checked"
                                                                                     : ""
                                                                                 }
                                                                                type="radio"  />
                                                                            <span for="alpha">Alpha</span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio">
                                                                        <label>
                                                                            <input class="with-gap" name="status"
                                                                                id="sakit" value="sakit"
                                                                                 ${
                                                                                   status ==
                                                                                   "sakit"
                                                                                     ? "checked"
                                                                                     : ""
                                                                                 }
                                                                                type="radio" />
                                                                            <span for="sakit">Sakit</span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio">
                                                                        <label>
                                                                            <input class="with-gap" name="status"
                                                                                id="ijin" value="ijin"
                                                                                 ${
                                                                                   status ==
                                                                                   "ijin"
                                                                                     ? "checked"
                                                                                     : ""
                                                                                 }
                                                                                type="radio" />
                                                                            <span for="ijin">Ijin</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                     </form`;

  $(`#modal-absen-${id}`).fireModal({
    title: "Ubah Data",
    body: modal_absen_body,
    buttons: [
      {
        text: "Import",
        class: "btn btn-primary btn-shadow",
        handler: function (modal) {
          $(".update-status").submit();
        },
      },
    ],
  });
}

let modal_mapel_body = "<p>Contoh Format Data Import</p>";
modal_mapel_body += "<p class='fw-bold font-weight-bold'>| Mapel |</p>";
// modal_mapel_body += "\n";
modal_mapel_body +=
  "<label class='fw-bold font-weight-bold'>Import Mapel</label>";
modal_mapel_body += `<form class="import" action="/mapel/m/import" enctype="multipart/form-data" method="post">
                    <input type="hidden" value="${$('meta[name="_token"]').attr(
                      "content"
                    )}" name="_token" id="">
                    <input type="file" name="file" id="">
                </form>`;

$("#modal-mapel").fireModal({
  title: "Import Data Mapel",
  body: modal_mapel_body,
  buttons: [
    {
      text: "Import",
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {
        $(".import").submit();
      },
    },
  ],
});

let modal_ruangan_body = "<p>Contoh Format Data Import</p>";
modal_ruangan_body +=
  "<p class='fw-bold font-weight-bold'>| Ruangan | Teknisi | </p>";
// modal_ruangan_body += "\n";
modal_ruangan_body +=
  "<label class='fw-bold font-weight-bold'>Import Ruangan</label>";
modal_ruangan_body += `<form class="import" action="/ruangan/r/import" enctype="multipart/form-data" method="post">
                    <input type="hidden" value="${$('meta[name="_token"]').attr(
                      "content"
                    )}" name="_token" id="">
                    <input type="file" name="file" id="">
                </form>`;

$("#modal-ruangan").fireModal({
  title: "Import Data Mapel",
  body: modal_ruangan_body,
  buttons: [
    {
      text: "Import",
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {
        $(".import").submit();
      },
    },
  ],
});

$("#modal-4").fireModal({
  footerClass: "bg-whitesmoke",
  body: "Add the <code>bg-whitesmoke</code> class to the <code>footerClass</code> option.",
  buttons: [
    {
      text: "No Action!",
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {},
    },
  ],
});

$("#modal-5").fireModal({
  title: "Login",
  body: $("#modal-login-part"),
  footerClass: "bg-whitesmoke",
  autoFocus: false,
  onFormSubmit: function (modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data);

    // DO AJAX HERE
    let fake_ajax = setTimeout(function () {
      form.stopProgress();
      modal
        .find(".modal-body")
        .prepend(
          '<div class="alert alert-info">Please check your browser console</div>'
        );

      clearInterval(fake_ajax);
    }, 1500);

    e.preventDefault();
  },
  shown: function (modal, form) {
    console.log(form);
  },
  buttons: [
    {
      text: "Login",
      submit: true,
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {},
    },
  ],
});

$("#modal-6").fireModal({
  body: "<p>Now you can see something on the left side of the footer.</p>",
  created: function (modal) {
    modal
      .find(".modal-footer")
      .prepend('<div class="mr-auto"><a href="#">I\'m a hyperlink!</a></div>');
  },
  buttons: [
    {
      text: "No Action",
      submit: true,
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {},
    },
  ],
});

$(".oh-my-modal").fireModal({
  title: "My Modal",
  body: "This is cool plugin!",
});
