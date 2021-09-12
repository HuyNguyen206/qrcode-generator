<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Account;
use App\Repositories\AccountRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Response;

class AccountController extends AppBaseController
{
    /** @var  AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
        $this->middleware('check-moderator')->only('markAsPaid');
        $this->middleware('check-admin')->except('markAsPaid', 'myAccount');
    }

    /**
     * Display a listing of the Account.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $accounts = $this->accountRepository->all();

        return view('accounts.index')
            ->with('accounts', $accounts);
    }

    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param CreateAccountRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        $account = $this->accountRepository->create($input);

        Flash::success('Account saved successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }
        $accountHistories = $account->accountHistories;
        return view('accounts.show', compact('account', 'accountHistories'));
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.edit')->with('account', $account);
    }

    /**
     * Update the specified Account in storage.
     *
     * @param int $id
     * @param UpdateAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountRequest $request)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $account = $this->accountRepository->update($request->all(), $id);

        Flash::success('Account updated successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $this->accountRepository->delete($id);

        Flash::success('Account deleted successfully.');

        return redirect(route('accounts.index'));
    }

    public function applyPayout(Account $account)
    {
        if (auth()->user()->isOwnerOfAccount($account)) {
            $account->applied_for_payout = true;
            $account->paid = false;
            $account->last_date_applied = now();
            $account->save();
            $account->accountHistories()->create([
                'user_id' => auth()->id(),
                'message' => 'Payout request initiated by account owner'
            ]);
            Flash::success('Account apply for payout successfully.');
            return redirect()->back();
        }
        Flash::error('You can not perform this operation on account which it not your');
        return redirect()->back();
    }

    public function markAsPaid(Account $account)
    {
        $user = auth()->user();
        $account->applied_for_payout = false;
        $account->paid = true;
        $account->last_date_paid = now();
        $account->save();
        $account->accountHistories()->create([
            'user_id' =>$account->user_id,
            'message' => "Payment completed by $user->name(admin)"
        ]);
        Flash::success('Account mark as paid successfully.');
        return redirect()->back();
    }

    public function myAccount()
    {
        $account = \request()->user()->account;

        if (empty($account)) {
            Flash::error('You do not have account yet');

            return redirect()->back();
        }
        $accountHistories = $account->accountHistories;
        return view('accounts.show', compact('account', 'accountHistories'));
    }
}
