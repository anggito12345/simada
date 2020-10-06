<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateorganisasiAPIRequest;
use App\Http\Requests\API\UpdateorganisasiAPIRequest;
use App\Models\organisasi;
use App\Repositories\organisasiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use c;
use Constant;
use Auth;

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
        $this->middleware('auth:api');
        $this->organisasiRepository = $organisasiRepo;
    }

    /**
     * public API USAGE
     */

     public function get(Request $request) {

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

        if ($request->has('pid') && !c::is('',[],[Constant::$GROUP_BPKAD_ORG, Constant::$GROUP_SEKDA, Constant::$GROUP_GUBERNUR])) {


            if ($request->input('pid') == "") {
                return $this->sendResponse([], 'Organisasis retrieved successfully');
            } else {
                $querys = $querys->whereRaw('pid = '.$request->get('pid'));
            }

            if (!c::is('',[],[Constant::$GROUP_BPKAD_ORG])) {

                $organisasiUser = \App\Models\organisasi::find(Auth::user()->pid_organisasi);
                if ($organisasiUser == null) {
                    $organisasiUser = new \App\Models\organisasi();
                }

                if (c::is('',[],[Constant::$GROUP_CABANGOPD_ORG])) {
                    $querys = $querys->whereRaw('id = '.$organisasiUser->pid);
                }

                if (c::is('',[],[Constant::$GROUP_OPD_ORG])) {
                    $querys = $querys
                        ->whereRaw('m_organisasi.id = '.$organisasiUser->id.' OR m_organisasi.pid = '.$organisasiUser->id)
                        ->whereRaw('(m_organisasi.level = \''. $request->input('level') . '\' OR m_organisasi.jabatans = \''. $request->input('level').'\')');
                }

            }



        } else {
            $organisasiUser = \App\Models\organisasi::find(Auth::user()->pid_organisasi);
            if (!empty($organisasiUser)) {
                $querys = $querys->whereRaw('m_organisasi.level >= '.$organisasiUser->level);
            }
        }

        if ($request->has('level')) {
            $querys = $querys->whereRaw('(m_organisasi.level = \''. $request->input('level') . '\' OR m_organisasi.jabatans = \''. $request->input('level').'\')');
        }

        if ($request->has('q')) {
            $querys = $querys->whereRaw("m_organisasi.nama ~* '".$request->input('q')."'");
        }


        if ($request->has('term')) {
            $querys = $querys->whereRaw("m_organisasi.nama ~* '".$request->input('term')."'");
        }

        $organisasis = $querys
            ->get();


        return $this->sendResponse($organisasis->toArray(), 'Organisasis retrieved successfully');
    }

    /**
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
