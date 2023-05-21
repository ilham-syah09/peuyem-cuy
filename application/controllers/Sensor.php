<?php
class Sensor extends CI_Controller
{
    public function save()
    {
        //url
        // http://localhost/monitoring_tape/sensor/save?suhu=nilai&udara=nilai&alkohol=nilai&berat=nilai


        $suhu = $this->input->get('suhu');
        $udara = $this->input->get('udara');
        $alkohol = $this->input->get('alkohol');
        $berat = $this->input->get('berat');

        $data = [
            'suhu' => $suhu,
            'udara' => $udara,
            'alkohol' => $alkohol,
            'berat' => $berat,
        ];

        if ($data) {
            $this->db->insert('tbl_sensor', $data);
            echo 'data berhasil masuk';
        } else {
            echo 'data gagal masuk';
        }
    }
}
