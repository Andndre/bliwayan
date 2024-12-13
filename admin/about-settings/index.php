<?php 
$_ENV = parse_ini_file('../../.env');
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location: /admin/login/');
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
    echo "Data tidak ditemukan!";
    exit;
}

// Ambil data menu berdasarkan ID dari database
$sql2 = "SELECT * FROM media_social WHERE id = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $id);
$stmt2->execute();
$result2 = $stmt2->get_result();

// Jika menu ditemukan
if ($result2->num_rows > 0) {
    $data2 = $result2->fetch_assoc();
} else {
    echo "Data tidak ditemukan!";
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
                        <h1 class="h3 mb-0 text-gray-800">About</h1>
                        <a href="#" data-toggle="modal" data-target="#inputModal" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-pen fa-sm text-white-50"></i> Media Sosial</a>
                    </div>

                    
                    <div class="card shadow mb-4 mt-4">
                      <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-info">Data About</h6>
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
                                        <label>Judul English</label>
                                        <input type="text" name="judul_english" class="form-control" value="<?php echo $data['judul_english']; ?>" required>
                                    </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="7"><?php echo $data['deskripsi']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi English</label>
                                    <textarea name="deskripsi_english" class="form-control" rows="7"><?php echo $data['deskripsi_english']; ?></textarea>
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
                                <div class="form-group">
                                    <label>Judul Video English</label>
                                    <input type="text" name="judul_video_english" class="form-control" value="<?php echo $data['judul_video_english']; ?>" required>
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
                                    <label>Judul Kedua English</label>
                                    <input type="text" name="judul_kedua_english" class="form-control" value="<?php echo $data['judul_kedua_english']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Kedua</label>
                                    <textarea name="deskripsi_kedua" class="form-control" rows="7"><?php echo $data['deskripsi_kedua']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Kedua English</label>
                                    <textarea name="deskripsi_kedua_english" class="form-control" rows="7"><?php echo $data['deskripsi_kedua_english']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Link YouTube</label>
                                    <input type="text" name="link_youtube" class="form-control" value="<?php echo $data['link_youtube']; ?>" required>
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
    <!-- Modal dengan Form Input -->
    <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Media Sosial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/admin/service/mediaSocialUpdate.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Link Instagram</label>
                            <input type="text" class="form-control" id="instagram" value="<?php echo $data2['instagram']; ?>" name="instagram" placeholder="Masukkan Link Instagram" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Link Facebook</label>
                            <input type="text" class="form-control" id="facebook" value="<?php echo $data2['facebook']; ?>" name="facebook" placeholder="Masukkan Link Facebook" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Link Youtube</label>
                            <input type="text" class="form-control" id="youtube" value="<?php echo $data2['youtube']; ?>" name="youtube" placeholder="Masukkan Link Youtube" required>
                        </div>
                    <div class="modal-footer">
                        <a href="/admin/about-settings" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php include '../layout/scripts-module.php'; ?>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'sukses'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data about berhasil diubah!',
                confirmButtonText: 'OK'
            });
        <?php 
            unset($_SESSION['alert']); 
        endif; 
        ?>
    </script>
    <script>
        <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'berhasil'): ?>
            // Tampilkan SweetAlert jika session status ada dan bernilai success
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data media sosial berhasil diubah!',
                confirmButtonText: 'OK'
            });
        <?php 
            unset($_SESSION['alert']); // Hapus session status setelah digunakan
        endif; 
        ?>
    </script>

</body>

</html>