<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->config->item('app_name') ?></title>
    
</head>
<body>
<nav class="pt-3">
<!--FALE CONOSCO-->
<div class="container">
    <div class="nav-head pb-3 row">
        <div class="col-md-6 d-flex align-items-center">
            <div class="rounded-user-pic"></div>
            <div class="buble bg-primary text-white">Fale conosco</div>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-md-end md-center">
            <div class="input-group input-group-merge me-md-4">
                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                <input type="text" class="form-control" placeholder="Buscar..." aria-label="Buscar..."
                    aria-describedby="basic-addon-search31">
            </div>
            <div class="d-flex align-items-center">
                <a class="text-primary d-flex align-items-center me-3" href="">
                    <i class="me-2 fa-solid fa-user"></i>
                    <span>Login</span>
                </a>
                <a class="cart-box bg-primary" href="" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd"
                    aria-controls="offcanvasEnd">
                    <span class="bg-primary text-white">3</span>
                    <i class="text-white fa-solid fa-cart-shopping"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!--FIM FALE CONOSCO-->
<!--INICIO ITENS PARA VENDA-->
<div class="nav-items bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <select class="form-select" id="exampleFormControlSelect1" style="border-radius:0;"
                    aria-label="Default select example">
                    <option selected="">Itens para venda</option>
                    <option value="1">um</option>
                    <option value="2">dois</option>
                    <option value="3">tres</option>
                </select>
            </div>
            <div class="col-md-9 d-flex align-items-center justify-content-md-end md-center">
                <ul class="topnav-items list-unstyled md-py-3 md-column">
                    <li>
                        <a href="">
                            Quem somos
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Serviços Prestados
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Nossos Clientes
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Projetos Criados
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--FIM ITENS PARA VENDA-->
</nav> <!--FIM DA NAV-->
<!--INICIO CARRINHO-->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel"
aria-hidden="true" style="visibility: hidden;">
<div class="offcanvas-header">
    <h5 id="offcanvasEndLabel" class="offcanvas-title">Carrinho</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div>
    <div class="offcanvas-body mx-0 flex-grow-0">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img class="card-img card-img-left"
                        src="https://returntofreedom.org/store/wp-content/uploads/shop-placeholder.png"
                        alt="Card image">
                </div>
                <!--INICIO CARD-->
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <!--FIM CARD 1-->
            </div>
        </div>
        <!--INICIO CARD 2-->
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img class="card-img card-img-left"
                        src="https://returntofreedom.org/store/wp-content/uploads/shop-placeholder.png"
                        alt="Card image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
        <!--FIM DO CARD 2-->
    </div>
    <button class="btn btn-primary">Ir para o carrinho</button>
</div>
</div>
<!--FIM DO CARRINHO-->
<div class="container py-4">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-img" style="background-image:url(<?= base_url('assets/_img/carousel-placeholder.svg') ?>)"></div>
            </div>
            <div class="carousel-item">
                <div class="carousel-img" style="background-image:url(<?= base_url('assets/_img/carousel-placeholder.svg') ?>)"></div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>

</div>
<!--INICIO LISTA DE PRODUTOS-->
<div class="container py-5">
    <div class="row">
        <div class="col-md-3 mtop-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="product-img"></div>
                </div>
                <div class="card-body">
                    <p class="card-text text-primary">
                        Aqui o nome do seu produto destaque
                    </p>
                    <small class="shop-old text-primary">De <span>R$1.199,99</span> por</small>
                    <h5 class="card-title shop-price text-primary"><small>R$</small> 764,99 <span>↓ 25%</span></h5>
                    <a href="" class="mt-3 btn btn-primary cart-baloon rounded"><img width="25px"
                            src="<?= base_url('assets/_img/cart-plus-icon.svg') ?>" alt="">Adicionar ao carrinho</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mtop-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="product-img"></div>
                </div>
                <div class="card-body">
                    <p class="card-text text-primary">
                        Aqui o nome do seu produto destaque
                    </p>
                    <small class="shop-old text-primary">De <span>R$1.199,99</span> por</small>
                    <h5 class="card-title shop-price text-primary"><small>R$</small> 764,99 <span>↓ 25%</span></h5>
                    <a href="" class="mt-3 btn btn-primary cart-baloon rounded"><img width="25px"
                            src="<?= base_url('assets/_img/cart-plus-icon.svg') ?>" alt="">Adicionar ao carrinho</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mtop-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="product-img"></div>
                </div>
                <div class="card-body">
                    <p class="card-text text-primary">
                        Aqui o nome do seu produto destaque
                    </p>
                    <small class="shop-old text-primary">De <span>R$1.199,99</span> por</small>
                    <h5 class="card-title shop-price text-primary"><small>R$</small> 764,99 <span>↓ 25%</span></h5>
                    <a href="" class="mt-3 btn btn-primary cart-baloon rounded"><img width="25px"
                            src="<?= base_url('assets/_img/cart-plus-icon.svg') ?>" alt="">Adicionar ao carrinho</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mtop-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="product-img"></div>
                </div>
                <div class="card-body">
                    <p class="card-text text-primary">
                        Aqui o nome do seu produto destaque
                    </p>
                    <small class="shop-old text-primary">De <span>R$1.199,99</span> por</small>
                    <h5 class="card-title shop-price text-primary"><small>R$</small> 764,99 <span>↓ 25%</span></h5>
                    <a href="" class="mt-3 btn btn-primary cart-baloon rounded"><img width="25px"
                            src="<?= base_url('assets/_img/cart-plus-icon.svg') ?>" alt="">Adicionar ao carrinho</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--FIM LISTA DE PRODUTOS-->
