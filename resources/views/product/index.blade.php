@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')

<style>
    .card {
        min-height: 400px; 
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-img-top {
        height: 250px; 
        object-fit: cover; 
    }

    .card-body {
        flex-grow: 1; 
        display: flex;
        flex-direction: column;
        justify-content: flex-end; 
        padding: 10px;
    }

    .card-body p {
        margin-bottom: 5px; 
    }

    .price {
        margin-top: 0; 
        font-size: 1.2rem;
    }

    .btn {
        margin-top: 10px; 
        font-size: 1rem; 
    }
</style>

<div class="row" id="product-list">
    @foreach ($viewData["products"] as $product)
        <div class="col-md-4 col-lg-4 mb-4"> 
            <div class="card shadow-sm border-light rounded">
                <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top img-card" alt="{{ $product->getName() }}">
                <div class="card-body text-center">
                    <p class="price text-dark fw-bold">${{ $product->getPrice() }}</p>
                    <a href="{{ route('product.show', ['id'=> $product->getId()]) }}" class="btn btn-dark w-100 text-white fw-bold rounded-pill">{{ $product->getName() }}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div id="loading-indicator" style="display: none; text-align: center;">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Cargando...</span>
    </div>
    <p class="mt-3">Cargando más productos...</p>
</div>

@endsection

@section('scripts')
<script>
    let page = 2; 
    let loading = false;
    let hasMoreProducts = true;  

    window.addEventListener('scroll', function () {
        let productList = document.getElementById('product-list');
        let productListHeight = productList.offsetHeight; 
        let scrollPosition = window.innerHeight + window.scrollY; 

        if (scrollPosition >= productListHeight - 200 && !loading && hasMoreProducts) {
            loading = true;
            document.getElementById('loading-indicator').style.display = 'block'; 

            fetch(`/products/load-more?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    if (data.products.length > 0) {
                        let productList = document.getElementById('product-list');
                        data.products.forEach(product => {
                            let productCard = `
                                <div class="col-md-4 col-lg-4 mb-4">
                                    <div class="card shadow-sm border-light rounded">
                                        <img src="/storage/${product.image}" class="card-img-top img-card" alt="${product.name}">
                                        <div class="card-body text-center">
                                            <p class="price text-dark fw-bold">$${product.price}</p>
                                            <a href="/products/${product.id}" class="btn btn-dark w-100 text-white fw-bold rounded-pill">${product.name}</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                            productList.innerHTML += productCard; 
                        });

                        page = data.nextPage;

                        if (data.nextPage === null) {
                            hasMoreProducts = false; 
                        }
                    }

                    document.getElementById('loading-indicator').style.display = 'none';
                    loading = false; 
                })
                .catch(() => {
                    document.getElementById('loading-indicator').style.display = 'none'; 
                    loading = false; 
                });
        }
    });
</script>
@endsection
