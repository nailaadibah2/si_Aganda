<?php

namespace Master;

use Config\Query_builder;

class staf
{
    private $db;

    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }

    public function index()
    {
        $data = $this->db->table('staf')->get()->resultArray();
        $res = ' <a href="?target=staf&act=tambah_staf" class="btn btn-info btn-sm">Tambah staf</a>
    <br><br>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>agenda</th>
                    <th>Tempat</th>
                    <th>Pekerjaan</th>
                    <th>Jk</th>
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
                    <td width="300">' . $r['pekerjaan'] . '</td>
                    <td width="300">' . $r['jk'] . '</td>
                    <td width="150">
                        <a href="?target=staf&act=edit_staf&id=' . $r['tgl'] . '" class="btn btn-success btn-sm">
                            Edit
                        </a>
                        <a href="?target=staf&act=delete_staf&id=' . $r['tgl'] . '" class="btn btn-danger btn-sm">
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
        $res = '<a href="?target=staf" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=staf&act=simpan_staf" method="post">
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
                    <label for="pekerjaan" class="form-label">pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                    </div>
                    <div class="mb-3">
                        <label for="JK" class="form-label">JK</label>
                        <br>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="jk" id="jk1" value="1">
                            <label for="jk1" class="form-check-label">
                                L
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="jk" id="jk0" value="0">
                            <label for="jk0" class="form-check-label">
                                P
                            </label>
                        </div>
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
        $pekerjaan = $_POST['pekerjaan'];
        $jk = $_POST['jk'];

        $data = array(
            'tgl' => $tgl,
            'agenda' => $agenda,
            'tempat' => $tempat,
            'pekerjaan' => $pekerjaan,
            'jk' => $jk
        );
        return $this->db->table('staf')->insert($data);
    }

    public function edit($id)
    {
        $r = $this->db->table('staf')->where("tgl='$id'")->get()->rowArray();

        $res = '<a href="?target=staf" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form action="?target=staf&act=update_staf" method="post">
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
                        <label for="pekerjaan" class="form-label">pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="' . $r['pekerjaan'] . '">
                            </label>
                    </div>
                    <div class="mb-3">
                        <label for="JK" class="form-label">JK</label>
                        <br>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="jk" id="jk1" value="1" ' . $this->cekRadio($r['jk'], 1) . '>
                            <label for="jk1" class="form-check-label">
                                L
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input type="radio" class="form-check-input" name="jk" id="jk0" value="0" ' . $this->cekRadio($r['jk'], 0) . '>
                            <label for="jk0" class="form-check-label">
                                P
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
        $pekerjaan = $_POST['pekerjaan'];
        $jk = $_POST['jk'];

        $data = array(
            'tgl' => $tgl,
            'agenda' => $agenda,
            'tempat' => $tempat,
            'pekerjaan' => $pekerjaan,
            'jk' => $jk
        );

        return $this->db->table('staf')->where("tgl='$param'")->update($data);
    }

    public function delete($id)
    {

        return $this->db->table('staf')->where("tgl='$id'")->delete();
    }

}

