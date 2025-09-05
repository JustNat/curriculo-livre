@extends('template')
@section('content')

    <div class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl p-8">
            <h1 class="text-2xl font-bold text-center text-blue-600 mb-6">
                Curriculo Livre
            </h1>
            <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">
                Formulário de Candidatura
            </h2>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('candidacy.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome completo</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input type="email" name="email" id="email" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                    <input type="tel" name="phone" id="phone" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="desired_role" class="block text-sm font-medium text-gray-700">Cargo desejado</label>
                    <input type="text" name="desired_role" id="desired_role" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="education_level" class="block text-sm font-medium text-gray-700">Escolaridade</label>
                    <select name="education_level" id="education_level" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Selecione...</option>
                        <option value="MIDDLE_SCHOOL">Ensino Fundamental</option>
                        <option value="HIGH_SCHOOL">Ensino Médio</option>
                        <option value="UNDERGRADUATE">Graduação</option>
                        <option value="POSTGRADUATE">Pós-Graduação</option>
                        <option value="MASTER">Mestrado</option>
                        <option value="PHD">Doutorado</option>
                    </select>
                </div>

                <div>
                    <label for="observations" class="block text-sm font-medium text-gray-700">Observações (opcional)</label>
                    <textarea name="observations" id="observations" rows="3"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>

                <div>
                    <label for="cv_file" class="block text-sm font-medium text-gray-700">Currículo (PDF, DOC, DOCX até
                        1MB)</label>
                    <input type="file" name="cv_file" id="cv_file" required accept=".pdf,.doc,.docx"
                        class="mt-1 block w-full text-sm text-gray-700 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500">
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-3 px-4 bg-blue-600 text-white font-bold rounded-lg shadow-md hover:bg-blue-500 transition">
                        Enviar Candidatura
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection