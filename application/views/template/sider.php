<div class="user_app">
	<img style="width:50px;height:50px" src="<?=base_url('storage/profile/'.$this->session->userdata('user_photo'))?>"/>
	<span class="user_name">
	<?=$this->session->userdata('group_name')?><br/>
	<strong><?=$this->session->userdata('user_name')?></strong><br/>
	<a href="<?=base_url('profile')?>">profile</a> | <a onclick="return confirm('apa anda yakin untuk keluar ?')" href="<?=base_url('front/sign_out')?>">sign out</a>
	</span>
</div>
<ul id="k-panel">
	<li>Barang
		<ul>
			<li><a href="<?=base_url('barang')?>">Data Barang</a></li>
			<li><a href="<?=base_url('barang/create')?>">Tambah Barang</a></li>
			<li><a href="<?=base_url('barang_masuk')?>">Data Barang Masuk</a></li>
			<li><a href="<?=base_url('barang_keluar')?>">Data Barang Keluar</a></li>
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
	<li>Profile
		<ul>
			<li><a href="<?=base_url('profile')?>">Profile</a></li>
			<li><a onclick="return confirm('apa anda yakin untuk keluar ?')" href="<?=base_url('front/sign_out')?>">Sign Out</a></li>
		</ul>
	</li>
</ul>
