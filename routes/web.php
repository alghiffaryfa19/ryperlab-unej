<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\AsistantController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\QrLoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaDuaController;
use App\Http\Controllers\ProjekMahasiswaController;
use App\Http\Controllers\ProjekAppendixController;
use App\Http\Controllers\KuesionerMahasiswaController;
use App\Http\Controllers\ViewProjectController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\DashboardAsistenController;
use App\Http\Controllers\MateriAsistenController;
use App\Http\Controllers\UjianAsistenController;
use App\Http\Controllers\SoalAsistenController;
use App\Http\Controllers\TugasAsistenController;
use App\Http\Controllers\ProjectAsistenController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MySubmissionController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\WaktuEnrollController;
use App\Http\Controllers\SubFormController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SubEventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\EnrollAsistenController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\HasilUjianController;
use App\Http\Controllers\HasilTugasController;
use App\Http\Controllers\HasilProjectController;

Route::get('/', [FrontendController::class, 'index'])->name('landing');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/staff', [FrontendController::class, 'staff'])->name('staff');
Route::get('/e-certificate', [FrontendController::class, 'sertifikat'])->name('sertifikat');
Route::get('/blog/{slug}', [FrontendController::class, 'read'])->name('read');

Route::post('/e-certificate/unduh', [FrontendController::class, 'unduh'])->name('unduh');
Route::post('/e-certificate/validation', [FrontendController::class, 'validation'])->name('validation');

Route::get('/projects', [ViewProjectController::class, 'projects'])->name('projects_frontend');
Route::get('/projects/kelas', [ViewProjectController::class, 'search'])->name('searching');
Route::get('/projects/{project}', [ViewProjectController::class, 'detail_projects'])->name('detail_projectss');

Route::get('/gallery', [ViewProjectController::class, 'gallery'])->name('galeries');

Route::get('/contacts', function () {
    return view('frontend.contacts');
})->name('contacts');

Route::get('/ryperlabs', function () {
    return view('frontend.ryperlabs');
})->name('ryperlabs');

Route::get('/login-qr-code', function () {
    return view('auth.qrcode');
})->name('login-qr')->middleware('guest');

