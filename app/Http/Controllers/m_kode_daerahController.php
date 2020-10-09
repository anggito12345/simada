<?php

namespace App\Http\Controllers;

use App\DataTables\m_kode_daerahDataTable;
use App\Http\Requests;
use App\Http\Requests\Createm_kode_daerahRequest;
use App\Http\Requests\Updatem_kode_daerahRequest;
use App\Repositories\m_kode_daerahRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class m_kode_daerahController extends AppBaseController
{
    /** @var  m_kode_daerahRepository */
    private $mKodeDaerahRepository;

    public function __construct(m_kode_daerahRepository $mKodeDaerahRepo)
    {
        $this->mKodeDaerahRepository = $mKodeDaerahRepo;
    }

    /**
     * Display a listing of the m_kode_daerah.
     *
     * @param m_kode_daerahDataTable $mKodeDaerahDataTable
     * @return Response
     */
    public function index(m_kode_daerahDataTable $mKodeDaerahDataTable)
    {
        return $mKodeDaerahDataTable->render('m_kode_daerahs.index');
    }

    /**
     * Show the form for creating a new m_kode_daerah.
     *
     * @return Response
     */
    public function create()
    {
        return view('m_kode_daerahs.create');
    }

    /**
     * Store a newly created m_kode_daerah in storage.
     *
     * @param Createm_kode_daerahRequest $request
     *
     * @return Response
     */
    public function store(Createm_kode_daerahRequest $request)
    {
        $input = $request->all();

        $mKodeDaerah = $this->mKodeDaerahRepository->create($input);

        Flash::success('M Kode Daerah saved successfully.');

        return redirect(route('mKodeDaerahs.index'));
    }

    /**
     * Display the specified m_kode_daerah.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mKodeDaerah = $this->mKodeDaerahRepository->find($id);

        if (empty($mKodeDaerah)) {
            Flash::error('M Kode Daerah not found');

            return redirect(route('mKodeDaerahs.index'));
        }

        return view('m_kode_daerahs.show')->with('mKodeDaerah', $mKodeDaerah);
    }

    /**
     * Show the form for editing the specified m_kode_daerah.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mKodeDaerah = $this->mKodeDaerahRepository->find($id);

        if (empty($mKodeDaerah)) {
            Flash::error('M Kode Daerah not found');

            return redirect(route('mKodeDaerahs.index'));
        }

        return view('m_kode_daerahs.edit')->with('mKodeDaerah', $mKodeDaerah);
    }

    /**
     * Update the specified m_kode_daerah in storage.
     *
     * @param  int              $id
     * @param Updatem_kode_daerahRequest $request
     *
     * @return Response
     */
    public function update($id, Updatem_kode_daerahRequest $request)
    {
        $mKodeDaerah = $this->mKodeDaerahRepository->find($id);

        if (empty($mKodeDaerah)) {
            Flash::error('M Kode Daerah not found');

            return redirect(route('mKodeDaerahs.index'));
        }

        $mKodeDaerah = $this->mKodeDaerahRepository->update($request->all(), $id);

        Flash::success('M Kode Daerah updated successfully.');

        return redirect(route('mKodeDaerahs.index'));
    }

    /**
     * Remove the specified m_kode_daerah from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mKodeDaerah = $this->mKodeDaerahRepository->find($id);

        if (empty($mKodeDaerah)) {
            Flash::error('M Kode Daerah not found');

            return redirect(route('mKodeDaerahs.index'));
        }

        $this->mKodeDaerahRepository->delete($id);

        Flash::success('M Kode Daerah deleted successfully.');

        return redirect(route('mKodeDaerahs.index'));
    }
}
