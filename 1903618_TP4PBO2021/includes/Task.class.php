<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_buku
		$query = "SELECT * FROM tb_buku";

		// Mengeksekusi query
		return $this->execute($query);
	}
	
	function addTask($data){
		$tkode = $data['tkode'];
		$tjudul = $data['tjudul'];
		$tname = $data['tname'];
		$tthn = $data['tthn'];
		$tgenre = $data['tgenre'];
		$tstatus = "Tersedia";

		$query = "INSERT into tb_buku (kode, judul, author, tahun, genre, status) VALUES
		('$tkode', '$tjudul', '$tname', '$tthn', '$tgenre', '$tstatus')";

		return $this->execute($query); 
	}

	function delTask(){
		$id = $_GET['id_hapus'];

		$query = "DELETE from tb_buku WHERE id = $id";

		return $this->execute($query);
	}

	function updTask(){
		$id = $_GET['id_status'];

		$query = "UPDATE tb_buku SET status='Kosong' WHERE id=$id";

		return $this->execute($query);
	}

	function upd2Task(){
		$id = $_GET['id_ada'];

		$query = "UPDATE tb_buku SET status='Tersedia' WHERE id=$id";

		return $this->execute($query);
	}

}



?>
