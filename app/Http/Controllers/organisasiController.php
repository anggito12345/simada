<?php

namespace App\Http\Controllers;

use App\DataTables\organisasiDataTable;
use App\DataTables\organisasisettingDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateorganisasiRequest;
use App\Http\Requests\UpdateorganisasiRequest;
use App\Repositories\organisasiRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\organisasi;
use Response;

class organisasiController extends AppBaseController
{
    /** @var  organisasiRepository */
    private $organisasiRepository;

    public function __construct(organisasiRepository $organisasiRepo)
    {
        $this->organisasiRepository = $organisasiRepo;
    }

    /**
     * Display a listing of the organisasi.
     *
     * @param organisasiDataTable $organisasiDataTable
     * @return Response
     */
    public function index(organisasiDataTable $organisasiDataTable)
    {
        return $organisasiDataTable->render('organisasis.index');
    }

    public function settings(organisasisettingDataTable $organisasisettingDataTable)
    {
        return $organisasisettingDataTable->render('organisasis.settings');
    }

    public function changeSetting($id,UpdateorganisasiRequest $request)
    {
       // print_r($request);exit;
        $organisasi = $this->organisasiRepository->find($id);

        if (empty($organisasi)) {
            Flash::error('Setting OPD gagal diperbarui');

            return redirect(route('organisasis.settings'));
        }
        if($organisasi->setting==1){
            $organisasi->setting=0;
        }
        else{
            $organisasi->setting=1;
        }
       // $organisasi->setting=$_GET['setting'];
        $organisasi = $this->organisasiRepository->update($organisasi->toArray(), $id);

        Flash::success('Setting OPD sudah diperbarui.');

        return redirect(route('organisasis.settings'));
    }

    /**
     * Show the form for creating a new organisasi.
     *
     * @return Response
     */
    public function create()
    {
        return view('organisasis.create');
    }

    /**
     * Store a newly created organisasi in storage.
     *
     * @param CreateorganisasiRequest $request
     *
     * @return Response
     */
    public function store(CreateorganisasiRequest $request)
    {
        $input = $request->all();

        $input["id"] = organisasi::max("id") +1;

        $organisasi = $this->organisasiRepository->create($input);

        Flash::success('Organisasi saved successfully.');

        return redirect(route('organisasis.index'));
    }

    /**
     * Display the specified organisasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $organisasi = $this->organisasiRepository->find($id);

        if (empty($organisasi)) {
            Flash::error('Organisasi not found');

            return redirect(route('organisasis.index'));
        }

        return view('organisasis.show')->with('organisasi', $organisasi);
    }

    /**
     * Show the form for editing the specified organisasi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $organisasi = $this->organisasiRepository->find($id);

        if (empty($organisasi)) {
            Flash::error('Organisasi not found');

            return redirect(route('organisasis.index'));
        }

        return view('organisasis.edit')->with('organisasi', $organisasi);
    }

    /**
     * Update the specified organisasi in storage.
     *
     * @param  int              $id
     * @param UpdateorganisasiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateorganisasiRequest $request)
    {
        $organisasi = $this->organisasiRepository->find($id);

        if (empty($organisasi)) {
            Flash::error('Organisasi not found');

            return redirect(route('organisasis.index'));
        }

        $organisasi = $this->organisasiRepository->update($request->all(), $id);

        Flash::success('Organisasi updated successfully.');

        return redirect(route('organisasis.index'));
    }

    /**
     * Remove the specified organisasi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $organisasi = $this->organisasiRepository->find($id);

        if (empty($organisasi)) {
            Flash::error('Organisasi not found');

            return redirect(route('organisasis.index'));
        }

        $this->organisasiRepository->delete($id);

        Flash::success('Organisasi deleted successfully.');

        return redirect(route('organisasis.index'));
    }
}
