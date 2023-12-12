<?php

use Master\admin;
use Master\Menu;
use Master\Kabag;
use Master\Staf;

include('autoload.php');
include('Config/Database.php');

$menu = new Menu();
$admin = new admin($dataKoneksi);
$kabag = new kabag($dataKoneksi);
$staf = new staf($dataKoneksi);
//$admin ->tambah()
$target = @$_GET['target'];
$act = @$_GET['act']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Web</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">admin</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MyMenu" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="MyMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        foreach ($menu->topMenu() as $r) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo $r['link']; ?>" class="nav-link">
                                    <?php echo $r['text']; ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="content">
            <h5>Content <?php echo strtoupper($target); ?></h5>

            <?php
            if (!isset($target) or $target == "home") {
                echo "Hai, Selamat Datang di Beranda";
                //====start content admin====
            } elseif ($target == "admin") {
                if ($act == "tambah_admin") {
                    echo $admin->tambah();
                } elseif ($act == "simpan_admin") {
                    if ($admin->simpan()) {
                        echo "<script>
                        alert ('Data Tersimpan')
                        window.location.href = '?target=admin'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Tersimpan')
                        window.location.href = '?target=admin'
                        </script>";
                    }
                } elseif ($act == "edit_admin") {
                    $id = $_GET['id'];
                    echo $admin->edit($id);
                } elseif ($act == "update_admin") {
                    if ($admin->update()) {
                        echo "<script>
                        alert ('Data Diupdate')
                        window.location.href = '?target=admin'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Diupdate')
                        window.location.href = '?target=admin'
                        </script>";
                    } 
                } elseif ($act == "delete_admin") {
                    $id = $_GET['id'];
                    if ($admin->delete($id)) {
                        echo "<script>
                        alert ('Data Dihapus')
                        window.location.href = '?target=admin'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Dihapus')
                        window.location.href = '?target=admin'
                        </script>";
                    }
                } else {
                    echo $admin->index();
                }
                //====And Content admin====
            }
            //====start content kabag====
             elseif ($target == "kabag") {
            if ($act == "tambah_kabag") {
                echo $kabag->tambah();
            } elseif ($act == "simpan_kabag") {
                if ($kabag->simpan()) {
                    echo "<script>
                    alert ('Data Tersimpan')
                    window.location.href = '?target=kabag'
                    </script>";
                } else {
                    echo "<script>
                    alert ('Data Gagal Tersimpan')
                    window.location.href = '?target=kabag'
                    </script>";
                }
            } elseif ($act == "edit_kabag") {
                $id = $_GET['id'];
                echo $kabag->edit($id);
            } elseif ($act == "update_kabag") {
                if ($kabag->update()) {
                    echo "<script>
                    alert ('Data Diupdate')
                    window.location.href = '?target=kabag'
                    </script>";
                } else {
                    echo "<script>
                    alert ('Data Gagal Diupdate')
                    window.location.href = '?target=kabag'
                    </script>";
                } 
            } elseif ($act == "delete_kabag") {
                $id = $_GET['id'];
                if ($kabag->delete($id)) {
                    echo "<script>
                    alert ('Data Dihapus')
                    window.location.href = '?target=kabag'
                    </script>";
                } else {
                    echo "<script>
                    alert ('Data Gagal Dihapus')
                    window.location.href = '?target=kabag'
                    </script>";
                }
            } else {
                echo $kabag->index();
            }
            //====And Content kabag====
        
        }
        //====start content staf====
        elseif ($target == "staf") {
            if ($act == "tambah_staf") {
                echo $staf->tambah();
            } elseif ($act == "simpan_staf") {
                if ($staf->simpan()) {
                    echo "<script>
                    alert ('Data Tersimpan')
                    window.location.href = '?target=staf'
                    </script>";
                } else {
                    echo "<script>
                    alert ('Data Gagal Tersimpan')
                    window.location.href = '?target=staf'
                    </script>";
                }
            } elseif ($act == "edit_staf") {
                $id = $_GET['id'];
                echo $staf->edit($id);
            } elseif ($act == "update_staf") {
                if ($staf->update()) {
                    echo "<script>
                    alert ('Data Diupdate')
                    window.location.href = '?target=staf'
                    </script>";
                } else {
                    echo "<script>
                    alert ('Data Gagal Diupdate')
                    window.location.href = '?target=staf'
                    </script>";
                } 
            } elseif ($act == "delete_staf") {
                $id = $_GET['id'];
                if ($staf->delete($id)) {
                    echo "<script>
                    alert ('Data Dihapus')
                    window.location.href = '?target=staf'
                    </script>";
                } else {
                    echo "<script>
                    alert ('Data Gagal Dihapus')
                    window.location.href = '?target=staf'
                    </script>";
                }
            } else {
                echo $staf->index();
            }
            //====And Content staf====
        } elseif ($target == "kabag") {
            echo "Ini adalah content kabag";
        } elseif ($target == "staf") {
            echo "Ini adalah content staf";
        }
            ?>
        </div>
    </div>
</body>

</html>