const menuToggle = document.getElementById('menu-toggle');
const compassToggle = document.getElementById('compass-toggle');
const container = document.querySelector('.container');

// menuToggle.addEventListener('click', function() {
//     container.classList.toggle('show-sidebar');
// });

// compassToggle.addEventListener('click', function() {
//     container.classList.toggle('show-sidebar');
// });
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
type: 'bar',
data: {
labels: ['Refund', 'Destinasi', 'Cek Fakta', 'Pembayaran'],
datasets: [{
    label: 'Laporan',
    data: [18, 5, 12, 20],
    backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)'
    ],
    borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
    ],
    borderWidth: 1
}]
},
options: {
responsive: true,
maintainAspectRatio: false,
scales: {
    y: {
        beginAtZero: true
    }
}
}
});
document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.getElementById('menu-toggle');
    const container = document.querySelector('.container');
    const ctx = document.getElementById('myChart').getContext('2d');

    // Inisialisasi chart
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Refund', 'Destinasi', 'Cek Fakta', 'Pembayaran'],
            datasets: [{
                label: 'Laporan',
                data: [18, 5, 12, 20],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Fungsi untuk resize chart jika layout berubah
    function updateChartLayout() {
        setTimeout(() => {
            myChart.resize();
        }, 300); // Waktu tunggu untuk memastikan layout sudah stabil
    }

    // Event listener untuk menu toggle (jika ada sidebar)
   
});

// Mendapatkan modal
var modal = document.getElementById("profileModal");

// Mendapatkan ikon profil
var profileIcon = document.querySelector(".bx-user.profile");

// Mendapatkan tombol close
var closeButton = document.querySelector(".close-button");

// Mendapatkan tombol edit
var editProfileButton = document.getElementById("editProfileBtn");

// Ketika ikon profil diklik, buka modal
profileIcon.onclick = function() {
    modal.style.display = "block";
}

// Ketika tombol close diklik, tutup modal
closeButton.onclick = function() {
    modal.style.display = "none";
}

// Ketika di luar modal diklik, tutup modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Logika untuk tombol edit dapat ditambahkan di sini
editProfileButton.onclick = function() {
    // Arahkan ke halaman edit atau tampilkan form untuk edit
    alert("Fitur edit profil akan ditambahkan di sini.");
}