<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createm_kode_daerahAPIRequest;
use App\Http\Requests\API\Updatem_kode_daerahAPIRequest;
use App\Models\m_kode_daerah;
use App\Repositories\m_kode_daerahRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class m_kode_daerahController
 * @package App\Http\Controllers\API
 */

class m_kode_daerahAPIController extends AppBaseController
{
    /** @var  m_kode_daerahRepository */
    private $mKodeDaerahRepository;

    public function __construct(m_kode_daerahRepository $mKodeDaerahRepo)
    {
        $this->mKodeDaerahRepository = $mKodeDaerahRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/mKodeDaerahs",
     *      summary="Get a listing of the m_kode_daerahs.",
     *      tags={"m_kode_daerah"},
     *      description="Get all m_kode_daerahs",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/m_kode_daerah")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $mKodeDaerahs = $this->mKodeDaerahRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($mKodeDaerahs->toArray(), 'M Kode Daerahs retrieved successfully');
    }

    /**
     * @param Createm_kode_daerahAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/mKodeDaerahs",
     *      summary="Store a newly created m_kode_daerah in storage",
     *      tags={"m_kode_daerah"},
     *      description="Store m_kode_daerah",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="m_kode_daerah that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/m_kode_daerah")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/m_kode_daerah"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Createm_kode_daerahAPIRequest $request)
    {
        $input = $request->all();

        $mKodeDaerah = $this->mKodeDaerahRepository->create($input);

        return $this->sendResponse($mKodeDaerah->toArray(), 'M Kode Daerah saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/mKodeDaerahs/{id}",
     *      summary="Display the specified m_kode_daerah",
     *      tags={"m_kode_daerah"},
     *      description="Get m_kode_daerah",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of m_kode_daerah",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/m_kode_daerah"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var m_kode_daerah $mKodeDaerah */
        $mKodeDaerah = $this->mKodeDaerahRepository->find($id);

        if (empty($mKodeDaerah)) {
            return $this->sendError('M Kode Daerah not found');
        }

        return $this->sendResponse($mKodeDaerah->toArray(), 'M Kode Daerah retrieved successfully');
    }

    /**
     * @param int $id
     * @param Updatem_kode_daerahAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/mKodeDaerahs/{id}",
     *      summary="Update the specified m_kode_daerah in storage",
     *      tags={"m_kode_daerah"},
     *      description="Update m_kode_daerah",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of m_kode_daerah",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="m_kode_daerah that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/m_kode_daerah")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/m_kode_daerah"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Updatem_kode_daerahAPIRequest $request)
    {
        $input = $request->all();

        /** @var m_kode_daerah $mKodeDaerah */
        $mKodeDaerah = $this->mKodeDaerahRepository->find($id);

        if (empty($mKodeDaerah)) {
            return $this->sendError('M Kode Daerah not found');
        }

        $mKodeDaerah = $this->mKodeDaerahRepository->update($input, $id);

        return $this->sendResponse($mKodeDaerah->toArray(), 'm_kode_daerah updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/mKodeDaerahs/{id}",
     *      summary="Remove the specified m_kode_daerah from storage",
     *      tags={"m_kode_daerah"},
     *      description="Delete m_kode_daerah",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of m_kode_daerah",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var m_kode_daerah $mKodeDaerah */
        $mKodeDaerah = $this->mKodeDaerahRepository->find($id);

        if (empty($mKodeDaerah)) {
            return $this->sendError('M Kode Daerah not found');
        }

        $mKodeDaerah->delete();

        return $this->sendSuccess('M Kode Daerah deleted successfully');
    }
}
