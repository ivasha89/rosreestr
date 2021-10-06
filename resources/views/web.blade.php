@extends('welcome')

@section('content')
    <table class='table table-bordered mt-3'>
        <thead>
            <tr>
                <th>Кадастровый номер</th>
                <th>Адрес</th>
                <th>Стоимость</th>
                <th>Площадь</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plots as $plot)
                <tr>
                    <td>{{ $plot['number'] }}</td>
                    <td>{{ $plot['address'] }}</td>
                    <td>{{ $plot['cad_cost'] . " ₽" }}</td>
                    <td>{{ $plot['area_value'] . " "}} м<sup>2</sup></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection