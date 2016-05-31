<div class="panel panel-default">
  <div class="panel-heading">
	<h2 class="sub-header">Perkembangan Terakhir</h2>
  </div>
  <div class="panel-body">
	<?php
		define('MAX_REC_PER_PAGE', 10);
		
		include "include/connect.php";
		$rs = mysql_query("SELECT COUNT(*) FROM master_riwayat
								JOIN master_karyawan ON master_riwayat.id_karyawan = master_karyawan.id_karyawan") or die("Count query error!");
		list($total) = mysql_fetch_row($rs);
		$total_pages = ceil($total / MAX_REC_PER_PAGE);
		$page = intval(@$_GET["page"]);
		
		if (0 == $page){
			$page = 1;
		}
		$start = MAX_REC_PER_PAGE * ($page - 1);
		$max = MAX_REC_PER_PAGE;
		$rs = mysql_query("SELECT * FROM master_riwayat
								JOIN master_karyawan ON master_riwayat.id_karyawan = master_karyawan.id_karyawan
							ORDER BY tanggal DESC, jam DESC LIMIT $start, $max ") or die("Query error!");
	?>
	
		<h4>Total Data : <?php echo $total; ?></h4>
		<table border="1" width="95%" align="center" class="table table-hover">
			<thead>
				<td class="success" style="text-align:center;">No.</td>
				<td class="success" style="text-align:center;">Tanggal</td>
				<td class="success" style="text-align:center;">Jam</td>
				<td class="success" style="text-align:center;">Nama Karyawan</td>
				<td class="success" style="text-align:center;">ID eTicket</td>
				<td class="success" style="text-align:center;">Keterangan</td>
			</thead>
			<?php
				$no = 1;
				while ($list = mysql_fetch_assoc($rs)) {
			?>
			<tr>
				<td align="center">
					<?php echo $no;?>
				</td>
				<td align="center">
					<?php echo $list['tanggal']; ?>
				</td>
				<td align="center">
					<?php echo $list['jam']; ?>
				</td>
				<td align="center">
					<?php echo $list['nama_karyawan']?>
				</td>
				<!-- JUDUL TICKET -->
				<td align="center">
					<?php echo $list['id_eticket']?>
				</td>
				<td align="center">
					<?php echo $list['keterangan']; ?>
				</td>
			</tr>
			<?php
				$no +=1;
				}
			?>
		</table>

		<table border="0" cellpadding="5" align="center">
			<tr>
				<td>
					<h4>
					<strong>Halaman : </strong>
				<?php
					for ($i = 1; $i <= $total_pages; $i++) {
						$txt=$i;
						if ($page != $i)
							$txt = "<a href=\"" . $_SERVER["PHP_SELF"] . "?contain=view_ticket&page=$i\">$txt</a>";
				?>
					<strong><?= $txt ?></strong>
				
				<?php
					}
				?>
					</h4>
				</td>
			</tr>
		</table>
  </div>
</div>