<footer>
    <div class="bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="topb-medias col-md-6 py-3 mtop-md-4 d-flex align-items-center md-center">
                        <a class="me-2" href=""><i class="fa-brands fa-facebook"></i></a>
                        <a class="me-2" href=""><i class="fa-brands fa-instagram"></i></a>
                        <a class="me-2" href=""><i class="fa-brands fa-youtube"></i></a>
                        <a class="me-2" href=""><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-4 text-white d-flex justify-content-md-end justify-sm-center">
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <i class="fa-regular fa-clock"></i>
                            <span>24 horas</span>
                        </div>
                        <a class="text-white d-flex align-items-center me-3" href="">
                            <i class="me-2 fa-solid fa-user"></i>
                            <span>Login</span>
                        </a>
                    </div>

                </div>
                <div class="col-md-4 p-0 mtop-md-4">
                    <div
                        class="d-flex py-3 fw-bold align-items-center text-primary justify-content-between px-5 bg-quartenary">
                        <span>R$ 00,00</span>
                        <a class="d-flex align-items-center me-2 ms-5" href="">
                            <i class="me-2 text-primary fa-solid fa-cart-shopping"></i>
                            Ver carrinho
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-quartenary">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pt-5">
                    <div class="rounded-user-pic" style="width:100px;height:100px;"></div>
                    <p class="text-primary py-4">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum doloribus iste voluptatum officiis
                        atque ducimus.
                    </p>
                    <ul class="list-unstyled p-0">
                        <li class="text-primary fw-bold">
                            <i class="me-2 fa-brands fa-whatsapp"></i>
                            (51) 9 99999-9999
                        </li>
                        <li class="text-primary fw-bold">
                            <i class="me-2 fa-solid fa-phone"></i>
                            (51) 9 99999-9999
                        </li>
                        <li class="text-primary fw-bold">
                            <i class="me-2 fa-solid fa-envelope"></i>
                            dev@agenciabrasildigital.com.br
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 pt-5 text-primary">
                    <h4 class="text-primary fw-bold">Categorias de Produto</h4>
                    <ul class="list-unstyled p-0">
                        <li>Categoria 1</li>
                        <li>Categoria 2</li>
                        <li>Categoria 3</li>
                        <li>Categoria 4</li>
                    </ul>
                </div>
                <div class="col-md-4 bg-primary py-3">
                    <div class="form-header py-3 d-flex flex-column justify-content-center align-items-center">
                        <i class="fs-2 mb-3 fa-solid text-white fa-envelope"></i>
                        <span class="text-white text-center">Receber <b>novidades<br>e promoções</b></span>
                    </div>
                    <hr>
                    <form class="px-4" action="" method="post">
                        <div>
                            <label for="defaultFormControlInput" class="form-label text-white">Nome</label>
                            <input type="text" class="form-control" style="border-radius:0;"
                                id="defaultFormControlInput" placeholder="Seu nome">
                        </div>
                        <div class="mt-3">
                            <label for="defaultFormControlInput" class="form-label text-white">E-mail</label>
                            <input type="text" class="form-control" style="border-radius:0;"
                                id="defaultFormControlInput" placeholder="Seu e-mail">
                        </div>
                        <button class="btn btn-link text-white w-100 mt-3">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-light">
        <div class="container d-flex align-items-center justify-content-between py-3">
            <a class="text-primary fw-bold" href="">Formas de pagamento</a>
            <div class="text-primary d-flex align-items-center">
                <p class="m-0" style="line-height:1;"><span class="text-uppercase fw-bold">site seguro</span><br>
                    <small>Certificado SSL</small>
                </p>
                <i class="fs-3 fa-solid fa-lock"></i>
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="container text-primary py-3">
            <span>CNPJ 12.345.678/0001-10 | Rua dos alfeneiros nº4 - Cidade/RS - CEP 95010-040</span>
        </div>
    </div>
</footer>
</body>
</html>