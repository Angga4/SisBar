<form action="{{ route('manual.logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Logout Manual</button>
</form>
