<?php
/*--------------------
https://github.com/jazmy/laravelformbuilder
Licensed under the GNU General Public License v3.0
Author: Jasmine Robinson (jazmy.com)
Last Updated: 12/29/2018
----------------------*/
namespace App\Http\Controllers;


use App\rpl\Helper;
use App\Models\Form;
use App\Models\Kelas;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubFormController extends Controller
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
     * @param integer $form_id
     * @return \Illuminate\Http\Response
     */
    public function index($kelas,$form_id)
    {
        $kelas = Kelas::find($kelas);
        $user = auth()->user();

        $form = Form::where(['user_id' => $user->id, 'id' => $form_id])
                    ->with(['user'])
                    ->firstOrFail();

        $pageTitle = "Submitted Entries for '{$form->name}'";
        if(request()->ajax())
        {
            return datatables()->of($form->submissions()->with('user')->select('form_submissions.*'))
            ->editColumn('edit', function ($data) use ($kelas,$form) {
                $mystring = '<a href="'.route("formbuilders::sub.asisten.show", [$kelas->id,$form->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Detail</a><a href="'.route("formbuilders::sub.asisten.delete", [$kelas->id,$form->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view(
            'asisten.dashboard.forms.submission.index',
            compact('form', 'kelas', 'pageTitle')
        );

        // $submissions = $form->submissions()
        //                     ->with('user')
        //                     ->latest()
        //                     ->paginate(100);

        // // get the header for the entries in the form
        // $form_headers = $form->getEntriesHeader();

        // $pageTitle = "Submitted Entries for '{$form->name}'";

        // return view(
        //     'asisten.dashboard.forms.submission.index',
        //     compact('form', 'submissions', 'pageTitle', 'form_headers')
        // );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $form_id
     * @param integer $submission_id
     * @return \Illuminate\Http\Response
     */
    public function show($kelas, $form_id, $submission_id)
    {
        $kelas = Kelas::find($kelas);
        $submission = Submission::with('user', 'form')
                            ->where([
                                'form_id' => $form_id,
                                'id' => $submission_id,
                            ])
                            ->firstOrFail();

        $form_headers = $submission->form->getEntriesHeader();

        $pageTitle = "View Submission";

        return view('asisten.dashboard.forms.submission.show', compact('pageTitle', 'submission', 'form_headers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $form_id
     * @param int $submission_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kelas, $form_id, $submission_id)
    {
        $kelas = Kelas::find($kelas);
        $submission = Submission::where(['form_id' => $form_id, 'id' => $submission_id])->firstOrFail();
        $submission->delete();

        return redirect()
                    ->route('formbuilders::sub.asisten', [$kelas->id,$form_id]);
    }
}
