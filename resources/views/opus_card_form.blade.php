@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <style>
                        .uper {
                            margin-top: 40px;
                        }
                    </style>
                    <div class="card uper">
                        <div class="card-header">
                            Link Opus Card
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                            <form method="post" action="{{ url('/link_opus_card') }}" >

                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <label for="name">Traveller Name:</label>
                                    <input type="text" class="form-control" name="traveller_name"/>
                                </div>
                                <div class="form-group">
                                    <label for="email">Traveller Email ID :</label>
                                    <input type="email" class="form-control" name="traveller_email"/>
                                </div>
                                <div class="form-group">
                                    <label for="number">Opus Card Number:</label>
                                    <input type="number" class="form-control" name="opus_card_number"/>
                                </div>
                                <div class="form-group">
                                    <label for="number">Opus Card Expiry Date:</label>
                                    <input type="date" class="form-control" name="opus_card_expiry_date"/>
                                </div>
                                <button type="submit" class="btn btn-primary">Link to iGo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

