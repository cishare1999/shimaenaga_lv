<?php

use Illuminate\Database\Seeder;

class EximagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eximages')->insert([
            [
            'id' => 1,
            'eximage_name' => '2Jq6w7uduTfCnvwEMUSsFu1RBscxiKNobCzvihF8.png',
            ],
            [
            'id' => 2,
            'eximage_name' => 'IcGBph1q57NXXB8jwquEqruSHJza3tkioEZlrxUR.png',
            ],
            [
            'id' => 4,
            'eximage_name' => 'iRXRsroEQHV5lxWAMyQ7luejHuTaqOvcqoMVRe5d.png',
            ],
            [
            'id' => 5,
            'eximage_name' => 'uDDeanEHQPnvczEUOXkHes8zRdFcAXmgeHrvqrVK.png',
            ],
            [
            'id' => 6,
            'eximage_name' => '8ZZMMw89KUPGtW8VZIqQMtxFaJ00uNyjQTrRBp3s.png',
            ],
            [
            'id' => 7,
            'eximage_name' => 'kffkyQBtczoQCaDxfNRy6KWCuw7IrFIdh563byUb.jpeg',
            ],
            [
            'id' => 8,
            'eximage_name' => 'lr87A8AR5wc3rtSHImtyXTNHZZ2D3iXI3QeGGfVO.png',
            ],
            [
            'id' => 9,
            'eximage_name' => '9qXk52OW1GXteUtIgtDjMXinW3RMVPavu7iXvxup.jpeg',
            ],
        ]);

    }
}
