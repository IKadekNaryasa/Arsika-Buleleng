@props(['bidangs'])
<form action="{{ route('user.store') }}" method="post">
    @csrf
    <input type="text" name="name" placeholder="name">
    <input type="email" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
</form>