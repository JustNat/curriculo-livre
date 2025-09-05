<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidacyRequest;
use App\Mail\CandidacyMail;
use App\Models\Candidacy;
use Exception;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CandidacyController extends Controller
{
    public function store(StoreCandidacyRequest $request)
    {
        $data = $request->validated();

        // dd($data);

        $cvFile = $request->file('cv_file');
        $fileName = $this->fomartFileName(file: $cvFile, name: $data['name']);

        $data['sender_ip'] = $request->ip();
        $data['cv_file'] = $fileName;

        try {
            $cvFile->storeAs(path: '', name: $fileName);

            Candidacy::create($data);

            Mail::to($data['email'])->send(new CandidacyMail(
                $data['name'],
                $data['desired_role'],
                $data['education_level'],
                $data['observations'],
                $data['sender_ip'],
            ));

            return redirect()->back()->with('success', 'Candidatura enviada com sucesso');
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->withErrors('Ocorreu um erro ao enviar a candidatura');        
        }
    }

    private function fomartFileName(UploadedFile|null $file, string $name): string
    {
        $fileExtension = $file->getClientOriginalExtension();

        $filename = strtolower(preg_replace('/\s+/', '_', $name))
            . '_' . time()
            . '.' . $fileExtension;

        return $filename;
    }
}
