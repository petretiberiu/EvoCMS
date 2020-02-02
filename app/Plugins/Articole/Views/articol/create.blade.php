@extends('Articole::articol')

@section('articol-section')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Adaugare articol nou</h4>
                    {!! Form::open(['class'=>'forms-sample', 'url'=>'articol', 'method'=>'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('Titlu', 'Titlu'); !!}
                        {!! Form::text('Titlu', '', ['class'=>'form-control', 'placeholder'=>'Titlu']); !!}
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6">
                            {!! Form::label('Categorie', 'Categorie'); !!}
                            {!! Form::text('Categorie', '', ['class'=>'form-control', 'placeholder'=>'Categorie']) !!}
                        </div>
                        <div class="col-md-6 col-lg-6">
                            {!! Form::label('keywords', 'Cuvinte cheie'); !!}
                            {!! Form::text('keywords', '', ['class'=>'form-control', 'placeholder'=>'Keywords...']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="width: 100%;">
                            Continut: <br><br>
                            {!! Form::textarea('Continut', '', ['class'=>'form-control summernote']) !!}
                        </label>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Posteaza', ['class'=>'btn btn-gradient-primary mr-2']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
