<?php
$_ENV = parse_ini_file('../../../.env');
session_start();
if(!isset($_SESSION['user_id']))
{
header('location:/login/');
}

include '../../service/config.php';

// Ambil ID menu dari parameter URL
$menu_id = $_GET['id'];

// Ambil data menu berdasarkan ID dari database
$sql = "SELECT * FROM menus WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $menu_id);
$stmt->execute();
$result = $stmt->get_result();

// Jika menu ditemukan
if ($result->num_rows > 0) {
$menu = $result->fetch_assoc();
} else {
echo "Menu tidak ditemukan!";
exit;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<?php include '../../layout/head.php'; ?>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include '../../components/sidebar.php'; ?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php include '../../components/navbar.php'; ?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Menu</h1>
                        </div>

                        
                        <div class="card shadow mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-box me-1"></i>
                                Data Menu
                            </div>
                            <div class="card-body"> 
                                <div class="card-body" style="max-width: 600px;">
                                <form action="/admin/service/menuUpdate.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
                                    <img id="preview-image" src="/admin/gambar/menus/<?php echo $menu['gambar']; ?>" class="img-fluid rounded mx-auto d-block" width="200px">
                                    <div class="form-group">
                                        <label>Gambar (Kosongkan jika tidak ingin mengganti)</label>
                                        <input type="file" name="gambar" class="form-control" onchange="previewImage(event)">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Menu</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $menu['name']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Menu English</label>
                                        <input type="text" name="name_english" class="form-control" value="<?php echo $menu['name_english']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <select name="jenis" class="form-control" required>
                                        <option value="makan" <?php if($menu['jenis'] == 'makan') echo 'selected'; ?>>Makanan</option>
                                        <option value="minuman" <?php if($menu['jenis'] == 'minuman') echo 'selected'; ?>>Minuman</option>
                                        <option value="lainnya" <?php if($menu['jenis'] == 'lainnya') echo 'selected'; ?>>Lainnya</option>
                                        <!-- Tambahkan opsi lain sesuai kebutuhan -->
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="form-control" value="<?php echo $menu['harga']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control"><?php echo $menu['keterangan']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan_english" class="form-control"><?php echo $menu['keterangan_english']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                        <option value="1" <?php if($menu['status'] == '1') echo 'selected'; ?>>Aktif</option>
                                        <option value="0" <?php if($menu['status'] == '0') echo 'selected'; ?>>Non-Aktif</option>
                                    </select>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-info">Simpan</button>
                                    <button type="reset" class="btn btn-danger">Batal</button>
                                </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include '../../components/footer.php'; ?>
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
                    <h5 class="modal-title" id="exampleModalLabel">Keluar dari Aplikasi?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Keluar" di bawah jika Anda yakin ingin mengakhiri sesi saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" href="/admin/service/logout.php">Keluar</a>
                </div>
            </div>
        </div>
    </div>

        <?php include '../../layout/scripts-module.php'; ?>

        <!-- JavaScript untuk menampilkan preview gambar -->
        <script>
            function previewImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const output = document.getElementById('preview-image');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
        <!-- SweetAlert script -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'suksesdiupdate'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Menu berhasil diupdate!',
                    confirmButtonText: 'OK'
                });
            <?php 
                unset($_SESSION['alert']); 
            endif; 
            ?>
        </script>


    </body>

</html>