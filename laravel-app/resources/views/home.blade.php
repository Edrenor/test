@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        Баланс вашего счета - {{ Auth::user()->wallet->balance }}
                    </div>
                    <div class="card-body">
                        <form action="{{url('/funds/add')}}" method="post">
                            {{ csrf_field() }}
                            <label for="funds">Сумма для зачисления на счет:</label>
                            <input type="number" id="funds" name="funds"><br><br>
                            <input type="submit">
                        </form>
                    </div>

                    <div class="card-body">
                        <form action="{{url('/deposit/create')}}" method="post">
                            {{ csrf_field() }}
                            <label for="deposit">Сумма для вклада по депозиту (от 10 до 100):</label>
                            <input type="number" id="deposit" name="deposit" min="10" max="100"><br><br>
                            <input type="submit">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