Route::post('/qrloginn', [QrLoginController::class, 'qrlogin'])->name('qr.login')->middleware('guest');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','peserta'])->name('dashboard');

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function(){
    Route::get('/dashboard', function () {
        return view('admin');
    })->name('admin');

    Route::resource('event', EventController::class);
    Route::resource('waktu-enroll', WaktuEnrollController::class);
    Route::get('event/{id}/delete', [EventController::class, 'destroy'])->name('hapus.event');
    Route::get('event/{id}/subevent', [SubEventController::class, 'index'])->name('subevent');
    Route::post('event/{id}/subevent/store', [SubEventController::class, 'store'])->name('subevent.store');
    Route::get('event/{id}/subevent/edit/{subevent}', [SubEventController::class, 'edit'])->name('subevent.edit');
    Route::put('event/{id}/subevent/update/{subevent}', [SubEventController::class, 'update'])->name('subevent.update');
    Route::get('event/{id}/subevent/delete/{subevent}', [SubEventController::class, 'destroy'])->name('hapus.subevent');
    Route::resource('participant', ParticipantController::class);
    Route::get('participant/{id}/delete', [ParticipantController::class, 'destroy'])->name('hapus.participant');
    Route::post('participant/import', [ParticipantController::class, 'import'])->name('import');

    Route::resource('category', CategoryController::class);
    Route::get('category/{id}/delete', [CategoryController::class, 'destroy'])->name('hapus.category');

    Route::resource('project-category', ProjectCategoryController::class);
    Route::get('project-category/{id}/delete', [ProjectCategoryController::class, 'destroy'])->name('hapus.project-category');

    Route::resource('tag', TagController::class);
    Route::get('tag/{id}/delete', [TagController::class, 'destroy'])->name('hapus.tag');

    Route::resource('post', PostController::class);
    Route::get('post/{id}/delete', [PostController::class, 'destroy'])->name('hapus.post');

    Route::resource('akun', UserController::class);
    Route::get('akun/{id}/delete', [UserController::class, 'destroy'])->name('hapus.user');

    Route::resource('matkul', MatkulController::class);
    Route::get('matkul/{id}/delete', [MatkulController::class, 'destroy'])->name('hapus.matkul');

    Route::resource('asistant', AsistantController::class);
    Route::get('asistant/{id}/delete', [AsistantController::class, 'destroy'])->name('hapus.asistant');

    Route::resource('divisi', DivisiController::class);
    Route::get('divisi/{id}/delete', [DivisiController::class, 'destroy'])->name('hapus.divisi');

    Route::resource('class', ClassController::class);
    Route::get('class/{id}/delete', [ClassController::class, 'destroy'])->name('hapus.class');
    Route::get('class/{id}/materi', [MateriController::class, 'index'])->name('materi');
    Route::get('class/{id}/materi/add', [MateriController::class, 'create'])->name('materi.create');
    Route::post('class/{id}/materi/store', [MateriController::class, 'store'])->name('materi.store');
    Route::get('class/{id}/materi/edit/{materi}', [MateriController::class, 'edit'])->name('materi.edit');
    Route::put('class/{id}/materi/update/{materi}', [MateriController::class, 'update'])->name('materi.update');
    Route::get('class/{id}/materi/delete/{materi}', [MateriController::class, 'destroy'])->name('materi.delete');

    Route::resource('enrollment', EnrollmentController::class);
    Route::get('enrollment/{id}/delete', [EnrollmentController::class, 'destroy'])->name('hapus.enrollment');

    Route::resource('assignment', AssignmentController::class);
    Route::get('assignment/{id}/delete', [AssignmentController::class, 'destroy'])->name('hapus.assignment');
    Route::get('assignment/{id}/submisi', [AssignmentController::class, 'submisi'])->name('submisi');
});

