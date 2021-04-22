<?php

/******************************************
PRAKTIKUM RPL
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

if(isset($_POST['submit'])){

	$otask->addTask($_POST);

	header("location: index.php");
}

// Memanggil method getTask di kelas Task
$otask->getTask();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $tkode, $tjudul, $tname, $tthn, $tgenre, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($tstatus == "Kosong"){
		$data .= "<tr>
		<th scope='row'>" . $no . "</th>
		<td>" . $tkode . "</td>
		<td>" . $tjudul . "</td>
		<td>" . $tname . "</td>
		<td>" . $tthn . "</td>
		<td>" . $tgenre . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_ada=" . $id .  "' style='color: white; font-weight: bold;'>Tersedia</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$data .= "<tr>
		<th scope='row'>" . $no . "</th>
		<td>" . $tkode . "</td>
		<td>" . $tjudul . "</td>
		<td>" . $tname . "</td>
		<td>" . $tthn . "</td>
		<td>" . $tgenre . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-warning' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Kosong</a></button>
		</td>
		</tr>";
		$no++;
	}
}

if(isset($_GET['id_hapus'])){

	$otask->delTask($_GET);

	header("location: index.php");
}

if(isset($_GET['id_status'])){

	$otask->updTask($_GET);

	header("location: index.php");
}

if(isset($_GET['id_ada'])){

	$otask->upd2Task($_GET);

	header("location: index.php");
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/table.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();