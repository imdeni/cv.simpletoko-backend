function showContent(contentId) {
    // Menyembunyikan semua konten
    document.getElementById('homeContent').style.display = 'none';
    document.getElementById('userContent').style.display = 'none';
    document.getElementById('supplierContent').style.display = 'none';
    document.getElementById('pelangganContent').style.display = 'none';
    document.getElementById('persediaanContent').style.display = 'none';
    document.getElementById('penjualanContent').style.display = 'none';
    document.getElementById('laporanpersediaanContent').style.display = 'none';
    document.getElementById('laporanpenjualanContent').style.display = 'none';
    document.getElementById('logContent').style.display = 'none';
    document.getElementById('panduanContent').style.display = 'none';
    
    
    // Menampilkan konten yang sesuai dengan ID yang dipilih
    document.getElementById(contentId + 'Content').style.display = 'block';
  }

  $( function() {
    $( "#date" ).datepicker();
  } );
  