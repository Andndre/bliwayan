<?php 
$_ENV = parse_ini_file('../../.env');
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:login/');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../layout/head.php'; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../components/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../components/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Gallery</h1>
                        <a href="/admin/gallery/tambah-gallery" class="btn btn-sm btn-info shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah Gallery</a>
                    </div>

                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-info">Data Gallery</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    // Koneksi ke database
                                    include '../service/config.php';

                                    // Query untuk mengambil semua data dari tabel menus
                                    $sql = "SELECT * FROM gallerys";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Output data per baris
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            if ($row['jenis'] == 'foto') {
                                                echo "<td><img src='/admin/gambar/gallerys/" . $row['file'] . "' class='img-fluid rounded mx-auto d-block' width='200px'></td>";
                                            } else {
                                                echo "<td><video controls class='img-fluid rounded mx-auto d-block' width='200px'>
                                                        <source src='/admin/gambar/gallerys/" . $row['file'] . "' type='video/mp4'>
                                                        Your browser does not support the video tag.
                                                      </video></td>";
                                            }
                                            echo "<td>" . $row['judul'] . "</td>";
                                            echo "<td>" . $row['jenis'] . "</td>";
                                            echo "<td>
                                                    <a href='/admin/gallery/edit-gallery/index.php?id=" . $row['id'] . "' class='btn btn-sm btn-info shadow-sm'><i class='fas fa-pen fa-sm text-white-50'></i> Edit Menu</a>
                                                    <a href='#' class='btn btn-sm btn-danger shadow-sm' onclick='confirmDelete(" . $row['id'] . ")'>
                                                        <i class='fas fa-trash fa-sm text-white-50'></i> Hapus Menu
                                                    </a>
                                                </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>Tidak ada data yang tersedia</td></tr>";
                                    }

                                    // Tutup koneksi
                                    $conn->close();
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include '../components/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php include '../layout/scripts-module.php'; ?>
    <!-- SweetAlert script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data gallery ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/admin/service/galleryHapus.php?id=' + id;
                }
            });
        }
    </script>
    <script>
        <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'suksesdihapus'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Gallery berhasil dihapus!',
                confirmButtonText: 'OK'
            });
        <?php 
            unset($_SESSION['alert']); 
        endif; 
        ?>
    </script>
    <script>
        <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'success'): ?>
            // Tampilkan SweetAlert jika session status ada dan bernilai success
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Gallery berhasil ditambahkan!',
                confirmButtonText: 'OK'
            });
        <?php 
            unset($_SESSION['alert']); // Hapus session status setelah digunakan
        endif; 
        ?>
    </script>

</body>

</html>