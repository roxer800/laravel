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
    <p>ვაკანსია</p>
    @csrf
    <img src="{{ asset('storage/' . $vacansies->photo) }}" style="width: 200px" alt="Vacancy Photo">
    <h4>{{$vacansies["name"]}}</h4>
    <h5>{{$vacansies["description"]}}</h5>
    <h5>{{$vacansies["available_at"]}}</h5>
    @auth
    @if(Auth::check() && Auth::id() != $vacansies->users_id)
    <form action="{{ url('/vacancies/' . $vacansies->id . '/apply') }}" method="POST">
        @csrf
        <div>
            <label for="name">თქვენი სახელი:</label>
            <input type="text" name="name" placeholder="name" id="">
        </div>
        <div>
            <label for="email">თქვენი მეილი</label>
            <input type="email" name="email" id="">
        </div>
        <div>
            <label for="motivation">სამოტივაციო წერილი</label>
            <textarea name="motivation" id=""></textarea>
        </div>
        <button value="apply"  type="submit" class="btn btn-primary">Sign Up</button>
    </form>
@else
<form action="/vacancys/{{$vacansies['id']}}" method="POST" >
        @method('delete')
        @csrf
         
        <button type="submit" class="btn btn-danger">ვაკანსიის წაშლა</button>
    </form>
 
    <button class="btn btn-primary" ><a style="color:white" href="{{ route('vacancy.edit', ['vacancy' => $vacansies['id']])}}"> ვაკანსიის რედაქტირება</a>  </button>
@endif
   


    @endauth
    
</body>
</html>