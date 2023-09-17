<form method="POST" action="{{ url('/google-drive-upload') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" />
    <button type="submit">Upload file</button>
</form>