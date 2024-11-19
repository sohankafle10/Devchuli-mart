@if (Session::has ('success'))


<div class="fixed flex justify-center top-0 right-0 left-0 z-50 " id="message">
    <p class="text-lg font-bold bg-blue-900 text-white px-5 py-2 rounded-b-lg">{{session('success')}} </p>
</div>

<script>
    setTimeout(() => {
        document.getElementById("message").style.display='none';
    }, 2500);
</script>
@endif
