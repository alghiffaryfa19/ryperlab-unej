<?php
/*--------------------
https://github.com/jazmy/laravelformbuilder
Licensed under the GNU General Public License v3.0
Author: Jasmine Robinson (jazmy.com)
Last Updated: 12/29/2018
----------------------*/
namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use App\rpl\Events\Form\FormCreated;
use App\rpl\Events\Form\FormDeleted;
use App\rpl\Events\Form\FormUpdated;
use App\rpl\Helper;
use App\Models\Form;
use App\rpl\Requests\SaveFormRequest;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use Throwable;

class FormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $pageTitle = "Forms";
        $kelas = Kelas::find($id);

        if(request()->ajax())
        {
            return datatables()->of(Form::with('kelas')->where('kelas_id',$kelas->id))
            ->editColumn('edit', function ($data) use ($kelas) {
                $mystring = '<a href="'.route("formbuilders::sub.asisten", [$kelas->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Submission</a><a href="'.route("formbuilders::form.asisten.edit", [$kelas->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("formbuilders::form.asisten.delete", [$kelas->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('asisten.dashboard.forms.index', compact('pageTitle','kelas'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $kelas = Kelas::find($id);
        $pageTitle = "Create New Form";

        $saveURL = route('formbuilders::form.asisten.store', $kelas->id);

        // get the roles to use to populate the make the 'Access' section of the form builder work
        $form_roles = Helper::getConfiguredRoles();

        return view('asisten.dashboard.forms.create', compact('pageTitle', 'saveURL', 'form_roles','kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  jazmy\FormBuilder\Requests\SaveFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveFormRequest $request, $id)
    {
        $kelas = Kelas::find($id);
        
        $user = $request->user();

        $input = $request->merge(['user_id' => $user->id])->except('_token');

        DB::beginTransaction();

        // generate a random identifier
        $input['identifier'] = $user->id.'-'.Helper::randomString(20);
        $created = Form::create($input);

        try {
            // dispatch the event
            event(new FormCreated($created));

            DB::commit();

            return response()
                    ->json([
                        'success' => true,
                        'details' => 'Form successfully created!',
                        'dest' => route('formbuilders::form.asisten', $kelas->id),
                    ]);
        } catch (Throwable $e) {
            info($e);

            DB::rollback();

            return response()->json(['success' => false, 'details' => 'Failed to create the form.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $form = Form::where(['user_id' => $user->id, 'id' => $id])
                    ->with('user')
                    ->withCount('submissions')
                    ->firstOrFail();

        $pageTitle = "Preview Form";

        return view('formbuilders::forms.show', compact('pageTitle', 'form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($class,$id)
    {
        $kelas = Kelas::find($class);
        $user = auth()->user();

        // $kelas = Kelas::with('asistant.matkul')->get();

        $form = Form::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();

        $pageTitle = 'Edit Form';

        $saveURL = route('formbuilders::form.asisten.update', [$kelas->id,$form]);

        // get the roles to use to populate the make the 'Access' section of the form builder work
        $form_roles = Helper::getConfiguredRoles();

        return view('asisten.dashboard.forms.edit', compact('form', 'pageTitle', 'saveURL', 'form_roles', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  jazmy\FormBuilder\Requests\SaveFormRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveFormRequest $request, $class,$id)
    {
        $kelas = Kelas::find($class);
        $user = auth()->user();
        $form = Form::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();

        $input = $request->except('_token');

        if ($form->update($input)) {
            // dispatch the event
            event(new FormUpdated($form));

            return response()
                    ->json([
                        'success' => true,
                        'details' => 'Form successfully updated!',
                        'dest' => route('formbuilders::form.asisten', $kelas->id),
                    ]);
        } else {
            response()->json(['success' => false, 'details' => 'Failed to update the form.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($class,$id)
    {
        $kelas = Kelas::find($class);
        $user = auth()->user();
        $form = Form::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();
        $form->delete();

        // dispatch the event
        event(new FormDeleted($form));

        return back()->with('success', "'{$form->name}' deleted.");
    }
}
