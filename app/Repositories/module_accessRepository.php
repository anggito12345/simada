<?php

namespace App\Repositories;

use App\Models\module_access;
use App\Repositories\BaseRepository;

/**
 * Class module_accessRepository
 * @package App\Repositories
 * @version November 13, 2019, 2:12 pm UTC
*/

class module_accessRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',        
        'kode_module',
        'pid_jabatan'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return module_access::class;
    }

     /**
     * Bulk save when jabatan is stored
     */
    public function bulkSaveJabatan($access, $pid_jabatan) {
        \App\Models\module_access::where([
            'pid_jabatan' => $pid_jabatan,
        ])->delete();
        foreach($access as $key => $acc) {
            foreach($acc as $keyAcc => $valueAcc) {
                $this->create([
                    'nama' => $key,
                    'kode_module' => $valueAcc, 
                    'pid_jabatan' => $pid_jabatan
                ]);
            }
            
        }

    }
}
