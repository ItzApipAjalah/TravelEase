<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/img/logo_icon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo_icon.png') }}" rel="apple-touch-icon">


</head>

<body>

    <div class="d-flex">
        <div class="sidebar p-3" id="sidebar">
            <a href="{{ route('user.home') }}"><img id="sidebarLogo" src="{{ url('assets/img/logoTravel.png') }}"
                    alt="Sidebar Image" class="img-fluid mx-auto d-block"></a>
            <br>
            <div class="toggleButton">
                <button class="btn btn-muted" id="toggleButton">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>


            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.home') }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="Chat">
                        <i class="fas fa-comments"></i>
                        <span>Chat</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ticket') }}">
                        <i class="fa-solid fa-ticket icon"></i>
                        <span>Ticketing</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories') }}">
                        <i class="fa-solid fa-tag"></i>
                        <span>Categories</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.list') }}">
                        <i class="fas fa-users"></i>
                        <span>UserList</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('trash.index') }}">
                        <i class="fas fa-trash"></i>
                        <span>Trash</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('setting') }}">
                        <i class="fa-solid fa-gear icon"></i>
                        <span>Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link logout-button" href="#"
                        onclick="event.preventDefault(); showLogoutModal();">
                        <i class="fa-solid fa-right-from-bracket icon"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ url('logout') }}" style="display: none;">
                        @csrf
                    </form>
                </li>

                <!-- Modal Konfirmasi Logout -->
                <div id="logoutModal" class="modal-overlay" style="display: none;">
                    <div class="modal-content">
                        <h3>Apakah kamu ingin Logout?</h3>
                        <div class="modal-buttons">
                            <button onclick="confirmLogout()" class="btn-confirm">
                                <i class="fas fa-check"></i> <!-- Ikon centang -->
                            </button>
                            <button onclick="closeLogoutModal()" class="btn-cancel">
                                <i class="fas fa-times"></i> <!-- Ikon X -->
                            </button>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
        <div class="content p-4">
            @yield('contents')
        </div>
    </div>

    <script>
        const toggleButton = document.getElementById('toggleButton');
        const sidebar = document.getElementById('sidebar');
        const sidebarLogo = document.getElementById('sidebarLogo');



        // Fungsi untuk mengatur sidebar berdasarkan status yang disimpan di localStorage
        function setSidebarState() {
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                sidebarLogo.src = "{{ url('assets/img/logo_icon.png') }}";
            } else {
                sidebar.classList.remove('collapsed');
                sidebarLogo.src = "{{ url('assets/img/logoTravel.png') }}";
            }
        }

        // Setiap kali tombol toggle diklik, status sidebar disimpan ke localStorage
        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);

            // Ganti logo saat sidebar dikecilkan
            if (isCollapsed) {
                sidebarLogo.src = "{{ url('assets/img/logo_icon.png') }}"; // Gambar kecil
            } else {
                sidebarLogo.src = "{{ url('assets/img/logoTravel.png') }}"; // Gambar besar
            }
        });

        // Panggil fungsi untuk mengatur sidebar saat halaman dimuat
        setSidebarState();

        function setActiveNavLink() {
            const currentUrl = window.location.href;
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        setActiveNavLink();

        function confirmLogout() {
            if (confirm("Apakah Anda ingin Logout?")) {
                document.getElementById('logout-form').submit();
            }
        }

        function showLogoutModal() {
            document.getElementById('logoutModal').style.display = 'flex';
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }

        function confirmLogout() {
            document.getElementById('logout-form').submit();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</body>

</html>
