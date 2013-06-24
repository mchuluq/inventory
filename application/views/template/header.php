<ul id="k-menu">
	<li><a href="<?=base_url('dashboard')?>">Dashboard</a></li>
	<li>Menu Utama
		<ul>
			<li>Barang
				<ul>
					<li><a href="<?=base_url('barang')?>">Data Barang</a></li>
					<li><a href="<?=base_url('barang/create')?>">Tambah Barang</a></li>
					<li><a href="<?=base_url('barang_masuk')?>">Data Barang Masuk</a></li>
					<li><a href="<?=base_url('barang_keluar')?>">Data Barang Keluar</a></li>
					<li><a href="<?=base_url('aktifitas')?>">Aktifitas Barang</a></li>
				</ul>			
			</li>
			<li>Jenis Barang
			<ul>
				<li><a href="<?=base_url('jenis_barang')?>">Data Jenis Barang</a></li>
				<li><a href="<?=base_url('jenis_barang/create')?>">Tambah Jenis Barang</a></li>
			</ul>
			</li>
			<li>Suplier
				<ul>
					<li><a href="<?=base_url('suplier')?>">Data Suplier</a></li>
					<li><a href="<?=base_url('suplier/create')?>">Tambah Suplier</a></li>
				</ul>
			</li>
			<li><a href="<?=base_url('users')?>">User Control</a></li>
			<li><a href="<?=base_url('config')?>">Konfigurasi Sistem</a></li>
		</ul>	
	</li>
	<li>Laporan
		<ul>
			<li><a href="<?=base_url('laporan')?>">Path Laporan</a></li>
			<li><a href="<?=base_url('laporan/create')?>">Buat Laporan</a></li>
		</ul>
	</li>
	<li>Bantuan</a>
		<ul>
			<li><a href="<?=base_url('tentang')?>">Tentang</a></li>
			<li><a href="<?=base_url('tentang/credits')?>">Credits</a></li>
		</ul>
	</li>	
</ul>
