<?php

use App\Models\Submissions;
use App\Models\Nilai;
use App\Models\StartUjian;
use App\Models\HistoryUjian;
use App\Models\ProjectGallery;
use App\Models\Soal;
use jazmy\FormBuilder\Models\Submission;
use App\Models\AssignmentProject;
use Carbon\Carbon;

function cekTugas($id,$idd)
{
	return $cek = Submissions::where('assigments_id',$id)->where('mahasiswa_id',$idd)->exists();
}

function cekForm()
{
	return $cek = Submission::where('user_id',auth()->user()->id)->exists();
}

function cekProject($id,$idd)
{
	return $cek = AssignmentProject::where('project_id',$id)->where('mahasiswa_id',$idd)->exists();
}

function cekSudahDikerjakan($kd_mapel,$id_siswa)
{
	return $cek = Nilai::where('ujian_id',$kd_mapel)->where('mahasiswa_id',$id_siswa)->exists();
}

function cekMasihDikerjakan($kd_mapel,$id_siswa)
{
	return $cek = StartUjian::where('ujian_id',$kd_mapel)
		->where('mahasiswa_id',$id_siswa)
		->where('is_active',1)->count();
}

function cekFoto($id)
{
	return ProjectGallery::where('assigment_project_id',$id)->count();
}

function waktu($date)
{
	$status = '';
	$now = Carbon::parse(Carbon::now())->format('Y-m-d');
	if($date == $now){
		$status = True;
	}
	else{
		$status = False;
	}
	return $status;
}

function getJumlahSoal($ujian_id)
{
	return $jumlah_soal = Soal::where('ujian_id',$ujian_id)->count();
}

function jawaban_benar($kd_mapel,$id_siswa)
{
	return $cek = HistoryUjian::whereHas('soal', function($q) use ($kd_mapel){
		$q->where('ujian_id', $kd_mapel);
	 })->where('mahasiswa_id',$id_siswa)->where('betul_or_tidak',1)->count();
}

function jawaban_salah($kd_mapel,$id_siswa)
{
	return $cek = HistoryUjian::whereHas('soal', function($q) use ($kd_mapel){
		$q->where('ujian_id', $kd_mapel);
	 })->where('mahasiswa_id',$id_siswa)->where('betul_or_tidak',0)->count();
}


function tess($kd_soal,$id_siswa)
{
	return HistoryUjian::where('soal_id',$kd_soal)
		->where('mahasiswa_id',$id_siswa)->exists();
}

function tes($kd_soal,$id_siswa)
{
	$cek = HistoryUjian::where('soal_id',$kd_soal)
		->where('mahasiswa_id',$id_siswa)->first();
	return $cek['your_answer'];
}

function cekSdhJawabSoal($kd_soal,$id_siswa)
{
	return $cek = HistoryUjian::where('soal_id',$kd_soal)
		->where('mahasiswa_id',$id_siswa)->exists();
}

function cekjawaban($kd_soal,$jawaban)
{
	$cek = Soal::where('id',$kd_soal)->where('right_answer',$jawaban)->count();
	return $cek;
}

function CekRagu2($kd_soal)
{
	$cek = HistoryUjian::where('soal_id',$kd_soal)
		->where('mahasiswa_id',auth()->user()->mahasiswa->id)->where('yakin_or_not',0)->count();
	return $cek;
}

function CekRagu($ujian_id)
{
	$ragu = HistoryUjian::whereHas('soal', function($q) use ($ujian_id){
		$q->where('ujian_id', $ujian_id);
	 })
        ->where('mahasiswa_id',auth()->user()->mahasiswa->id)->where('yakin_or_not',0)->count();
	return $ragu;
}

function CekYakin($kd_soal)
{
	$cek = HistoryUjian::where('soal_id',$kd_soal)
		->where('mahasiswa_id',auth()->user()->mahasiswa->id)->where('yakin_or_not',1)->count();
	return $cek;
}

function CekYourAnswer($kd_soal)
{
	$cek = HistoryUjian::where('soal_id',$kd_soal)
		->where('mahasiswa_id',auth()->user()->mahasiswa->id)->first();
	return $cek['your_answer'];
}

function CekPengerjaan($value, $jawabanAnda, $jawabanBenar)
{
	$status = '';
	if($jawabanAnda == $jawabanBenar && $value == $jawabanAnda){
		$status = 'text-green-500';
	}elseif($jawabanAnda != $jawabanBenar && $value == $jawabanAnda){
		$status = 'text-red-500';
	}
	return $status;
}




