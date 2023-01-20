@extends('admin.layout')
@section('title')
    Trang sửa product
@endsection
@section('javascript')
<script>
// fetch(`http://example.com/movies.json`)
//   .then((async response) => await response.json())
//   .then((data) => console.log(data));
console.log(1);
const APP_ID = 'cf26e7b2c25b5acd18ed5c3e836fb235';
console.log(APP_ID);
  fetch(`https://api.openweathermap.org/data/2.5/weather?q=ha noi&appid=${APP_ID}&units=metric&lang=vi`)
        .then(async res => {
            const data = await res.json();
            console.log(1);
        });
</script>
@endsection