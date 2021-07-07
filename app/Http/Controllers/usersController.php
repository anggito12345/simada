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
use Laracasts\Flash\Flash as FlashFlash;

class usersController extends AppBaseController
{
    use AuthenticatesUsers {
        logout as performLogout;
    }

    /** @var  usersRepository */
    private $usersRepository;

    public function __construct(usersRepository $usersRepo)
    {
        $this->middleware('auth');
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

        FlashFlash::success('Users saved successfully.');


        if (isset($input['from-login'])) {
            return redirect('login?successRegister=1');
        }

        return redirect(route('users.index'));
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

        $users = $this->usersRepository->create($input);

        FlashFlash::success('Users saved successfully.');

        return redirect(route('login'));
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
        $this->middleware('auth');
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            FlashFlash::error('Users not found');

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
            FlashFlash::error('Users not found');

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
            FlashFlash::error('Users not found');

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

        if (isset($input['from_forgot_password']) || isset($input['from_ubah_password'])) {
            if (!Hash::check($input['password_confirmation'], $input['password'])) {
                // The passwords match...
                FlashFlash::error('Password lama tidak sama');
                return redirect()->back();
            }


            if (strlen($input['password_confirmation']) < 6) {
                FlashFlash::error('Password minimal 6 huruf atau angka');
                return redirect()->back();
            }

            if (isset($input['from_forgot_password'])) {
                $input['email_forgot_password'] = '';
            }
        }

        $users = $this->usersRepository->update($input, $id);

        if (isset($input['from_aktif_process'])) {
            Mail::to($users->email)->send(new \App\Mail\ActivationUser($users));
            return redirect(route('users.index') . '?IsSent=true');
        }

        if (isset($input['from_forgot_password'])) {
            FlashFlash::success('Password berhasil diubah!.');
            return redirect('/login?forgotPasswordCallback=1');
        }

        if (isset($input['from_ubah_password'])) {
            FlashFlash::success('Password berhasil diubah!.');
            return redirect('/home?triggerSwal=true&msg=Password berhasil diubah&type=success');
        }

        FlashFlash::success('Users updated successfully.');

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
        $this->middleware('auth');
        $users = $this->usersRepository->find($id);

        if (empty($users)) {
            FlashFlash::error('Users not found');

            return redirect(route('users.index'));
        }

        $this->usersRepository->delete($id);

        FlashFlash::success('Users deleted successfully.');

        return redirect(route('users.index'));
    }

    public function forgotPassword($forgotPasswordCode, Request $request) {

        $user = \App\Models\users::where('email_forgot_password', $forgotPasswordCode)->first();

        if ($user) {
            return view('users.forgot_password')->with('users', $user );
        } else {
            FlashFlash::error('Link telah expired atau tidak valid!');
            // it means fail on validate email forgot password code!
            return redirect('login?verificationCallback=2');
        }
    }

    public function ubahPassword(Request $request) {
        $this->middleware('auth');

        return view('users.ubah_password')->with('users', Auth::user() );
    }



    public function activate($activationcode, Request $request)
    {
        $userByVerificationCode = \App\Models\users::where('email_verification_code', $activationcode)->first();

        if (empty($userByVerificationCode)) {

            FlashFlash::error('Link telah expired atau tidak valid!');
            if (!Auth::guest()) {

                $this->performLogout($request);
            }

            return redirect('login?verificationCallback=0');
        }

        $userByVerificationCode->email_verification_code = '';

        $userByVerificationCode->aktif = '1';

        $userByVerificationCode->save();

        FlashFlash::success('User berhasil diaktivasi!.');

        if (!Auth::guest()) {

            $this->performLogout($request);
        }

        return redirect('login?verificationCallback=1');



    }
}
