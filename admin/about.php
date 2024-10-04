<!DOCTYPE html>
<html lang="en">

<?php include 'layout/head.php'; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'components/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'components/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">About Settings</h1>
                    </div>

                    
                    <div class="card shadow mb-4 mt-4">
                      <div class="card-header">
                          <i class="fas fa-wrench me-1"></i>
                          About Settings
                      </div>
                      <div class="card-body"> 
                          <div class="card-body" style="max-width: 600px;">
                            <form action="proses/simpan_data_barang.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <img src="/images/illustrations/illustration-1.png" class="img-fluid rounded mx-auto d-block" width=200px >
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Unggah Foto</label>
                                <input type="file" name="foto" class="form-control" accept=".jpg, jpeg, .png, .gif">
                                <font color="red">*tipe yang bisa di upload adalah : .jpg, .jpeg, .png, .gift</font>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Judul</label>
                                <input type="text" name="nama_menu" class="form-control">
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Keterangan</label>
                                <textarea class="form-control" rows="7" name="keterangan"></textarea>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Jenis</label>
                                <select class="form-control" name="jenis">
                                  <option value="" hidden></option>
                                  <option value="makanan">Makanan</option>
                                  <option value="minuman">Minuman</option>
                                  <option value="Lainnya">Lainnya</option>
                                </select>
                              </div>
                              <div class="form-group cols-sm-6">
                                <label>Harga</label>
                                <input type="text" name="harga" class="form-control">
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Keterangan</label>
                                <textarea class="form-control" rows="7" name="keterangan"></textarea>
                              </div>
                              <div class="form-group cols-sm-6 mb-3">
                                <label>Status</label>
                                <!-- <input type="text" name="jenis" class="form-control"> -->
                                <select class="form-control" name="jenis">
                                  <option value="makanan">Aktif</option>
                                  <option value="minuman">Non Aktif</option>
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
            <?php include 'components/footer.php'; ?>
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

    <?php include 'layout/scripts-module.php'; ?>

</body>

</html>