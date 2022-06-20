@extends('backend.layouts.master')

@section('title', 'Seach Reports')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-search icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Search Reports

                </div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('admin.categories.index') }}" class="mr-3 btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    All Categories
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <form action="{{ route('admin.search.date.reports') }}" method="post">
                            @csrf
                            <label for="date">Date Select</label>
                            <input class="form-control @error('date') is-invalid @enderror" type="date" name="date">
                            @error('date')
                                <p>
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </p>
                            @enderror
                            <button type="submit" class="btn btn-primary" style="margin-top:20px;">Search</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <form action="{{ route('admin.search.month.reports') }}" method="post">
                            @csrf
                            <label for="month">Month select</label>
                            <select class="form-control @error('month') is-invalid @enderror" name="month" id="month">
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="Septemer">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                            @error('month')
                                <p>
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </p>
                            @enderror
                            <button type="submit" class="btn btn-primary" style="margin-top:20px;">Search</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <form action="{{ route('admin.search.year.reports') }}" method="post">
                            @csrf
                            <label for="year">Year select</label>
                            <select class="form-control @error('year') is-invalid @enderror" name="year" id="year">
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                            </select>
                            @error('year')
                                <p>
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </p>
                            @enderror
                            <button type="submit" class="btn btn-primary" style="margin-top:20px;">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
