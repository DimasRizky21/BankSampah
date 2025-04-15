// Ambil parameter dari URL
const urlParams = new URLSearchParams(window.location.search);
const fromHome = urlParams.get("from");

// Cek jika user datang bukan dari home ATAU halaman di-refresh
if (
  fromHome !== "home" ||
  performance.getEntriesByType("navigation")[0].type === "reload"
) {
  window.location.href = "index.html";
}





