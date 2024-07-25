<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>Applicants for Your Vacancies</h1>

                    @foreach($applications as $application)
                    <hr>
                    <h4>აპლიკანტის სახელი</h4>
                  
                    <p>{{ $application->name }}</p>

                    <h4>აპლიკანტის მეილი</h4>
                    <p>{{ $application->email }}</p>
                    
                    <h4>აპლიკანტის სამოტივაციო წერილი</h4>
                    <p>{{ $application->motivation }}</p>

                    <hr>
                     
                    @endforeach
           
        
                    
    </div>
</body>
</html>