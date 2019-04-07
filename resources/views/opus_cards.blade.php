@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Opus Cards

                        <a href="{{ url('/link_opus_card') }}" class="float-right btn-primary btn">Link another Opus
                            Card to the Account
                        </a>
                    </div>

                    <div class="card-body">
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div><br/>
                        @endif
                        @if(session()->get('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div><br/>
                        @endif
                        @if(!$opus_cards->isEmpty())
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Name</th>
                                    <th> Opus Card Number</th>
                                    <th> Email ID</th>
                                    <th> Opus Card Expiry Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($opus_cards as $opus_card)
                                    <tr>
                                        <td> {{$opus_card->id}} </td>
                                        <td> {{$opus_card->name}} </td>
                                        <td> {{$opus_card->number}} </td>
                                        <td> {{$opus_card->email}} </td>
                                        <td> {{$opus_card->expiry_date}} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            You don't have any Opus Cards linked to iGo!
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

