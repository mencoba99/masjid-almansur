<body>
		<div class="row">
			<br>
			<label><a href="?page=gallery-km&action=tambah-gallery-km" class="btn-floating btn-medium waves-effect waves-light blue darken-1"><i class="material-icons">add</i></a> Tambah Data</label>
			<div class="divider"></div>
			<table class="responsive-table striped highlight">
				<h5 class="center"><b>Data Gallery Kajian Mingguan</h5></b>
		        <thead class="blue darken-1">
		        	<div class="input-field col s6 right">
		        		<form action="" method="post">
							<i class="material-icons prefix">search</i>
							<input type="text" name="cari_gkm" placeholder="Cari Disini">
							<input type="submit" name="cari_skr" value="Cari" hidden="hidden">
						</form>
					</div>
		          <tr>
		              <th class="center white-text">Nomor</th>
		              <th class="center white-text">Judul Kajian</th>
		              <th class="center white-text">Gambar</th>
		              <th class="center white-text">Keterangan</th>
		              <th class="center white-text">Aksi</th>
		          </tr>
		        </thead>
		        <?php 
		        $no = 1;

		        $batas = 5;
		        $hal = @$_GET['hal'];
		        if(empty($hal)){
		        	$posisi = 0;
		        	$hal	= 1;
		        } else {
		        	$posisi = ($hal - 1) * $batas;
		        }
		        $cari_gkm = @$_POST['cari_gkm'];
				$cari_skr = @$_POST['cari_skr'];
				if($cari_skr){
					if($cari_gkm != "") {
		        $sql = mysqli_query($db, "SELECT * FROM gallery_km INNER JOIN kajian_mingguan on gallery_km.id_km=kajian_mingguan.id_km WHERE judul_kajian like '%$cari_gkm%' or gid_km like '%$cari_gkm%' or keterangan_km like '%$cari_gkm%'") or die ($db->error);
		        } else {
						$sql = mysqli_query($db, "SELECT * FROM gallery_km INNER JOIN kajian_mingguan on gallery_km.id_km=kajian_mingguan.id_km LIMIT $posisi, $batas") or die ($db->error);
					}
				} else {
						$sql = mysqli_query($db, "SELECT * FROM gallery_km INNER JOIN kajian_mingguan on gallery_km.id_km=kajian_mingguan.id_km LIMIT $posisi, $batas") or die ($db->error);
				}

				$no = $posisi + 1;
				$cek = mysqli_num_rows($sql);
				if($cek < 1) {
					?>
					<tr>
						<td colspan="7" class="center" style="padding: 10px;">Data Tidak di Temukan</td>
					</tr>
					<?php
				} else {
					while($data = mysqli_fetch_array($sql)) {
				?>
		        <tbody>
		          <tr>
		            <td class="center"><?php echo $no++; ?></td>
		            <td class="center"><?php echo $data['judul_kajian']; ?></td>
		            <td class="center"><img src="../img/k_mingguan/<?php echo $data['gambar_km']; ?>" width="120px" class="materialboxed"></td>
		            <td><?php echo $data['keterangan_km']; ?></td>
		            <td class="center" width="15%">
		            	<a onclick="return confirm('Ingin Menghapus Data Ini?')" href="?page=gallery-km&action=hapus-gallery-km&gid_km=<?php echo $data['gid_km']; ?>" class="btn-floating btn-small waves-effect waves-light red darken-1"><i class="material-icons">delete</i></a> </td>
		          </tr>
		          <?php 
		      		}
		  			}
		       		?>
		       </tbody>
		    </table>
		    <div class="row" style="margin-top: 10px; margin-left: 20px; float: left;">
		    	<?php 
		    		$jumlah = mysqli_num_rows(mysqli_query($db, "SELECT * FROM gallery_km"));
		    		echo "<u>Jumlah Data : <b>".$jumlah."</b></u>";
		    	 ?>
		    </div>

		    <ul class="row pagination" style="margin-top: 10px; margin-right: 20px; float: right;">
		    	<?php 
		    		$jumlah_hal = ceil($jumlah / $batas);
		    		for ($i=1; $i <= $jumlah_hal; $i++){
		    			if($i != $hal){
		    				echo "<a href='?page=gallery-km&hal=$i'><button class='btn blue lighten-1 btn-small'>$i</button></a>";
		    			} else {
		    				echo "<button class='btn grey darken-1 btn-small'>$i</button></a>";
		    			}
		    		}
		    	 ?>
		    </ul>
	  </div>
</body>