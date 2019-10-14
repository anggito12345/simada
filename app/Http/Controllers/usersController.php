<?php

namespace App\Http\Controllers;

use App\DataTables\usersDataTable;
use Illuminate\Http\Request;
use App\Http\Requests\CreateusersRequest;
use App\Http\Requests\UpdateusersRequest;
use App\Repositories\usersRepository;
use Illuminate\Support\Facades\Hash;
use Flash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class usersController extends AppBaseController
{
    use AuthenticatesUsers {
        logout as performLogout;
    }

    /** @var  usersRepository */
    private $usersRepository;

    public function __construct(usersRepository $usersRepo)
    {
        parent::__construct();
        $this->usersRepository = $usersRepo;
    }

    /**
     * Display a listing of the users.
     *
     * @param usersDataTable $usersDataTable
     * @return Response
     */
    public function index(usersDataTable $usersDataTable)
    {
        return $usersDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new users.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created users in storage.
     *
     * @param CreateusersRequest $request
     *
     * @return Response
     */
    public function store(CreateusersRequest $request)
    {
        $input = $request->all();
        

        $input['password'] = Hash::make($request->password);

        $users = $this->usersRepository->create($input);

        Flash::success('Users saved successfully.');


        if (isset($input['from-login'])) {
            return redirect('login?successRegister=1');
        }

        return redirect(route('users.index'));
    }

    /**
     * Display the specified users.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('users', $users);
    }

    /**
     * Show the form for editing the specified users.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('users', $users);
    }

    /**
     * Update the specified users in storage.
     *
     * @param  int              $id
     * @param UpdateusersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateusersRequest $request)
    {
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }

        $input = $request->all();

        if (isset($input['password']) && $input['password'] != "") {
            $input['password'] = Hash::make($request->password);
        } else {
            $input['password'] = $users->password;
        }
        
        if (isset($input['username']) && $input['username'] == "") {
            $input['username'] = $users->username;
        }

        if (isset($input['from_aktif_process'])) {
            $input['email_verification_code'] = sha1(date('Y-m-d') . uniqid() . $users->username);
        }

        $users = $this->usersRepository->update($input, $id);

        if (isset($input['from_aktif_process'])) {
            Mail::to($users->email)->send(new \App\Mail\ActivationUser($users));
        }

        Flash::success('Users updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified users from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            Flash::error('Users not found');

            return redirect(route('users.index'));
        }

        $this->usersRepository->delete($id);

        Flash::success('Users deleted successfully.');

        return redirect(route('users.index'));
    }

    public function activate($activationcode, Request $request)
    {
        $userByVerificationCode = \App\Models\users::where('email_verification_code', $activationcode)->first();

        if (empty($userByVerificationCode)) {
            
            Flash::error('Link telah expired atau tidak valid!');
            if (!Auth::guest()) {
            
                $this->performLogout($request);
            }
    
            return redirect('login?verificationCallback=0');
        }

        $userByVerificationCode->email_verification_code = '';

        $userByVerificationCode->aktif = '1';

        $userByVerificationCode->save();

        Flash::success('User berhasil diaktivasi!.');

        if (!Auth::guest()) {
            
            $this->performLogout($request);
        }

        return redirect('login?verificationCallback=1');


        
    }
}
