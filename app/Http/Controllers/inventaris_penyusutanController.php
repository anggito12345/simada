<?php

namespace App\Http\Controllers;

use App\DataTables\inventaris_penyusutanDataTable;
use App\Http\Requests;
use App\Http\Requests\Createinventaris_penyusutanRequest;
use App\Http\Requests\Updateinventaris_penyusutanRequest;
use App\Repositories\inventaris_penyusutanRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\inventaris_penyusutan;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Response;

class inventaris_penyusutanController extends AppBaseController
{
    /** @var  inventaris_penyusutanRepository */
    private $inventarisPenyusutanRepository;

    public function __construct(inventaris_penyusutanRepository $inventarisPenyusutanRepo)
    {
        $this->inventarisPenyusutanRepository = $inventarisPenyusutanRepo;
    }

    /**
     * display detail as partial html to show up on penatausahaan page
     */
    public function partialviewdetail($id) {
        $mdl = new inventaris_penyusutan();

        try {
            $this->inventarisPenyusutanRepository->CalculatingPenyusutan($id);

            $data = inventaris_penyusutan::where('inventaris_id', $id)->first();
            if (empty($data)) {
                throw new \Exception("inventaris not found");
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }



        return view('inventaris_penyusutans.show')->with('inventarisPenyusutan', $data);
    }

    /**
     * Display a listing of the inventaris_penyusutan.
     *
     * @param inventaris_penyusutanDataTable $inventarisPenyusutanDataTable
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function index(inventaris_penyusutanDataTable $inventarisPenyusutanDataTable)
    {
        return $inventarisPenyusutanDataTable->render('inventaris_penyusutans.index');
    }

    /**
     * Show the form for creating a new inventaris_penyusutan.
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function create()
    {
        return view('inventaris_penyusutans.create');
    }

    /**
     * Store a newly created inventaris_penyusutan in storage.
     *
     * @param Createinventaris_penyusutanRequest $request
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function store(Createinventaris_penyusutanRequest $request)
    {
        $input = $request->all();

        $inventarisPenyusutan = $this->inventarisPenyusutanRepository->create($input);

        Flash::success('Inventaris Penyusutan saved successfully.');

        return redirect(route('inventarisPenyusutans.index'));
    }

    /**
     * Display the specified inventaris_penyusutan.
     *
     * @param  int $id
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function show($id)
    {
        $inventarisPenyusutan = $this->inventarisPenyusutanRepository->find($id);

        if (empty($inventarisPenyusutan)) {
            Flash::error('Inventaris Penyusutan not found');

            return redirect(route('inventarisPenyusutans.index'));
        }

        return view('inventaris_penyusutans.show')->with('inventarisPenyusutan', $inventarisPenyusutan);
    }

    /**
     * Show the form for editing the specified inventaris_penyusutan.
     *
     * @param  int $id
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function edit($id)
    {
        $inventarisPenyusutan = $this->inventarisPenyusutanRepository->find($id);

        if (empty($inventarisPenyusutan)) {
            Flash::error('Inventaris Penyusutan not found');

            return redirect(route('inventarisPenyusutans.index'));
        }

        return view('inventaris_penyusutans.edit')->with('inventarisPenyusutan', $inventarisPenyusutan);
    }

    /**
     * Update the specified inventaris_penyusutan in storage.
     *
     * @param  int              $id
     * @param Updateinventaris_penyusutanRequest $request
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function update($id, Updateinventaris_penyusutanRequest $request)
    {
        $inventarisPenyusutan = $this->inventarisPenyusutanRepository->find($id);

        if (empty($inventarisPenyusutan)) {
            Flash::error('Inventaris Penyusutan not found');

            return redirect(route('inventarisPenyusutans.index'));
        }

        $inventarisPenyusutan = $this->inventarisPenyusutanRepository->update($request->all(), $id);

        Flash::success('Inventaris Penyusutan updated successfully.');

        return redirect(route('inventarisPenyusutans.index'));
    }

    /**
     * Remove the specified inventaris_penyusutan from storage.
     *
     * @param  int $id
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function destroy($id)
    {
        $inventarisPenyusutan = $this->inventarisPenyusutanRepository->find($id);

        if (empty($inventarisPenyusutan)) {
            Flash::error('Inventaris Penyusutan not found');

            return redirect(route('inventarisPenyusutans.index'));
        }

        $this->inventarisPenyusutanRepository->delete($id);

        Flash::success('Inventaris Penyusutan deleted successfully.');

        return redirect(route('inventarisPenyusutans.index'));
    }
}
