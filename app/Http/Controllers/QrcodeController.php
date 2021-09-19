<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQrcodeRequest;
use App\Http\Requests\UpdateQrcodeRequest;
use App\Http\Resources\QrcodeResource;
use App\Http\Resources\QrcodeResourceCollection;
use App\Models\User;
use App\Repositories\QrcodeRepository;
use App\Http\Controllers\AppBaseController;
use Collective\Html\FormFacade;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends AppBaseController
{
    /** @var  QrcodeRepository */
    private $qrcodeRepository;

    public function __construct(QrcodeRepository $qrcodeRepo)
    {
        $this->qrcodeRepository = $qrcodeRepo;
    }

    /**
     * Display a listing of the Qrcode.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $isApiCall = $request->expectsJson();
        $user = $request->user();
        if ($user->isAdmin() || $user->isModerator()) {
            $queryBuilder = $this->qrcodeRepository->makeModel()->latest();
            $qrcodes = $isApiCall ? $queryBuilder->paginate(10) : $queryBuilder->get();
        }
        else {
            $qrcodes = $user->qrcodes()->paginate(10)->sortDesc();
        }
        if ($request->expectsJson()) {
            return response()->success(QrcodeResource::collection($qrcodes)->response()->getData());
        }
        return view('qrcodes.index')
            ->with('qrcodes', $qrcodes);
    }

    /**
     * Show the form for creating a new Qrcode.
     *
     * @return Response
     */
    public function create()
    {
        return view('qrcodes.create');
    }

    /**
     * Store a newly created Qrcode in storage.
     *
     * @param CreateQrcodeRequest $request
     *
     * @return Response
     */
    public function store(CreateQrcodeRequest $request)
    {
        $input = $request->all();
        $qrcodePath = 'qrcodes/'.time().'.png';
        $qrcodeFullPath = public_path('storage/'.$qrcodePath);
        QrCode::format('png')->generate('message qrcode', $qrcodeFullPath);
//        dd($input);
        if (Storage::exists($qrcodePath)) {
            $input['qrcode_path'] = $qrcodePath;
            $input['user_id'] = getCurrentUser()->id;
            $input['status'] = $request->has('status');
            $qrcode = $this->qrcodeRepository->create($input);
            Flash::success('Qrcode saved successfully.');
        }
        else {
            $error = 'Qrcode saved fail.';
            Flash::error($error);
        }
        if($request->expectsJson()) {
            if (isset($error)) {
                return response()->error($error);
            }
            return response()->success(new QrcodeResource($qrcode));
        }

        return redirect(route('qrcodes.index'));
    }

    /**
     * Display the specified Qrcode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $qrcode = $this->qrcodeRepository->find($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }
        $transactions = $qrcode->transactions;
        return view('qrcodes.show', compact('qrcode', 'transactions'));
    }

    /**
     * Show the form for editing the specified Qrcode.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $qrcode = $this->qrcodeRepository->find($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }

        return view('qrcodes.edit')->with('qrcode', $qrcode);
    }

    /**
     * Update the specified Qrcode in storage.
     *
     * @param int $id
     * @param UpdateQrcodeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQrcodeRequest $request)
    {
        $qrcode = $this->qrcodeRepository->find($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }
        $input = $request->all();
        $input['status'] = $request->has('status');
        $qrcode = $this->qrcodeRepository->update($input, $id);

        Flash::success('Qrcode updated successfully.');

        return redirect(route('qrcodes.index'));
    }

    /**
     * Remove the specified Qrcode from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $qrcode = $this->qrcodeRepository->find($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }

        $this->qrcodeRepository->delete($id);

        Flash::success('Qrcode deleted successfully.');

        return redirect(route('qrcodes.index'));
    }
}
