<?php
//panggil koneksi ke database
include('hub.php');
//panggil header
include('header.php');
//panggil nav menu
include('navmenu.php');

$nm_kelas = 'TES';
$nama_guru = 'Arif';
$query = mysqli_query($connect, "SELECT * FROM kelas WHERE nm_kelas='$nm_kelas' ORDER BY nm_kelas ASC") or die(mysqli_error());
$data = mysqli_fetch_array($query);
//merubah waktu kedalam format indonesia
$hari = array ("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$bln = array ("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
?>     
	 <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <p class="fs-4 text-center text-black-50 m-0 fw-bold">Absen Kelas <?php echo $nm_kelas;?></p>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">Valerie Luna</span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-center text-black-50 m-0 fw-bold"><?php echo "".$hari[date("w")].", ".date("j")." ".$bln[date("n")]." ".date("Y");""; ?></p>
                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable" style="text-align: center;"><label class="form-label fw-bold text-center">Piket / Mapel&nbsp;
							<form action="ps.php" method="post" id="form-absen" name="rows">
                              <input type="hidden" value="<?php echo $nama_guru;?>" name="nm_guru"/>
                               <input type="hidden" value="<?php echo $nm_kelas;?>" name="nm_kelas"/>
							<select name="nm_mapel" class="d-inline-block form-select form-select-sm" style="height: 33px;width: auto;font-size: 15px;border-width: 2px;">
                                        <option value="Piket" >Piket</option>
                                    </select>&nbsp;</label></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-bordered my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th class="table-primary text-uppercase text-center">Foto</th>
                                            <th class="table-primary text-uppercase text-center">Nama</th>
                                            <th class="table-primary text-uppercase text-center">NIS</th>
                                            <th class="table-primary text-uppercase text-center">Ket</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									//penting nech buat kasih nilai awal cekbox
									$no=0;
									$query=mysqli_query($connect, "SELECT * FROM siswa WHERE nm_kelas='$nm_kelas' ORDER BY nis ASC");
									while($data=mysqli_fetch_assoc($query)){
									?>
                                        <tr>
                                            <td class="text-center"><img class="rounded-circle me-2" width="30" height="30" src="assets/img/avatars/avatar1.jpeg"></td>
											
                                            <td><?php echo $data['nama'];?>
											<input type="hidden" value="<?php echo $data['nama'];?>" name="nm_siswa[]"/></td>											
                                            <td><?php echo $data['nis'];?>
											<input type="hidden" value="<?php echo $data['nis'];?>" name="nis[]"/></td>
                                            <td class="text-center">
                                                <div class="form-check form-check-inline text-center"><input class="form-check-input" type="radio" id="formCheck-1" name="ket[<?php echo $data['nis'];?>]" value="H" checked=""><label class="form-check-label" for="formCheck-1">Hadir</label></div>
                                                <div class="form-check form-check-inline text-center"><input class="form-check-input" type="radio" id="formCheck-3" name="ket[<?php echo $data['nis'];?>]" value="I"><label class="form-check-label" for="formCheck-3">Izin</label></div>
                                                <div class="form-check form-check-inline text-center"><input class="form-check-input" type="radio" id="formCheck-2" name="ket[<?php echo $data['nis'];?>]" value="S"><label class="form-check-label" for="formCheck-2">Sakit</label></div>
                                                <div class="form-check form-check-inline text-center"><input class="form-check-input" type="radio" id="formCheck-4" name="ket[<?php echo $data['nis'];?>]" value="A"><label class="form-check-label text-center" for="formCheck-4">Alfa</label></div>
                                            </td>
                                        </tr>
									<?php }?>
                                    </tbody>
                                </table>
                            </div><button class="btn btn-primary border rounded" type="submit" style="width: 136px;" value="simpan">Submit Absen</button>
							</form>
                        </div>
                    </div>
                </div>
            </div>
<?php include('footer.php'); ?>