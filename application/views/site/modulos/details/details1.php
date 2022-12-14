<section>
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-md-5">
                <img class="img-fluid" src="<?= base_url('assets/_img/carousel-placeholder.svg') ?>" alt="">
            </div>
            <div class="col-md-7">
                <form action="<?= base_url('contract/'.$plano->id_category. '/' .$plano->id) ?>">
                    <h2><?= $plano->name ?></h2>
                    <p><?= $plano->description ?></p>
                    <div class="row mb-2">
                        <?php if($plano->monthly_value != '') : ?>
                        <div class="col-md-6">
                            <div class="form-check mt-3">
                                <input name="assinatura" class="form-check-input" type="radio" value="" id="mensal">
                                <label class="form-check-label" for="mensal">
                                    Assinatura mensal (<?= $plano->monthly_value ?>)
                                </label>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($plano->quarterly_discount_value != '') : ?>
                        <div class="col-md-6">
                            <div class="form-check mt-3">
                                <input name="assinatura" class="form-check-input" type="radio" value="" id="trimestral">
                                <label class="form-check-label" for="trimestral">
                                    Assinatura trimestral (<?= $plano->quarterly_discount_value ?>)
                                </label>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($plano->semester_discount_value != '') : ?>
                        <div class="col-md-6">
                            <div class="form-check mt-3">
                                <input name="assinatura" class="form-check-input" type="radio" value="" id="semestral">
                                <label class="form-check-label" for="semestral">
                                    Assinatura semestral (<?= $plano->semester_discount_value ?>)
                                </label>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($plano->annual_discount_value != '') : ?>
                        <div class="col-md-6">
                            <div class="form-check mt-3">
                                <input name="assinatura" class="form-check-input" type="radio" value="" id="anual">
                                <label class="form-check-label" for="anual">
                                    Assinatura anual (<?= $plano->annual_discount_value ?>)
                                </label>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <p class="mb-1"><b>Carência: </b><?= $plano->carencia ?></p>
                    <p class="mb-3"><b>Telefone da assistência: </b><?= $plano->phone_assistance ?></p>
                    <button class="btn btn-primary" type="submit">Contratar</button>
                </form>
            </div>
        </div>
    </div>
</section>