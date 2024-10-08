<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import File</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Importer votre fichier CSV, XLS ou autre</h2>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Choisir un fichier</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Importer</button>
                </form>
            </div>
        </div>
        <div class="container mt-5">
            <h1 class="mb-4">Données Importées</h1>

            @if ($imports->isEmpty())
                <div class="alert alert-info" role="alert">
                    Aucune donnée importée.
                </div>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Shift</th>
                            <th>Timetable</th>
                            <th>Attendance Status</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <!-- Ajoutez d'autres colonnes si nécessaire -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($imports as $import)
                            <tr>
                                <td>{{ $import->name }}</td>
                                <td>{{ $import->department }}</td>
                                <td>{{ $import->date }}</td>
                                <td>{{ $import->shift }}</td>
                                <td>{{ $import->timetable }}</td>
                                <td>{{ $import->attendance_status }}</td>
                                <td>{{ $import->check_in }}</td>
                                <td>{{ $import->check_out }}</td>
                                <!-- Ajoutez d'autres colonnes si nécessaire -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
