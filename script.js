// // Ambil parameter dari URL
// const urlParams = new URLSearchParams(window.location.search);
// const fromHome = urlParams.get("from");

// // Cek jika user datang bukan dari home ATAU halaman di-refresh
// if (
//   fromHome !== "home" ||
//   performance.getEntriesByType("navigation")[0].type === "reload"
// ) {
//   window.location.href = "index.html";
// }

// document.addEventListener("DOMContentLoaded", function () {
//   const openFormBtn = document.getElementById("openFormBtn");
//   const feedbackForm = document.getElementById("feedbackForm");

//   openFormBtn.addEventListener("click", function () {
//     if (feedbackForm.style.display === "none") {
//       feedbackForm.style.display = "block";
//     } else {
//       feedbackForm.style.display = "none";
//     }
//   });

//   feedbackForm.addEventListener("submit", function (event) {
//     event.preventDefault();
//     alert("Terima kasih atas masukan Anda!");
//     feedbackForm.reset();
//     feedbackForm.style.display = "none";
//   });
// });




