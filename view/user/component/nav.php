<div class="container">
    <header>
        <div class="logo">
            <img src="../../icon/logo.png" width="100px" height="50px">
        </div>
        <nav>
            <ul>
                <li id="homeBtn" class="btnhover" onclick="openHome()">Home</li>
                <div class="dropdown">
                    <li><a class="dropbtn">Master Data</a></li>
                    <div class="dropdown-content">
                        <li id="userBtn" class="mnu" onclick="openDataUser()">Data User</li>
                        <li id="pelangganBtn" class="mnu" onclick="openDataPelanggan()">Data Pelanggan</li>
                        <li id="supplierBtn" class="mnu" onclick="openDataSupplier()">Data Supplier</li>
                    </div>
                </div>
                <li id="persediaanBtn"class="btnhover"  onclick="openPersediaan()">Persediaan</li>
                <li id="penjualanBtn"class="btnhover"  onclick="openPenjualan()">Penjualan</li>
                <div class="dropdown">
                    <li><a class="dropbtn">Laporan</a></li>
                    <div class="dropdown-content">
                        <li class="mnu" id="laporanpersediaanBtn" onclick="openLaporanPersediaan()">Persediaan
                        </li>
                        <li class="mnu" id="laporanpenjualanBtn" onclick="openLaporanPenjualan()">Penjualan
                        </li>
                    </div>
                </div>
                <div class="dropdown">
                    <li><a class="dropbtn">Pengaturan</a></li>
                    <div class="dropdown-content">
                        <li class="mnu" id="logBtn" onclick="showContent('log')">Log Aktivitas!</li>
                        <li class="mnu" id="panduanBtn" onclick="showContent('panduan')">Panduan?</li>
                    </div>
                </div>

                <li id="logoutButton" class="btnhover">logout</li>
            </ul>
        </nav>
        <div class="profil">
            <li><a href="#"><img src="../../icon/user.png" width="35px" height="35px"></a></li>
        </div>
    </header>
</div>

<script>
    document.getElementById("logoutButton").addEventListener("click", function () {
        if (confirm("Are you sure you want to logout?")) {
            // Send AJAX request to logout.php
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Redirect to login page after logout
                    window.location.href = "../../Setting/logoutSet.php";
                }
            };
            xhttp.open("GET", "../../Setting/logoutSet.php", true);
            xhttp.send();
        }
    });
    
    function openHome() {
        window.location.href = "home.php";
    };
    function openDataUser() {
        window.location.href = "datauser.php";
    };
    function openDataPelanggan() {
        window.location.href = "datapelanggan.php";
    };
    function openDataSupplier() {
        window.location.href = "datasupplier.php";
    }; 
    function openPersediaan() {
        window.location.href = "datapersediaan.php";
    }; 
    function openPenjualan() {
        window.location.href = "penjualan.php";
    };
    function openLaporanPersediaan() {
        window.location.href = "laporanpersediaan.php";
    };
    function openLaporanPenjualan() {
        window.location.href = "laporanpenjualan.php";
    };
</script>