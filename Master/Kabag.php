<?php

namespace Master;

use Config\Query_builder;

class kabag
{
    private $db;

    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }

    public function index()
    {
        $data = $this->db->table('kabag')->get()->resultArray();
        $res = ' <a href="?target=kabag&act=tambah_kabag" class="btn btn-info btn-sm">Tambah kabag</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>agenda</th>
                    <th>Tempat</th>
                    <th>Status</th>
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
                    <td width="300">' . $r['status'] . '</td>
                    <td width="150">
                        <a href="?target=kabag&act=edit_kabag&id=' . $r['tgl'] . '" class="btn btn-success btn-sm">
                            Edit
                        </a>
                        <a href="?target=kabag&act=delete_kabag&id=' . $r['tgl'] . '" class="btn btn-danger btn-sm">
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
        $res = '<a href="?target=kabag" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=kabag&act=simpan_kabag" method="post">
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
                    <div class="mb-3">
                    <label for="status" class="form-label">status</label>
                    <input type="text" class="form-control" id="status" name="status">
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
        $status = $_POST['status'];

        $data = array(
            'tgl' => $tgl,
            'agenda' => $agenda,
            'tempat' => $tempat,
            'status' => $status
        );
        return $this->db->table('kabag')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('kabag')->where("tgl='$id'")->get()->rowArray();

        $res = '<a href="?target=kabag" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=kabag&act=update_kabag" method="post">
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
                    <div class="mb-3">
                        <label for="status" class="form-label">status</label>
                        <input type="text" class="form-control" id="status" name="status" value="' . $r['status'] . '">
                            </label>
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
        $status = $_POST['status'];

        $data = array(
            'tgl' => $tgl,
            'agenda' => $agenda,
            'tempat' => $tempat,
            'status' => $status
        );

        return $this->db->table('kabag')->where("tgl='$param'")->update($data);
    }

    public function delete($id)
    {

        return $this->db->table('kabag')->where("tgl='$id'")->delete();
    }

}

