@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                    <div class="card-body">
                        <table>
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>Сумма вклада</td>
                                <td>Процент</td>
                                <td>Количество текущих начислений</td>
                                <td>Сумма начислений</td>
                                <td>Статус депозита</td>
                                <td>Дата</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(Auth::user()->deposits as $deposit)
                                <tr>
                                    <td>{{$deposit->id}}</td>
                                    <td>{{$deposit->invested}}</td>
                                    <td>{{$deposit->percent*100}}%</td>
                                    <td>{{$deposit->accrue_times}}</td>
                                    <td>{{$deposit->profit}}</td>
                                    <td>@if($deposit->active)Активен@elseНеакивен@endif</td>
                                    <td>{{$deposit->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body">
                        <table style="width: 100%">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>Тип</td>
                                <td>Сумма</td>
                                <td>Дата</td>
                            </tr>
                            </thead>
                            <tbody>
{{--                            {{dd(Auth::user()->transactions)}}--}}
                            @foreach(Auth::user()->transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->id}}</td>
                                    <td>{{$transaction->type}}</td>
                                    <td>{{$transaction->amount}}</td>
                                    <td>{{$transaction->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
