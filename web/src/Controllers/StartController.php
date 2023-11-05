<?php

namespace Agro\Controllers;

use Agro\Exceptions\TaxException;
use Agro\Services\CalculateService;
use Agro\Services\TaxParseService;
use Agro\System\BaseController;
use Agro\Validators\TaxValidator;
use InvalidArgumentException;

class StartController extends BaseController
{
    public function index(): void
    {
        $renderData = [
            'products' => $this->getFakeData()->getProducts(),
        ];

        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $taxNumber = $this->normalizeData($_POST['tax_number']);
            $productId = $this->normalizeData($_POST['product_id'], true);

            if (!TaxValidator::validateTaxNumber($taxNumber)) {
                $this->view()->setError(TaxValidator::getValidatorError());
            } elseif (!TaxValidator::validateProductId($productId)) {
                $this->view()->setError(TaxValidator::getValidatorError());
            } else {
                try {
                    $taxService = new TaxParseService();
                    $taxService->setTaxNumber($taxNumber);
                    $taxService->setPattern(TaxParseService::DEFAULT_PATTERN);

                    $country = $this->getFakeData()->getCountryByCode($taxService->parse());
                    $product = $this->getFakeData()->getProductById($productId);

                    $calculateService = new CalculateService($product, $country);
                    $calculateService->calculate();

                    $renderData['sum'] = $calculateService->getMoneyFormat();
                } catch (InvalidArgumentException|TaxException $e) {
                    $this->view()->setError($e->getMessage());
                }
            }
        }
        $this->view()->render($renderData);
    }

    private function normalizeData(string $tax_number, bool $isInt = false): string
    {
        $clearData = trim(htmlspecialchars($tax_number));

        return $isInt ? abs((int) $clearData) : $clearData;
    }
}
