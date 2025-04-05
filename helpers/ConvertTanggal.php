<?php

namespace app\helpers;


use Yii;
use yii\base\Component;

class ConvertTanggal extends Component
{
    public function ConvertTanggal($tanggal)
    { {
            $bulan = array(
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );

            $hari = array(
                1 => 'Senin',
                2 => 'Selasa',
                3 => 'Rabu',
                4 => 'Kamis',
                5 => 'Jumat',
                6 => 'Sabtu',
                7 => 'Minggu'
            );

            $pecahkan = explode('-', $tanggal);

            return $hari[(int)$pecahkan[0]] . ', ' . $pecahkan[3] . ' ' . $bulan[(int)$pecahkan[2]] . ' ' . $pecahkan[1];
        }
    }
}
