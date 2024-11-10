<?php 
$_ENV = parse_ini_file('../../../.env');
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:login/');
}
include '../../service/config.php';

// Ambil ID menu dari parameter URL
$id = $_GET['id'];

// Ambil data menu berdasarkan ID dari database
$sql = "SELECT * FROM gallerys WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Jika menu ditemukan
if ($result->num_rows > 0) {
$menu = $result->fetch_assoc();
} else {
echo "data tidak ditemukan!";
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
                        <h1 class="h3 mb-0 text-gray-800">Gallery</h1>
                    </div>
                    <div class="card shadow mb-4 mt-4">
                      <div class="card-header">
                          <i class="fas fa-box me-1"></i>
                          Data Gallery
                      </div>
                      <div class="card-body"> 
                          <div class="card-body" style="max-width: 600px;">
                            <form action="/admin/service/galleryUpdate.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
                              <img id="preview-image" src="/admin/gambar/gallerys/<?php echo $menu['file']; ?>" class="img-fluid rounded mx-auto d-block" width="200px">
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Unggah Foto</label>
                                <input type="file" name="gambar" class="form-control" accept=".jpg, jpeg, .png, .gif"  onchange="previewImage(event)">
                                <font color="red">*tipe yang bisa di upload adalah : .jpg, .jpeg, .png, .gift</font>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Judul</label>
                                <input type="text" name="judul" value="<?php echo $menu['judul']; ?>" class="form-control" required>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Jenis</label>
                                <select class="form-control" name="jenis">
                                  <option value="" hidden></option>
                                  <option value="foto" <?php if($menu['jenis'] == 'foto') echo 'selected'; ?>>Foto</option>
                                  <option value="video" <?php if($menu['jenis'] == 'video') echo 'selected'; ?>>Video</option>
                                </select>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Keterangan</label>
                                <textarea class="form-control" rows="7" name="deskripsi"><?php echo $menu['deskripsi']; ?></textarea>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Status</label>
                                <!-- <input type="text" name="jenis" class="form-control"> -->
                                <select class="form-control" name="status">
                                  <option value="1" <?php if($menu['status'] == '1') echo 'selected'; ?>>Aktif</option>
                                  <option value="0" <?php if($menu['status'] == '0') echo 'selected'; ?>>Non-Aktif</option>
                                </select>
                              </div>
                              
                              <div class="form-group cols-sm-6 mb-3">
                                <input type="submit" value="Simpan" class="btn btn-success">
                                <input type="reset" value="batal" class="btn btn-danger">
                              </div>
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
                text: 'gallery berhasil diupdate!',
                confirmButtonText: 'OK'
            });
        <?php 
            unset($_SESSION['alert']); 
        endif; 
        ?>
    </script>

</body>

</html>