Route::group(['prefix' => 'mahasiswa', 'middleware' => ['auth','mahasiswa']], function(){
    Route::get('/dashboard', function () {
        return view('mahasiswa');
    })->name('mahasiswa');

    Route::get('enrollment', [MahasiswaController::class, 'enroll'])->name('enroll');
    Route::get('enrollment/delete/{id}/{kelas}', [MahasiswaController::class, 'hapus_enroll'])->name('hapus_enroll');
    Route::get('myclass', [MahasiswaController::class, 'myclass'])->name('myclass');
    Route::get('enrollment/{kelas}', [MahasiswaController::class, 'detail_kelas'])->name('detail_kelas');
    Route::post('enrollment/{kelas}/enroll', [MahasiswaController::class, 'enroll_now'])->name('enroll_now');
    Route::get('myclass/{kelas}/materi/{id}', [MahasiswaController::class, 'materi'])->name('materi_kelas');
    Route::get('myclass/{kelas}/materi/{id}/{materi}', [MahasiswaController::class, 'detail_materi'])->name('detail_materi');

    Route::get('myclass/{kelas}/tugas/', [MahasiswaController::class, 'tugas'])->name('tugas');
    Route::get('myclass/{kelas}/tugas/{id}', [MahasiswaController::class, 'upload_tugas'])->name('upload_tugas');
    Route::post('myclass/{kelas}/tugas/{id}/upload', [MahasiswaController::class, 'store'])->name('unggah');
    Route::put('myclass/{kelas}/tugas/{id}/upload', [MahasiswaController::class, 'unggah_ulang'])->name('unggah_ulang');

    Route::get('myclass/{kelas}/ujian/', [MahasiswaDuaController::class, 'exam'])->name('exam');
    Route::get('myclass/{kelas}/ujian/{id}', [MahasiswaDuaController::class, 'detail_exam'])->name('detail_exam');
    Route::post('ujian/start_ujian', [MahasiswaDuaController::class, 'start_ujian'])->name('attemp'); 
    Route::get('test/soal/{ujian}/{no_soal}', [MahasiswaDuaController::class, 'getSoal'])->name('kerjakan');
    Route::post('test/simpan', [MahasiswaDuaController::class, 'simpanSoal']);
    Route::get('test/konfirmasi/{ujian}', [MahasiswaDuaController::class, 'konfirmasi']);
    Route::post('test/selesai', [MahasiswaDuaController::class, 'finish'])->name('finish');

    Route::get('myclass/{kelas}/projects/', [ProjekMahasiswaController::class, 'projects'])->name('projects');
    Route::get('myclass/{kelas}/projects/{id}', [ProjekMahasiswaController::class, 'detail_projects'])->name('detail_projects');
    Route::post('myclass/{kelas}/projects/{id}/upload', [ProjekMahasiswaController::class, 'store'])->name('unggah_project');
    Route::put('myclass/{kelas}/projects/{id}/upload', [ProjekMahasiswaController::class, 'unggah_ulang'])->name('unggah_ulang_project');

    Route::get('myclass/{kelas}/projects/{id}/assignment/{a}/galeri', [ProjekAppendixController::class, 'galeri_project'])->name('galeri_project');
    Route::post('myclass/{kelas}/projects/{id}/assignment/{a}/galeri', [ProjekAppendixController::class, 'galeri_store'])->name('galeri_store');
    Route::get('myclass/{kelas}/projects/{id}/assignment/{a}/galeri/edit/{g}', [ProjekAppendixController::class, 'galeri_edit'])->name('galeri_edit');
    Route::put('myclass/{kelas}/projects/{id}/assignment/{a}/galeri/update/{g}', [ProjekAppendixController::class, 'galeri_update'])->name('galeri_update');
    Route::get('myclass/{kelas}/projects/{id}/assignment/{a}/galeri/delete/{g}', [ProjekAppendixController::class, 'galeri_delete'])->name('galeri_delete');

    Route::get('myclass/{kelas}/projects/{id}/assignment/{a}/member', [ProjekAppendixController::class, 'member_project'])->name('member_project');
    Route::post('myclass/{kelas}/projects/{id}/assignment/{a}/member', [ProjekAppendixController::class, 'member_store'])->name('member_store');
    Route::get('myclass/{kelas}/projects/{id}/assignment/{a}/member/edit/{g}', [ProjekAppendixController::class, 'member_edit'])->name('member_edit');
    Route::put('myclass/{kelas}/projects/{id}/assignment/{a}/member/update/{g}', [ProjekAppendixController::class, 'member_update'])->name('member_update');
    Route::get('myclass/{kelas}/projects/{id}/assignment/{a}/member/delete/{g}', [ProjekAppendixController::class, 'member_delete'])->name('member_delete');

    Route::get('myclass/{kelas}/kuesioner/', [KuesionerMahasiswaController::class, 'kuesioner'])->name('kuesioner');
    Route::get('myclass/{kelas}/kuesioner/{id}', [KuesionerMahasiswaController::class, 'detail_kuesioner'])->name('detail_kuesioner');
    Route::post('myclass/{kelas}/kuesioner/{id}/upload', [KuesionerMahasiswaController::class, 'store'])->name('store_kuesioner');

});

