<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Asistant;
use App\Models\Participant;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function index()
    {
        $post = Post::with('category:id,name,slug','user:id,name')->latest()->take(3)->get();
        return view('welcome', compact('post'));
    }

    public function read($slug)
    {
        $post = Post::with('category:id,name,slug','user:id,name','tag:id,name,slug')->where('slug', $slug)->first();
        return view('frontend.detail_post', compact('post'));
    }

    public function blog()
    {
        $post = Post::with('category:id,name,slug','user:id,name')->latest()->paginate(6);
        return view('frontend.post', compact('post'));
    }

    public function staff()
    {
        $staff = Asistant::with('user','divisi')->get();
        return view('frontend.staff', compact('staff'));
    }

    public function sertifikat(){
        if(request()->ajax())
        {
            return datatables()->of(Participant::with('sub_event.event'))
            ->editColumn('identity', function ($data) {
                return preg_replace("/(?!^).(?!$)/", "*", $data->identity);
            })
            ->editColumn('email', function ($data) {
                $mystring = $data->email;
                $first = strtok($mystring, '@');
                $text = substr($mystring, (strpos($mystring, '@') ?: -1));
                return preg_replace("/(?!^).(?!$)/", "*", $first) . $text;
            })
            ->addColumn('unduh', function ($data) {
              $modal = '<div x-data="{ show: false }">
              <div class="flex justify-center">
                  <button @click={show=true} type="button" class="leading-tight bg-indigo-600 text-gray-200 rounded px-6 py-3 text-sm focus:outline-none focus:border-white">Unduh</Button>
              </div>
              <div x-show="show" tabindex="0" class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed">
                  <div  @click.away="show = false" class="z-50 relative p-3 mx-auto my-0 max-w-full" style="width: 600px;">
                      <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden">
                          <button @click={show=false} class="fill-current h-6 w-6 absolute right-0 top-0 m-6 font-3xl font-bold">&times;</button>
                          <div class="px-6 py-3 text-xl border-b font-bold">Masukkan Nomor HP dan Email untuk verifikasi</div>


                          <div class="wrapper px-2 w-full">
                          

         <form action="'.route('unduh').'" method="POST" class="px-3 py-5 my-10 m-auto">'
                                  
         . csrf_field() .
         '<div class="my-5">
         <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
             <div class="flex flex-col mb-4">
                 <label for="name"
                     class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                     No Hp
                 </label>
         
                 <div class="relative">
         
                     <input id="name"
                         name="nohp"
                         type="text"
                         placeholder="NoHP"
                         value=""
                         class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
         
                 </div>
             </div>
             <div class="flex flex-col mb-4">
                 <label for="name"
                     class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                     E-Mail
                 </label>
         
                 <div class="relative">
         
                     <input id="name"
                         name="email"
                         type="email"
                         placeholder="Email"
                         value=""
                         class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
         
                 </div>
             </div>
             <input
                  name="id"
                     type="hidden"
                     value="'. $data->id .'"
                     placeholder="Email"
                     class="w-full py-2 px-1 placeholder-indigo-400 outline-none placeholder-opacity-50"
                     autocomplete="off"
                  />
             
             
         </div>
     </div>
     <div class="flex justify-end pt-2">
                   
                    <button type="submit"
                        class="focus:outline-none px-4 bg-indigo-500 p-3 ml-3 rounded-lg text-white hover:bg-indigo-400">Unduh</button>
                </div>';
                return $modal;
            })
            ->rawColumns(['identity','email','unduh'])
            ->make(true);
        }
        return view('frontend.sertifikat');
    }

    public function unduh(Request $request)
    {
      $nohp = $request->nohp;
        $email = $request->email;
        $id = $request->id;

        $user = Participant::with('sub_event.event')->where('email',$email)->where('identity',$nohp)->where('id',$id)->first();
        if ($user === null) {
          return redirect()->route('sertifikat')->with('biasalah','Gaada');
        }
        else {
          
          $template = new \PhpOffice\PhpWord\TemplateProcessor(public_path('uploads/'.$user->sub_event->event->template));
          $template->setValue('no', $user->sub_event->event->nomor_surat);
          $template->setValue('name', $user->nama);
          $template->setValue('sebagai', $user->sub_event->nama_sub_event);
          $template->setValue('event', $user->sub_event->event->nama_event);
          $template->setValue('code', $user->code);
          
         
          $saveDocPath = public_path('sertifikat/sertifikat-'.Str::slug($user->nama).'-'.Str::slug($user->sub_event->event->nama_event).rand().'.docx');
          $template->saveAs($saveDocPath);          
          return response()->download($saveDocPath)->deleteFileAfterSend();
         
        }
    }

    public function validation(Request $request)
    {
      $nomor = $request->nomor;

        $user = Participant::with('sub_event.event')->where('code',$nomor)->first();
        if ($user === null) {
          return redirect()->route('sertifikat')->with('biasalah','Gaada');
        }
        else {     
          return view('frontend.valid', compact('user'));
         
        }
    }
}
