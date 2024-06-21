<nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
  <div class="container">
    <a style="font-size: 30px" class="page-scroll oleo-font navbar-brand" href="<?= base_url('auth/'); ?>#home">Permata Laundry</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav text-center">
        <a class="text-light nav-item nav-link page-scroll" href="<?= base_url('auth/'); ?>#tentang">Tentang</a>
        <a class="text-light nav-item nav-link page-scroll" href="<?= base_url('auth/'); ?>#testimoni">Testimoni</a>
      </div>
      <div class="navbar-nav ml-auto">
        <a class="nav-item nav-link px-3 py-2 btn btn-primary rounded-pill text-white" href="<?= base_url('auth/cekStatusPesanan'); ?>"><i class="fas fa-fw fa-check"></i> Cek Status Pesanan</a>
      </div>
    </div>
  </div>
</nav>
<section class="pt-5">
  <div class="jumbotron jumbotron-fluid bg-info">
    <div class="container text-white text-center">
        <form action="<?= base_url('auth/cekStatusPesanan'); ?>" method="post">
          <div class="form-group">
              <label for="kode_invoice">Masukkan Kode Invoice Anda</label>
              <?php if (isset($_POST['cari_kode'])): ?>
                <input type="text" id="kode_invoice" class="text-center form-control" name="kode_invoice" value="<?= $kode_invoice; ?>">
              <?php else: ?>
                <input type="text" id="kode_invoice" class="text-center form-control" name="kode_invoice">
              <?php endif ?>
          </div>
          <div class="form-group">
            <button type="submit" name="cari_kode" class="btn btn-primary">Cari <i class="fas fa-fw fa-search"></i></button>
          </div>
        </form>
    </div>
    <div class="container-fluid text-white">
      <?php if (isset($berhasil)): ?>
        <div class="container">
          <div class="row">
            <div class="col-lg">
              <div class="modal-content">
                <div class="modal-body px-5">
                  <div class="row my-2 justify-content-center text-center">
                    <div class="col-sm-3">
                      <span class="badge badge-danger"><i class="fas fa-fw fa-sync"></i> Proses</span>
                    </div>
                    <div class="col-sm-3">
                      <span class="text-white badge badge-warning"><i class="fas fa-fw fa-tshirt"></i> Dicuci</span>
                    </div>
                    <div class="col-sm-3">
                      <span class="badge badge-primary"><i class="fas fa-fw fa-people-carry"></i> Siap Diambil</span>
                    </div>
                    <div class="col-sm-3">
                      <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> Sudah Diambil</span>
                    </div>
                  </div>  
                  <div class="row my-2 mb-3">
                    <div class="col-sm">
                      <?php if ($detail_header_transaksi['status_transaksi'] == 'proses'): ?>
                        <div class="progress">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      <?php elseif ($detail_header_transaksi['status_transaksi'] == 'dicuci'): ?>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      <?php elseif ($detail_header_transaksi['status_transaksi'] == 'siap diambil'): ?>
                        <div class="progress">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 63%" aria-valuenow="63" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      <?php elseif ($detail_header_transaksi['status_transaksi'] == 'sudah diambil'): ?>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      <?php endif ?>
                    </div>
                  </div>                
                  <table class="table">
                    <tr>
                      <td class="font-weight-bold">Kode Invoice</td>
                      <td class="px-2"> : </td>
                      <td><?= $detail_header_transaksi['kode_invoice']; ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Nama Member</td>
                      <td class="px-2"> : </td>
                      <td><?= $detail_header_transaksi['nama_member']; ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Tanggal Transaksi</td>
                      <td class="px-2"> : </td>
                      <td><?= date('d-m-Y, H:i:s', strtotime($detail_header_transaksi['tanggal_transaksi'])); ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Batas Waktu</td>
                      <td class="px-2"> : </td>
                      <td><?= date('d-m-Y, H:i:s', strtotime($detail_header_transaksi['batas_waktu'])); ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Tanggal Bayar</td>
                      <td class="px-2"> : </td>
                      <?php if ($detail_header_transaksi['tanggal_bayar'] == '0000-00-00 00:00:00'): ?>
                        <td>-</td>
                        <?php else: ?>
                        <td><?= date('d-m-Y, H:i:s', strtotime($detail_header_transaksi['tanggal_bayar'])); ?></td>
                      <?php endif ?>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Status Transaksi</td>
                      <td class="px-2"> : </td>
                      <td>
                        <?php if ($detail_header_transaksi['status_transaksi'] == 'proses'): ?>
                          <span class="badge badge-danger"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></span>
                        <?php elseif ($detail_header_transaksi['status_transaksi'] == 'dicuci'): ?>
                          <span class="text-white badge badge-warning"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></span>
                        <?php elseif ($detail_header_transaksi['status_transaksi'] == 'siap diambil'): ?>
                          <span class="badge badge-primary"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></span>
                        <?php elseif ($detail_header_transaksi['status_transaksi'] == 'sudah diambil'): ?>
                          <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></span>
                        <?php else: ?>
                          <span class="badge badge-info"><?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></span>
                        <?php endif ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Status Bayar</td>
                      <td class="px-2"> : </td>
                      <td>
                        <?php if ($detail_header_transaksi['status_bayar'] == 'belum dibayar'): ?>
                          <span class="badge badge-danger"><i class="fas fa-fw fa-times"></i> <?= $detail_header_transaksi['status_bayar']; ?></span>
                        <?php elseif ($detail_header_transaksi['status_bayar'] == 'sudah dibayar'): ?>
                          <span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $detail_header_transaksi['status_bayar']; ?></span>
                        <?php endif ?>
                      </td>
                    </tr>
                  </table>
                  <hr class="mt-0 pt-0 mb-2 pb-2">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered border border-dark mt-3 mb-1">
                      <thead>
                        <tr class="text-center">
                          <th>No</th>
                          <th>Nama Paket</th>
                          <th>Keterangan</th>
                          <th>Harga Paket (Rp.)</th>
                          <th>Kuantitas</th>
                          <th>Sub Harga (Rp.)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($detail_transaksi as $dt): ?>
                          <tr class="text-center">
                            <td><?= $i++; ?></td>
                            <td><?= $dt['nama_paket']; ?></td>
                            <td><?= $dt['keterangan']; ?></td>
                            <td><?= number_format($dt['harga_paket']); ?></td>
                            <td><?= number_format($dt['kuantitas']); ?></td>
                            <td class="text-right"><?= number_format($dt['harga_paket'] * $dt['kuantitas']); ?></td>
                          </tr>
                        <?php endforeach ?>
                        <tr>
                          <td colspan="5">
                            Biaya Tambahan (Rp.)
                          </td>
                          <td class="text-right">
                            + <?= number_format($dt['biaya_tambahan']); ?>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5">
                            Diskon %
                          </td>
                          <td class="text-right">
                            <?php $diskon = ($total_harga['total_harga'] + $dt['biaya_tambahan']) * $dt['diskon'] / 100; ?>
                            <?= number_format($dt['diskon']); ?> (- <?= number_format($diskon); ?>)
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5">
                            Pajak %
                          </td>
                          <td class="text-right">
                            <?php $pajak = ($total_harga['total_harga'] + $dt['biaya_tambahan'] - $diskon) * $dt['pajak'] / 100; ?>
                            <?= number_format($dt['pajak']); ?> (+ <?= number_format($pajak); ?>)
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5">
                            Total Harga dibulatkan (Rp.)
                          </td>
                          <td class="text-right">
                            <?php 
                              $total_harga_terakhir = (ceil(($total_harga['total_harga'] + $dt['biaya_tambahan'] - $diskon + $pajak) / 100)) * 100;
                             ?>
                            <?= number_format($total_harga['total_harga'] + $dt['biaya_tambahan'] - $diskon + $pajak); ?> <span class="font-weight-bold">(<?= number_format($total_harga_terakhir); ?>)</span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5">
                            Uang yang dibayar (Rp.)
                          </td>
                          <td class="text-right font-weight-bold">
                            <?php if ($pembayaran != null): ?>
                              <span>Rp. <?= number_format($pembayaran['uang_yg_dibayar']); ?></span>
                            <?php else: ?>
                              <span class="badge badge-danger"><i class="fas fa-fw fa-times"></i> Belum Dibayar</span>
                            <?php endif ?>
                          </td>
                        </tr>
                        <tr>
                          <th colspan="5">
                            Kembalian (Rp.)        
                          </th>
                          <td class="text-right font-weight-bold">
                            <?php if ($pembayaran != null): ?>
                              <span>Rp. <?= number_format($pembayaran['kembalian']); ?></span>
                            <?php else: ?>
                              <span class="badge badge-danger"><i class="fas fa-fw fa-times"></i> Belum Dibayar</span>
                            <?php endif ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php elseif(isset($error)): ?>
        <div class="container">
          <div class="row">
            <div class="col-lg text-center">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Kode Transaksi</strong> tidak sesuai atau salah! Silahkan Coba Lagi!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      <?php endif ?>
    </div>
  </div>
</section>
