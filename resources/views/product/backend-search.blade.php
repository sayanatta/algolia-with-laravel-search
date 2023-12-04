@extends('layout.layout')
@section('contents')
    <div class="carts">
        <form action="{{ route('search') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-9 mt-2">
                    <input type="text" class="form-control" value="{{ $search }}" name="search" id="search"
                        placeholder="Search here..." autocomplete="off">
                </div>
                <div class="col-md-1 mt-2">
                    <button type="submit" id="search_submit" class="btn btn-success">Search</button>
                </div>
                <div class="col-md-1 mt-2">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Filter
                        </a>

                        <ul class="dropdown-menu" style="padding: 10px;">
                            <li>
                                <div class="form-group">
                                    <div class="form-check" onclick="search_submit()">
                                        <input class="form-check-input" type="radio" name="filter" id="exampleRadios1"
                                            value="a_to_z" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            A to Z
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form-group">
                                    <div class="form-check" onclick="search_submit()">
                                        <input class="form-check-input" type="radio" name="filter" id="exampleRadios2"
                                            value="z_to_a">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Z to A
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>

                                <div class="form-group">
                                    <div class="form-check" onclick="search_submit()">
                                        <input class="form-check-input" type="radio" name="filter" id="exampleRadios3"
                                            value="low_to_high">
                                        <label class="form-check-label" for="exampleRadios3">
                                            Low to High
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form-group">
                                    <div class="form-check" onclick="search_submit()">
                                        <input class="form-check-input" type="radio" name="filter" id="exampleRadios3"
                                            value="high_to_low">
                                        <label class="form-check-label" for="exampleRadios3">
                                            High to Low
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-1 mt-2">
                    <a href="{{ route('backend_search') }}" class="btn btn-warning">Clear</a>
                </div>
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control" value="{{ $min_price }}" name="min_price" id="min_price"
                        placeholder="Min price" autocomplete="off">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control" value="{{ $max_price }}" name="max_price" id="max_price"
                        placeholder="Max price" autocomplete="off">
                </div>
            </div>
        </form>
        <div class="row mt-2">
            @if ($products)
                @foreach ($products as $product)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">Price: KD {{ $product->price }}</p>
                                <p class="card-text">{!! $product->description !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @push('scripts')
        <script>
            const search_submit = () => {
                $("#search_submit").click();
            }
        </script>
    @endpush
@endsection
