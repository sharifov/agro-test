<?php

use Agro\View\View;
use Agro\Entities\ProductEntity;

/**
 * @var View $this
 * @var ProductEntity[] $products
 * @var int $sum
 */

?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Tax номер</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container pt-4">
            <?php if ($this->hasError()) { ?>
                <p class="alert alert-danger">Ошибка: <?= $this->getError() ?></p>
            <?php } elseif (isset($sum)) { ?>
                <p class="alert alert-success">Рассчетная сумма составляет: <?= $sum ?></p>
            <?php } ?>
            <form action="" method="post">
                <p>
                    <label for="product">Выберите товар:</label>
                    <select name="product_id" class="form-control" id="product">
                        <?php if ($products !== []) { ?>
                            <?php foreach ($products as $product) { ?>
                                <option value="<?= $product->getId() ?>"><?= $product->getTitle() ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </p>
                <p>
                    <label for="tax_number">Введите tax номер:</label>
                    <input type="text" class="form-control" name="tax_number" placeholder="DE66666666" id="tax_number"/>
                </p>
                <p class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg" name="calculate_sum">
                        Рассчитать сумму
                    </button>
                </p>
            </form>
        </div>
    </body>
</html>