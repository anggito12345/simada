<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateusersRequest;
use App\Models\role;
use App\Repositories\organisasiRepository;
use App\Repositories\roleRepository;
use App\Repositories\usersRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class authController extends AppBaseController {
     /** @var  usersRepository */
     private $usersRepository;
     private $organisasiRepository;
     private $roleRepository;

     public function __construct(
        usersRepository $usersRepo,
        organisasiRepository $organisasiRepository,
        roleRepository $roleRepository)
     {
         parent::__construct();
         $this->usersRepository = $usersRepo;
         $this->organisasiRepository = $organisasiRepository;
         $this->roleRepository = $roleRepository;
     }


        /**
     * Store a sign up user.
     *
     * @param CreateusersRequest $request
     *
     * @return Response
     */
    public function SignUp(CreateusersRequest $request)
    {

        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        try {
            $users = $this->usersRepository->create($input);
            $organisasi = $this->organisasiRepository->find($input["pid_organisasi"]);
            $roles = $this->roleRepository->all([
                'level' => $organisasi->level,
            ]);
            if (count($roles) > 0) {
                $users->assignRole($roles[0]->name);
            }
        } catch (\Exception $e) {
            Flash::error($e->getMessage());
            return back();
        }


        Flash::success('Users saved successfully.');

        return redirect(route('login'));
    }
}
