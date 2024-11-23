<?php 
$_ENV = parse_ini_file('../../../.env');
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location:login/');
}
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
                            <form action="/admin/service/menuTambah.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Unggah Foto</label>
                                <input type="file" name="gambar" class="form-control" accept=".jpg, jpeg, .png, .gif" required>
                                <font color="red">*tipe yang bisa di upload adalah : .jpg, .jpeg, .png, .gift</font>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Nama Menu</label>
                                <input type="text" name="name" class="form-control" required>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Nama English Menu</label>
                                <input type="text" name="name_english" class="form-control" required>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Jenis</label>
                                <select class="form-control" name="jenis">
                                  <option value="" hidden></option>
                                  <option value="makan">Makanan</option>
                                  <option value="minuman">Minuman</option>
                                  <option value="lainnya">Lainnya</option>
                                </select>
                              </div>
                              <div class="form-group cols-sm-6">
                                <label>Harga</label>
                                <input type="text" name="harga" class="form-control" required>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Keterangan</label>
                                <textarea class="form-control" rows="7" name="keterangan"></textarea>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Keterangan English</label>
                                <textarea class="form-control" rows="7" name="keterangan_english"></textarea>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Status</label>
                                <!-- <input type="text" name="jenis" class="form-control"> -->
                                <select class="form-control" name="status">
                                  <option value="1">Aktif</option>
                                  <option value="0">Non Aktif</option>
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

    <!-- SweetAlert script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] === 'gagal'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat menyimpan data',
            confirmButtonText: 'OK'
        });
      <?php 
          unset($_SESSION['alert']); 
      endif; 
      ?>
        
    </script>

</body>

</html>