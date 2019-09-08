<?php

namespace App\Repositories;

use App\Models\perolehan;
use App\Repositories\BaseRepository;

/**
 * Class perolehanRepository
 * @package App\Repositories
 * @version September 8, 2019, 12:31 pm UTC
*/

class perolehanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'aktif'
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
        return perolehan::class;
    }
}
