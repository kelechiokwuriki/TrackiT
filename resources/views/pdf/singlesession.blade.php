<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Session</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr class="table-danger">
        <td>Name</td>
        <td>Type</td>
        <td>Weight Number</td>
        <td>Reps</td>
        <td>Sets</td>
      </tr>
      </thead>
      <tbody>
        @foreach ($session->exercises as $exercise)
        <tr>
            <td>{{ $exercise->name }}</td>
            <td>{{ $exercise->type }}</td>
            <td>{{ $exercise->weight_number }} kg</td>
            <td>{{ $exercise->sets }}</td>
            <td>{{ $exercise->reps }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>