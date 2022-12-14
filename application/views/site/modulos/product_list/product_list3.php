<section class="big-p">
    <div class="product-box-style"></div>
    <div class="container">
        <div class="container d-flex thtitle text-white align-items-center justify-content-between mt-5 pt-4">
            <h3 class="text-white">Lista de produtos ou serviços</h3>
            <a class="text-white" href="">ver todos</a>
        </div>
        <div class="container py-5">
            <div class="row">
                <?php foreach ($planos as $p) : ?>
                <div class="col-md-3 mtop-md-2 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="product-img"></div>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-primary">
                                <?= $p->name ?>
                            </p>
                            <!-- <small class="shop-old text-primary">De <span>R$1.199,99</span> por</small> -->
                            <h5 class="card-title shop-price text-primary">
                                <?= $p->monthly_value == '' ? $p->value : $p->monthly_value ?>
                                <?php if ($p->quarterly_discount_value != '') : ?>
                                <span>↓<?= $p->quarterly_discount_value ?></span>
                                <?php endif; ?>
                            </h5>
                            <a href="<?= base_url('home/plan/'.$p->id) ?>"
                                class="mt-3 btn btn-primary cart-baloon rounded">Detalhes
                                do plano</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>