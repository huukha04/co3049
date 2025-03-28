<header class="sticky-top px-3"
                style="min-height: 100px;">
    <div class="navbar border-bottom py-3">
        <div>
            <a href="main/home" class="text-decoration-none fs-3">Cinema</a>
        </div>
        <div class="d-flex gap-3">
            <div class="d-flex align-items-center btn btn-outline-primary py-1 px-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                    <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z"/>
                    <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z"/>
                </svg>
                <span class="d-none d-sm-block ms-2">Đặt vé</span>
            </div>
            <div class="d-flex align-items-center btn btn-outline-primary py-1 px-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cup-straw" viewBox="0 0 16 16">
                    <path d="M13.902.334a.5.5 0 0 1-.28.65l-2.254.902-.4 1.927c.376.095.715.215.972.367.228.135.56.396.56.82q0 .069-.011.132l-.962 9.068a1.28 1.28 0 0 1-.524.93c-.488.34-1.494.87-3.01.87s-2.522-.53-3.01-.87a1.28 1.28 0 0 1-.524-.93L3.51 5.132A1 1 0 0 1 3.5 5c0-.424.332-.685.56-.82.262-.154.607-.276.99-.372C5.824 3.614 6.867 3.5 8 3.5c.712 0 1.389.045 1.985.127l.464-2.215a.5.5 0 0 1 .303-.356l2.5-1a.5.5 0 0 1 .65.278M9.768 4.607A14 14 0 0 0 8 4.5c-1.076 0-2.033.11-2.707.278A3.3 3.3 0 0 0 4.645 5c.146.073.362.15.648.222C5.967 5.39 6.924 5.5 8 5.5c.571 0 1.109-.03 1.588-.085zm.292 1.756C9.445 6.45 8.742 6.5 8 6.5c-1.133 0-2.176-.114-2.95-.308a6 6 0 0 1-.435-.127l.838 8.03c.013.121.06.186.102.215.357.249 1.168.69 2.438.69s2.081-.441 2.438-.69c.042-.029.09-.094.102-.215l.852-8.03a6 6 0 0 1-.435.127 9 9 0 0 1-.89.17zM4.467 4.884s.003.002.005.006zm7.066 0-.005.006zM11.354 5a3 3 0 0 0-.604-.21l-.099.445.055-.013c.286-.072.502-.149.648-.222"/>
                </svg>
                <span class="d-none d-sm-block ms-2">Đặt bắp nước</span>
            </div>
        </div>


        <div class="dropdown">
            <a href="#" class="sidebar-link" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                </svg>
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" id="dropdownMenu">
                <!-- Nội dung sẽ được cập nhật bằng JavaScript -->
            </ul>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                fetch('main/get_session_user')
                .then(response => response.json())
                .then(data => {
                    console.log("User Data:", data);
                    
                    const dropdownMenu = document.getElementById("dropdownMenu");

                    if (data && data.role) {
                        if (data.role === "admin") {
                            dropdownMenu.innerHTML = `
                                <li>
                                    <a class="dropdown-item" href="admin/home">
                                        Chế độ quản lí
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="auth/logout">
                                       Đăng xuất
                                    </a>
                                </li>
                            `;
                        } else if (data.role === "customer") {
                            dropdownMenu.innerHTML = `
                                <li>
                                    <a class="dropdown-item" href="#">
                                        Tài khoản
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        Vé của tôi
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        Giao diện tối/sáng
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="auth/logout">
                                        Đăng xuất
                                    </a>
                                </li>
                            `;
                        }
                    } else {
                        // Nếu chưa đăng nhập
                        dropdownMenu.innerHTML = `
                            <li>
                                <a class="dropdown-item" href="auth/login">
                                    Đăng nhập
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="auth/register">
                                    Đăng ký
                                </a>
                            </li>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
            });
        </script>

    </div>
    <!--  -->
    <div class="navbar">
        <div class="d-flex gap-2">
            <div>Chọn rạp</div>
            <div>Chọn phim</div>

        </div>
        <div class="d-flex gap-2">
            <div>Thuê rạp</div>
            <div>Khuyến mãi</div>
            <div>About</div>
            <div>Contact</div>
        </div>
    </div>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>