@if(session()->has('message'))
<!-- <div class="fixed top-0 transform left-1/2 -translate-x-1/2 bg-laravel text-white px-48 py-3">
    <p>
        {{session('message')}}
    </p>
</div> -->
<!-- Abaixo uma modificação com alpine JS, neste caso exibe a mensagem por apenas 3 segundos-->
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show ="show"  class="fixed top-0 transform left-1/2 -translate-x-1/2 bg-laravel text-white px-48 py-3">
    <p>
        {{session('message')}}
    </p>
</div>
@endif