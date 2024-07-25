<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h3 class="m-3" >profile page</h3>
        @guest
            <h4 class="m-3">განცხადების განსათავსებლად გთხოვთ გაიაროთ რეგისტრაცია</h4>
        @endguest
        <button class=" m-3 btn btn-primary" onclick="redirectToVacancy()">ვაკანსიების ნახვა</button>
        @auth
        <div class="m-5">
            
            <a href="{{ route('vacancy.create') }}" class="btn btn-primary">ვაკანსიის შექმნა</a>
        </div>
        @endauth
        <div>
            
   
           </div>
    </main>
   
</x-app-layout>
<script>
    function   redirectToVacancy(){
        window.location.href = "{{ url('/vacancys') }}";
        }
    
</script>