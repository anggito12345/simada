<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateorganisasiAPIRequest;
use App\Http\Requests\API\UpdateorganisasiAPIRequest;
use App\Models\organisasi;
use App\Repositories\organisasiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class organisasiController
 * @package App\Http\Controllers\API
 */

class organisasiAPIController extends AppBaseController
{
    /** @var  organisasiRepository */
    private $organisasiRepository;

    public function __construct(organisasiRepository $organisasiRepo)
    {
        $this->organisasiRepository = $organisasiRepo;
    }

    /**
     * Display a listing of the organisasi.
     * GET|HEAD /organisasis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $querys = \App\Models\organisasi::select([
            'm_organisasi.nama as text',
            'm_organisasi.id',      
            'm_organisasi.jabatans',      
            'm_organisasi.kode',
        ]);
        // ->join('m_jenis_opd', 'm_jenis_opd.id', 'm_organisasi.jenis')
        
        if ($request->has('pid')) {
            if ($request->input('pid') == "") {
                return $this->sendResponse([], 'Organisasis retrieved successfully');
            }
            $querys = $querys->where('m_organisasi.pid', $request->input('pid'));
        }

        if ($request->has('level')) {
            $querys = $querys->where('m_organisasi.jabatans', $request->input('level'));
        }

        if ($request->has('q')) {
            $querys = $querys->whereRaw("m_organisasi.nama ~* '".$request->input('q')."'");
        }

        $organisasis = $querys 
        ->get();


        return $this->sendResponse($organisasis->toArray(), 'Organisasis retrieved successfully');
    }/**
     * Display a listing of the organisasi.
     * GET|HEAD /organisasis
     *
     * @param Request $request
     * @return Response
     */
    public function settings(Request $request)
    {
        $querys = \App\Models\organisasi::select([
            'm_organisasi.nama as text',
            'm_organisasi.id',      
            'm_organisasi.jabatans',      
            'm_organisasi.kode',
        ]);
        // ->join('m_jenis_opd', 'm_jenis_opd.id', 'm_organisasi.jenis')
        
        if ($request->has('pid')) {
            if ($request->input('pid') == "") {
                return $this->sendResponse([], 'Organisasis retrieved successfully');
            }
            $querys = $querys->where('m_organisasi.pid', $request->input('pid'));
        }

        if ($request->has('level')) {
            $querys = $querys->where('m_organisasi.level', $request->input('level'));
        }

        if ($request->has('q')) {
            $querys = $querys->whereRaw("m_organisasi.nama ~* '".$request->input('q')."'");
        }

        $organisasis = $querys 
        ->get();


        return $this->sendResponse($organisasis->toArray(), 'Organisasis retrieved successfully');
    }

    /**
     * Store a newly created organisasi in storage.
     * POST /organisasis
     *
     * @param CreateorganisasiAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateorganisasiAPIRequest $request)
    {
        $input = $request->all();

        $organisasi = $this->organisasiRepository->create($input);

        return $this->sendResponse($organisasi->toArray(), 'Organisasi saved successfully');
    }

    /**
     * Display the specified organisasi.
     * GET|HEAD /organisasis/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var organisasi $organisasi */
        $organisasi = $this->organisasiRepository->find($id);

        if (empty($organisasi)) {
            return $this->sendError('Organisasi not found');
        }

        return $this->sendResponse($organisasi->toArray(), 'Organisasi retrieved successfully');
    }

    /**
     * Update the specified organisasi in storage.
     * PUT/PATCH /organisasis/{id}
     *
     * @param int $id
     * @param UpdateorganisasiAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateorganisasiAPIRequest $request)
    {
        $input = $request->all();

        /** @var organisasi $organisasi */
        $organisasi = $this->organisasiRepository->find($id);

        if (empty($organisasi)) {
            return $this->sendError('Organisasi not found');
        }

        $organisasi = $this->organisasiRepository->update($input, $id);

        return $this->sendResponse($organisasi->toArray(), 'organisasi updated successfully');
    }

    /**
     * Remove the specified organisasi from storage.
     * DELETE /organisasis/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var organisasi $organisasi */
        $organisasi = $this->organisasiRepository->find($id);

        if (empty($organisasi)) {
            return $this->sendError('Organisasi not found');
        }

        $organisasi->delete();

        return $this->sendResponse($id, 'Organisasi deleted successfully');
    }
}
