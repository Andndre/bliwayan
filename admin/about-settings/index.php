<?php 
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:login/');
}
include '../service/config.php';

// Ambil ID menu dari parameter URL
$id = 1;

// Ambil data menu berdasarkan ID dari database
$sql = "SELECT * FROM deskripsi WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Jika menu ditemukan
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
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
                        <h1 class="h3 mb-0 text-gray-800">Menu</h1>
                    </div>

                    
                    <div class="card shadow mb-4 mt-4">
                      <div class="card-header">
                          <i class="fas fa-box me-1"></i>
                          Data Menu
                      </div>
                      <div class="card-body"> 
                          <div class="card-body" style="max-width: 600px;">
                          <form action="/admin/service/aboutUpdate.php" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                              <img id="preview-image" src="/admin/gambar/about/<?php echo $data['gambar_pertama']; ?>" class="img-fluid rounded mx-auto d-block" width="200px">
                              <div class="form-group">
                                  <label>Gambar (Kosongkan jika tidak ingin mengganti)</label>
                                  <input type="file" name="gambar_pertama" class="form-control" onchange="previewImage(event)">
                              </div>
                              <div class="form-group">
                                  <label>Judul</label>
                                  <input type="text" name="judul" class="form-control" value="<?php echo $data['judul']; ?>" required>
                              </div>
                              <div class="form-group">
                                  <label>Deskripsi</label>
                                  <textarea name="deskripsi" class="form-control" rows="7"><?php echo $data['deskripsi']; ?></textarea>
                              </div>
                              <div class="form-group">
                                  <label>Whatsapp</label>
                                  <input type="text" name="whatsapp" class="form-control" value="<?php echo $data['whatsapp']; ?>" required>
                              </div>
                              <div class="form-group">
                                  <label>Email</label>
                                  <input type="text" name="email" class="form-control" value="<?php echo $data['email']; ?>" required>
                              </div>
                              <div class="form-group">
                                  <label>Alamat</label>
                                  <textarea name="alamat" class="form-control" rows="4"><?php echo $data['alamat']; ?></textarea>
                              </div>
                              <video id="preview-video" class="img-fluid rounded mx-auto d-block mt-3" width="320" height="240" controls>
                                  <source src="/admin/gambar/about/<?php echo $data['video']; ?>" type="video/mp4">
                                  Browser Anda tidak mendukung video.
                              </video>
                              <div class="form-group">
                                  <label>Video (Kosongkan jika tidak ingin mengganti)</label>
                                  <input type="file" name="video" class="form-control">
                              </div>
                              <div class="form-group">
                                  <label>Judul Video</label>
                                  <input type="text" name="judul_video" class="form-control" value="<?php echo $data['judul_video']; ?>" required>
                              </div>
                              <img id="preview-image2" src="/admin/gambar/about/<?php echo $data['gambar_kedua']; ?>" class="img-fluid rounded mx-auto d-block" width="200px">
                              <div class="form-group">
                                  <label>Gambar (Kosongkan jika tidak ingin mengganti)</label>
                                  <input type="file" name="gambar_kedua" class="form-control" onchange="previewImage2(event)">
                              </div>
                              <div class="form-group">
                                  <label>Judul Kedua</label>
                                  <input type="text" name="judul_kedua" class="form-control" value="<?php echo $data['judul_kedua']; ?>" required>
                              </div>
                              <div class="form-group">
                                  <label>Deskripsi Kedua</label>
                                  <textarea name="deskripsi_kedua" class="form-control" rows="7"><?php echo $data['deskripsi_kedua']; ?></textarea>
                              </div>
                              <div class="form-group">
                                  <label>Link YouTube</label>
                                  <input type="text" name="link_youtube" class="form-control" value="<?php echo $data['link_youtube']; ?>" required>
                              </div>
                              <button type="submit" class="btn btn-info">Simpan Perubahan</button>
                              <a href="menu.php" class="btn btn-secondary">Batal</a>
                          </form>
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

    <!-- Modal Sukses -->
    <div class="modal fade" id="suksesModal" tabindex="-1" role="dialog" aria-labelledby="suksesModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="suksesModalLabel">Sukses!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Data Anda telah berhasil diperbarui.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Oke</button>
          </div>
        </div>
      </div>
    </div>

    <?php include '../layout/scripts-module.php'; ?>
    <!-- JavaScript untuk menampilkan preview gambar -->
    <?php 
    
      // Cek apakah ada session 'update_success' dan unset setelah modal tampil
      if (isset($_SESSION['update_success'])) {
        echo "<script type='text/javascript'>
                $(document).ready(function(){
                    $('#suksesModal').modal('show');
                });
              </script>";
        unset($_SESSION['update_success']);
      }
    ?>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview-image');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage2(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview-image2');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewVideo(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const video = document.getElementById('preview-video');
                video.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>


</body>

</html>