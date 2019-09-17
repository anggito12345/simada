<?php

namespace App\Http\Controllers;

use App\DataTables\pemeliharaanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatepemeliharaanRequest;
use App\Http\Requests\UpdatepemeliharaanRequest;
use App\Repositories\pemeliharaanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class pemeliharaanController extends AppBaseController
{
    /** @var  pemeliharaanRepository */
    private $pemeliharaanRepository;

    public function __construct(pemeliharaanRepository $pemeliharaanRepo)
    {
        parent::__construct();
        $this->pemeliharaanRepository = $pemeliharaanRepo;
    }

    /**
     * Display a listing of the pemeliharaan.
     *
     * @param pemeliharaanDataTable $pemeliharaanDataTable
     * @return Response
     */
    public function index(pemeliharaanDataTable $pemeliharaanDataTable)
    {
        return $pemeliharaanDataTable->render('pemeliharaans.index');
    }

    /**
     * Show the form for creating a new pemeliharaan.
     *
     * @return Response
     */
    public function create()
    {
        return view('pemeliharaans.create');
    }

    /**
     * Store a newly created pemeliharaan in storage.
     *
     * @param CreatepemeliharaanRequest $request
     *
     * @return Response
     */
    public function store(CreatepemeliharaanRequest $request)
    {
        $input = $request->all();

        $pemeliharaan = $this->pemeliharaanRepository->create($input);

        Flash::success('Pemeliharaan saved successfully.');

        return redirect(route('pemeliharaans.index'));
    }

    /**
     * Display the specified pemeliharaan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pemeliharaan = $this->pemeliharaanRepository->find($id);

        if (empty($pemeliharaan)) {
            Flash::error('Pemeliharaan not found');

            return redirect(route('pemeliharaans.index'));
        }

        return view('pemeliharaans.show')->with('pemeliharaan', $pemeliharaan);
    }

    /**
     * Show the form for editing the specified pemeliharaan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pemeliharaan = $this->pemeliharaanRepository->find($id);

        if (empty($pemeliharaan)) {
            Flash::error('Pemeliharaan not found');

            return redirect(route('pemeliharaans.index'));
        }

        return view('pemeliharaans.edit')->with('pemeliharaan', $pemeliharaan);
    }

    /**
     * Update the specified pemeliharaan in storage.
     *
     * @param  int              $id
     * @param UpdatepemeliharaanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepemeliharaanRequest $request)
    {
        $pemeliharaan = $this->pemeliharaanRepository->find($id);

        if (empty($pemeliharaan)) {
            Flash::error('Pemeliharaan not found');

            return redirect(route('pemeliharaans.index'));
        }

        $pemeliharaan = $this->pemeliharaanRepository->update($request->all(), $id);

        Flash::success('Pemeliharaan updated successfully.');

        return redirect(route('pemeliharaans.index'));
    }

    /**
     * Remove the specified pemeliharaan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pemeliharaan = $this->pemeliharaanRepository->find($id);

        if (empty($pemeliharaan)) {
            Flash::error('Pemeliharaan not found');

            return redirect(route('pemeliharaans.index'));
        }

        $this->pemeliharaanRepository->delete($id);

        Flash::success('Pemeliharaan deleted successfully.');

        return redirect(route('pemeliharaans.index'));
    }
}
