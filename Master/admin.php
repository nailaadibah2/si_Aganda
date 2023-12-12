<?php

namespace Master;

use Config\Query_builder;

class Admin
{
    private $db;

    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }

    public function index()
    {
        $data = $this->db->table('admin')->get()->resultArray();
        $res = ' <a href="?target=admin&act=tambah_admin" class="btn btn-info btn-sm">Tambah admin</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Agenda</th>
                    <th>Tempat</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                    <td width="10">' . $no . '</td>
                    <td width="300">' . $r['tgl'] . '</td>
                    <td>' . $r['agenda'] . '</td>
                    <td width="300">' . $r['tempat'] . '</td>
                    <td width="150">
                        <a href="?target=admin&act=edit_admin&id=' . $r['tgl'] . '" class="btn btn-success btn-sm">
                            Edit
                        </a>
                        <a href="?target=admin&act=delete_admin&id=' . $r['tgl'] . '" class="btn btn-danger btn-sm">
                            Hapus
                        </a>
                    </td>
                </tr>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }

    public function tambah()
    {
        $res = '<a href="?target=admin" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=admin&act=simpan_admin" method="post">
                    <div class="mb-3">
                        <label for="tgl" class="form-label">tgl</label>
                        <input type="date" class="form-control" id="tgl" name="tgl">
                    </div>
                    <div class="mb-3">
                        <label for="agenda" class="form-label">agenda</label>
                        <input type="text" class="form-control" id="agenda" name="agenda">
                    </div>
                    <div class="mb-3">
                        <label for="tempat" class="form-label">tempat</label>
                        <input type="text" class="form-control" id="tempat" name="tempat">
                    </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>';
        return $res;
    }

    public function simpan()
    {
        $tgl = $_POST['tgl'];
        $agenda = $_POST['agenda'];
        $tempat = $_POST['tempat'];

        $data = array(
            'tgl' => $tgl,
            'agenda' => $agenda,
            'tempat' => $tempat
        );
        return $this->db->table('admin')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('admin')->where("tgl='$id'")->get()->rowArray();

        $res = '<a href="?target=admin" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=admin&act=update_admin" method="post">
                <input type="hidden" class="form-control" id="param" name="param" value="' . $r['tgl'] . '">
                    <div class="mb-3">
                        <label for="tgl" class="form-label">tgl</label>
                        <input type="date" class="form-control" id="tgl" name="tgl" value="' . $r['tgl'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="agenda" class="form-label">agenda</label>
                        <input type="text" class="form-control" id="agenda" name="agenda" value="' . $r['agenda'] . '">
                    </div>
                    <div class="mb-3">
                        <label for="tempat" class="form-label">tempat</label>
                        <input type="text" class="form-control" id="tempat" name="tempat" value="' . $r['tempat'] . '">
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>';
        return $res;
    }

    public function cekRadio($val1, $val2)
    {
        if ($val1 == $val2) {
            return "checked";
        }
        return "";
    }

    public function update()
    {
        $param = $_POST['param'];
        $tgl = $_POST['tgl'];
        $agenda = $_POST['agenda'];
        $tempat = $_POST['tempat'];

        $data = array(
            'tgl' => $tgl,
            'agenda' => $agenda,
            'tempat' => $tempat
        );

        return $this->db->table('admin')->where("tgl='$param'")->update($data);
    }

    public function delete($id)
    {

        return $this->db->table('agenda')->where("tgl='$id'")->delete();
    }

}
