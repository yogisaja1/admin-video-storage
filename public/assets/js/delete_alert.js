// Untuk komfirmasi delete data
function hapusData(id, identifier) {
  console.log(id);
  if (confirm("Apakah anda yakin akan menghapus data ini?")) {
    switch (identifier) {
      case 1:
        window.location.href = "category/delete/" + id;
        break;
      case 2:
        window.location.href = "video/delete/" + id;
        break;
      case 3:
        window.location.href = "admin/delete/" + id;
        break;
    }
  }
}
