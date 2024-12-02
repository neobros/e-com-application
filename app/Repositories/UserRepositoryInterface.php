<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getCartData($id);
    public function getBrandList();
    public function getProductList();
    public function getSingleUserData($id);

    public function getProductData($product_id);
    public function getCartDetails($product_id , $customer_id);
    public function getProductCartData($customer_id);
    public function getRateData($customer_id , $product_id);
    public function getCartAndProductData($customer_id);
    public function getTotalPrice($customer_id);

    public function login(array $credentials);
    public function logout($role);
    public function register(array $credentials);
    public function updateUserProfile(array $data ,$id );
    public function updateCartSize($cart_id, array $data);
    // public function updateQuantity($cart_id, array $data);
    public function removeCart($cart_id);
    public function updateRate(array $rateData,$customer_id ,$product_id);

    public function addToCart(array $data);
}