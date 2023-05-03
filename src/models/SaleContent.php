<?php

namespace CashRegister\models;

class SaleContent {

    /** @var Product $product product id */
    private Product $product;
    /** @var Sale $sale ticket id */
    private Sale $sale;

    /** @var int $quantity product quantity */
    private int $quantity;

    /**
     * @param Product $product
     * @param Sale $sale
     * @param int $quantity
     */
    public function __construct(Product $product, Sale $sale, int $quantity) {
        $this->product = $product;
        $this->sale = $sale;
        $this->quantity = $quantity;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void {
        $this->product = $product;
    }

    /**
     * @return Sale
     */
    public function getSale(): Sale {
        return $this->sale;
    }

    /**
     * @param Sale $sale
     */
    public function setSale(Sale $sale): void {
        $this->sale = $sale;
    }

    /**
     * @return int
     */
    public function getQuantity(): int {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }

}