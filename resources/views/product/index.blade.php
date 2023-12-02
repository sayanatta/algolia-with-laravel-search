@extends('layout.layout')
@section('contents')
    <div class="carts">
        <div class="row">
            <div id="searchbox" style="padding: 8px"></div>
            <div id="range-slider" style="padding: 8px"></div>
            <div id="hits" style="padding: 8px"></div>
            <div id="pagination" style="padding: 8px"></div>
        </div>
    </div>
    @push('scripts')
        <script>
            const searchClient = algoliasearch(
                '{{ config('scout.algolia.id') }}',
                '{{ Algolia\ScoutExtended\Facades\Algolia::searchKey(App\Models\Product::class) }}'
            );

            const search = instantsearch({
                indexName: 'products',
                searchClient,
            });

            search.addWidgets([
                instantsearch.widgets.searchBox({
                    container: '#searchbox',
                }),

                instantsearch.widgets.rangeSlider({
                    container: '#range-slider',
                    attribute: 'price',
                    min: 10,
                    max: 200,
                }),

                instantsearch.widgets.configure({
                    hitsPerPage: 2,
                }),

                instantsearch.widgets.pagination({
                    container: '#pagination',
                    showFirst: true,
                    showPrevious: true,
                    showNext: true,
                    showLast: true,
                    padding: 1,
                    totalPages: 3,
                }),

                instantsearch.widgets.hits({
                    container: '#hits',
                    templates: {
                        item(hit, {
                            html,
                            components
                        }) {
                            return html`
                <p><b>Name:-</b> ${hit.name}</p>
                <p><b>Price:-</b> KD ${hit.price}</p>
                <p><b>Description:-</b> ${hit.description}</p>
              `;
                        },
                    },
                })
            ]);

            search.start();
        </script>
    @endpush
@endsection
