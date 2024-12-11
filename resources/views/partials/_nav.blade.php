<!-- Navbar -->
<nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/dashboard-admin">The Grand Palace Hotel</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <!-- Fullscreen Button -->
        <li class="nav-item">
            <a class="nav-link" href="#" id="btnFullscreen" onclick="toggleFullscreen()" style="color: #007bff;">
                <i class="fas fa-expand"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownAlerts" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #007bff;">
                <i class="fas fa-bell"></i>
                @if($notifications->count() > 0)
                    <span class="badge bg-danger" id="badgeAlerts">{{ $notifications->count() }}</span>
                @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownAlerts">
                @forelse ($notifications as $notification)
                    @if(!$notification->is_read)
                        <li>
                            <a class="dropdown-item notification-link" href="#" data-id="{{ $notification->id }}">
                                {{ $notification->title }}
                                <div class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    @endif
                @empty
                    <li><a class="dropdown-item" href="#">No new notifications</a></li>
                @endforelse
                <li><a class="dropdown-item" href="#">See all notifications</a></li>
            </ul>
        </li>
        
        <script>
            document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', function () {
        const notificationId = this.dataset.id; // Pastikan ID notifikasi ada di data attribute
        fetch(`/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Hapus notifikasi dari tampilan
                this.parentElement.remove();
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

        document.addEventListener('DOMContentLoaded', function() {
            const notificationLinks = document.querySelectorAll('.notification-link');
        
            notificationLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
        
                    const notificationId = this.getAttribute('data-id');
        
                    // AJAX request untuk menandai notifikasi sebagai dibaca
                    fetch(`/notifications/${notificationId}/read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Hapus notifikasi dari tampilan
                            this.parentElement.remove();
                        } else {
                            console.error('Error:', data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
        </script>
        


     
        <!-- Profile Link -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('profile.edit') }}" style="color: #007bff;">
                <span class="material-symbols-outlined">
                    account_circle
                </span>
            </a>
        </li>
    </ul>
</nav>

<!-- Include Bootstrap JS and its dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleFullscreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen(); 
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
    // Seleksi semua link notifikasi
    const notificationLinks = document.querySelectorAll('.notification-link');

    notificationLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            const notificationId = this.getAttribute('data-id');

            // AJAX request untuk menandai notifikasi sebagai dibaca
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hapus notifikasi dari tampilan
                    this.parentElement.remove();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>