Route::group(['prefix' => 'asisten', 'middleware' => ['auth','asisten']], function(){
    Route::get('/dashboard', [DashboardAsistenController::class, 'asist'])->name('asist');

    Route::get('kelas/{kelas}/materi/', [MateriAsistenController::class, 'index'])->name('materi.asisten');
    Route::get('kelas/{kelas}/materi/add', [MateriAsistenController::class, 'create'])->name('materi.asisten.create');
    Route::post('kelas/{kelas}/materi/', [MateriAsistenController::class, 'store'])->name('materi.asisten.store');
    Route::get('kelas/{kelas}/materi/edit/{materi}', [MateriAsistenController::class, 'edit'])->name('materi.asisten.edit');
    Route::put('kelas/{kelas}/materi/update/{materi}', [MateriAsistenController::class, 'update'])->name('materi.asisten.update');
    Route::get('kelas/{kelas}/materi/delete/{materi}', [MateriAsistenController::class, 'destroy'])->name('materi.asisten.delete');

    Route::get('kelas/{kelas}/ujian/', [UjianAsistenController::class, 'index'])->name('ujian.asisten');
    Route::get('kelas/{kelas}/ujian/add', [UjianAsistenController::class, 'create'])->name('ujian.asisten.create');
    Route::post('kelas/{kelas}/ujian/', [UjianAsistenController::class, 'store'])->name('ujian.asisten.store');
    Route::get('kelas/{kelas}/ujian/edit/{ujian}', [UjianAsistenController::class, 'edit'])->name('ujian.asisten.edit');
    Route::put('kelas/{kelas}/ujian/update/{ujian}', [UjianAsistenController::class, 'update'])->name('ujian.asisten.update');
    Route::get('kelas/{kelas}/ujian/delete/{ujian}', [UjianAsistenController::class, 'destroy'])->name('ujian.asisten.delete');

    Route::get('kelas/{kelas}/ujian/{ujian}/hasil', [HasilUjianController::class, 'index'])->name('hasil.ujian.asisten');
    Route::get('kelas/{kelas}/ujian/{ujian}/hasil/{hasil}', [HasilUjianController::class, 'edit'])->name('hasil.ujian.asisten.edit');
    Route::put('kelas/{kelas}/ujian/{ujian}/hasil/{hasil}/update', [HasilUjianController::class, 'update'])->name('hasil.ujian.asisten.update');
    Route::get('kelas/{kelas}/ujian/{ujian}/hasil/{hasil}/delete', [HasilUjianController::class, 'destroy'])->name('hasil.ujian.asisten.delete');

    Route::get('kelas/{kelas}/ujian/{ujian}/soal', [SoalAsistenController::class, 'index'])->name('soal.asisten');
    Route::get('kelas/{kelas}/ujian/{ujian}/soal/add', [SoalAsistenController::class, 'create'])->name('soal.asisten.create');
    Route::post('kelas/{kelas}/ujian/{ujian}/soal/add', [SoalAsistenController::class, 'store'])->name('soal.asisten.store');
    Route::get('kelas/{kelas}/ujian/{ujian}/soal/{soal}', [SoalAsistenController::class, 'edit'])->name('soal.asisten.edit');
    Route::put('kelas/{kelas}/ujian/{ujian}/soal/{soal}/update', [SoalAsistenController::class, 'update'])->name('soal.asisten.update');
    Route::get('kelas/{kelas}/ujian/{ujian}/soal/{soal}/delete', [SoalAsistenController::class, 'destroy'])->name('soal.asisten.delete');

    Route::get('kelas/{kelas}/tugas/', [TugasAsistenController::class, 'index'])->name('tugas.asisten');
    Route::get('kelas/{kelas}/tugas/add', [TugasAsistenController::class, 'create'])->name('tugas.asisten.create');
    Route::post('kelas/{kelas}/tugas/', [TugasAsistenController::class, 'store'])->name('tugas.asisten.store');
    Route::get('kelas/{kelas}/tugas/edit/{tugas}', [TugasAsistenController::class, 'edit'])->name('tugas.asisten.edit');
    Route::put('kelas/{kelas}/tugas/update/{tugas}', [TugasAsistenController::class, 'update'])->name('tugas.asisten.update');
    Route::get('kelas/{kelas}/tugas/delete/{tugas}', [TugasAsistenController::class, 'destroy'])->name('tugas.asisten.delete');

    Route::get('kelas/{kelas}/tugas/{tugas}/hasil', [HasilTugasController::class, 'index'])->name('hasil.tugas.asisten');
    Route::get('kelas/{kelas}/tugas/{tugas}/hasil/{hasil}', [HasilTugasController::class, 'edit'])->name('hasil.tugas.asisten.edit');
    Route::get('kelas/{kelas}/tugas/{tugas}/hasil/{hasil}/delete', [HasilTugasController::class, 'destroy'])->name('hasil.tugas.asisten.delete');

    Route::get('kelas/{kelas}/project/', [ProjectAsistenController::class, 'index'])->name('project.asisten');
    Route::get('kelas/{kelas}/project/add', [ProjectAsistenController::class, 'create'])->name('project.asisten.create');
    Route::post('kelas/{kelas}/project/', [ProjectAsistenController::class, 'store'])->name('project.asisten.store');
    Route::get('kelas/{kelas}/project/edit/{project}', [ProjectAsistenController::class, 'edit'])->name('project.asisten.edit');
    Route::put('kelas/{kelas}/project/update/{project}', [ProjectAsistenController::class, 'update'])->name('project.asisten.update');
    Route::get('kelas/{kelas}/project/delete/{project}', [ProjectAsistenController::class, 'destroy'])->name('project.asisten.delete');

    Route::get('kelas/{kelas}/project/{project}/hasil', [HasilProjectController::class, 'index'])->name('hasil.project.asisten');
    Route::get('kelas/{kelas}/project/{project}/hasil/{hasil}', [HasilProjectController::class, 'edit'])->name('hasil.project.asisten.edit');
    Route::get('kelas/{kelas}/project/{project}/hasil/{hasil}/delete', [HasilProjectController::class, 'destroy'])->name('hasil.project.asisten.delete');

    Route::get('kelas/{kelas}/enrollments/', [EnrollAsistenController::class, 'index'])->name('enroll.asisten');
    Route::get('kelas/{kelas}/enrollments/edit/{enrollments}', [EnrollAsistenController::class, 'edit'])->name('enroll.asisten.edit');
    Route::put('kelas/{kelas}/enrollments/update/{enrollments}', [EnrollAsistenController::class, 'update'])->name('enroll.asisten.update');
    Route::get('kelas/{kelas}/enrollments/delete/{enrollments}', [EnrollAsistenController::class, 'destroy'])->name('enroll.asisten.delete');

    Route::middleware('web')
	->prefix(config('formbuilder.url_path', '/form-builder'))
	// ->namespace('jazmy\FormBuilder\Controllers')
	->name('formbuilders::')
	->group(function () {
		Route::redirect('/', url(config('formbuilder.url_path', '/form-builder').'/forms'));

		Route::resource('/my-submissions', MySubmissionController::class);
		
		Route::name('forms.')
			->prefix('/forms/{fid}')
			->group(function () {
				Route::resource('/submissions', SubmissionController::class);
			});

		// Route::resource('/forms', FormController::class);

        Route::get('kelas/{kelas}/forms/', [FormController::class, 'index'])->name('form.asisten');
        Route::get('kelas/{kelas}/forms/add', [FormController::class, 'create'])->name('form.asisten.create');
        Route::post('kelas/{kelas}/forms/', [FormController::class, 'store'])->name('form.asisten.store');
        Route::get('kelas/{kelas}/forms/edit/{project}', [FormController::class, 'edit'])->name('form.asisten.edit');
        
        Route::put('kelas/{kelas}/forms/update/{project}', [FormController::class, 'update'])->name('form.asisten.update');
        Route::get('kelas/{kelas}/proformsject/delete/{project}', [FormController::class, 'destroy'])->name('form.asisten.delete');

        Route::get('kelas/{kelas}/forms/submission/{project}', [SubFormController::class, 'index'])->name('sub.asisten');
        Route::get('kelas/{kelas}/forms/submission/{project}/show/{sub}', [SubFormController::class, 'show'])->name('sub.asisten.show');
        Route::get('kelas/{kelas}/forms/submission/{project}/delete/{sub}', [SubFormController::class, 'destroy'])->name('sub.asisten.delete');
	});

});

require __DIR__.'/auth.php';
