<form action="{{ route('postFile', ['workspace' => $workspace, 'card' => $card]) }}" method="POST"
    enctype='multipart/form-data'>
    @csrf
    <input type="file" name="file">
    <button>send</button>
</form>
<img src="{{ asset('storage/2.png') }}" alt="">
@if (isset($message))
    {{ $message }}
@endif
